<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\PodcastApp\Database\Factories\EpisodeFileFactory;

class EpisodeFile extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    protected static function newFactory(): EpisodeFileFactory
    {
        //return EpisodeFileFactory::new();
    }
}
