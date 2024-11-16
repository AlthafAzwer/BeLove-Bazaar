<x-guest-layout>
    <div class="container" style="background-color: rgba(255, 255, 255, 0.9); padding: 1.5rem; border-radius: 12px; max-width: 350px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <!-- Logo -->
        <img src="{{ asset('images/Relove logo.png') }}" alt="Relove Bazaar Logo" style="width: 60px; margin-bottom: 8px;">
        
        <!-- Title -->
        <h2 style="font-size: 1.3rem; font-weight: 600; color: #4a90e2; margin-bottom: 1.5rem;">ReLove Bazaar</h2>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                              style="width: 100%; padding: 0.6rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div style="margin-top: 0.8rem;">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password"
                              style="width: 100%; padding: 0.6rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center" style="font-size: 0.9rem;">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Login and Forgot Password Link -->
            <div style="margin-top: 1.2rem; display: flex; justify-content: space-between; align-items: center;">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" style="color: #4a90e2; font-size: 0.85rem; text-decoration: none; font-weight: 500;">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button style="padding: 0.6rem 1.2rem; background: linear-gradient(135deg, #4a90e2, #50e3c2); border-radius: 6px; font-size: 0.9rem; font-weight: bold; color: #fff;">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
