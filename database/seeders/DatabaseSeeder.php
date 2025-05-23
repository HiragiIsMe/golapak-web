<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Address;
use App\Models\Admin;
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

        $menus = [
            [
                'name' => 'Nasi Goreng Spesial',
                'image' => 'menus/lY66mGLXYSrhbgAHT0SPTVhb7hunzAjtcxm7h25e.jpg',
                'main_cost' => 15000,
                'tipe' => 'makanan',
                'stock' => true,
            ],
            [
                'name' => 'Mie Ayam',
                'image' => 'menus/xo1gEiUsz6JhergLMoSI4WaDBU16CTdw9ls8Cpjw.jpg',
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
                'image' => 'menus/4BKoXC0DqcawWud7PP8veAvJfSyYO770O5aqYmXp.jpg',
                'main_cost' => 8000,
                'tipe' => 'minuman',
                'stock' => false,
            ],
            [
                'name' => 'Sate Ayam',
                'image' => 'menus/TtDknd68lcHKReYURC597sqqv7P1MG3uFKyyvEXS.jpg',
                'main_cost' => 18000,
                'tipe' => 'makanan',
                'stock' => true,
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
                'image' => 'menus/ugW0FZymjToj5yiVReYz2aRO3gbZCKoQirqwHd4Q.png',
                'main_cost' => 3000,
                'tipe' => 'minuman',
                'stock' => true,
            ],
            [
                'name' => 'Es Jeruk',
                'image' => 'menus/deggjaEW7uKCl1brjJQa1kvy647RopXYx8hi22Qj.jpg',
                'main_cost' => 6000,
                'tipe' => 'minuman',
                'stock' => true,
            ],
            [
                'name' => 'Roti Bakar',
                'image' => 'menus/rH0sNCYsFtVLweWFRuz7WETp87xwnFeicbbLxKHn.jpg',
                'main_cost' => 7000,
                'tipe' => 'makanan',
                'stock' => true,
            ],
            [
                'name' => 'Teh Tarik',
                'image' => 'menus/2pU9E40XcwCnz5eAqzNynzWobNGNZL0yxJ0Hq2VG.jpg',
                'main_cost' => 7000,
                'tipe' => 'minuman',
                'stock' => true,
            ],
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
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567891',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Citra Lestari',
                'email' => 'citra@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567892',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Dodi Saputra',
                'email' => 'dodi@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567893',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Eka Putri',
                'email' => 'eka@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567894',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Fajar Hidayat',
                'email' => 'fajar@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567895',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Gita Ramadhani',
                'email' => 'gita@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567896',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Hadi Prasetyo',
                'email' => 'hadi@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567897',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Indah Permatasari',
                'email' => 'indah@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567898',
                'activation_token' => '',
                'status' => true,
            ],
            [
                'name' => 'Joko Susilo',
                'email' => 'joko@example.com',
                'password' => bcrypt('akuadalahuser'),
                'phone_number' => '081234567899',
                'activation_token' => '',
                'status' => true,
            ],
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
                'latitude' => '-6.200000',
                'longitude' => '106.816666',
                'main_address' => true,
            ],
            [
                'user_id' => 2,
                'name' => 'Budi Kost',
                'phone_number' => '0812222222',
                'address' => 'Jl. Kenanga No. 2, Bandung',
                'latitude' => '-6.914864',
                'longitude' => '107.608238',
                'main_address' => true,
            ],
            [
                'user_id' => 3,
                'name' => 'Citra Apartemen',
                'phone_number' => '0813333333',
                'address' => 'Apartemen Citra Tower, Surabaya',
                'latitude' => '-7.250445',
                'longitude' => '112.768845',
                'main_address' => true,
            ],
            [
                'user_id' => 4,
                'name' => 'Dodi Rumah',
                'phone_number' => '0814444444',
                'address' => 'Jl. Kamboja No. 4, Yogyakarta',
                'latitude' => '-7.795580',
                'longitude' => '110.369490',
                'main_address' => true,
            ],
            [
                'user_id' => 5,
                'name' => 'Eka Rumah',
                'phone_number' => '0815555555',
                'address' => 'Jl. Cendana No. 5, Semarang',
                'latitude' => '-6.966667',
                'longitude' => '110.416664',
                'main_address' => true,
            ],
            [
                'user_id' => 6,
                'name' => 'Fajar Rumah',
                'phone_number' => '0816666666',
                'address' => 'Jl. Anggrek No. 6, Medan',
                'latitude' => '3.595196',
                'longitude' => '98.672226',
                'main_address' => true,
            ],
            [
                'user_id' => 7,
                'name' => 'Gita Rumah',
                'phone_number' => '0817777777',
                'address' => 'Jl. Flamboyan No. 7, Makassar',
                'latitude' => '-5.147665',
                'longitude' => '119.432732',
                'main_address' => true,
            ],
            [
                'user_id' => 8,
                'name' => 'Hadi Rumah',
                'phone_number' => '0818888888',
                'address' => 'Jl. Dahlia No. 8, Malang',
                'latitude' => '-7.981894',
                'longitude' => '112.626503',
                'main_address' => true,
            ],
            [
                'user_id' => 9,
                'name' => 'Indah Rumah',
                'phone_number' => '0819999999',
                'address' => 'Jl. Mawar No. 9, Palembang',
                'latitude' => '-2.976074',
                'longitude' => '104.775430',
                'main_address' => true,
            ],
            [
                'user_id' => 10,
                'name' => 'Joko Rumah',
                'phone_number' => '0810000000',
                'address' => 'Jl. Teratai No. 10, Balikpapan',
                'latitude' => '-1.265386',
                'longitude' => '116.831200',
                'main_address' => true,
            ],
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
