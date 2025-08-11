<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-6 text-center">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Welcome to Clinivie</h1>
        <p class="text-gray-600">Sign in to access your clinic management system</p>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
            <x-text-input id="email" class="input-modern block mt-2 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
            <x-text-input id="password" class="input-modern block mt-2 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-sky-600 hover:text-sky-800 hover:underline transition-colors" href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
            @endif
        </div>

        <div class="space-y-4">
            <button type="submit" class="btn-primary w-full py-3 px-4 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300">
                {{ __('Sign In') }}
            </button>

            <div class="text-center">
                <span class="text-sm text-gray-600">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-sm text-sky-600 hover:text-sky-800 font-medium hover:underline transition-colors ml-1">
                    Create one here
                </a>
            </div>
        </div>
    </form>

    <!-- Demo Accounts -->
    {{-- <div class="mt-8 p-4 bg-sky-50 rounded-lg border border-sky-200">
        <h3 class="text-sm font-semibold text-gray-900 mb-3">Demo Accounts:</h3>
        <div class="grid grid-cols-2 gap-3 text-xs">
            <div class="bg-white p-2 rounded border">
                <div class="font-medium text-sky-700">Patient</div>
                <div class="text-gray-600">patient@clinic.com</div>
            </div>
            <div class="bg-white p-2 rounded border">
                <div class="font-medium text-blue-700">Doctor</div>
                <div class="text-gray-600">doctor@clinic.com</div>
            </div>
            <div class="bg-white p-2 rounded border">
                <div class="font-medium text-cyan-700">Nurse</div>
                <div class="text-gray-600">nurse@clinic.com</div>
            </div>
            <div class="bg-white p-2 rounded border">
                <div class="font-medium text-indigo-700">Admin</div>
                <div class="text-gray-600">admin@clinic.com</div>
            </div>
        </div>
        <p class="text-xs text-gray-500 mt-2">Password: password</p>
    </div> --}}
</x-guest-layout>
