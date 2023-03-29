<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Spaghetti Aglio Olio',
                'description' => 'Spaghetti that cooked with onion and olive oil',
                'price' => 50000
            ],
            [
                'name' => 'Ice Teavana',
                'description' => 'A fresh tea with ice',
                'price' => 18000
            ],
            [
                'name' => 'White Choclate Moccachino',
                'description' => 'A fresh choclate blend with mocha',
                'price' => 51000
            ],
            [
                'name' => 'Chicken Fried Rice',
                'description' => 'Just a fried chicken :)',
                'price' => 32000
            ],
            [
                'name' => 'Super Chicken Teriyaki',
                'description' => 'Chicken with teriyaki',
                'price' => 35000
            ],
            [
                'name' => 'Meatball with curry',
                'description' => 'Meatball with curry',
                'price' => 28000
            ],
            [
                'name' => 'Roasted Chicken Mayo',
                'description' => 'We roast chicken with mayo',
                'price' => 25000
            ],
            [
                'name' => 'Steak with mash potato',
                'description' => 'Yap, it just a steak with mash potato',
                'price' => 45000
            ],
            [
                'name' => 'Strawberry Gelato',
                'description' => 'Cold',
                'price' => 38000
            ],
            [
                'name' => 'Chocolate brownies',
                'description' => 'Choclate with nice',
                'price' => 24000
            ],
            [
                'name' => 'Caramel Macchiato',
                'description' => 'Macchiato with caramel sauce',
                'price' => 51000
            ]
        ]);
    }
}
