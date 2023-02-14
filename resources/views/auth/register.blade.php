<x-guest-layout>
<div class="w-full max-w-lg bg-white rounded-xl block p-3">
    <div class="space-y-8 bg-white block bg-opacity-100 px-6 py-8 rounded-xl shadow-xl">
        <div>
            <div class="flex justify-center items-center py-3">
                <x-application-logo class="h-32 rounded-lg" />
            </div>

            <h2 class="text-center md:text-xl text-base font-bold tracking-tight text-gray-900">{{ config('app.name') }}</h2>
            <p class="text-center text-sm text-gray-600">Register a new account</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="col-span-2">
                    <x-input-label for="first-name" :value="__('First Name')" />
                    <x-text-input id="first-name" class="block mt-1 w-full" type="text" name="first_name" :value="old('nfirst_ame')" required autofocus />
                    <x-input-error :messages="$errors->get('first_name')" class="mt-2" />
                </div>

                <div class="col-span-2">
                    <x-input-label for="last-name" :value="__('Last Name')" />
                    <x-text-input id="last-name" class="block mt-1 w-full" type="text" name="last_name" :value="old('last_name')" required autofocus />
                    <x-input-error :messages="$errors->get('last_name')" class="mt-2" />
                </div>
            </div>
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-4">
                <div class="col-span-2">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="col-span-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation" required />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="group relative flex w-full justify-center rounded border border-transparent bg-blue-600 py-2 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    Register
                </button>
                <p class="my-4 text-sm text-center">
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </p>
            </div>
        </form>

    </div>
</div>
</x-guest-layout>
