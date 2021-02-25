<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(10),
            'content' => $this->faker->paragraph(rand(30,100)),
            'user_id' => rand(1,10),
            'published_at' => date('Y-m-d H:i:s'),
            'image' => NULL,
            'category_id' => rand(1,10),
        ];
    }
}
