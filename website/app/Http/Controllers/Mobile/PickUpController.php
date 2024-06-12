<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Driver;
use App\Models\Schedule;
use App\Models\Photo;
use App\Models\Location;
use Carbon\Carbon;

class PickUpController extends Controller
{
    public function index()
    {
        $driver = Auth::guard('api')->user();

        if (!$driver) {
            return response()->json([
                'message' => 'Driver not authenticated',
            ], 401);
        }

        $today = Carbon::now()->isoFormat('dddd, D MMMM YYYY');
        $date = Carbon::now()->toDateString();
        $day = Carbon::now()->format('l');

        if ($driver->day != $day) {
            return response()->json([
                'today' => $today,
                'message' => 'No schedule available for today',
                'pickup1' => [],
                'pickup2' => [],
                'pickup3' => [],
            ]);
        }

        $schedule = Schedule::whereDate('pick_up_date', $date)
            ->orderBy('pick_up_time', 'asc')
            ->get();

        $schedule->each(function ($item) {
            $item->pick_up_date = Carbon::parse($item->pick_up_date)->format('M d, Y');
            $item->typeid = $this->convertTypeId($item->typeid);
            return $item;
        });

        $chunkSize = ceil($schedule->count() / 3);
        $pickup1 = $schedule->slice(0, $chunkSize)->values();
        $pickup2 = $schedule->slice($chunkSize, $chunkSize)->values();
        $pickup3 = $schedule->slice($chunkSize * 2)->values();

        return response()->json([
            'today' => $today,
            'pickup1' => $pickup1,
            'pickup2' => $pickup2,
            'pickup3' => $pickup3,
        ]);
    }

    public function detail($scheduleid)
    {
        $driver = Auth::guard('api')->user();

        if (!$driver) {
            return response()->json([
                'message' => 'Driver not authenticated',
            ], 401);
        }

        $schedule = Schedule::find($scheduleid);

        if ($schedule) {
            $schedule->pick_up_date = Carbon::parse($schedule->pick_up_date)->format('M d, Y');
            $schedule->typeid = $this->convertTypeId($schedule->typeid);
        }

        return response()->json([
            'schedule' => $schedule,
        ]);
    }
    
    public function update(Request $request, $scheduleid)
    {
        $driver = Auth::guard('api')->user();
    
        if (!$driver) {
            return response()->json([
                'message' => 'Driver not authenticated',
            ], 401);
        }

        $schedule = Schedule::find($scheduleid);
    
        if (!$schedule) {
            return response()->json(['message' => 'Schedule not found'], 404);
        }
    
        $schedule->status = $request->status;
        $schedule->driverid = $request->driverid;
        $schedule->photoid = $request->photo_ids;
        $schedule->save();
    
        return response()->json(['message' => 'Schedule updated successfully']);
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
