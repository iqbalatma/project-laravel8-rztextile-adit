<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\CustomerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = [
        //     [
        //         "id_number" => "6101071602990002",
        //         "name"      => "iqbal atma muliawan",
        //         "email"     => "iqbalatma@gmail.com",
        //         "password"  => Hash::make("admin"),
        //         "address"   => "selakau",
        //         "phone"     => "+62895351172040",
        //         "role_id"   => "1",
        //     ]
        // ];

        // foreach ($data as $key => $item) {
        //     User::create($item);
        // }

        User::factory()->count(30)->customer()->create();
    }
}
