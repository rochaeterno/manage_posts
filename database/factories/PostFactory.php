<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        return [
            "title" => $this->faker->word(),
            "author" => $this->faker->name(),
            "content" => $this->faker->paragraph(),
            "tags" => $this->faker->words(5)
        ];
    }
}
