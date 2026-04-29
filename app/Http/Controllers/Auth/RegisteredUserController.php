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
            'name'           => $validated['name'],
            'email'          => $validated['email'],
            'mobile'         => $validated['mobile'],
            'password'       => Hash::make($validated['password']),
            'role'           => 'university',
            'status'         => 'active',
            'linking_status' => 'not_linked',
            'email_otp'      => $otp,
            'email_otp_expiry' => now()->addMinutes(10),
            'is_email_verified'    => false,
        ]);
        // Mail::to($user->email)->send(new SendOtpMail($otp));
        $user->notify(new RegistrationSuccessNotification('otp', $otp));
        // ✅ session mein email store karo
        session(['otp_email' => $user->email]);
        return redirect()->route('otp.verify.form');
    }

    /**
     * Show OTP Form
     */
    public function showOtpForm(Request $request)
    {
        $email = session('otp_email');

        if (!$email) {
            return redirect()->route('university.register')
                ->with('error', 'Session expired. Please register again.');
        }

        return view('auth.verify-otp', compact('email'));
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
            'otp'   => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        // ✅ email_otp field + loose comparison (string vs int)
        if ((string)$user->email_otp !== (string)$request->otp) {
            return back()->withErrors(['otp' => 'Invalid OTP. Please try again.']);
        }

        if ($user->email_otp_expiry < now()) {
            return back()->withErrors(['otp' => 'OTP expired. Please resend.']);
        }
        // ✅ correct field names
        $user->update([
            'is_email_verified'    => true,
            'email_otp'      => null,
            'email_otp_expiry' => null,
        ]);
        // $user->notify(new RegistrationSuccessNotification('welcome'));

        // ✅ session clear
        session()->forget('otp_email');

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request): RedirectResponse
    {
        $email = $request->email ?? session('otp_email');
        $user  = User::where('email', $email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'User not found.']);
        }

        $otp = rand(100000, 999999);

        // ✅ email_otp not otp
        $user->update([
            'email_otp'      => $otp,
            'otp_expires_at' => now()->addMinutes(10),
        ]);

        Mail::to($user->email)->send(new SendOtpMail($otp));

        return back()->with('success', 'OTP resent successfully!');
    }
}
