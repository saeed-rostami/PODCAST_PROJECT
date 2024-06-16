<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\CommentFactory;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "comments";

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];


    protected static function newFactory(): CommentFactory
    {
        //return CommentFactory::new();
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
