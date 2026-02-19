<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MonitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Monitor::create([
            'name' => 'Primary API',
            'url' => 'https://api.example.com',
            'status' => 'up',
            'last_response_time' => 45,
            'last_checked_at' => now(),
        ]);

        \App\Models\Monitor::create([
            'name' => 'Auth Service',
            'url' => 'https://auth.example.com',
            'status' => 'up',
            'last_response_time' => 32,
            'last_checked_at' => now(),
        ]);

        \App\Models\Monitor::create([
            'name' => 'Database Cluster',
            'url' => '10.0.0.5',
            'status' => 'down',
            'last_response_time' => null,
            'last_checked_at' => now(),
        ]);
    }
}
