<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\UserPlayListFactory;

class UserPlayList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_play_lists';

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected static function newFactory(): UserPlayListFactory
    {
        //return UserPlayListFactory::new();
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function episodes(): BelongsToMany
    {
        return $this->belongsToMany(
            Episode::class,
            'user_play_list_episodes',
            'playlist_id',
            'episode_id'
        );
    }
}
