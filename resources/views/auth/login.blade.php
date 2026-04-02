<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    {{-- <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form> --}}
    <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <x-text-input id="email" 
                        class="block w-full border-gray-300 rounded-md p-3 focus:ring-[#785144] focus:border-[#785144]" 
                        type="email" name="email" 
                        :placeholder="__('Enter email address')"
                        :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

              <div class="mb-6 relative">

                <x-text-input id="password" 
                    class="block w-full border-gray-300 rounded-md p-3 pr-12 focus:ring-[#785144] focus:border-[#785144]"
                    type="password"
                    name="password"
                    :placeholder="__('Enter Password')"
                    required />

                <!-- Eye Icon -->
                <span onclick="togglePassword('password', 'eyeIcon1')"
                    class="absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-gray-500">
                    <i id="eyeIcon1" class="fa fa-eye"></i>
                </span>

                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>
                <button type="submit" class="w-full bg-[#785144] hover:bg-[#5d3f35] text-white font-bold py-3 px-4 rounded-md transition duration-200">
                    {{ __('Login') }}
                </button>

                <div class="mt-8 text-center text-sm">
                    <span class="text-gray-600">New to topuniversityindia.com?</span>
                    <a href=" class="text-[#785144] font-bold hover:underline ml-1">
                        Sign Up
                    </a>
                </div>
                
                @if (Route::has('password.request'))
                    <div class="mt-2 text-center">
                        <a class="text-xs text-gray-500 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    </div>
                @endif
            </form>
</x-guest-layout>
