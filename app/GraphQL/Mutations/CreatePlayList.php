<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\UserPlayList;

final readonly class CreatePlayList
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        $title = $args["title"];
        $is_private = $args["is_private"];

        return UserPlayList::query()
            ->create([
                "title" => $title,
                "user_id" => Auth::id(),
                "is_private" => $is_private,
            ]);
    }
}
