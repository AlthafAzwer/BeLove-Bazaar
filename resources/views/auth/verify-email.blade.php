<x-guest-layout>
    <div class="container" style="background-color: #f0f4f8; padding: 2rem; border-radius: 12px; max-width: 400px; text-align: center; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
        <h2 style="font-size: 1.5rem; font-weight: 600; color: #4a90e2; margin-bottom: 1.5rem;">Verify Your Email</h2>

        <p class="mb-4 text-sm text-gray-600">
            {{ __('Before proceeding, please check your email for a verification link.') }}
        </p>

        @if (session('message'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="button" style="width: 100%; padding: 0.8rem; background: linear-gradient(135deg, #4a90e2, #50e3c2); border-radius: 8px; font-size: 1.1em; font-weight: bold; color: #fff;">
                {{ __('Resend Verification Email') }}
            </button>
        </form>
    </div>
</x-guest-layout>
