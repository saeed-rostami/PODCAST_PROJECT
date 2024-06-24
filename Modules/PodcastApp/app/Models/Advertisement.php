<?php

namespace Modules\PodcastApp\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\AdvertisementFactory;

class Advertisement extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected $table = "advertisements";

    protected static function newFactory(): AdvertisementFactory
    {
        //return AdvertisementFactory::new();
    }

    public function item(): MorphTo
    {
        return $this->morphTo("item");
    }
}
