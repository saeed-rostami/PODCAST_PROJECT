<?php

namespace Modules\PodcastApp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PodcastApp\Models\Season;

class EpisodeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\PodcastApp\Models\Episode::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
//            'season_id' => self::factoryForModel(Season::class)->create()->id,
            'cover' => "cover.jpg",
            "allow_share" => $this->faker->boolean(),
            "allow_comment" => $this->faker->boolean(),
            "publish_at" => $this->faker->date(),
            "published_at" => $this->faker->randomElement([$this->faker->date(), null]),

        ];
    }
}

