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
                'content' => '寿司'
            ],
            [
                'id' => 2,
                'content' => '焼肉'
            ],
            [
                'id' => 3,
                'content' => '居酒屋'
            ],
            [
                'id' => 4,
                'content' => 'イタリアン'
            ],
            [
                'id' => 5,
                'content' => 'ラーメン'
            ],
        ];

        DB::table('categories')->insert($param);
    }
}
