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
        // Use Carbon to get today's date
        $today = date('Y-m-d');
        
        // Correcting the use of env to get environment variables
        $host = env('DB_HOST2');
        $database = env('DB_DATABASE2');
        $username = env('DB_USERNAME2');

        $this->info("Connecting to: $host, database: $database, username: $username");

        // Fetch data with specific conditions
        $data = DB::connection('mysql2')
            ->table('bookings')
            ->where('status', 2)
            ->whereDate('pick_up_date', $today)
            ->get();

        foreach ($data as $item) {
            DB::connection('mysql')->table('bookings')->insert([
                'bookingid' => $item->booking_id,
                'booking_number' => $item->booking_number,
                'booking_accountid' => $item->booking_account_id,
                'address' => $item->address,
                'latlng' => $item->latlng,
                'g_maps_address' => $item->g_maps_address,
                'postal_code' => $item->postal_code,
                'city_name' => $item->city_name,
                'sub_district_name' => $item->sub_district_name,
                'pick_up_date' => $item->pick_up_date,
                'pick_up_time' => $item->pick_up_time,
                'goods' => $item->goods,
                'goods_image' => $item->goods_image,
                'whatsapp' => $item->whatsapp,
                'name' => $item->name,
                'email' => $item->email,
                'step' => $item->step,
                'status' => $item->status,
                'confirm_date' => $item->confirm_date,
                'finish_date' => $item->finish_date,
                'on_going_date' => $item->on_going_date,
            ]);
        }

        $this->info('Data pulled successfully');
    }
}
