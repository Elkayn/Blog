<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition(): array
    {
        return [
            'content' => fake()->text,
//            'profile_id' => Profile::first()->id,
            'commentable_type' => 'App\Models\Post',
            'commentable_id' => Post::inRandomOrder()->first()->id
            //'post_id' => Post::inRandomOrder()->first()->id
        ];
    }
}
