<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\Episode;
use Modules\PodcastApp\Models\Like;
use Modules\PodcastApp\Models\UserFollowedPodcast;

final readonly class LikeTrigger
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $item = $args['item'];
        $item_id = $args['item_id'];

        $exists = Like::query()
            ->where(['user_id' => Auth::id(), 'item_type' => Episode::class , 'item_id' => $item_id])
            ->exists();

        if ($exists) {
            return Like::query()
                ->where(['user_id' => Auth::id(), 'item_type' => Episode::class , 'item_id' => $item_id])
                ->delete();
        } else {
            return Like::query()
                ->create(
                    ['user_id' => Auth::id(), 'item_type' => Episode::class , 'item_id' => $item_id]
                );
        }
    }
}
