<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use App\Models\Courier;
use App\Models\Menu;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('akuadalahadmin')
        ]);

        Courier::create([
            'name' => 'Kurir',
            'email' => 'kurir@gmail.com',
            'password' => bcrypt('akuadalahkurir'),
            'phone_number' => '08912332112',
            'total_balance' => 0
        ]);
    }
}
