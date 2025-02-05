<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Otp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OtpVerification extends Component
{
    public $otp = ['', '', '', '', '', ''];
    public $message = '';

    public function sendOtp()
    {

        $user = Auth::user();

        if (!$user) {
            $this->message = 'User not authenticated.';
            return;
        }

        // Generate a 6-digit OTP
        $otpCode = random_int(100000, 999999);

        // Store OTP in the database
        Otp::create([
            'user_id' => $user->id,
            'code' => $otpCode,
            'type' => 'sms', // Or 'email'
            'expires_at' => now()->addMinutes(15),
        ]);

        // Simulate OTP sent (In real-world, send via email/SMS)
        $this->message = "OTP Sent! (Code: {$otpCode})"; // Remove in production
    }

    public function verifyOtp()
    {
        $code = implode('', $this->otp);

        if (!ctype_digit($code) || strlen($code) !== 6) {
            $this->message = 'OTP must be 6 numeric digits.';
            return;
        }

        $user = Auth::user();

        if (!$user) {
            $this->message = 'User not authenticated.';
            return;
        }

        $otp = Otp::where('code', $code)
            ->where('user_id', $user->id)
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            $this->message = 'Invalid or expired OTP.';
            return;
        }

        // Mark OTP as verified
        $otp->update(['verified_at' => now()]);

        // Clear the OTP input fields
        $this->otp = [];

        $this->message = 'OTP Verified Successfully!';
    }


    // public function render()
    // {
    //     return view('livewire.otp-verification');
    // }

    public function render()
    {
        return view('livewire.otp-verification');
    }
}
