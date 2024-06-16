<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use Illuminate\Support\Facades\Auth;
use Modules\PodcastApp\Models\Comment;
use Modules\PodcastApp\Models\Episode;
use Modules\PodcastApp\Models\Like;

final readonly class CreateComment
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $item_type = $args['item_type'];
        $item_id = $args['item_id'];
        $comment = $args['comment'];

        return Comment::query()
            ->create([
                'user_id' => Auth::id(),
                'item_type' => Episode::class ,
                'item_id' => $item_id ,
                'comment' => $comment])
          ;
    }
}
