<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\University;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'university_name' => ['required', 'string', 'max:255'],
            'mobile'          => ['required', 'digits:10'],
            'email'           => ['required', 'email', 'max:255', 'unique:users,email'],
            'password'        => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => 'university',
        ]);
        $university = University::create([
            'name'    => $validated['university_name'],
            'email'   => $validated['email'],
            'mobile'  => $validated['mobile'],
            'user_id' => $user->id,
        ]);

        event(new Registered($user));
        Auth::login($user);
        return redirect()->route('university.dashboard');
    }
}
