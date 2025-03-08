<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            ['shop_id' => 1, 'category_id' => 1],
            ['shop_id' => 2, 'category_id' => 2],
            ['shop_id' => 3, 'category_id' => 3],
            ['shop_id' => 4, 'category_id' => 4],
            ['shop_id' => 5, 'category_id' => 5],
            ['shop_id' => 6, 'category_id' => 2],
            ['shop_id' => 7, 'category_id' => 4],
            ['shop_id' => 8, 'category_id' => 5],
            ['shop_id' => 9, 'category_id' => 3],
            ['shop_id' => 10, 'category_id' => 1],
            ['shop_id' => 11, 'category_id' => 2],
            ['shop_id' => 12, 'category_id' => 2],
            ['shop_id' => 13, 'category_id' => 3],
            ['shop_id' => 14, 'category_id' => 1],
            ['shop_id' => 15, 'category_id' => 5],
            ['shop_id' => 16, 'category_id' => 3],
            ['shop_id' => 17, 'category_id' => 1],
            ['shop_id' => 18, 'category_id' => 2],
            ['shop_id' => 19, 'category_id' => 4],
            ['shop_id' => 20, 'category_id' => 1],
        ];

        DB::table('category_shops')->insert($param);
    }
}
