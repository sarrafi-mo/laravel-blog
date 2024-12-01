<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->unique()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->faker->paragraph(30, true),
            'category' => 'economic',
            'image' => '1732949026-674ab422f24dd.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
