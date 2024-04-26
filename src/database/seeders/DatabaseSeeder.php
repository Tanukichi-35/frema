<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ConditionsTableSeeder::class,
            AddressesTableSeeder::class,
            ItemsTableSeeder::class,
            ItemCategoriesTableSeeder::class,
            AdminsTableSeeder::class,
        ]);

        \App\Models\User::factory(7)->create();
        \App\Models\Like::factory(30)->create();
        \App\Models\Comment::factory(30)->create();
    }
}
