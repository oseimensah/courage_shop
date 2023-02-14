<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 bg-white p-3 rounded" :status="session('status')" />


    <div class="w-full max-w-lg space-y-8 bg-white block bg-opacity-100 px-6 py-8 rounded-xl shadow-xl">
        <div>
            <div class="flex justify-center items-center py-3">
                <x-application-logo class="h-32 rounded-lg" />
            </div>

            <h2 class="text-center md:text-xl text-base font-bold tracking-tight text-gray-900">{{ config('app.name') }}</h2>
            <p class="text-center text-sm text-gray-600">Login to your account</p>
        </div>

        <form method="POST" action="{{ route('login') }}" autocomplete="off">
            @csrf
            <div class="-space-y-px rounded-md shadow-sm">
                <div>
                    <x-input-label for="email" class="sr-only" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full appearance-none rounded-none rounded-t-md" type="email" placeholder="youremail.@domain.com" name="email" :value="old('email')" required />
                    {{-- <input id="email" name="email" type="email" autocomplete="email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Email address"> --}}
                </div>

                <div>
                    <x-input-label for="password" class="sr-only" :value="__('Password')" />
                    <x-text-input id="password" class="block w-full appearance-none rounded-none rounded-b-md"
                            type="password"
                            name="password"
                            placeholder="*******"
                            required />
                </div>

                <div class="mt-2 p-3">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary shadow-sm focus:ring-primary dark:focus:ring-primary dark:focus:ring-offset-primary" name="remember">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-primary rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary dark:focus:ring-offset-primary" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <div class="mt-12">
                <button type="submit" class="group relative flex w-full justify-center rounded border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Sign in
                </button>
            </div>

            <p class="my-4 text-sm text-center text-gray-600">Don't have account? <a href="{{ route('register') }}" class="text-gray-800 underline font-semibold">Register now</a></p>
        </form>
    </div>



</x-guest-layout>
