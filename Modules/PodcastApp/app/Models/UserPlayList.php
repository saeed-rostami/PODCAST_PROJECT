<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\UserPlayListFactory;

class UserPlayList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'user_playlists';

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
}
