<?php

namespace Modules\PodcastApp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PodcastApp\Models\Channel;

class PodcastFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = Channel::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(150),
            'category_id' => rand(1,15),
            'user_id' => 1,
            "allow_comment" => $this->faker->boolean(),
            'cover' => "cover.jpg",
            'financial_status' => "FREE"
        ];
    }
}

