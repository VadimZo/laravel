<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
            'title' => $this->faker->text(15),
            'content' => $this->faker->realText(250),
            'description' => $this->faker->realText(50),
            'views' => $this->faker->numberBetween(1000,8000),
            'status' => 0,
            'is_featured'=>0,
            'image'=>'blog-1.jpg',
            'date'=>'2020-11-09',
            'category_id'=>$this->faker->numberBetween(11,14),

        ];
    }
}
