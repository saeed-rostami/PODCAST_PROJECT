<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;

final readonly class UpdateProfile
{
    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        $user = User::query()->find(Auth::id());
        if ($args['username']) {
            $user->update([
                'username' => $args['username']
            ]);
        }

        $profile = UserProfile::query()
            ->where("user_id", $user->id)
            ->first();

        if (!$profile) {
            UserProfile::query()
                ->create(
                    [
                        'birthday' => $args['birthday'],
                        'donate' => $args['donate'],
                        'donate_text' => $args['donate_text'],
                        'user_id' => $user->id
                    ]
                );
        } else {
            $profile->update(
                [
                    'birthday' => $args['birthday'],
                    'donate' => $args['donate'],
                    'donate_text' => $args['donate_text'],
                ]
            );
        }
        return $user;
    }
}
