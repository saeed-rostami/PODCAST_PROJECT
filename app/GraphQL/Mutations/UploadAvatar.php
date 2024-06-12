<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

final readonly class UploadAvatar
{
    /** @param  array{}  $args */
    public function __invoke(null $_, array $args)
    {
        $file = $args['file'];

        $path = Storage::putFile('avatars', $file);
        $profile = UserProfile::query()
            ->where("user_id", Auth::id())
            ->first();

        $profile->update([
           'avatar' => $path
        ]);

        return true;
    }
}
