<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\UserFollowedPodcast;

final readonly class FollowedPodcastTrigger
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {

        $podcast_id = $args['podcast_id'];

        $exists = UserFollowedPodcast::query()
            ->where(['user_id' => Auth::id(), 'podcast_id' => $podcast_id])
            ->exists();

        if ($exists) {
            return UserFollowedPodcast::query()
                ->where(['user_id' => Auth::id(), 'podcast_id' => $podcast_id])
                ->delete();
        } else {
            return UserFollowedPodcast::query()
                ->create(
                    ['user_id' => Auth::id(), 'podcast_id' => $podcast_id]
                );
        }
    }
}
