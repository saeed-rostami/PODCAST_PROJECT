<?php


namespace Modules\OTP\Traits;

use App\Models\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Modules\OTP\Models\OTP as OTPAuthModel;
use Modules\OTP\Rules\MobileRule;
use Symfony\Component\HttpFoundation\Response;

trait OTPAuth
{
    /**
     * @param $mobile
     *
     * @return OTPAuthModel
     * @throws ValidationException
     */
    public function otpRequest($mobile): OTPAuthModel
    {
        $mobile = $this->validateOTPRequest($mobile);

        if ($otp = $this->getByMobile($mobile)) {

            $otp = $this->regenerateOtp($otp);

        } else {
            $user = $this->createUser();

            $otp = $this->createOtpRelation($user->id, $mobile);
        }

        return $otp;
    }

    /**
     * @param $mobile
     *
     * @return bool|string
     * @throws ValidationException
     */
    protected function validateOTPRequest($mobile)
    {
        $mobile = $this->normalizePhoneNumber($mobile);

        Validator::validate(['mobile' => $mobile], [
            'mobile' => ['required', new MobileRule()],
        ]);

        return $mobile;
    }

    /**
     * normalize mobile numbers
     *
     * @param $mobile
     *
     * @return bool|string
     */
    public function normalizePhoneNumber($mobile)
    {
        if (preg_match('/^(09)[0-9]{9}$/', $mobile, $matches, PREG_OFFSET_CAPTURE, 0)) {
            return '98' . substr($mobile, 1);
        } else if (preg_match('/^(9)[0-9]{9}$/', $mobile, $matches, PREG_OFFSET_CAPTURE, 0)) {
            return '98' . $mobile;
        } else if (preg_match('/^(0989)[0-9]{9}$/', $mobile, $matches, PREG_OFFSET_CAPTURE, 0)) {
            return substr($mobile, 1);
        } else {
            return $mobile;
        }
    }

    /**
     * @param $mobile
     *
     * @return mixed
     */
    public function getByMobile($mobile)
    {
        return OTPAuthModel::whereMobile($this->normalizePhoneNumber($mobile))->first();
    }

    /**
     * @param OTPAuthModel $otp
     *
     * @return OTPAuthModel
     */
    public function regenerateOtp(OTPAuthModel $otp): OTPAuthModel
    {
        $otp->update([
            'otp' => $this->generateCode(),
            'otp_expire_at' => date('Y-m-d H:i:s', strtotime("+5 min")),
        ]);

        return $otp->refresh();
    }

    /**
     * @return string
     */
    public function generateCode($length = 4)
    {
        $characters = "123456789";

        $randomChars = '';
        for ($i = 0; $i < $length; $i++) {
            $randomChars .= $characters[rand(1, 8)];
        }

        return $randomChars;
    }

    /**
     * @param array $data
     *
     * @return User|Model
     */
    public function createUser($data = [])
    {
        return User::create(['mobile' => $data]);
    }

    /**
     * @param $user_id
     * @param $mobile
     *
     * @return mixed
     */
    public function createOtpRelation($user_id, $email = null, $phoneNumber, $type)
    {
        return OTPAuthModel::create([
            'user_id' => $user_id,
            'user_type' => User::class,
            'email' => $email,
            'mobile' => $phoneNumber,
            'otp' => $this->generateCode(),
            'type' => $type,
            'otp_expire_at' => date('Y-m-d H:i:s', strtotime("+5 min")),
        ]);
    }

    /**
     * @param $mobile
     * @param $code
     *
     * @return bool|Response
     * @throws ValidationException
     */
    public function login($mobile, $code)
    {

        $mobile = $this->validateLogin($mobile, $code);

        if (!$token = $this->attempt($mobile, $code)) {
            return $this->sendFailedLoginResponse();
        }

        return $this->sendLoginResponse();
    }

    /**
     * @param $mobile
     * @param $code
     *
     * @return bool|string
     */
    protected function validateLogin($mobile, $code)
    {
        $mobile = $this->normalizePhoneNumber($mobile);

        Validator::validate(['mobile' => $mobile, 'code' => $code], [
            'mobile' => ['required', new MobileRule()],
            'code' => ['required', 'numeric'],
        ]);

        return $mobile;
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
            return false;
        }

        if ($otpModel->otp == $code && $otpModel->otp_expire_at > date('Y-m-d H:i:s', strtotime("now"))) {

            $otpModel->update(['otp' => null, 'otp_expire_at' => null]);

            return $this->guard()->login($otpModel->user);
        }

        return false;
    }

    /**
     * @return Guard|StatefulGuard
     */
    public function guard()
    {
        return Auth::guard('api');
    }

    /**
     * Get the failed login response instance.
     *
     * @return Response
     */
    protected function sendFailedLoginResponse()
    {
        throw ValidationException::withMessages([
            'mobile' => [trans('auth.failed')],
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @return JsonResponse
     */
    protected function sendLoginResponse()
    {
        return redirect()->intended($this->redirectPath());
    }

    /**
     * @return string
     */
    public function redirectPath()
    {
        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }

    /**
     *
     */
    public function logout()
    {
        $this->guard()->logout();

        return $this->sendLogoutResponse();
    }

    /**
     * Send the response after the user was logout.
     *
     * @return JsonResponse
     */
    protected function sendLogoutResponse()
    {
        return redirect()->intended($this->redirectPath());
    }

    public function findUserByEmail($email)
    {
        return User::query()->where('email', $email)->first();
    }

}
