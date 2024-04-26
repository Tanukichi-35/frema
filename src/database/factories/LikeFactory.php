<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class LikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(4,10),
            'item_id' => Item::all()[$this->faker->numberBetween(0,9)]->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
