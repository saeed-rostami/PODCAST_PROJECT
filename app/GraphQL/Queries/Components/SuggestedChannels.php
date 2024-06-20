<?php declare(strict_types=1);

namespace App\GraphQL\Queries\Components;

use Modules\PodcastApp\Classes\ComponentClass;
use Modules\PodcastApp\Models\Component;
use Modules\PodcastApp\Models\Episode;

final readonly class SuggestedChannels
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        $component = Component::query()
            ->where("class", "SUGGESTED_CHANNELS")
            ->first();

        $episodes = Episode::query()
            ->take(5)
            ->get();

        $data = (new ComponentClass($episodes))
            ->setKey($component->key)
            ->setDisplayKey($component->display_key)
            ->setSortOrder($component->sort_order)
            ->setClass($component->class)
            ->setUrl($component->class)
            ->setIsActive($component->is_active)
        ->render();

        return $data;
    }
}
