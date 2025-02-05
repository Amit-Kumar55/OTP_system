******\*\*******\*\*******\*\******* OTP Verification System ******\*\*******\*\*\*\*******\*\*******

* Installation

* Prerequisites

* PHP 8.1+

* Laravel 10+

* Composer

* Livewire 3+ with Volt

* Alpine.js

1. Steps
   Clone the repository:
   git clone -b master https://github.com/Amit-Kumar55/OTP_system.git
   cd <project_directory>

2. Install dependencies:
   composer install
   npm install && npm run dev

3. Set up environment variables:
   cp .env.example .env
   php artisan key:generate

4. Configure database in .env:
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=your_database
   DB_USERNAME=your_username
   DB_PASSWORD=your_password

5. Run migrations:
   php artisan migrate

6. Install required packages:
   composer require livewire/livewire
   composer require livewire/volt
   composer require laravel/ui

7. Configure Volt:Add the Volt service provider in config/app.php:
   Livewire\Volt\VoltServiceProvider::class,
   Then install Volt:
   php artisan volt:install

8. Run the Laravel development server:
   php artisan serve

Testing
To test the OTP verification system, follow these steps:

* Run tests using PHPUnit:

php artisan test

* Test OTP Generation and Verification:

$user = User::factory()->create();
$otp = Otp::create([
'user_id' => $user->id,
'code' => '123456',
'expires_at' => now()->addMinutes(15),
]);

$response = $this->actingAs($user)->post('/verify-otp', ['otp' => '123456']);
$response->assertSessionHas('message', 'OTP Verified Successfully!');

* Assumptions

* The user must be authenticated before requesting an OTP.

* OTPs expire after 15 minutes.

* Only numeric OTPs (6 digits) are allowed.

* The OTP can be sent via SMS or Email.

* Livewire and Volt are used for handling OTP verification.

* The system must prevent brute-force attacks with rate-limiting

* Additional Features

* Auto-focus & auto-submit on OTP input fields.

* Clipboard paste support for OTP input.

* Real-time error messages for validation failures.

* Session-based flash messages for feedback.

* Secure one-time use OTP verification.

* Technical Decisions

* Livewire with Volt: Used to create a seamless OTP verification experience without full-page reloads.

* Middleware for authentication: Ensured routes requiring authentication use auth middleware.

*Service Class for OTP Management: Moved OTP generation and verification logic to OtpService.php for maintainability.

* Route Definition: Used Volt::route('/otp-verification', 'otp-verification'); to define OTP routes.

* Error Handling & Debugging: Fixed issues related to Auth::user() returning null and RouteNotFoundException for Livewire.

* Layout Fixes: Ensured resources/views/layouts/app.blade.php properly included @livewireStyles and @livewireScripts.

* Security Measures: Implemented one-time usage and expiration checks for OTPs.
