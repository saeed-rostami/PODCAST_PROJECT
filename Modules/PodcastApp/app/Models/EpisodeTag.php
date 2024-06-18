<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PodcastApp\Database\Factories\EpisodeTagFactory;

class EpisodeTag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ["id"];
    protected $table = "episode_tags";

    protected static function newFactory(): EpisodeTagFactory
    {
        //return EpisodeTagFactory::new();
    }

    public function tag(): BelongsTo
    {
        return $this->belongsTo(Tag::class);
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }
}
