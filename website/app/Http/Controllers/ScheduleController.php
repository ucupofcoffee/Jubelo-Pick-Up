<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Driver;
use Carbon\Carbon;

class ScheduleController extends Controller
{
    public function index()
    {
        $day = Carbon::now()->format('l');
        $today = Carbon::now()->format('l, d F Y');
        $date = Carbon::now()->toDateString();
        $drivers = Driver::where('day', $day)->get();

        $schedule = Schedule::whereDate('pick_up_date', $date)
        ->where('status', 2)
        ->orderBy('pick_up_time', 'asc')
        ->get();

        $pickup1 = $schedule->slice(0, ceil($schedule->count() / 3));
        $pickup2 = $schedule->slice(ceil($schedule->count() / 3), ceil($schedule->count() / 3));
        $pickup3 = $schedule->slice(ceil($schedule->count() / 3) * 2);

        $pickup1->transform(function ($item) {
            $item->pick_up_time = $this->convertPickUpTime($item->pick_up_time);
            return $item;
        });

        $pickup2->transform(function ($item) {
            $item->pick_up_time = $this->convertPickUpTime($item->pick_up_time);
            return $item;
        });

        $pickup3->transform(function ($item) {
            $item->pick_up_time = $this->convertPickUpTime($item->pick_up_time);
            return $item;
        });

        return view('schedule.index', [
            'title' => 'Schedule List',
            'drivers' => $drivers,
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
