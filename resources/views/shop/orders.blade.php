<x-shop-layout>
    <div class="relative bg-sky-700 pb-32 overflow-hidden">
        <div class="inset-y-0 bottom-0 absolute inset-x-0 left-1/2 transform -translate-x-1/2 w-full overflow-hidden lg:inset-y-0">
            <div class="absolute inset-0 flex">
                <div class="h-full w-1/2" style="background-color: #0a527b"></div>
                <div class="h-full w-1/2" style="background-color: #065d8c"></div>
            </div>
            <div class="relative flex justify-center">
                <svg class="flex-shrink-0" width="1750" height="308" viewBox="0 0 1750 308" xmlns="http://www.w3.org/2000/svg">
                    <path d="M284.161 308H1465.84L875.001 182.413 284.161 308z" fill="#0369a1" />
                    <path d="M1465.84 308L16.816 0H1750v308h-284.16z" fill="#065d8c" />
                    <path d="M1733.19 0L284.161 308H0V0h1733.19z" fill="#0a527b" />
                    <path d="M875.001 182.413L1733.19 0H16.816l858.185 182.413z" fill="#0a4f76" />
                </svg>
            </div>
        </div>

        <div class="relative py-10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h1 class="text-3xl font-bold text-white">Orders</h1>
            </div>
        </div>
    </div>

    <section class="relative -mt-32">
        <div class="max-w-screen-xl mx-auto pb-6 px-4 sm:px-6 lg:pb-16 lg:px-8">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="divide-y divide-gray-200 lg:grid lg:grid-cols-12 lg:divide-y-0 lg:divide-x">
                    <aside class="py-6 lg:col-span-3">
                        <nav class="space-y-1">
                            <a href="{{ route('profile.edit') }}" class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium" >
                                <span class="truncate">
                                    Profile
                                </span>
                            </a>
                            <a href="{{ route('profile.orders') }}" class="border-transparent text-gray-900 hover:bg-gray-50 hover:text-gray-900', 'group border-l-4 px-3 py-2 flex items-center text-sm font-medium" >
                                <span class="truncate">
                                    Orders
                                </span>
                            </a>
                        </nav>
                    </aside>
                    <div class="py-6 lg:col-span-9">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                            @foreach ($orders as $order)
                            <div class="bg-gray-100 hover:bg-white transition-all duration-30 my-2 ease-linear p-3 hover:rounded-md hover:shadow-lg w-full flex justify-between">
                                <h2 class="text-stone-800">{{ $order->code }}</h2>
                                <div class="space-x-3">
                                    <span>{{ $order->amount_with_currency }}</span>
                                    @if ($order->status != 'paid')
                                    <a class="rounded bg-blue-100 hover:bg-blue-600 text-gray-800 hover:text-white py-1 px-2" href="{{ route('checkout.pay', ['code'=>$order->code]) }}">Pay</a>
                                    @else
                                    <span class="rounded capitalize bg-orange-600 text-gray-100 py-1 px-2">{{ $order->status ? $order->status : 'pending' }}</span>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-shop-layout>
