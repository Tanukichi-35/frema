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
            'name' => 'テスト太郎',
            'email' => 'test@user.com',
            // 'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'address_id' => '1',
            'created_at' => now(),
            'updated_at' => now(),
        ];
        DB::table('users')->insert($param);
    }
}
