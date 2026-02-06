<x-guest-layout>
    <form method="POST" action="{{ route('university.register') }}">
        @csrf

        <!-- Full Name -->
        <div>
            <x-input-label value="Full Name" />
            <x-text-input
                name="name"
                type="text"
                class="block mt-1 w-full"
                value="{{ old('name') }}"
                required
            />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <!-- University -->
        <div class="mt-4">
            <x-input-label value="Select University" />
            <select name="university_name" required
                class="block w-full mt-1 rounded-md border-gray-300">
                <option value="">-- Select University --</option>
                <option value="Delhi University">Delhi University</option>
                <option value="Mumbai University">Mumbai University</option>
                <option value="Amity University">Amity University</option>
                <option value="Chandigarh University">Chandigarh University</option>
                <option value="Lovely Professional University">Lovely Professional University</option>
            </select>
            <x-input-error :messages="$errors->get('university_name')" />
        </div>

        <!-- Mobile (🔥 FIXED) -->
        <div class="mt-4">
            <x-input-label value="Mobile Number" />
            <x-text-input
                name="mobile"
                type="text"
                maxlength="10"
                class="block mt-1 w-full"
                value="{{ old('mobile') }}"
                required
            />
            <x-input-error :messages="$errors->get('mobile')" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label value="Corporate Email" />
            <x-text-input
                name="email"
                type="email"
                class="block mt-1 w-full"
                value="{{ old('email') }}"
                required
            />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label value="Password" />
            <x-text-input
                name="password"
                type="password"
                class="block mt-1 w-full"
                required
            />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label value="Confirm Password" />
            <x-text-input
                name="password_confirmation"
                type="password"
                class="block mt-1 w-full"
                required
            />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a href="{{ route('login') }}"
               class="text-sm underline text-gray-600">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
