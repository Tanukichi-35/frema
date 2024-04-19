<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '新品',
        ];
        DB::table('conditions')->insert($param);

        $param = [
            'name' => '良品',
        ];
        DB::table('conditions')->insert($param);

        $param = [
            'name' => '使用感有り',
        ];
        DB::table('conditions')->insert($param);

        $param = [
            'name' => 'ジャンク品',
        ];
        DB::table('conditions')->insert($param);
    }
}
