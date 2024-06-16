<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\Episode;

final readonly class LikeEpisodes
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return Episode::query()
            ->whereHas('likes', function ($builder) {
                $builder->where("user_id", Auth::id());
            })
            ->get();
    }
}
