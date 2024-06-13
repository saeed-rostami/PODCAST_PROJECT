<?php

namespace Modules\PodcastApp\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\PodcastApp\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories_podcast = [
            "هنر",
            "کسب و کار",
            "کمدی",
            "آموزش",
            "داستان",
            "داستان",
            "تاریخی",
            "سرگرمی",
            "جنایات واقعی",
            "تکنولوژی",
            "ورزش",
            "جامعه و فرهنگ",
        ];

        $categories_audio_book = [
            "هنر",
            "کسب و کار",
            "کمدی",
            "آموزش",
            "داستان",
            "داستان",
            "تاریخی",
            "سرگرمی",
            "جنایات واقعی",
            "تکنولوژی",
            "ورزش",
            "جامعه و فرهنگ",
        ];

        $categories_music = [
            "موسیقی ملل",
            "راک",
            "پاپ",
            "سنتی ایرانی",
            "کلاسیک",
        ];

        foreach ($categories_podcast as $item) {
            Category::query()
                ->create([
                    'type_id' => 1,
                    'title' => $item,
                ]);
        }

        foreach ($categories_audio_book as $item) {
            Category::query()
                ->create([
                    'type_id' => 3,
                    'title' => $item,
                ]);
        }

        foreach ($categories_music as $item) {
            Category::query()
                ->create([
                    'type_id' => 2,
                    'title' => $item,
                ]);
        }
    }
}
