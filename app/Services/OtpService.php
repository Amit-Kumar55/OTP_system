<?php

namespace App\Services;

use App\Models\Otp;
use App\Models\User;
use Illuminate\Support\Carbon;

class OtpService
{
    public static function generateOtp(User $user, $type = 'email')
    {
        $otpCode = rand(100000, 999999);

        $otp = Otp::create([
            'user_id' => $user->id,
            'code' => $otpCode,
            'type' => $type,
            'expires_at' => Carbon::now()->addMinutes(15),
        ]);

        return $otpCode;
    }

    public static function verifyOtp(User $user, string $code)
    {
        $otp = Otp::where('user_id', $user->id)
            ->where('code', $code)
            ->whereNull('verified_at')
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if ($otp) {
            $otp->update(['verified_at' => Carbon::now()]);
            return true;
        }

        return false;
    }
}
