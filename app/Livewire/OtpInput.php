<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Otp; // Ensure this import exists
// use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth;


class OtpInput extends Component
{

    public $otp = [];


    public function verifyOtp()
    {
        if (!ctype_digit(implode('', $this->otp)) || count($this->otp) !== 6) {
            session()->flash('error', 'OTP must be 6 numeric digits.');
            return;
        }

        $user = Auth::user(); // Correct way to get authenticated user
        if (!$user) {
            session()->flash('error', 'User is not authenticated.');
            return;
        }

        $code = implode('', $this->otp);
        $otp = Otp::where('code', $code)
            ->where('user_id', $user->id) // Get user ID properly
            ->whereNull('verified_at')
            ->where('expires_at', '>', now())
            ->first();

        if (!$otp) {
            session()->flash('error', 'Invalid or expired OTP.');
            return;
        }

        $otp->update(['verified_at' => now()]);
        session()->flash('message', 'OTP Verified Successfully!');
    }




    public function render()
    {
        return view('livewire.otp-input');
    }
}
