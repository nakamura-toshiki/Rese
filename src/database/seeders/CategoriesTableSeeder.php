<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            [
                'id' => 1,
                'content' => '寿司',
                'image' => 'storage/images/sushi.jpg'
            ],
            [
                'id' => 2,
                'content' => '焼肉',
                'image' => 'storage/images/yakiniku.jpg'
            ],
            [
                'id' => 3,
                'content' => '居酒屋',
                'image' => 'storage/images/izakaya.jpg'
            ],
            [
                'id' => 4,
                'content' => 'イタリアン',
                'image' => 'storage/images/italian.jpg'
            ],
            [
                'id' => 5,
                'content' => 'ラーメン',
                'image' => 'storage/images/ramen.jpg'
            ],
        ];

        DB::table('categories')->insert($param);
    }
}
