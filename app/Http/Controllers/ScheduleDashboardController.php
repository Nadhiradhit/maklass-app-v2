<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Semester;
use App\Models\Booking;
use Carbon\Carbon;

class ScheduleDashboardController extends Controller
{
    public function index(){

        Carbon::setLocale('id');

        $today = Carbon::today();
        $currentMonth = $today->month;
        $currentYear = $today->year;

        $schedules = Schedule::with(['room', 'semester'])->get();
        $bookings = Booking::with('room')
                            ->where('status','approved')
                            ->whereDate('booking_start_datetime', '>=', $today)
                            ->get();

        $filteredBookings = $bookings->filter(function ($booking) use ($currentMonth, $currentYear, $today) {
        $bookingDate = Carbon::parse($booking->booking_start_datetime);
        return $bookingDate->month == $currentMonth
            && $bookingDate->year == $currentYear
            && $bookingDate->gte($today);
        });

        $transformedSchedules = $schedules->map(function ($schedule) {
            $startTime = Carbon::parse($schedule->schedule_start_time)->format('H:i');
            $endTime = Carbon::parse($schedule->schedule_end_time)->format('H:i');
            return [
                'type' => 'schedule',
                'id' => $schedule->id,
                'title' => $schedule->title_schedule,
                'lecturer_name' => $schedule->lecturer_name,
                'start_time' => $startTime,
                'end_time' => $endTime,
                'day_of_week' => $schedule->schedule_day_of_week,
                'room_name' => $schedule->room->name ?? 'N/A',

                'description' => $schedule->description ?? null,
            ];
        });

        $transformedBookings = $filteredBookings->sortBy('booking_start_datetime')
            ->map(function ($booking) {
            $dayOfWeek = Carbon::parse($booking->booking_start_datetime)->locale('id')->dayName;
            $dayName = Carbon::parse($booking->booking_start_datetime)->locale('id')->isoFormat('dddd, DD MMMM YYYY');
            $startTime = Carbon::parse($booking->booking_start_datetime)->format('H:i');
            $endTime = Carbon::parse($booking->booking_end_datetime)->format('H:i');
            return [
                'type' => 'booking',
                'id' => $booking->id,
                'title' => $booking->booking_purpose,
                'lecturer_name' => $booking->responsible ?? 'N/A',
                'start_time' => $startTime,
                'end_time' => $endTime,
                'day_of_week' => $dayOfWeek,
                'day_name' => $dayName,
                'room_name' => $booking->room->name ?? 'N/A',
                'description' => $booking->description ?? null,
            ];
        });

        $combinedData = $transformedSchedules->merge($transformedBookings);

        $dayOrder = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];


        $sortedCombinedData = $combinedData->sort(function ($a, $b) use ($dayOrder) {
            $dayA = array_search($a['day_of_week'], $dayOrder);
            $dayB = array_search($b['day_of_week'], $dayOrder);

            if ($dayA === $dayB) {
                return strtotime($a['start_time']) <=> strtotime($b['start_time']);
            }

            return $dayA <=> $dayB;
        });

        $groupedCombinedData = $sortedCombinedData->groupBy('day_of_week');


        return view('landing.user.schedule.dashboard-schedule', [
            'groupedCombinedData' => $groupedCombinedData,
            'dayOrder' => $dayOrder,
        ]);
    }
}
