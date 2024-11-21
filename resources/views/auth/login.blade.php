<x-guest-layout>
    <style>
        .login-container {
            position: relative;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin: 0 auto;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #0a192f;
            z-index: -1;
            overflow: hidden;
        }

        .star {
            position: absolute;
            background: white;
            border-radius: 50%;
            animation: twinkle 2s infinite;
        }

        @keyframes twinkle {
            0% { opacity: 0; }
            50% { opacity: 1; }
            100% { opacity: 0; }
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
            width: 100px;
            height: 100px;
            margin: 0 auto 2rem auto;
            padding: 10px;
            background: white;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .logo-container img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            border-radius: 50%;
        }

        .form-input {
            border: 1px solid #e2e8f0;
            border-radius: 0.375rem;
            padding: 0.5rem 0.75rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #4f46e5;
        }

        .btn-primary {
            background-color: #4f46e5;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        @keyframes logoFloat {
            0% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
            100% { transform: translateY(0); }
        }

        .logo-container {
            animation: logoFloat 3s ease-in-out infinite;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelector('.stars');
            for (let i = 0; i < 100; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.width = Math.random() * 3 + 'px';
                star.style.height = star.style.width;
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.animationDelay = Math.random() * 2 + 's';
                stars.appendChild(star);
            }
        });
    </script>

    <div class="stars"></div>

    <div class="login-container">
        <!-- Logo -->
        <div class="logo-container">
            <img src="{{ asset('images/logo-unib.png') }}" alt="Logo UNIB">
        </div>

        <div class="text-center mb-4">
            <h2 class="text-xl font-bold text-indigo-600">Selamat Datang di Laman Login</h2>
            <p class="text-gray-600">Silakan masuk menggunakan email dan password Anda untuk mengakses layanan kami.</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
                <x-primary-button class="btn-primary ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

        </form>
    </div>
</x-guest-layout>
