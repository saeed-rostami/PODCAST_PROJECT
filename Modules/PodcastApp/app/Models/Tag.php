<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\TagFactory;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ["id"];
    protected $table = "tags";

    protected static function newFactory(): TagFactory
    {
        //return TagFactory::new();
    }
}
