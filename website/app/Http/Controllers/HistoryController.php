<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\Schedule;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = Schedule::all();

        return view('history.index', [
            'title' => 'History List',
            'histories' => $histories,
        ]);
    }

    public function historyList()
    {
        $histories = Schedule::with('driver')->where('status', 1)->get();
    
        $events = [];
    
        foreach ($histories as $history) {
            $event = [
                'title' => $history->transaction_id,
                'start' => $history->pick_up_date,
                'end' => $history->pick_up_date,
                'extendedProps' => [
                    'transaction_id' => $history->transaction_id,
                    'driver_name' => $history->driver ? $history->driver->name : 'Unknown',
                ],
            ];
            array_push($events, $event);
        }
    
        return response()->json($events);
    }    

    public function detail($pick_up_date)
    {
        $histories = Schedule::whereDate('pick_up_date', $pick_up_date)->orderBy('pick_up_time', 'asc')->get();

        $pickup1 = $histories->slice(0, ceil($histories->count() / 3));
        $pickup2 = $histories->slice(ceil($histories->count() / 3), ceil($histories->count() / 3));
        $pickup3 = $histories->slice(ceil($histories->count() / 3) * 2);

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

        return view('history.detail', [
            'title' => 'History Detail',
            'histories' => $histories,
            'pickup1' => $pickup1,
            'pickup2' => $pickup2,
            'pickup3' => $pickup3,
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
