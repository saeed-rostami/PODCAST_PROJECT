<?php

namespace Modules\PodcastApp\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\PodcastApp\Models\EpisodeTag;
use Modules\PodcastApp\Models\Tag;

trait Taging
{
    public function saveTags(array $items)
    {
        if (count($items) === 0) {
            return ;
        }
        $tags = Tag::query()->whereIn("title", $items)->get();
        $fetchedTitles = [];
        foreach ($tags as $item) {
            $fetchedTitles[] = $item->title;
        }
        $diff = array_diff($items, $fetchedTitles);
        if (count($diff) === 0) {
            $this->tags()->sync($tags->pluck("id"));
            return;
        }
        foreach ($diff as $diffTag) {
            $tags->add(Tag::create(["title" => $diffTag]));
        }
        $this->tags()->sync($tags->pluck("id"));
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class , 'episode_tags');
    }
}
