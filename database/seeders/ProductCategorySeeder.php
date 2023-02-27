<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories =  [
            [
                'name' => 'Skin Care',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hair Pomade',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Raw Pomade',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Combos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert($category);
        }

        // $products =  [
        //     [
        //         'category_id' => '',
        //         'name' => 'Skin Care',
        //         'price' => '',
        //         'discount' => '',
        //         'description' => '',
        //         'featured' => '',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ],
        // ];

        // foreach ($products as $product) {
        //     DB::table('products')->insert($product);
        // }
    }
}
