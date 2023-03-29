<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_variants')->insert([
           [
               'products_id' => 1,
               'name' => 'original',
               'additional_price' => 0
           ],
            [
                'products_id' => 1,
                'name' => 'mushroom',
                'additional_price' => 10000
            ],
            [
                'products_id' => 1,
                'name' => 'chicken',
                'additional_price' => 20000
            ],
            [
                'products_id' => 2,
                'name' => 'original',
                'additional_price' => 0
            ],
            [
                'products_id' => 2,
                'name' => 'Extra Lemon Syrup',
                'additional_price' => 20000
            ],
            [
                'products_id' => 2,
                'name' => 'Extra Pearl',
                'additional_price' => 10000
            ],
            [
                'products_id' => 3,
                'name' => 'original',
                'additional_price' => 0
            ],
            [
                'products_id' => 3,
                'name' => 'Extra Caramel Sauce',
                'additional_price' => 15000
            ],
            [
                'products_id' => 3,
                'name' => 'Extra Soy Milk',
                'additional_price' => 25000
            ],
            [
                'products_id' => 4,
                'name' => 'original',
                'additional_price' => 0
            ],
            [
                'products_id' => 4,
                'name' => 'Extra Sausage',
                'additional_price' => 12000
            ],
            [
                'products_id' => 4,
                'name' => 'Extra Chedar',
                'additional_price' => 10000
            ],
            [
                'products_id' => 5,
                'name' => 'original',
                'additional_price' => 0
            ],
            [
                'products_id' => 5,
                'name' => 'Extra Rice',
                'additional_price' => 8000
            ],
            [
                'products_id' => 5,
                'name' => 'Extra BBQ Sauce',
                'additional_price' => 12000
            ],
            [
                'products_id' => 6,
                'name' => 'original',
                'additional_price' => 0
            ],
            [
                'products_id' => 6,
                'name' => 'Extra Rice',
                'additional_price' => 8000
            ],
            [
                'products_id' => 6,
                'name' => 'Extra BBQ Sauce',
                'additional_price' => 12000
            ],
            [
                'products_id' => 7,
                'name' => 'original',
                'additional_price' => 0
            ],
            [
                'products_id' => 7,
                'name' => 'Extra Rice',
                'additional_price' => 8000
            ],
            [
                'products_id' => 7,
                'name' => 'Extra BBQ Sauce',
                'additional_price' => 12000
            ],
            [
                'products_id' => 8,
                'name' => 'original',
                'additional_price' => 0
            ],
            [
                'products_id' => 8,
                'name' => 'Extra Rice',
                'additional_price' => 8000
            ],
            [
                'products_id' => 8,
                'name' => 'Extra BBQ Sauce',
                'additional_price' => 12000
            ]
        ]);
    }
}
