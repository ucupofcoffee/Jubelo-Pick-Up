<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PullData extends Command
{
    protected $signature = 'pull:data';
    protected $description = 'Pull Bookings Data';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $today = date('Y-m-d');

        $host = env('DB_HOST2');
        $database = env('DB_DATABASE2');
        $username = env('DB_USERNAME2');

        $this->info("Connecting to: $host, database: $database, username: $username");

        $data = DB::connection('mysql2')->table('transactions')->where('status', 2)->whereDate('pick_up_date', $today)->get();

        foreach ($data as $item) {
            DB::connection('mysql')
                ->table('schedules')
                ->insert([
                    'transaction_id' => $item->transaction_id,
                    'full_address' => $item->full_address,
                    'status' => $item->status,
                    'typeid' => $item->type,
                    'pick_up_date' => $item->pick_up_date,
                    'pick_up_time' => $item->pick_up_time,
                    'latitude' => $item->latitude,
                    'longitude' => $item->longitude,
                    'g_maps_address' => $item->g_maps_address,
                    'postal_code' => $item->postal_code,
                    'phone' => $item->phone,
                    'email' => $item->email,
                    'name' => $item->name,
                ]);
        }

        $this->info('Data pulled successfully');
    }
}
