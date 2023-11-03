<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 塞假資料給Controller用
            'id' => Str::uuid(),
            'name' => fake()->name(),
            'message' => fake()->text(),
            'created_at' => fake()->dateTimeInInterval('-40 days', '-20 days'),
            'updated_at' => fake()->dateTimeBetween('-20 days')
        ];
    }
}
