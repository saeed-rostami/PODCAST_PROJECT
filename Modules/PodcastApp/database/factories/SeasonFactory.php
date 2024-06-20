<?php

namespace Modules\PodcastApp\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\PodcastApp\Models\Podcast;

class SeasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\PodcastApp\Models\Season::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            "title" => "Season 1",
        ];
    }
}

