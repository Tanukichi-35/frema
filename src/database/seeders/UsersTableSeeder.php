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
            'name' => 'バイヤー1',
            'email' => 'buyer1@user.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'バイヤー1',
            'email' => 'buyer2@user.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => 'テスト太郎',
            'email' => 'test@user.com',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($param);
    }
}
