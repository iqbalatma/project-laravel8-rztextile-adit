<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "name" => "superadmin",
                "description" => "user that has all access"
            ],
            [
                "name" => "admin",
                "description" => "user that has administrator access"
            ],
            [
                "name" => "cashier",
                "description" => "user that responsible on transaction item"
            ],
            [
                "name" => "warehouse keeper",
                "description" => "user that responsible on warehouse transaction item"
            ],
            [
                "name" => "customer",
                "description" => "user that act as buyer items"
            ]
        ];

        foreach ($data as $key => $item) {
            Role::create($item);
        }
    }
}
