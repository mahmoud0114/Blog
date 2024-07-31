<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
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
       $title = $this->faker->sentence(10);
        return [
            'title' => $title ,
            'slug' => Str::slug($title),
            'description' => $this->faker->sentence(100),
              'image_path' => 'https://picsum.photos/640/480?random=' . rand(1, 1000), 
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Post $post) {
            $tags = \App\Models\Tag::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $post->tags()->attach($tags);
        });
    }
}
