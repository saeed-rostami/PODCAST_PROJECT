<?php declare(strict_types=1);

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\Channel;

final readonly class MyChannels
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        return Channel::query()
            ->where('user_id', Auth::id())
            ->get();
    }
}
