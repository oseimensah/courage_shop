<x-app-layout>
    <div class="py-12">
        <div class="flex justify-end mb-3">
            <a href="{{ route('admin.product.create') }}" class="rounded bg-blue-800 hover:bg-blue-900 hover:shadow-lg text-white border-2 border-indigo-900 py-2 px-3 text-xs md:text-sm transition-all ease-linear duration-200">New Product</a>
        </div>
        @forelse ($products as $product)
        <div class="bg-white transition-all duration-30 my-2 ease-linear p-3 hover:rounded-md hover:shadow-lg w-full flex justify-between">
            <div class="flex items-center space-x-3">
                <div class="rounded shadow w-10 h-10 bg-primary p-1">
                    @if ($product->thumb_image_url)
                    <img src="{{ $product->thumb_image_url }}" alt="" class="w-full h-full">
                    @else
                    <img src="{{ asset('images/products/product10.jpg') }}" alt="" class="w-full h-full">
                    @endif
                </div>
                <h2 class="text-stone-800">{{ $product->name }}</h2>
            </div>

            <div class="flex space-x-3 items-center">
                <h4>{{ $product->price_with_currency }}</h4>
                <div class="flex space-x-3">
                    <span class="rounded bg-blue-100 hover:bg-blue-600 text-gray-800 hover:text-white py-1 px-2">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </span>
                    <span class="rounded bg-red-100 hover:bg-red-600 text-gray-800 hover:text-white py-1 px-2">
                        <i class="fa-solid fa-trash-can"></i>
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-3 rounded-md shadow-lg w-full flex justify-between">
            <div class="py-16 flex justify-center items-center w-full">
                <h2>
                    No Product added
                </h2>
            </div>
        </div>
        @endforelse
    </div>
</x-app-layout>
