<div x-data="{ showProduct: @entangle('showProduct') }">

    <div class="relative bg-gray-900">
        <div aria-hidden="true" class="absolute inset-0 overflow-hidden">
            <img src="{{ asset('images/banner/banner.jpeg') }}" alt="" class="w-full h-full object-center object-cover" />
        </div>
        <div aria-hidden="true" class="absolute inset-0 bg-gray-900 opacity-50"></div>

        @include('partials.user.header', ['categories'=>$categories, 'showCart' => $showCart, 'cart_value' => $cart_value, 'cart' => $cart])

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
                        <h3 wire:click.prevent="viewProduct({{ $product }})" class="text-sm font-medium text-gray-900">
                           <span class="cursor-pointer">{{ $product->name }}</span>
                        </h3>
                        <div class="flex justify-between">
                            <p class="mt-4 text-base font-medium text-gray-900">{{ $product->price_with_currency }}</p>
                            <button type="button" wire:click.prevent="addToCart({{ $product }})" class="bg-gray-800 dark:bg-gray-200 hover:bg-orange-800 text-white px-4 py-2 uppercase tracking-widest rounded-md font-semibold inline-flex items-center transition-all duration-300 ease-in-out text-xs">
                                add to cart
                            </button>
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

    <div x-show="showProduct" class="relative z-10" role="dialog" aria-modal="true">
        <div x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 hidden bg-gray-500 bg-opacity-75 transition-opacity md:block"></div>

        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-stretch justify-center text-center md:items-center md:px-2 lg:px-4">
                <div x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                    x-transition:enter-end="opacity-100 translate-y-0 md:scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-y-0 md:scale-100"
                    x-transition:leave-end="opacity-0 translate-y-4 md:translate-y-0 md:scale-95"
                    class="flex w-full transform text-left text-base transition md:my-8 md:max-w-2xl md:px-4 lg:max-w-4xl">

                    <div class="relative flex w-full items-center overflow-hidden bg-white px-4 pt-14 pb-8 shadow-2xl sm:px-6 sm:pt-8 md:p-6 lg:p-8">
                        <button type="button" wire:click.prevent="closeProduct()" class="absolute top-4 right-4 text-gray-400 hover:text-gray-500 sm:top-8 sm:right-6 md:top-6 md:right-6 lg:top-8 lg:right-8">
                            <span class="sr-only">Close</span>
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>

                        <div class="grid w-full grid-cols-1 items-start gap-y-8 gap-x-6 sm:grid-cols-12 lg:gap-x-8">
                            <div class="aspect-w-2 aspect-h-3 overflow-hidden rounded-lg bg-gray-100 sm:col-span-4 lg:col-span-5">
                                <img src="{{ $product->thumb_image_url }}" alt="" class="object-cover object-center border border-gray-300 shadow-lg">
                            </div>

                            <div class="sm:col-span-8 lg:col-span-7">
                                <div class="space-y-3">
                                    <h4 class="text-xs md:text-sm text-gray-500">{{ $product->category->name }}</h4>
                                    <h2 class="text-2xl font-bold text-gray-900 sm:pr-12">{{ $product->name }}</h2>
                                </div>

                                <section aria-labelledby="information-heading" class="mt-2">
                                    <h3 id="information-heading" class="sr-only">{{ $product->description }}</h3>

                                    <p class="text-2xl text-gray-900">{{ $product->price_with_currency }}</p>

                                    <div class="mt-10 mb-3">
                                        <button type="button" wire:click.prevent="addToCart({{ $product }})" class="bg-gray-800 dark:bg-gray-200 hover:bg-orange-800 w-full text-center text-white px-4 py-3 uppercase tracking-widest rounded-md font-semibold inline-flex justify-center items-center transition-all duration-300 ease-in-out text-xs">
                                            add to cart
                                        </button>
                                    </div>

                                </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.user.footer')
    @push('custom-script')
        <script>
            Livewire.on('swal', (message,type) => {
                Swal.fire({
                    icon: type,
                    text: message,
                    showConfirmButton: false,
                    // background: "#21d4fd",
                    // color: "#fff",
                    timer: 1500,
                    position: "top-end",
                    timerProgressBar: true,
                });
            });
        </script>
    @endpush
</div>

