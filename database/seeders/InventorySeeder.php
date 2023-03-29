<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InventorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('inventories')->insert([[
           'name' => 'Sugar',
            'price' => 2000,
            'amount' => 100,
            'unit' => 'Kilogram'
        ],
            [
                'name' => 'Brown Sugar',
                'price' => 5000,
                'amount' => 100,
                'unit' => 'Kilogram'
            ],
            [
                'name' => 'Tea',
                'price' => 3000,
                'amount' => 100,
                'unit' => 'Gram'
            ],
            [
                'name' => 'Black Tea',
                'price' => 2000,
                'amount' => 100,
                'unit' => 'Gram'
            ]]);
    }
}
