<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class ItemCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'item_id' => Item::all()[0]->id,
            'category_id' => '4',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[1]->id,
            'category_id' => '2',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[2]->id,
            'category_id' => '1',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[2]->id,
            'category_id' => '2',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[3]->id,
            'category_id' => '5',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[4]->id,
            'category_id' => '3',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[5]->id,
            'category_id' => '5',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[6]->id,
            'category_id' => '3',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[7]->id,
            'category_id' => '4',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[8]->id,
            'category_id' => '3',
        ];
        DB::table('item_categories')->insert($param);

        $param = [
            'item_id' => Item::all()[9]->id,
            'category_id' => '4',
        ];
        DB::table('item_categories')->insert($param);
    }
}
