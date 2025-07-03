<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\Booking;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(){
        // $data = \App\Models\Schedule::all();

        $rooms = Room::all();
        $semesters = Semester::where('is_active', true)->get();

        $schedules = Schedule::with(['room', 'semester'])->get();

        $title = 'Jadwal Lab';
        return view('landing.admin.schedule.dashboard-schedule', compact( 'title', 'rooms', 'semesters', 'schedules'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'room_laboratory_id' => 'required|exists:room_laboratory,id',
            'semester_id' => 'required|exists:semesters,id',
            'title_schedule' => 'required|string|max:255',
            'lecturer_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'schedule_day_of_week' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'schedule_start_time' => 'required|date_format:H:i',
            'schedule_end_time' => 'required|date_format:H:i|after_or_equal:schedule_start_time',
        ]);

        $roomLaboratoryId = $validated['room_laboratory_id'];
        $requestedSemesterId = $validated['semester_id'];

        $startDateTime = Carbon::parse($request->schedule_start_time);
        $endDateTime = Carbon::parse($request->schedule_end_time);

        if ($startDateTime->isWeekend() || $endDateTime->isWeekend()) {
            return redirect()->back()->withErrors([
                'schedule_start_time' => 'Peminjaman tidak dapat dilakukan pada hari Sabtu atau Minggu.'
            ])->withInput();
        }

        $workingStartTime = Carbon::createFromTime(7, 30);
        $workingEndTime = Carbon::createFromTime(17, 0);

        $scheduleStartTimeOnly = Carbon::createFromTime($startDateTime->hour, $startDateTime->minute);
        $scheduleEndTimeOnly = Carbon::createFromTime($endDateTime->hour, $endDateTime->minute);

        if ($scheduleStartTimeOnly->lt($workingStartTime) || $scheduleEndTimeOnly->gt($workingEndTime)) {
            return redirect()->back()->withErrors([
                'schedule_start_time' => 'Peminjaman hanya dapat dilakukan antara 07:30 dan 17:00.'
            ])->withInput();
        }

        $breakTimes = [
            ['start' => Carbon::createFromTime(10, 0), 'end' => Carbon::createFromTime(10, 30)],
            ['start' => Carbon::createFromTime(12, 0), 'end' => Carbon::createFromTime(13, 0)],
        ];

        foreach ($breakTimes as $break) {
            // Check if the schedule overlaps with any break interval
            if ($startDateTime->lt($break['end']) && $endDateTime->gt($break['start'])) {
                return redirect()->back()->withErrors([
                    'schedule_start_time' => 'Peminjaman tidak boleh mencakup waktu istirahat (10:00-10:30 atau 12:00-13:00).'
                ])->withInput();
            }
        }

        $existingSchedules = Schedule::where('room_laboratory_id', $roomLaboratoryId)
                 ->where('schedule_day_of_week', $validated['schedule_day_of_week']) // Crucial: same day of the week
                ->where(function ($query) use ($startDateTime, $endDateTime) {

                $query->where('schedule_start_time', '<', $endDateTime->format('H:i'))
                      ->where('schedule_end_time', '>', $startDateTime->format('H:i'));
            })
             ->where(function ($query) use ($requestedSemesterId) {
                // Check for conflicts in the same semester or future semesters
                 $query->where('semester_id', $requestedSemesterId)
                       ->orWhereHas('semester', function ($q) {
                           $q->where('end_date', '>=', Carbon::now()->toDateString());
                       });
             })

            ->first();

        if ($existingSchedules) {
            return redirect()->back()->withErrors([
                'room_laboratory_id' => 'Ruangan ini sudah terjadwal pada waktu dan hari yang Anda pilih.'
            ])->withInput();
        }


        $validated['user_id'] = Auth::id();
        $validated['status'] = 'active';

        $schedule = Schedule::create($validated);

        return redirect()->back()->with('success', 'Schedule created successfully.');
    }

    public function delete($id){
        $schedule = Schedule::find($id);
        $schedule->delete();
        return redirect()->route('landing.admin.schedule.dashboard')->with('success', 'Schedule deleted successfully.');
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'room_laboratory_id' => 'required|exists:room_laboratory,id',
            'semester_id' => 'required|exists:semesters,id',
            'title_schedule' => 'required|string|max:255',
            'lecturer_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'schedule_day_of_week' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat',
            'schedule_start_time' => 'required|date_format:H:i',
            'schedule_end_time' => 'required|date_format:H:i|after_or_equal:schedule_start_time',
        ]);

        $schedule = Schedule::findOrFaild($id);
        $schedule->room_laboratory_id = $validated['room_laboratory_id'];
        $schedule->semester_id = $validated['semester_id'];
        $schedule->title_schedule = $validated['title_schedule'];
        $schedule->lecturer_name = $validated['lecturer_name'];
        $schedule->description = $validated['description'];
        $schedule->schedule_day_of_week = $validated['schedule_day_of_week'];
        $schedule->schedule_start_time = $validated['schedule_start_time'];
        $schedule->schedule_end_time = $validated['schedule_end_time'];
        $schedule->save();
        return redirect()->route('landing.admin.schedule.dashboard')->with('success', 'Schedule updated successfully.');

    }
}
