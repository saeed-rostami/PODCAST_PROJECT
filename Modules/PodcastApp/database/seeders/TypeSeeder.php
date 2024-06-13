<?php

namespace Modules\PodcastApp\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PodcastApp\Models\Type;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $this->call([]);

        $types = [
          "پادکست",
          "موسیقی",
          "کتاب صوتی",
        ];

        foreach ($types as $type) {
            Type::query()
                ->create([
                   "title" => $type
                ]);
        }
    }
}
