<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\EpisodeFactory;

class Episode extends Model
{
    use HasFactory, SoftDeletes;

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

    public function podcast()
    {
        return $this->season->podcast;
    }

    public function file() : HasOne
    {
        return $this->hasOne(EpisodeFile::class);
    }

    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'item');

    }
}
