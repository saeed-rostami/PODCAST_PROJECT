<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Scout\Searchable;
use Modules\PodcastApp\Database\Factories\EpisodeFactory;
use Modules\PodcastApp\Traits\JalaliDate;
use Modules\PodcastApp\Traits\Taging;

class Episode extends Model
{
    use HasFactory, SoftDeletes, Taging, JalaliDate, Searchable;

    protected $table = "episodes";

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected static function newFactory(): EpisodeFactory
    {
        return EpisodeFactory::new();
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function channel()
    {
        return $this->season->channel;
    }

    public function file() : HasOne
    {
        return $this->hasOne(EpisodeFile::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'item');

    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'item');
    }

    public function listens(): HasMany
    {
        return $this->hasMany(UserListeningAnalytics::class);
    }

    public function userListenedSecond()
    {
        $user_id = Auth::id();
        return UserListeningAnalytics::query()
            ->where("episode_id" , $this->id)
            ->where("user_id" , $user_id)
            ->first()
        ?->second;
    }

    public function isLiked(): bool
    {
        if (!Auth::check()) {
            return false;
        }

        return DB::table("likes")
            ->where("user_id", Auth::id())
            ->where("item_type", self::class)
            ->where("item_id", $this->id)
            ->exists();
    }


   protected static function booted(): void
   {
       self::addGlobalScope("published", function (Builder $query) {
            $query
               ->whereNotNull("published_at");
       });
   }
}
