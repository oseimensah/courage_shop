<x-shop-layout>
    @section('title', 'Cart - Purely Ghanaian')
    <div class="w-full h-fit p-12">
        <?php $total = 0 ?>
        <div class="w-full mx-3 md:mx-auto md:max-w-7xl font-poppins">
            <div class="mb-2">
                <h1 class="text-3xl md:text-5xl font-bold text-gray-600 flex items-center"><x-application-logo class="w-10 h-10 rounded mr-3"/> My basket</h1>
            </div>

            <div class="rounded bg-white shadow p-12 font-poppins mt-8 w-full">
                <div class="mx-auto max-w-5xl justify-center px-6 md:flex md:space-x-6 xl:px-0">
                    <div class="rounded-lg md:w-2/3">
                        @if(session('cart'))
                        @foreach(session('cart') as $id => $product)
                        <?php $total += $product['price'] * $product['quantity'] ?>
                        <div class="justify-between mb-6 rounded-lg bg-white p-6 shadow-md sm:flex sm:justify-start">
                            <img src="{{ $product['photo'] }}" alt="product-image" class="w-full rounded-lg sm:w-40" />
                            <div class="sm:ml-4 sm:flex sm:w-full sm:justify-between">
                                <div class="mt-5 sm:mt-0">
                                    <h2 class="text-lg font-bold text-gray-900">{{ $product['name'] }}</h2>
                                    <p class="mt-1 text-xs text-gray-700">$ {{ $product['price'] }}</p>
                                </div>
                                <div class="mt-4 flex justify-between im sm:space-y-6 sm:mt-0 sm:block sm:space-x-6">
                                    <div class="flex items-center border-gray-100">
                                        <span id="remove-quantity" onclick="updateCart({{ $id }}, 'sub')" class="cursor-pointer rounded-l bg-gray-100 py-1 px-3.5 duration-100 hover:bg-blue-500 hover:text-blue-50 hover:shadow-inner sub-to-cart"> - </span>
                                        <span class="border border-gray-50 bg-white py-1 px-3.5 text-gray-900 text-center"> {{ $product['quantity'] }} </span>
                                        <span id="add-quantity" onclick="updateCart({{ $id }}, 'add')" class="cursor-pointer rounded-r bg-gray-100 py-1 px-3 duration-100 hover:bg-blue-500 hover:text-blue-50 hover:shadow-inner add-to-cart"> + </span>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <p class="text-sm">$ {{ $product['price'] * $product['quantity'] }}</p>
                                        <span id="remove-cart" onclick="removeCart({{ $id }})" >
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-5 w-5 cursor-pointer duration-150 hover:text-red-500">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif

                    </div>
                    <!-- Sub total -->
                    <div class="mt-6 h-full rounded-lg border bg-white p-6 shadow-md md:mt-0 md:w-1/3">
                        {{-- <div class="mb-2 flex justify-between">
                            <p class="text-gray-700">Subtotal</p>
                            <p class="text-gray-700">$129.99</p>
                        </div>
                        <div class="flex justify-between">
                            <p class="text-gray-700">Shipping</p>
                            <p class="text-gray-700">$4.99</p>
                        </div>
                        <hr class="my-4" /> --}}
                        <div class="flex justify-between">
                            <p class="text-lg font-bold">Total</p>
                            <div class="">
                                <p class="mb-1 text-lg font-bold">$ {{ $total }}</p>
                            </div>
                        </div>
                        <div class="w-full mt-8">
                            <a href="{{ route('checkout') }}">
                                <p class="w-full rounded-md text-white bg-blue-800 hover:bg-blue-700 py-1.5 items-center flex justify-center hover:shadow-lg font-semibold text-sm transition-all duration-200 ease-linear">
                                    Order Now
                                </p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    @push('custom-script')
    <script type="text/javascript">
        async function updateCart(id, type) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            const body = {
                'id': id,
                'quantityType': type,
            };

            fetch('{{ route('cart.update') }}', {
                method: 'PATCH', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                },
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify(body),
            })
            .then((response) => response)
            .then((data) => {
                console.log('Success:', data);
                window.location.reload();
            })
            .catch((error) => {
                console.log(error);
            });
        }

        async function removeCart(id) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            const body = {
                'id': id,
            };

            fetch('{{ route('cart.remove') }}', {
                method: 'DELETE', // or 'PUT'
                headers: {
                    'Content-Type': 'application/json',
                },
                headers: {
                    'Content-Type': 'application/json',
                    "Accept": "application/json, text-plain, */*",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify(body),
            })
            .then((data) => {
                console.log('Success:', data);
                window.location.reload();
            })
            .catch((error) => {
                console.log(error);
            });
        }
        // addBtn.onclick = async function updateCart(id) {
        //     var csrfToken = document.querySelector('meta[name="csrf-token"]').content;

        // }
            // this function is for update card
            // $(".add-to-cart").click(function (e) {
            // e.preventDefault();
            // var ele = $(this);
            //     $.ajax({
            //     url: '{{ route('cart.update') }}',
            //     method: "patch",
            //     data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantityType: 'add'},
            //     success: function (response) {
            //         window.location.reload();
            //     }
            //     });
            // });
            // $(".sub-to-cart").click(function (e) {
            // e.preventDefault();
            // var ele = $(this);
            //     $.ajax({
            //     url: '{{ route('cart.update') }}',
            //     method: "patch",
            //     data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantityType: 'sub'},
            //     success: function (response) {
            //         window.location.reload();
            //     }
            //     });
            // });
            // $(".remove-from-cart").click(function (e) {
            //     e.preventDefault();
            //     var ele = $(this);
            //     if(confirm("Are you sure")) {
            //         $.ajax({
            //             url: '{{ route('cart.update') }}',
            //             method: "DELETE",
            //             data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
            //             success: function (response) {
            //                 window.location.reload();

            //             }
            //         });
            //     }
            // });
        </script>
    @endpush
</x-shop-layout>
