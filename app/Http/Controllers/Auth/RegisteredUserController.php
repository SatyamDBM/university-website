<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtpMail;
use App\Notifications\RegistrationSuccessNotification;

class RegisteredUserController extends Controller
{
    /**
     * Show Register Form
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Register + Send OTP
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'mobile'   => ['required', 'digits:10'],
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $otp = rand(100000, 999999);

        try {
            $user = User::create([
                'name'              => $validated['name'],
                'email'             => $validated['email'],
                'mobile'            => $validated['mobile'],
                'password'          => Hash::make($validated['password']),
                'role'              => 'university',
                'status'            => 'active',
                'linking_status'    => 'not_linked',
                'email_otp'         => $otp,
                'email_otp_expiry'  => now()->addMinutes(10), // ✅ make sure this matches DB column
                'is_email_verified' => false,
            ]);
        } catch (\Exception $e) {
            \Log::error('User Create Error: ' . $e->getMessage());
            return back()->withErrors(['email' => 'Registration failed. Try again.'])->withInput();
        }

        // Send OTP — don't let this block registration
        try {
            Mail::to($user->email)->send(new SendOtpMail($otp));
        } catch (\Exception $e) {
            \Log::error('OTP Mail Error: ' . $e->getMessage());
            // Continue even if mail fails
        }

        \Log::info('User registered, redirecting to OTP: ' . $user->email);

        // ✅ Redirect with email in URL
        return redirect()->route('otp.verify.form', ['email' => $user->email]);
    }

    public function showOtpForm(Request $request)
    {
        // ✅ URL se email lo
        $email = $request->query('email');

        if (!$email) {
            return redirect()->route('university.register')
                ->with('error', 'Please register again.');
        }

        return view('auth.verify-otp', compact('email'));
    }


    public function verifyOtp(Request $request): RedirectResponse
    {
        \Log::info('OTP Verify Request', $request->all());

        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required'],
        ]);

        $email = $request->email;
        $user = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('otp.verify.form', ['email' => $email])
                ->withErrors(['email' => 'User not found.']);
        }

        \Log::info('DB OTP: ' . $user->email_otp . ' | Request OTP: ' . $request->otp);

        if ((string)$user->email_otp !== (string)$request->otp) {
            return redirect()->route('otp.verify.form', ['email' => $email])
                ->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }

        if ($user->email_otp_expiry < now()) {
            return redirect()->route('otp.verify.form', ['email' => $email])
                ->withErrors(['otp' => 'OTP expired. Please resend.']);
        }

        $user->update([
            'is_email_verified' => true,
            'email_otp'         => null,
            'email_otp_expiry'  => null,
        ]);

        Auth::login($user);

        \Log::info('OTP Verified - Login success');

        return redirect()->route('dashboard');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $email = $request->email;
        $user  = User::where('email', $email)->first();

        if (!$user) {
            return redirect()->route('otp.verify.form', ['email' => $email])
                ->withErrors(['email' => 'User not found.']);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'email_otp'        => $otp,
            'email_otp_expiry' => now()->addMinutes(10),
        ]);

        try {
            Mail::to($user->email)->send(new SendOtpMail($otp));
        } catch (\Exception $e) {
            \Log::error('Resend OTP Error: ' . $e->getMessage());
            return redirect()->route('otp.verify.form', ['email' => $email])
                ->with('error', 'Failed to send OTP.');
        }

        return redirect()->route('otp.verify.form', ['email' => $email])
            ->with('success', 'OTP resent successfully!');
    }
}
