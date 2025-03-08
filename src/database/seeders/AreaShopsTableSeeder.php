<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AreaShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            ['shop_id' => 1, 'area_id' => 13],
            ['shop_id' => 2, 'area_id' => 27],
            ['shop_id' => 3, 'area_id' => 40],
            ['shop_id' => 4, 'area_id' => 13],
            ['shop_id' => 5, 'area_id' => 40],
            ['shop_id' => 6, 'area_id' => 13],
            ['shop_id' => 7, 'area_id' => 27],
            ['shop_id' => 8, 'area_id' => 13],
            ['shop_id' => 9, 'area_id' => 27],
            ['shop_id' => 10, 'area_id' => 13],
            ['shop_id' => 11, 'area_id' => 27],
            ['shop_id' => 12, 'area_id' => 40],
            ['shop_id' => 13, 'area_id' => 13],
            ['shop_id' => 14, 'area_id' => 27],
            ['shop_id' => 15, 'area_id' => 13],
            ['shop_id' => 16, 'area_id' => 27],
            ['shop_id' => 17, 'area_id' => 13],
            ['shop_id' => 18, 'area_id' => 13],
            ['shop_id' => 19, 'area_id' => 40],
            ['shop_id' => 20, 'area_id' => 27],
        ];
        DB::table('area_shops')->insert($param);
    }
}
