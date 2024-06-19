<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\CustomException;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\SubscriptionPlan;
use Modules\PodcastApp\Models\UserSubscribedPlanHistory;

final readonly class OrderSubscriptionPlan
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        $user = Auth::user();
        if ($user->hasActivePlan()) {
            throw new CustomException("You have subscribed already" , 422);
        }
        $plan = SubscriptionPlan::query()
            ->find($args['plan_id']);

        $now = Carbon::now();
        $plan_days = $plan->duration_days;
        $expire_at = $now->addDays($plan_days);

        return UserSubscribedPlanHistory::query()
            ->create([
                "user_id" => Auth::id(),
                "plan_id" => $args['plan_id'],
                "start_at" => $now,
                "expire_at" => $expire_at,
                "price" => $plan->price

            ]);
    }
}
