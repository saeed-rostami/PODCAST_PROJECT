<?php declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\GraphQL\CustomException;
use Modules\OTP\Traits\OTPAuth;

final readonly class AuthenticateUser
{
    use OTPAuth;

    /** @param array{} $args */
    public function __invoke(null $_, array $args)
    {

        $mobile = $this->normalizePhoneNumber($args['mobile']);

        return $this->login($mobile, $args['code']);
    }

    /**
     * @param $mobile
     * @param $code
     *
     * @return boolean|string
     */
    public function login($mobile, $code)
    {
        if (!$token = $this->attempt($mobile, $code)) {
            throw new CustomException("Invalid credentials" , 422);

        }

        return $token;
    }

    /**
     * @param $mobile
     * @param $code
     *
     * @return bool|string
     */
    public function attempt($mobile, $code)
    {
        $otpModel = $this->getByMobile($mobile);

        if (!$otpModel) {
            throw new CustomException("Not found mobile" , 422);

        }

        if ($otpModel->otp == $code && $otpModel->otp_expire_at > date('Y-m-d H:i:s', strtotime("now"))) {

            $otpModel->update(['otp' => null, 'otp_expire_at' => null]);

            return $this->guard()->login($otpModel->user);
        }

        return null;
    }
}
