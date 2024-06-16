<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\PodcastFactory;

class Podcast extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "podcasts";

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected static function newFactory(): PodcastFactory
    {
        return PodcastFactory::new();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(Season::class);
    }

    public function episodes(): HasManyThrough
    {
        return $this->hasManyThrough(
            Episode::class,
            Season::class,
            "podcast_id",
            'season_id'
        );
    }

    public function follows(): HasMany
    {
        return $this->hasMany(UserFollowedPodcast::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'item');

    }


    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'item');

    }
}
