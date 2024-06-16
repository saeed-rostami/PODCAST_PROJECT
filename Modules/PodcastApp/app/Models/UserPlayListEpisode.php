<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PodcastApp\Database\Factories\UserPlayListEpisodeFactory;

class UserPlayListEpisode extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected $table = 'user_play_list_episodes';

    protected static function newFactory(): UserPlayListEpisodeFactory
    {
        //return UserPlayListEpisodeFactory::new();
    }

    public function playlist(): BelongsTo
    {
        return $this->belongsTo(UserPlayList::class);
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }
}
