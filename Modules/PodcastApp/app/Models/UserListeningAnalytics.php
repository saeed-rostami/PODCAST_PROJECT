<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\PodcastApp\Database\Factories\UserListeningAnalyticsFactory;

class UserListeningAnalytics extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];

    protected $table = 'user_listening_analytics';

    protected static function newFactory(): UserListeningAnalyticsFactory
    {
        //return UserListeningAnalyticsFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }
}
