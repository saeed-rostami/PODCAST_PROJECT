<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\UserPlayListEpisode;

final readonly class SyncEpisodeToPlayList
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        $episode_id = $args['episode_id'];
        $playlist_id = $args['playlist_id'];

        $exists = UserPlayListEpisode::query()
            ->where(['playlist_id' => $playlist_id, 'episode_id' => $episode_id])
            ->exists();

        if ($exists) {
            return UserPlayListEpisode::query()
                ->where(['playlist_id' => $playlist_id, 'episode_id' => $episode_id])
                ->delete();
        } else {
            return UserPlayListEpisode::query()
                ->create(
                    ['playlist_id' => $playlist_id, 'episode_id' => $episode_id]
                );
        }
    }
}
