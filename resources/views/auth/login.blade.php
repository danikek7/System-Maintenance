<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Maintenance System - FATHMA MEDIKA HOSPITAL</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .bg-gradient-custom {
                background: linear-gradient(135deg, #60a5fa 0%, #3b82f6 50%, #1e40af 100%);
            }
            .card-shadow {
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            .floating-animation {
                animation: float 6s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                50% { transform: translateY(-10px) rotate(2deg); }
            }
            .tech-pattern {
                background-image: 
                    radial-gradient(circle at 2px 2px, rgba(255,255,255,0.15) 1px, transparent 0);
                background-size: 20px 20px;
            }
        </style>
    </head>
    <body class="min-h-screen bg-gradient-custom flex items-center justify-center p-4 overflow-y-auto">
    
    <!-- Main Container -->
    <div class="bg-white rounded-2xl card-shadow overflow-hidden max-w-4xl w-full flex flex-col-reverse md:flex-row">
        
        <!-- Left Side - Login Form -->
        <div class="flex-1 p-6 sm:p-8 md:p-10 lg:p-12">
            <div class="max-w-md mx-auto">
                <!-- Header -->
                <div class="text-center mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Welcome to</h1>
                    <h2 class="text-xl md:text-3xl font-bold text-gray-800 mb-2">Maintenance System</h2>
                    <h2>FATHMA MEDIKA HOSPITAL</h2>
                    <p class="text-xs text-gray-500 mt-2">Please use your account to access our system</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- Username Field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <x-text-input 
                            id="username" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                            type="text" 
                            name="username" 
                            placeholder="Username"
                            :value="old('username')" 
                            required 
                            autofocus 
                            autocomplete="username" 
                        />
                        <x-input-error :messages="$errors->get('username')" class="mt-2" />
                    </div>

                    <!-- Password Field -->
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <x-text-input 
                            id="password" 
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent outline-none transition-all duration-200 bg-gray-50 focus:bg-white"
                            type="password"
                            name="password"
                            placeholder="Password"
                            required 
                            autocomplete="current-password" 
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label class="inline-flex items-center cursor-pointer">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Login Button -->
                    <button 
                        type="submit" 
                        class="w-full bg-blue-800 hover:bg-blue-900 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-105 focus:ring-4 focus:ring-blue-300 focus:outline-none mt-6"
                    >
                        {{ __('Log in') }}
                    </button>
                </form>

                <!-- Additional Links -->
                <div class="flex items-center justify-between mt-6">
                    @if (Route::has('password.request'))
                        <a 
                            class="text-sm text-blue-800 hover:underline" 
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Side - Welcome Panel -->
        <div class="flex-1 p-8 md:p-12 text-white relative overflow-hidden min-h-[300px]" style="background-image: url('image.png'); background-size: cover; background-position: center;">
            <!-- Tech Pattern Background -->
            <div class="absolute inset-0 tech-pattern opacity-30"></div>
            
            <!-- Content -->
            <div class="relative z-10 h-full flex flex-col justify-center text-center md:text-left">
                <h3 class="text-2xl md:text-3xl font-bold mb-4">Hello, Everyone!</h3>
                <p class="text-blue-100 mb-8 text-sm md:text-base leading-relaxed">
                    Let's make another great day's<br>
                    and keep smile
                </p>
                <div class="flex justify-center md:justify-start">
                    <x-application-logo class="w-20 h-20 fill-current text-white" />
                </div>
            </div>

            <!-- Floating decorations -->
            <div class="absolute -top-4 -right-2 w-2 h-2 bg-white rounded-full opacity-60 floating-animation" style="animation-delay: -1s;"></div>
            <div class="absolute -bottom-2 -left-4 w-1 h-1 bg-white rounded-full opacity-40 floating-animation" style="animation-delay: -3s;"></div>
            <div class="absolute bottom-0 right-0 w-32 h-32 bg-white bg-opacity-5 rounded-full transform translate-x-16 translate-y-16"></div>
        </div>
    </div>
</body>

</html>