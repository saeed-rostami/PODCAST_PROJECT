<?php

namespace Modules\PodcastApp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PodcastApp\Models\Podcast;

class PodcastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Podcast::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(150),
            'category_id' => rand(1,30),
            'user_id' => 1,
            "allow_comment" => $this->faker->boolean(),
            'cover' => "cover.jpg",
        ];
    }
}

