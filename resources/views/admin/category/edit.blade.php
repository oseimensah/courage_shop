<x-app-layout>
    <div class="py-12">
        <div class="bg-white p-3 rounded-md shadow-lg w-full">
            <div class="w-full max-w-7xl mx-auto py-8">
                <h2>Edit Category <span class="text-indigo-600">[ {{ $category->name }} ]</span></h2>
                <br>
                <form method="POST" enctype="multipart/form-data"  action="{{ route('admin.category.update', $category->id) }}">
                    @csrf

                    <div class="mb-3">
                        <x-input-label for="name" :value="__('Category Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $category->name }}" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="image" :value="__('Image Upload:')" />
                        <div class="mt-8">
                            <strong>Previous Image File</strong>
                            <div class="rounded p-1">
                                <img src="{{ $category->thumb_image_url }}" alt="category image" class="w-42 h-28 rounded">
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="rounded-lg hover:shadow-lg bg-white max-w-6xl mx-auto">
                                <div class="p-4">
                                    <div class="flex items-center justify-center w-full">
                                        <label class="flex flex-col w-full h-32 border-4 border-blue-200 border-dashed hover:bg-gray-100 hover:border-gray-300">
                                            <div class="flex flex-col items-center justify-center pt-7">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400 group-hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                </svg>
                                                <p class="pt-1 text-sm tracking-wider text-gray-400 group-hover:text-gray-600">Change Image</p>
                                            </div>
                                            <input type="file" name="image" class="border-0" />
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <x-input-error :messages="$errors->get('image')" class="mt-2" /> --}}
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-primary-button class="ml-4 bg-blue-700 hover:bg-blue-500">
                            {{ __('Submit') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('custom-script')
    @endpush
</x-app-layout>
