<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Otp;

class OtpTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_otp_verification()
    {
        $user = User::factory()->create();
        $otp = Otp::create([
            'user_id' => $user->id,
            'code' => '123456',
            'expires_at' => now()->addMinutes(15),
        ]);

        $response = $this->actingAs($user)->post('/verify-otp', ['otp' => '123456']);
        $response->assertSessionHas('message', 'OTP Verified Successfully!');
    }
}
