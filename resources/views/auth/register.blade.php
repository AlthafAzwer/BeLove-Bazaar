<x-guest-layout>
    <div class="container" style="background-color: rgba(255, 255, 255, 0.9); padding: 1.5rem; border-radius: 12px; max-width: 350px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <!-- Logo -->
        <img src="{{ asset('images/Relove logo.png') }}" alt="Relove Bazaar Logo" class="logo" style="width: 60px; margin-bottom: 8px;">
        
        <!-- Title -->
        <h2 style="font-size: 1.3rem; font-weight: 600; color: #4a90e2; margin-bottom: 1rem;">ReLove Bazaar</h2>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="input-field" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" style="width: 100%; padding: 0.6rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;" />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Role Selection -->
            <div>
                <label for="role" style="display: block; margin-top: 0.8rem; font-weight: bold; font-size: 0.9rem;">Register as:</label>
                <select id="role" name="role" class="input-field" required style="width: 100%; padding: 0.6rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;">
                    <option value="buyer">Buyer</option>
                    <option value="seller">Seller</option>
                    <option value="charity">Charity Organization</option>
                </select>
            </div>

            <!-- Email Address -->
            <div style="margin-top: 0.8rem;">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="input-field" type="email" name="email" :value="old('email')" required autocomplete="username" style="width: 100%; padding: 0.6rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div style="margin-top: 0.8rem;">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="input-field" type="password" name="password" required autocomplete="new-password" style="width: 100%; padding: 0.6rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Confirm Password -->
            <div style="margin-top: 0.8rem;">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="input-field" type="password" name="password_confirmation" required autocomplete="new-password" style="width: 100%; padding: 0.6rem; margin-top: 0.4rem; border: 1px solid #d1d5db; border-radius: 6px; font-size: 0.9rem;" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
            </div>

            <!-- Register Button -->
            <div style="margin-top: 1.2rem;">
                <x-primary-button class="button" style="width: 100%; padding: 0.6rem; background: linear-gradient(135deg, #4a90e2, #50e3c2); border-radius: 6px; font-size: 1rem; font-weight: bold; color: #fff;">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

            <!-- Already Registered Link -->
            <div class="text-center" style="margin-top: 1rem;">
                <a href="{{ route('login') }}" style="color: #4a90e2; font-size: 0.85rem; text-decoration: none; font-weight: 500;">
                    {{ __('Already registered? Log in') }}
                </a>
            </div>
        </form>
    </div>
</x-guest-layout>
