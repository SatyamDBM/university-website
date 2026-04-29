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

        $user = User::create([
            'name'             => $validated['name'],
            'email'            => $validated['email'],
            'mobile'           => $validated['mobile'],
            'password'         => Hash::make($validated['password']),
            'role'             => 'university',
            'status'           => 'active',
            'linking_status'   => 'not_linked',
            'email_otp'        => $otp,
            'email_otp_expiry' => now()->addMinutes(10),
            'is_email_verified' => false,
        ]);

        try {
            $user->notify(new RegistrationSuccessNotification('otp', $otp));
        } catch (\Exception $e) {
            \Log::error('Notification Error: ' . $e->getMessage());
        }

        // ✅ Session bilkul nahi — sirf email URL mein
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
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required'],
        ]);

        // ✅ DB se user dhundho aur OTP match karo
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        if ((string)$user->email_otp !== (string)$request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP.']);
        }

        if ($user->email_otp_expiry < now()) {
            return back()->withErrors(['otp' => 'OTP expired.']);
        }

        $user->update([
            'is_email_verified' => true,
            'email_otp'         => null,
            'email_otp_expiry'  => null,
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        // ✅ session hatao, sirf request se email lo
        $email = $request->email;

        $user = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $otp = rand(100000, 999999);

        $user->update([
            'email_otp'        => $otp,
            'email_otp_expiry' => now()->addMinutes(10), // ✅ sahi column name
        ]);

        try {
            Mail::to($user->email)->send(new SendOtpMail($otp));
        } catch (\Exception $e) {
            \Log::error('Resend OTP Mail Error: ' . $e->getMessage());
            return back()->with('error', 'Failed to send OTP. Try again.');
        }

        return back()->with('success', 'OTP resent successfully!');
    }
}
