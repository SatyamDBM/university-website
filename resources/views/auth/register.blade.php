<x-guest-layout>
    {{-- <form method="POST" action="{{ route('university.register') }}">
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
    </form> --}}

     <form method="POST" action="{{ route('university.register') }}">
    @csrf

    <!-- University Name -->
    <div class="mb-4">
        <input type="text" name="name"
            placeholder="University Name *"
            value="{{ old('name') }}"
            class="w-full border border-gray-300 rounded-md px-4 py-3"
            required
            >

        @error('name')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Email -->
    <div class="mb-4">
        <input type="email" name="email"
            placeholder="Email Address *"
            value="{{ old('email') }}"
            class="w-full border border-gray-300 rounded-md px-4 py-3"
            required>

        @error('email')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Mobile -->
    <div class="mb-4">
        <input type="text" name="mobile"
            placeholder="Mobile Number *"
            maxlength="10"
            value="{{ old('mobile') }}"
            class="w-full border border-gray-300 rounded-md px-4 py-3"
            required>

        @error('mobile')
            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Password -->
  <div class="mb-4 relative">
    <input type="password" name="password" id="password"
        placeholder="Password *"
        class="w-full border border-gray-300 rounded-md px-4 py-3 pr-12"
        required>

    <!-- Eye Icon -->
    <span onclick="togglePassword('password', 'eyeIcon1')"
        class="absolute right-4 top-3 cursor-pointer text-gray-500">
        <i id="eyeIcon1" class="fa fa-eye"></i>
    </span>

    @error('password')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

    <!-- Confirm Password -->
   <div class="mb-4 relative">
    <input type="password" name="password_confirmation" id="confirmPassword"
        placeholder="Confirm Password*"
        class="w-full border border-gray-300 rounded-md px-4 py-3 pr-12"
        required>
    <!-- Eye Icon -->
    <span onclick="togglePassword('confirmPassword', 'eyeIcon2')"
        class="absolute right-4 top-3 cursor-pointer text-gray-500">
        <i id="eyeIcon2" class="fa fa-eye"></i>
    </span>
</div>
    <!-- Terms -->
    <div class="flex items-start mb-4 text-sm text-gray-600">
        <input type="checkbox" name="terms" class="mt-1 mr-2" required>
        <span>
            By clicking continue button, you agree with the
            <a href="#" class="underline">Terms & Conditions</a>
            and
            <a href="#" class="underline">Privacy policy</a>
        </span>
    </div>

    @error('terms')
        <p class="text-red-500 text-sm mb-3">{{ $message }}</p>
    @enderror

    <!-- Register Button -->
    <button type="submit"
        class="w-full bg-[#7B4F3A] text-white py-3 rounded-md text-lg font-semibold hover:opacity-90">
        Register
    </button>

    <!-- Login -->
    <p class="text-center text-sm text-gray-600 mt-4">
        Already Have an Account?
        <a href="{{ route('login') }}" class="text-[#7B4F3A] font-semibold">
            Login
        </a>
    </p>
</form>
</x-guest-layout>
