<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\Podcast;

final readonly class FollowedPodcasts
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return Podcast::query()
            ->whereHas("follows", function ($builder) {
                $builder->where("user_id", Auth::id());
            })
            ->get();
    }
}
