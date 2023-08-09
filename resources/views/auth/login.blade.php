<head>

    <title>Login Account</title>
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> --}}

    <style>
        
    </style>
</head>


<x-guest-layout>

    <div class="">


        <x-auth-card >
            <x-slot name="logo">
                <a href="/">
                {{-- <img src="image/logo_chien.png"  class="mx-auto d-block mt-3" style="width: 200px"> --}}
                    
                </a>
            </x-slot>
    
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
    
            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />
    
    
            <form method="POST" action="{{ route('login') }}" >
                @csrf
    
                <!-- Email Address -->
                <div>
                    <x-label for="name" :value="__('Username')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                    {{-- <x-label for="email" :value="__('Email')" />
    
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus /> --}}
                </div>
    
                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />
    
                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                </div>
    
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
    
                <div class="d-flex justify-content-center mt-3">
                    <div>
                        <x-button class="">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </div>
                     
                <div class="d-flex justify-content-center mt-3">
    
                    <div>
                        <span>Don't have an account?</span>
                        <a href="register" class="text-sm text-gray-700 dark:text-gray-500 underline">Create one</a>
                    </div>
                 </div>
                    
                
            </form>
        </x-auth-card>
    </div>

</x-guest-layout>
