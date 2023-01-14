<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
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
                "name" => "Kilogram",
                "shortname" => "kg"
            ],
            [
                "name" => "Yard",
                "shortname" => "yrd"
            ],
            [
                "name" => "Gram",
                "shortname" => "grm"
            ]
        ];

        foreach ($data as $key => $item) {
            Unit::create($item);
        }
    }
}
