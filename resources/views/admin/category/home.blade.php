<x-app-layout>
    <div class="py-12">
        <div class="flex justify-end mb-3">
            <a href="{{ route('admin.category.create') }}" class="rounded bg-blue-800 hover:bg-blue-900 hover:shadow-lg text-white border-2 border-indigo-900 py-2 px-3 text-xs md:text-sm transition-all ease-linear duration-200">New Category</a>
        </div>
        @forelse ($categories as $category)
        <div class="bg-white transition-all duration-300 ease-linear p-3 my-2 hover:rounded-md hover:shadow-lg w-full flex justify-between">
            <div class="flex items-center space-x-3">
                <div class="rounded shadow w-10 h-10 bg-primary p-1">
                    @if ($category->thumb_image_url)
                    <img src="{{ $category->thumb_image_url }}" alt="" class="w-full h-full">
                    @else
                    <img src="{{ asset('images/products/product10.jpg') }}" alt="" class="w-full h-full">
                    @endif
                </div>
                <h2 class="text-stone-800">{{ $category->name }}</h2>
            </div>

            <div class="flex space-x-8 items-center">
                <h4>{{ $category->getDateHumanReadableAttribute() }}</h4>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.category.edit', $category->id) }}" class="rounded bg-blue-100 hover:bg-blue-600 text-gray-800 hover:text-white py-1 px-2">
                        <span>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                    </a>
                    <span class="rounded bg-red-100 hover:bg-red-600 text-gray-800 hover:text-white py-1 px-2 cursor-pointer">
                        <form action="{{ route('admin.category.delete',$category->id) }}" method="POST">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white p-3 rounded-md shadow-lg w-full flex justify-between">
            <div class="py-16 flex justify-center items-center w-full">
                <h2>
                    No category added
                </h2>
            </div>
        </div>
        @endforelse
    </div>
</x-app-layout>
