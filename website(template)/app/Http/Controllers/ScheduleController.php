<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('l, d F Y');
        $date = Carbon::now()->toDateString();

        $schedule = Schedule::whereDate('pick_up_date', $date)->orderBy('pick_up_time', 'asc')->get();
        
        $schedule->each(function ($item) {
            $item->pick_up_time = $this->convertPickUpTime($item->pick_up_time);
            return $item;
        });
        
        $chunkSize = ceil($schedule->count() / 3);
        $pickup1 = $schedule->slice(0, $chunkSize)->values();
        $pickup2 = $schedule->slice($chunkSize, $chunkSize)->values();
        $pickup3 = $schedule->slice($chunkSize * 2)->values();
        
        return view('schedule.index', [
            'title' => 'Schedule List',
            'today' => $today,
            'schedule' => $schedule,
            'pickup1' => $pickup1,
            'pickup2' => $pickup2,
            'pickup3' => $pickup3,
        ]);
    }

    public function detail($scheduleid)
    {
        $schedule = Schedule::find($scheduleid);

        $schedule->pick_up_time = $this->convertPickUpTime($schedule->pick_up_time);

        return view('schedule.detail', [
            'title' => 'Schedule Detail',
            'schedule' => $schedule,
        ]);
    }

    private function convertPickUpTime($time)
    {
        switch ($time) {
            case 1:
                return '09:00 - 11:00';
            case 2:
                return '11:00 - 14:00';
            case 3:
                return '14:00 - 16:00';
        }
    }
}
