<?php

namespace Modules\PodcastApp\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PodcastApp\Models\Channel;
use Modules\PodcastApp\Models\Episode;
use Modules\PodcastApp\Models\Podcast;
use Modules\PodcastApp\Models\Season;

class PodcastAppDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);
//        $this->call(TypeSeeder::class);
//        $this->call(CategorySeeder::class);
//        $this->call(PlanSeedSeeder::class);

        Channel::factory()
            ->has(Season::factory()
                ->has(Episode::factory()->count(3))
                ->count(1))
            ->count(25)
            ->create();

    }
}
