<x-guest-layout>
    <div class="container" style="background-color: rgba(255, 255, 255, 0.9); padding: 2rem; border-radius: 12px; max-width: 400px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        
        <!-- Title -->
        <h2 style="font-size: 1.5rem; font-weight: 600; color: #4a90e2; margin-bottom: 1.5rem;">Forgot Password</h2>

        <div class="mb-4 text-sm text-gray-600" style="color: #333;">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" style="text-align: left;">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" style="font-weight: bold; color: #333;" />
                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autofocus style="width: 100%; padding: 0.8rem; margin-top: 0.5rem; border: 1px solid #d1d5db; border-radius: 8px; font-size: 1rem;" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-6">
                <x-primary-button style="width: 100%; padding: 0.8rem; background: linear-gradient(135deg, #4a90e2, #50e3c2); border-radius: 8px; font-size: 1.1em; font-weight: bold; color: #fff;">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
