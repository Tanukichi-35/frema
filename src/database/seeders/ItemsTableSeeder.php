<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Str;

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
            'id' => Str::uuid(),
            'name' => 'カメラ',
            'description' => '古いカメラです。ジャンク品です。',
            'user_id' => '1',
            'condition_id' => '1',
            'price' => 300,
            'img_url' => 'img/camera.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => '小物ケース',
            'description' => '小物を色々収納できます。',
            'user_id' => '1',
            'condition_id' => '3',
            'price' => 600,
            'img_url' => 'img/case.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => 'マグカップ',
            'description' => 'ピンク色のかわいいマグカップです。',
            'user_id' => '2',
            'condition_id' => '1',
            'price' => 1200,
            'img_url' => 'img/cup.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => '偏光グラス',
            'description' => '運転、アウトドア用に。',
            'user_id' => '1',
            'condition_id' => '2',
            'price' => 2000,
            'img_url' => 'img/glass.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => '外付けHDD',
            'description' => '容量:1TB、USB3.0対応。',
            'user_id' => '1',
            'condition_id' => '3',
            'price' => 9800,
            'img_url' => 'img/hdd.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => '自転車用ヘルメット',
            'description' => 'シンプルなデザインの自転車用ヘルメットです。',
            'user_id' => '2',
            'condition_id' => '1',
            'price' => 3000,
            'img_url' => 'img/helmet.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => 'キーボード',
            'description' => '白くきれいなキーボードです。',
            'user_id' => '1',
            'condition_id' => '2',
            'price' => 4900,
            'img_url' => 'img/keyboard.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => '交換用レンズ',
            'description' => '望遠レンズ。',
            'user_id' => '1',
            'condition_id' => '3',
            'price' => 12000,
            'img_url' => 'img/lens.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => 'トラックボールマウス',
            'description' => '人間工学に基づいたすごいマウス。',
            'user_id' => '1',
            'condition_id' => '1',
            'price' => 2500,
            'img_url' => 'img/mouse.jpg',
        ];
        DB::table('items')->insert($param);

        $param = [
            'id' => Str::uuid(),
            'name' => 'フィルター',
            'description' => 'カメラ用の減光、偏光フィルター。',
            'user_id' => '1',
            'condition_id' => '2',
            'price' => 1200,
            'img_url' => 'img/filter.jpg',
        ];
        DB::table('items')->insert($param);
    }
}
