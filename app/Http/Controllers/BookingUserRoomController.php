<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class BookingUserRoomController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $now = Carbon::now();

        Booking::where('status', 'pending')
            ->where('booking_start_datetime', '<', $now)
            ->update(['status' => 'rejected']);

        $data = Booking::where('user_id', $userId)
                       ->with(['user', 'room'])
                       ->orderBy('booking_start_datetime')
                       ->get();
        $laboratories = Room::all();

        return view('landing.user.room.room-booking', compact('data', 'laboratories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_purpose' => 'required|string|max:255',
            'responsible' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'booking_start_datetime' => [
                'required',
                'date',
                function ($attribute,$value, $fail){

                    if(empty($value)){
                        $fail('Waktu mulai peminjaman tidak boleh kosong.');
                    }

                    try{
                        $startDateTime = Carbon::parse($value);
                    }catch (\Exception $e) {
                        $fail('Format waktu mulai peminjaman tidak valid.');
                        return;
                    }

                    $now = Carbon::now();
                    if ($startDateTime->lt($now)) {
                        $fail('Waktu peminjaman tidak boleh waktu yang sudah berlalu.');
                    }
                },
            ],
            'booking_end_datetime' => 'required|date|after:booking_start_datetime',
            'room_laboratory_id' => 'required|exists:room_laboratory,id',
            'file_attachment' => 'required|file|max:10240|mimes:pdf,doc,docx'
        ]);


        // Check if the booking start and end times are within the allowed range
        $startDateTime = Carbon::parse($request->booking_start_datetime);
        $endDateTime = Carbon::parse($request->booking_end_datetime);
        $roomLaboratoryId = $request->room_laboratory_id;

        // Check is weekend
        if ($startDateTime->isWeekend() || $endDateTime->isWeekend()) {
            return redirect()->back()->withErrors([
                'booking_start_datetime' => 'Peminjaman tidak dapat dilakukan pada hari Sabtu atau Minggu.'
            ])->withInput();
        }

        // Check working hours
        $workingStartTime = Carbon::createFromTime(7, 30);
        $workingEndTime = Carbon::createFromTime(17, 0);

        $bookingStartTimeOnly = Carbon::createFromTime($startDateTime->hour, $startDateTime->minute);
        $bookingEndTimeOnly = Carbon::createFromTime($endDateTime->hour, $endDateTime->minute);

        if ($bookingStartTimeOnly->lt($workingStartTime) || $bookingEndTimeOnly->gt($workingEndTime)) {
            return redirect()->back()->withErrors([
                'booking_start_datetime' => 'Peminjaman hanya dapat dilakukan antara 07:30 dan 17:00.'
            ])->withInput();
        }

        $breakTimes = [
            ['start' => Carbon::createFromTime(10, 0), 'end' => Carbon::createFromTime(10, 30)],
            ['start' => Carbon::createFromTime(12, 0), 'end' => Carbon::createFromTime(13, 0)],
        ];

        foreach ($breakTimes as $break) {
            if ($startDateTime->lt($break['end']->setDate($startDateTime->year, $startDateTime->month, $startDateTime->day)) &&
                $endDateTime->gt($break['start']->setDate($endDateTime->year, $endDateTime->month, $endDateTime->day))) {
                return redirect()->back()->withErrors([
                    'booking_start_datetime' => 'Peminjaman tidak boleh mencakup waktu istirahat (10:00-10:30 atau 12:00-13:00).'
                ])->withInput();
            }
        }

        $existingApprovedBooking = Booking::where('room_laboratory_id', $roomLaboratoryId)
            ->where('status', 'approved')
            ->where(function ($query) use ($startDateTime, $endDateTime) {
                // Check for overlaps: new booking starts before existing ends AND new booking ends after existing starts
                $query->where('booking_start_datetime', '<', $endDateTime)
                      ->where('booking_end_datetime', '>', $startDateTime);
            })
            ->first();

        if ($existingApprovedBooking) {
            return redirect()->back()->withErrors([
                'room_laboratory_id' => 'Ruangan ini sudah dipesan dan disetujui pada waktu yang Anda pilih. Silakan pilih waktu atau ruangan lain.'
            ])->withInput();
        }

        $bookingDayOfWeek = $startDateTime->locale('id')->dayName;

        // Get the time parts in H:i format for comparison with schedule times
        $bookingTimeStart = $startDateTime->format('H:i');
        $bookingTimeEnd = $endDateTime->format('H:i');
        $bookingDate = $startDateTime->toDateString();


        $existingSchedule = Schedule::where('room_laboratory_id', $roomLaboratoryId)
            ->where('schedule_day_of_week', $bookingDayOfWeek)
            ->where(function ($query) use ($bookingTimeStart, $bookingTimeEnd) {
                // Check for overlaps: new booking starts before existing ends AND new booking ends after existing starts
                $query->where('schedule_start_time', '<', $bookingTimeEnd)
                    ->where('schedule_end_time', '>', $bookingTimeStart);
            })
            ->whereHas('semester', function ($query) use ($bookingDate) {
                $query->where('start_date', '<=', $bookingDate)
                    ->where('end_date', '>=', $bookingDate);
            })
            ->first();

        if ($existingSchedule) {
            return redirect()->back()->withErrors([
                'room_laboratory_id' => 'Ruangan ini sudah terjadwal untuk perkuliahan pada waktu dan hari yang Anda pilih.'
            ])->withInput();
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        if ($request->hasFile('file_attachment')) {
            $file = $request->file('file_attachment');
            $file_ext = $file->extension();
            $file_slug = Str::of($request->booking_purpose);
            $file_name = 'Booking_' . $file_slug . '.' . $file_ext;
            $file->move(public_path('storage/attachments'), $file_name);
            $validated['file_attachment'] = $file_name;
        }

        Booking::create($validated);
        // dd($booking);

        return redirect()->back()->with('success', 'Booking request submitted successfully');
    }
}
