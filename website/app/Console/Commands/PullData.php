<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class PullData extends Command
{
    protected $signature = 'pull:data';
    protected $description = 'Pull data from second database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $host = env('DB_HOST2');
        $port = env('DB_PORT2');
        $database = env('DB_DATABASE2');
        $username = env('DB_USERNAME2');
        $password = env('DB_PASSWORD2');

        $this->info("Connecting to: $host, database: $database, username: $username");

        $data = DB::connection('mysql2')->table('users')->get();

        foreach ($data as $item) {
            DB::connection('mysql')->table('users')->updateOrInsert(
            ['userid' => $item->userid],
            [
                'name' => $item->name,
                'username' => $item->username,
            ]
                );
        }

        $this->info('Data has been pulled successfully');
    }
}
