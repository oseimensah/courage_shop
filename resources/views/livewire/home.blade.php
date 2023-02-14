<div>

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
                        <h3 class="text-sm font-medium text-gray-900">
                           <a href="">{{ $product->name }}</a>
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

