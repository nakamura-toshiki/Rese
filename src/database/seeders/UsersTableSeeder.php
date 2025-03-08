<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'Owner User',
                'email' => 'owner@example.com',
                'password' => Hash::make('owner12345'),
                'role' => 'owner',
            ],
            [
                'id' => 3,
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('user12345'),
                'role' => 'user',
            ]
        ];
        DB::table('users')->insert($param);
    }
}
