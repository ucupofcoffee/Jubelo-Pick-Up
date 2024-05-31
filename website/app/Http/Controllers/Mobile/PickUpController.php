<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use Carbon\Carbon;

class PickUpController extends Controller
{
    public function index()
    {
        $today = Carbon::now()->format('l, d F Y');
        $date = Carbon::now()->toDateString();
    
        $schedule = Schedule::whereDate('pick_up_date', $date)->orderBy('pick_up_time', 'asc')->get();
    
        $schedule->each(function ($item) {
            $item->pick_up_time = $this->convertPickUpTime($item->pick_up_time);
            $item->pick_up_date = Carbon::parse($item->pick_up_date)->format('M d, Y');
            $item->typeid = $this->convertTypeId($item->typeid);
            return $item;
        });
    
        $chunkSize = ceil($schedule->count() / 3);
        $pickup1 = $schedule->slice(0, $chunkSize)->values();
        $pickup2 = $schedule->slice($chunkSize, $chunkSize)->values();
        $pickup3 = $schedule->slice($chunkSize * 2)->values();
    
        return response()->json([
            // 'schedule' => $schedule,
            'today' => $today,
            'pickup1' => $pickup1,
            'pickup2' => $pickup2,
            'pickup3' => $pickup3,
        ]);
    }
    
    private function convertPickUpTime($time)
    {
        switch ($time) {
            case 1:
                return '9 AM';
            case 2:
                return '11 AM';
            case 3:
                return '2 PM';
        }
    }

    private function convertTypeId($typeId)
    {
        switch ($typeId) {
            case 1:
                return 'Minyak Jelantah';
            case 2:
                return 'Kardus';
            case 3:
                return 'Botol Plastik';
            case 4:
                return 'Gelas Plastik';
        }
    }
}
