<x-shop-layout>
    @section('title', 'Home - Purely Ghanaian')
    <div class="w-full h-fit">
        <div class="relative bg-gray-900">
            <!-- Decorative image and overlay -->
            <div aria-hidden="true" class="absolute inset-0 overflow-hidden">
                <img src="{{ asset('images/banner/banner.jpeg') }}" alt="" class="w-full h-full object-center object-cover" />
            </div>
            <div aria-hidden="true" class="absolute inset-0 bg-gray-900 opacity-50"></div>

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
                                    <div class="absolute w-full min-w-fit left-0 text-xs top-full bg-white shadow-lg py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                                        @if(auth()->user()->hasRole('admin'))
                                        <x-dropdown-link class="text-gray-800 hover:text-white hover:bg-primary hover:shadow-lg" :href="route('admin.dashboard')">
                                            {{ __('Dashboard') }}
                                        </x-dropdown-link>
                                        @endif
                                        <x-dropdown-link class="text-gray-800 hover:text-white hover:bg-primary hover:shadow-lg" href="">
                                            {{ __('Orders') }}
                                        </x-dropdown-link>
                                        <x-dropdown-link class="text-gray-800 hover:text-white hover:bg-primary hover:shadow-lg" href="">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <x-dropdown-link class="text-gray-800 hover:text-white hover:bg-primary hover:shadow-lg" :href="route('logout')"
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
                    <div class="backdrop-blur-md backdrop-filter bg-opacity-10 bg-white">
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
                                                @if(session('cart'))
                                                <a href="{{ route('carts') }}" class="group -m-2 p-2 flex items-center">
                                                    <span class="flex-shrink-0 h-6 w-6 text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                        </svg>
                                                    </span>
                                                    <span class="ml-2 text-sm font-medium text-white bg-white w-6 h-6 shadow-lg flex justify-center items-center bg-opacity-40 rounded-full p-1">{{ count(session('cart')) }}</span>
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

            <div class="relative max-w-4xl mx-auto py-16 px-6 flex flex-col items-center text-center sm:py-32 lg:px-0">
                <h1 class="text-4xl bg-white rounded bg-opacity-40 shadow-xl p-10 font-extrabold tracking-tight text-white lg:text-6xl">Your No. 1 Ghanaian Products Shop.</h1>
                <p class="mt-12 text-xl text-white max-w-lg">Get the latest stock of all your Ghanaian products here. No need to hustle, just visit, add to cart and buy. Purely Ghanaian - Your easy shopping center.</p>
            </div>
        </div>

        <div class="bg-white p-0">
            <div class="py-12 font-poppins max-w-7xl mx-auto">
                <h2 class="font-bold py-8">Featured Products</h2>
                <div class="-mx-px border-l border-gray-200 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
                    @forelse ( $featuredProducts as $product )
                    <div class="group p-4 border-r border-b border-gray-200 sm:p-6 hover:shadow-xl transition-all duration-300 ease-in-out">
                        <div class="rounded-lg overflow-hidden bg-gray-200 aspect-w-1 aspect-h-1">
                            <img src="{{ $product->thumb_image_url }}" alt="product image" class="w-full h-full object-center object-cover" />
                        </div>
                        <div class="w-full h-full overflow-hidden space-y-3 mt-3">
                            <h3 class="text-sm font-medium text-gray-900">
                               <a href="">{{ $product->name }}</a>
                            </h3>
                            <div class="flex justify-between">
                                <p class="mt-4 text-base font-medium text-gray-900">{{ $product->price_with_currency }}</p>
                                <a href="{{ route('cart.add', $product->id) }}" class="bg-gray-800 dark:bg-gray-200 hover:bg-orange-800 text-white px-4 py-2 uppercase tracking-widest rounded-md font-semibold inline-flex items-center transition-all duration-300 ease-in-out text-xs">
                                    add to cart
                                </a>
                            </div>
                        </div>
                    </div>

                    @empty
                        <div class="bg-white p-3 rounded-md shadow-lg w-full flex justify-between col-span-2 sm:mx-0 md:col-span-3 lg:col-span-4">
                            <div class="py-16 flex justify-center items-center w-full">
                                <h2>
                                    No product available. Products will be loaded soon
                                </h2>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>

            <section aria-labelledby="comfort-heading" class="max-w-7xl mx-auto mb-8">
                <div class="relative rounded-lg overflow-hidden">
                    <div class="absolute inset-0">
                        <img src="https://tailwindui.com/img/ecommerce-images/home-page-01-feature-section-02.jpg" alt="" class="w-full h-full object-center object-cover" />
                    </div>
                    <div class="relative bg-gray-900 bg-opacity-75 py-20 px-6 sm:py-28 sm:px-12 lg:px-16">
                        <div class="relative max-w-3xl mx-auto flex flex-col items-center text-center">
                            <h2 id="comfort-heading" class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Our Best Products</h2>
                            <p class="mt-3 text-xl text-white">Known for our rich culture, Purely Ghanaian is able to supply you with the best of all cultural items in Ghana.</p>
                        </div>
                    </div>
                </div>
            </section>

            <div class="py-8 font-poppins max-w-7xl mx-auto">
                {{-- <h2 class="font-bold py-8">Featured Products</h2> --}}
                <div class="-mx-px border-l border-gray-200 grid grid-cols-2 sm:mx-0 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($products as $product)
                    <div class="group p-4 border-r border-b border-gray-200 sm:p-6 hover:shadow-xl transition-all duration-300 ease-in-out">
                        <div class="rounded-lg overflow-hidden bg-gray-200 aspect-w-1 aspect-h-1">
                            <img src="{{ $product->thumb_image_url }}" alt="product image" class="w-full h-full object-center object-cover" />
                        </div>
                        <div class="w-full h-full overflow-hidden space-y-3 mt-3">
                            <h3 class="text-sm font-medium text-gray-900">
                               <a href="">{{ $product->name }}</a>
                            </h3>
                            <div class="flex justify-between">
                                <p class="mt-4 text-base font-medium text-gray-900">{{ $product->getPriceWithCurrencyAttribute() }}</p>
                                <a href="{{ route('cart.add', $product->id) }}" class="bg-gray-800 dark:bg-gray-200 hover:bg-orange-800 text-white px-4 py-2 uppercase tracking-widest rounded-md font-semibold inline-flex items-center transition-all duration-300 ease-in-out text-xs">
                                    add to cart
                                </a>
                            </div>

                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

        </div>

        @include('partials.user.footer')
    </div>
</x-shop-layout>
