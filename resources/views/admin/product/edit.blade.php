<x-app-layout>
    <div class="py-12">
        <div class="bg-white p-3 rounded-md shadow-lg w-full">
            <div class="w-full max-w-7xl mx-auto py-8">
                <h2>Edit Product <span class="text-indigo-600">[ {{ $product->name }} ]</span></h2>
                <br>

                <form method="POST" enctype="multipart/form-data"  action="{{ route('admin.product.update', $product->id) }}" class="px-10">
                    @csrf
                    <div class="grid grid-cols-2 gap-4 m-0 p-0">
                        <div class="">
                            <x-input-label for="category" :value="__('Category')" />
                            <select id="category" seleted="{{ $product->category->id }}" name="category" class="mt-1 block w-full rounded-md border border-gray-300 bg-white py-2 px-3 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm">
                                @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category',$product->category->id) == $cat->id ? 'selected' : '' }}>{{ ucwords($cat->name) }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </div>
                        <div class="">
                            <x-input-label for="name" :value="__('Product Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $product->name }}" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="">
                            <x-input-label for="price" :value="__('Price')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" min="0" value="0" step=".01" name="price" value="{{ $product->price }}" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>
                        <div class="">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-text-input id="description" class="block mt-1 w-full" type="text" name="description" value="{{ $product->description }}" required />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="">
                            <label for="featured" class="inline-flex items-center">
                                <input id="featured" type="checkbox" checked="{{ $product->featured ? 'yes' : 'no' }}" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-primary shadow-sm focus:ring-primary dark:focus:ring-primary dark:focus:ring-offset-primary" name="featured">
                                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Featured') }}</span>
                            </label>
                        </div>

                        <div>
                            <x-input-label for="image" :value="__('Product Image Upload:')" />
                            <div class="mt-3 flex space-x-3">
                                <div class="flex-1">
                                    <div class="rounded-lg hover:shadow-lg bg-white max-w-6xl mx-auto">
                                        <div class="p-4">
                                            <div class="flex items-center justify-center w-full">
                                                <label class="flex flex-col w-full h-32 border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                                    <div class="flex flex-col items-center justify-center pt-7">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                        </svg>
                                                        <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Attach an image</p>
                                                    </div>
                                                    <input type="file" name="image" class="border-0" value="old('thumbnail', $product->thumb_image_url)" />
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div>
                                    <strong>Previous Image File</strong>
                                    <div class="rounded p-1">
                                        <img src="{{ $product->thumb_image_url }}" alt="category image" class="w-40 h-24 rounded">
                                    </div>

                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                    </div>

                    <div class="flex items-center justify-end mt-4 border-t border-gray-200">
                        <x-primary-button class="ml-4 bg-blue-700 hover:bg-blue-500 mt-3">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
