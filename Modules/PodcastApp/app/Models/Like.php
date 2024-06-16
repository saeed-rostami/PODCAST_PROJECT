<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Modules\PodcastApp\Database\Factories\LikesFactory;

class Like extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected $table = 'likes';

    protected static function newFactory(): LikesFactory
    {
        //return LikesFactory::new();
    }

    public function item(): MorphTo
    {
        return $this->morphTo('item');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
