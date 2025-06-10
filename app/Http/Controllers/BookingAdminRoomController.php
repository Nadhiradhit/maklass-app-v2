<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;

class BookingAdminRoomController extends Controller
{
    //

    public function index()
    {
        $data = Booking::with(['user', 'room'])->get();
        return view('landing.admin.request.room.request-room', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $booking = Booking::findOrFail($id);

        $originalStatus = $booking->status; // Store original status to check if it changes to 'approved'


        if ($validated['status'] === 'approved' && $originalStatus !== 'approved') {
            $roomLaboratoryId = $booking->room_laboratory_id;
            $startDateTime = $booking->booking_start_datetime;
            $endDateTime = $booking->booking_end_datetime;

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
                ->where(function ($query) use ($startDateTime, $endDateTime) {
                    $query->where('schedule_start_datetime', '<', $endDateTime)
                          ->where('schedule_end_datetime', '>', $startDateTime);
                })
                ->first();

            if ($existingSchedule) {
                return redirect()->back()->withErrors([
                    'status' => 'Tidak dapat menyetujui peminjaman ini. Ruangan memiliki jadwal yang ada pada waktu yang sama.'
                ])->withInput();
            }
        }

        $booking->update($validated);

        if ($booking->status === 'approved' && $originalStatus !== 'approved') {
            // Find all other PENDING bookings for the same room and time slot, and reject them
            Booking::where('room_laboratory_id', $booking->room_laboratory_id)
                ->where('id', '!=', $booking->id)
                ->where('status', 'pending')
                ->where(function ($query) use ($booking) {
                    $query->where('booking_start_datetime', '<', $booking->booking_end_datetime)
                          ->where('booking_end_datetime', '>', $booking->booking_start_datetime);
                })
                ->update(['status' => 'rejected']);

            return redirect()->back()->with('success', 'Peminjaman disetujui, dan peminjaman pending yang berkonflik telah ditolak.');
        }


        return redirect()->back()->with('success', 'Booking status updated successfully');
    }


}
