<div>
    <header class="relative z-10">
            <nav aria-label="Top">
                <div class="bg-gray-900">
                    <div class="max-w-7xl mx-auto h-10 px-4 flex items-center justify-between sm:px-6 lg:px-8">
                        <div class="flex items-center text-white uppercase underline font-bold font-poppins">
                            <a href="{{ route('home') }}">{{ config('app.name') }}</a>
                        </div>
                        <div class="flex items-center space-x-6">
                            @if(!auth()->user())
                            <a href="{{ route('login') }}" class="text-sm font-medium text-white hover:text-gray-100">Sign in</a>
                            <a href="{{ route('register') }}" class="text-sm font-medium text-white hover:text-gray-100">Create an account</a>
                            @endif

                            @auth
                            <div class="text-center z-20 font-medium text-white hover:text-gray-100 transition relative group cursor-pointer">
                                <div class="text-sm">{{ auth()->user()->profile->last_name }}</div>
                                <div class="absolute max-w-lg w-fit min-w-fit left-0 text-xs top-full bg-white shadow-lg py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                                    @if(auth()->user()->hasRole('admin'))
                                    <x-dropdown-link class="text-gray-800 hover:text-white hover:bg-primary hover:shadow-lg" :href="route('admin.dashboard')">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                    @endif
                                    <x-dropdown-link class="text-gray-800 hover:text-white hover:bg-primary hover:shadow-lg" href="{{ route('profile.orders') }}">
                                        {{ __('Orders') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link class="text-gray-800 hover:text-white hover:bg-primary hover:shadow-lg" href="{{ route('profile.edit') }}">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>
                                    <form method="POST" action="{{ route('logout') }}" class="">
                                        @csrf
                                        <x-dropdown-link class="text-gray-800 hover:text-white w-full hover:bg-primary hover:shadow-lg" :href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </x-dropdown-link>
                                    </form>

                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Secondary navigation -->
                <div class="w-full" x-data="{ atTop: true }" x-on:scroll.window="atTop =( window.pageYOffset > 30) ? false : true" x-bind:class="!atTop ? 'shadow-lg bg-gray-800 fixed top-0 z-20' : 'backdrop-blur-md backdrop-filter bg-opacity-10 w-full bg-white'">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div>
                            <div class="h-16 flex items-center justify-between">
                                <div class="hidden lg:flex-1 lg:flex lg:items-center">
                                    <a href="{{ route('home') }}">
                                        <span class="sr-only">{{ config('app.name') }}</span>
                                        <img class="h-8 rounded w-auto" src="{{ asset('images/logo/logo.jpg') }}" alt="" />
                                    </a>
                                </div>

                                <div class="hidden h-full lg:flex">
                                    <div class="px-4 bottom-0 inset-x-0">
                                        <div class="h-full flex justify-center space-x-8">
                                            @foreach ($categories as $cat)
                                            <a href="" class="flex items-center text-sm font-medium text-white">{{ $cat->name }}</a>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-1 flex items-center justify-end">
                                    <div class="flex items-center lg:ml-8">
                                        <div class="ml-4 flow-root lg:ml-8">
                                            @if($cart_value > 0)
                                            <a href="#" wire:click.prevent="gotoCheckout()" class="group -m-2 p-2 flex items-center">
                                                <span class="flex-shrink-0 h-6 w-6 text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                    </svg>
                                                </span>
                                                <span class="ml-2 text-sm font-medium text-white bg-white w-6 h-6 shadow-lg flex justify-center items-center bg-opacity-40 rounded-full p-1">{{ $cart_value }}</span>
                                                <span class="sr-only">items in cart, view bag</span>
                                            </a>
                                            @else
                                            <div class="group -m-2 p-2 flex items-center">
                                                <span class="flex-shrink-0 h-6 w-6 text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                    </svg>
                                                </span>
                                                <span class="ml-2 text-sm font-medium text-white">0</span>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
</div>
