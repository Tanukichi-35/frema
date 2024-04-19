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
            'name' => '小物',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '雑貨',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => '周辺機器',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => 'カメラ',
        ];
        DB::table('categories')->insert($param);

        $param = [
            'name' => 'ファッション',
        ];
        DB::table('categories')->insert($param);
    }
}
