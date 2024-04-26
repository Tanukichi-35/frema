<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class CommentFactory extends Factory
{
    private static int $i = 1;

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
            'comment' => $this->faker->realText($maxNbChars = 30),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
