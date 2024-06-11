<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\CustomException;
use App\Models\User;
use Carbon\Carbon;
use Modules\OTP\Models\OTP;
use Modules\OTP\Traits\OTPAuth;

final readonly class OTPRequest
{
    use OTPAuth;

    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {
        $mobile = $args['mobile'];
        return $this->otpRequest($mobile);

    }

    public function otpRequest($mobile): OTP
    {
        $mobile = $this->normalizePhoneNumber($mobile);
        $isNewUser = false;

        if ($otp = $this->getByMobile($mobile)) {
            if ($otp->otp_expire_at < date('Y-m-d H:i:s', strtotime("now"))) {
                $otp = $this->regenerateOtp($otp);
            }
            if (!optional($otp->user)->username) {
                $isNewUser = true;
            }

        } else {

            $user = $this->createUser($mobile);

            $otp = $this->createOtpRelation($user->id, null, $mobile, null);
            $isNewUser = true;
        }


        return $otp;

    }

}
