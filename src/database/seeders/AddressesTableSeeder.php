<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'user_id' => '3',
            'postcode' => '150-0043',
            'address' => '東京都渋谷区道玄坂',
            'building' => 'サムシンビル',
        ];
        DB::table('addresses')->insert($param);
    }
}
