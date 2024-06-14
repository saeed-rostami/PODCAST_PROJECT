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
    protected $guarded = ['id'];

    protected $table = 'episode_files';

    protected $casts = ['metas' => 'json'];

    protected static function newFactory(): EpisodeFileFactory
    {
        //return EpisodeFileFactory::new();
    }
}
