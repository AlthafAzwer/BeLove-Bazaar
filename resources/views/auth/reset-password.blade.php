<x-guest-layout>
    <div class="container" style="background-color: #f0f4f8; padding: 2rem; border-radius: 12px; max-width: 400px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        
        <!-- Title -->
        <h2 style="font-size: 1.5rem; font-weight: 600; color: #4a90e2; margin-bottom: 1.5rem;">Reset Password</h2>

        <!-- Reset Password Form -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" style="width: 100%; padding: 0.8rem; margin-top: 0.5rem; border: 1px solid #d1d5db; border-radius: 8px;" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="input-field" type="password" name="password" required autocomplete="new-password" style="width: 100%; padding: 0.8rem; margin-top: 0.5rem; border: 1px solid #d1d5db; border-radius: 8px;" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required autocomplete="new-password" style="width: 100%; padding: 0.8rem; margin-top: 0.5rem; border: 1px solid #d1d5db; border-radius: 8px;" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Reset Password Button -->
            <div class="flex items-center justify-center mt-6">
                <x-primary-button class="button" style="width: 100%; padding: 0.8rem; background: linear-gradient(135deg, #4a90e2, #50e3c2); border-radius: 8px; font-size: 1.1em; font-weight: bold; color: #fff;">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
