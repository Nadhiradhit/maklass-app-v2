<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    public function index(){
        // $data = \App\Models\Schedule::all();

        $rooms = Room::all();

        $title = 'Jadwal Lab';
        return view('landing.admin.schedule.dashboard-schedule', compact( 'title', 'rooms'));
    }

    public function store(Request $request){
        $validated = $request->validate([
            'room_laboratory_id' => 'required|exists:room_laboratory,id',
            'title_schedule' => 'required|string|max:255',
            'lecturer' => 'required|string|max:255',
            'description' => 'nullable|string',
            'schedule_start_datetime' => 'required|date',
            'schedule_end_datetime' => 'required|date|after_or_equal:schedule_start_datetime',
        ]);

        $startDateTime = Carbon::parse($request->schedule_start_datetime);
        $endDateTime = Carbon::parse($request->schedule_end_datetime);

        if ($startDateTime->isWeekend() || $endDateTime->isWeekend()) {
            return redirect()->back()->withErrors([
                'schedule_start_datetime' => 'Peminjaman tidak dapat dilakukan pada hari Sabtu atau Minggu.'
            ])->withInput();
        }

        $workingStartTime = Carbon::createFromTime(7, 30);
        $workingEndTime = Carbon::createFromTime(17, 0);

        $scheduleStartTimeOnly = Carbon::createFromTime($startDateTime->hour, $startDateTime->minute);
        $scheduleEndTimeOnly = Carbon::createFromTime($endDateTime->hour, $endDateTime->minute);

        if ($scheduleStartTimeOnly->lt($workingStartTime) || $scheduleEndTimeOnly->gt($workingEndTime)) {
            return redirect()->back()->withErrors([
                'schedule_start_datetime' => 'Peminjaman hanya dapat dilakukan antara 07:30 dan 17:00.'
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
                    'schedule_start_datetime' => 'Peminjaman tidak boleh mencakup waktu istirahat (10:00-10:30 atau 12:00-13:00).'
                ])->withInput();
            }
        }

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'active';

        $schedule = Schedule::create($validated);
        $schedule->save();

        return redirect()->back()->with('success', 'Schedule created successfully.');
    }
}
