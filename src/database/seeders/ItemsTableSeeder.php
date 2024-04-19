<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'カメラ',
            'description' => '古いカメラです。ジャンク品です。',
            'condition_id' => '4',
            'price' => 300,
            'img_url' => asset('img/camera.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '小物ケース',
            'description' => '小物を色々収納できます。',
            'condition_id' => '3',
            'price' => 600,
            'img_url' => asset('img/case.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'マグカップ',
            'description' => 'ピンク色のかわいいマグカップです。',
            'condition_id' => '1',
            'price' => 1200,
            'img_url' => asset('img/cup.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '偏光グラス',
            'description' => '運転、アウトドア用に。',
            'condition_id' => '2',
            'price' => 2000,
            'img_url' => asset('img/glass.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '外付けHDD',
            'description' => '容量:1TB、USB3.0対応。',
            'condition_id' => '3',
            'price' => 9800,
            'img_url' => asset('img/hdd.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '自転車用ヘルメット',
            'description' => 'シンプルなデザインの自転車用ヘルメットです。',
            'condition_id' => '1',
            'price' => 3000,
            'img_url' => asset('img/helmet.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'キーボード',
            'description' => '白くきれいなキーボードです。',
            'condition_id' => '2',
            'price' => 4900,
            'img_url' => asset('img/keyboard.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '交換用レンズ',
            'description' => '望遠レンズ。',
            'condition_id' => '3',
            'price' => 12000,
            'img_url' => asset('img/lens.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '静音マウス',
            'description' => 'クリック音の無いマウスです。',
            'condition_id' => '1',
            'price' => 2500,
            'img_url' => asset('img/mouse.jp'),
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'フィルター',
            'description' => 'カメラ用のフィルター',
            'condition_id' => '2',
            'price' => 1200,
            'img_url' => asset('img/filter.jp'),
        ];
        DB::table('items')->insert($param);
    }
}
