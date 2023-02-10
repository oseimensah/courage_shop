<x-app-layout>
    <div class="py-12">
        <section aria-labelledby="applicant-information-title">
          <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6 flex justify-between">
                <div>
                    <h2 id="applicant-information-title" class="text-lg leading-6 font-medium text-gray-900">{{ $product->name }}</h2>
                    <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $product->featured ? 'Featured Product' : 'Not Featured Product' }}</p>
                </div>
                <div class="flex space-x-3 items-center">
                    <a href="{{ route('admin.product.edit', $product->id) }}" class="rounded bg-blue-100 hover:bg-blue-600 text-gray-800 hover:text-white py-1 px-2">
                        <span>
                            <i class="fa-solid fa-pen-to-square"></i>
                        </span>
                    </a>
                    <span class="rounded bg-red-100 hover:bg-red-600 text-gray-800 hover:text-white py-1 px-2 cursor-pointer">
                        <form action="{{ route('admin.product.delete',$product->id) }}" method="POST">
                            @csrf
                            <button type="submit">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </span>
                </div>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
              <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Name</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $product->name }}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Price</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $product->price_with_currency }}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Category</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $product->category->name }}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Featured</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $product->featured ? 'Yes' : 'No' }}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Description</dt>
                  <dd class="mt-1 text-sm text-gray-900">{{ $product->description }}</dd>
                </div>
                <div class="sm:col-span-1">
                  <dt class="text-sm font-medium text-gray-500">Product Image</dt>
                  <dd class="mt-1 text-sm">
                    <div class="rounded bg-white shadow p-2 w-64 h-48 overflow-hidden">
                        <img src="{{ $product->thumb_image_url }}" alt="product image" class="rounded w-full h-full">
                    </div>
                  </dd>
                </div>
              </dl>
            </div>
            <div class="block bg-gray-50 p-5 shadow-inner sm:rounded-b-lg">
            </div>
          </div>
        </section>
    </div>
</x-app-layout>



