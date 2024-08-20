<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\CustomException;
use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\UserPlayList;
use Modules\PodcastApp\Models\UserPlayListEpisode;

final readonly class DeletePlayList
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        $playlist = UserPlayList::query()
            ->find($args['id']);

        if ($playlist->user_id != Auth::id()) {
            throw new CustomException("Invalid playlist" , 422);
        }

        UserPlayListEpisode::query()
            ->where("playlist_id", $args['id'])
            ->delete();

        return $playlist->forceDelete();
    }
}
