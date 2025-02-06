<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'title' => fake()->sentence(),
            'body' => fake()->paragraph(),
            'content' => fake()->text(1000),
            'user_id' => User::inRandomOrder()->first()->id ?? User::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            // Attach multiple random categories to the post
            $categories = \App\Models\Category::inRandomOrder()->limit(rand(1, 5))->pluck('id');
            $post->categories()->attach($categories);
        });
    }
}
