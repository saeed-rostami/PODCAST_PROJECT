<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\UserFollowedChannel;

final readonly class FollowedChannelTrigger
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {

        $channel_id = $args['channel_id'];

        $exists = UserFollowedChannel::query()
            ->where(['user_id' => Auth::id(), 'channel_id' => $channel_id])
            ->exists();

        if ($exists) {
            return UserFollowedChannel::query()
                ->where(['user_id' => Auth::id(), 'channel_id' => $channel_id])
                ->delete();
        } else {
            return UserFollowedChannel::query()
                ->create(
                    ['user_id' => Auth::id(), 'channel_id' => $channel_id]
                );
        }
    }
}
