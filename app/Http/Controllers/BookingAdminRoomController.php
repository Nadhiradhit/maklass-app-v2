<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class BookingAdminRoomController extends Controller
{
    //

    public function index()
    {
        $data = Booking::with(['user', 'room'])->paginate(15);

        return view('landing.admin.request.room.request-room', compact('data'));
    }

    public function detailModal($id)
    {
        $booking = Booking::with(['user', 'room'])->findOrFail($id);

        return view('landing.admin.partials.booking-detail-modal', compact('booking'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'reason' => 'nullable|string|max:255',
        ]);

        $booking = Booking::findOrFail($id);

        $originalStatus = $booking->status;


        if ($validated['status'] === 'approved' && $originalStatus !== 'approved') {
            $roomLaboratoryId = $booking->room_laboratory_id;
            $startDateTime = $booking->booking_start_datetime;
            $endDateTime = $booking->booking_end_datetime;

            Carbon::setLocale('id');
            $dayOfWeekForBooking = Carbon::parse($startDateTime)->translatedFormat('l');

            // Check if this approved booking overlaps with any existing bookings or schedules
            $existingApprovedBooking = Booking::where('id', '!=', $booking->id)
                ->where('room_laboratory_id', $roomLaboratoryId)
                ->where('status', 'approved')
                ->where(function ($query) use ($startDateTime, $endDateTime) {
                    $query->where('booking_start_datetime', '<', $endDateTime)
                          ->where('booking_end_datetime', '>', $startDateTime);
                })
                ->first();

            if ($existingApprovedBooking) {
                return redirect()->back()->withErrors([
                    'status' => 'Tidak dapat menyetujui peminjaman ini. Ruangan sudah disetujui untuk peminjaman lain pada waktu yang sama.'
                ])->withInput();
            }

            // Check for overlapping schedules
            $existingSchedule = Schedule::where('room_laboratory_id', $roomLaboratoryId)
                ->where('schedule_day_of_week', $dayOfWeekForBooking)
                ->where(function ($query) use ($startDateTime, $endDateTime) {
                    $query->where('schedule_start_time', '<', Carbon::parse($endDateTime)->format('H:i:s'))
                          ->where('schedule_end_time', '>', Carbon::parse($startDateTime)->format('H:i:s'));
                })
                ->first();

            if ($existingSchedule) {
                return redirect()->back()->withErrors([
                    'status' => 'Tidak dapat menyetujui peminjaman ini. Ruangan memiliki jadwal yang ada pada waktu yang sama.'
                ])->withInput();
            }
        } elseif ($validated['status'] === 'rejected' && $originalStatus !== 'rejected') {
            // If the booking is being rejected, we can check if a reason is provided
            if (empty($validated['reason'])) {
                return redirect()->back()->withErrors([
                    'reason' => 'Alasan penolakan wajib diisi.'
                ])->withInput();
            }
        }


        $booking->update($validated);

        // dd($booking->status, $originalStatus, $booking->reason );


        if ($booking->status === 'approved' && $originalStatus !== 'approved') {

            Carbon::setLocale('id');
            $pdf = PDF::loadView('pdfs.booking-proof', compact('booking'));

            $directory = 'public/booking_proofs';
            $filename = 'booking_proof_' . $booking->id . '.pdf';
            Storage::put($directory . '/' . $filename, $pdf->output());

            $booking->file_attachment_approval = Storage::url($directory . '/' . $filename); // <-- UPDATED FIELD NAME
            $booking->save();

            Booking::where('room_laboratory_id', $booking->room_laboratory_id)
                ->where('id', '!=', $booking->id)
                ->where('status', 'pending')
                ->where(function ($query) use ($booking) {
                    $query->where('booking_start_datetime', '<', $booking->booking_end_datetime)
                        ->where('booking_end_datetime', '>', $booking->booking_start_datetime);
                })
                ->update(['status' => 'rejected', 'reason' => 'Booking ini ditolak karena ada booking yang telah disetujui pada waktu yang sama.']);

            return redirect()->back()->with('success', 'Peminjaman disetujui, dan peminjaman pending yang berkonflik telah ditolak.');

        }   elseif ($booking->status === 'rejected' && $originalStatus !== 'rejected') {

            return redirect()->back()->with('success', 'Peminjaman berhasil ditolak dengan alasan yang diberikan.');
        }

        return redirect()->back()->with('success', 'Booking status updated successfully');
    }


}
