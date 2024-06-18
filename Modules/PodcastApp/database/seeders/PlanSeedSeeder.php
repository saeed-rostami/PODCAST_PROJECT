<?php

namespace Modules\PodcastApp\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PodcastApp\Models\SubscriptionPlan;

class PlanSeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ["title" => "اشتراک یک ماهه" , "price" => 50000 , "duration_days" => 30],
            ["title" => "اشتراک سه ماهه" , "price" => 80000 , "duration_days" => 90],
            ["title" => "اشتراک شش ماهه" , "price" => 120000 , "duration_days" => 180],
            ["title" => "اشتراک 12 ماهه" , "price" => 200000 , "duration_days" => 365],
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::query()
                ->create([
                    "title" => $plan["title"],
                    "description" => "description",
                    "price" => $plan["price"],
                    "duration_days" => $plan["duration_days"],
                    "is_active" => true,
                ]);
        }
    }
}
