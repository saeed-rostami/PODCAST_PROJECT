<?php

namespace Modules\PodcastApp\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\PodcastApp\Database\Factories\UserSubscribedPlanHistoryFactory;

class UserSubscribedPlanHistory extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id'];
    protected $table = "user_subscribed_plan_histories";

    protected static function newFactory(): UserSubscribedPlanHistoryFactory
    {
        //return UserSubscribedPlanHistoryFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(SubscriptionPlan::class);
    }

    public function isExpired(): bool
    {
        return $this->expire_at < Carbon::now();
    }
}
