<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\Episode;

final readonly class MyDratEpisodes
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return Episode::query()
            ->withoutGlobalScopes(["published"])
            ->whereHas("season.channel", function (Builder $q) {
                $q->where("user_id", Auth::id());
            })
           ->whereNull("published_at")
            ->get()
            ;
    }
}
