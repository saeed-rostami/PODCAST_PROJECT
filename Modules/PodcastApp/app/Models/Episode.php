<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PodcastApp\Database\Factories\EpisodeFactory;

class Episode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

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

}
