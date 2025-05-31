<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Admin;
use App\Models\BukaTutup;
use App\Models\Courier;
use App\Models\Menu;
use App\Models\ShippingCost;
use App\Models\User;
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

        BukaTutup::create([
            'is_open' => false
        ]);

        $menus = [
            [
                'name' => 'Mie Ayam',
                'image' => 'menus/xo1gEiUsz6JhergLMoSI4WaDBU16CTdw9ls8Cpjw.jpeg',
                'main_cost' => 12000,
                'tipe' => 'makanan',
                'stock' => true,
            ],
            [
                'name' => 'Es Teh Manis',
                'image' => 'menus/thMxvhid2SajLuyCerrQj7B31zUETwIoPrmDG9az.jpg',
                'main_cost' => 5000,
                'tipe' => 'minuman',
                'stock' => true,
            ],
            [
                'name' => 'Jus Alpukat',
                'image' => 'menus/4BKoXC0DqcawWud7PP8veAvJfSyYO770O5aqYmXp.jpeg',
                'main_cost' => 8000,
                'tipe' => 'minuman',
                'stock' => false,
            ],
            [
                'name' => 'Bakso',
                'image' => 'menus/3ccDOJat06bpKSC72bz5waTo4Kz4HOoWmhpfkmt5.jpg',
                'main_cost' => 14000,
                'tipe' => 'makanan',
                'stock' => true,
            ],
            [
                'name' => 'Air Mineral',
                'image' => 'menus/ugW0FZymjToj5yiVReYz2aRO3gbZCKoQirqwHd4Q.jpeg',
                'main_cost' => 3000,
                'tipe' => 'minuman',
                'stock' => true,
            ],
            [
                'name' => 'Es Jeruk',
                'image' => 'menus/deggjaEW7uKCl1brjJQa1kvy647RopXYx8hi22Qj.jpeg',
                'main_cost' => 6000,
                'tipe' => 'minuman',
                'stock' => true,
            ]
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }

        $users = [
            [
                'name' => 'Andi Setiawan',
                'email' => 'andi@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567890',
                'activation_token' => '',
                'status' => true,
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

        $addresses = [
            [
                'user_id' => 1,
                'name' => 'Andi Rumah',
                'phone_number' => '0811111111',
                'address' => 'Jl. Melati No. 1, Jakarta',
                'latitude' => '-7.920247837633146',
                'longitude' => '113.82805135804588',
                'main_address' => true,
            ]
        ];

        foreach ($addresses as $address) {
            Address::create($address);
        }

        $costs = [
            [
                'lower_limit' => 0,
                'upper_limit' => 5,
                'cost' => 5000,
            ],
            [
                'lower_limit' => 5.01,
                'upper_limit' => 10,
                'cost' => 10000,
            ],
            [
                'lower_limit' => 10.01,
                'upper_limit' => 20,
                'cost' => 15000,
            ],
            [
                'lower_limit' => 20.01,
                'upper_limit' => 30,
                'cost' => 20000,
            ],
            [
                'lower_limit' => 30.01,
                'upper_limit' => 9999,
                'cost' => 30000,
            ],
        ];

        foreach ($costs as $cost) {
            ShippingCost::create($cost);
        }

    }
}
