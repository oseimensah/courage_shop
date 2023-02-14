<div class="w-full md:max-w-sm max-w-xs p-3">
    <div class="h-full min-h-fit bg-gray-200 shadow-lg rounded-md border border-gray-300">
        <div class="p-3 bg-white rounded-t-md border-b border-gray-300 shadow">
            <a href="{{ route('home') }}" class="flex items-center underline">
                <x-application-logo class="w-20 h-20" />
                <span class="text-gray-800 text-sm md:text-2xl font-bold">{{ config('app.name') }}</span>
            </a>
        </div>

        <div class="py-3 divide-y divide-gray-300 divide-dashed space-y-3">
            <span>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-800 shadow-inner text-white' : 'hover:bg-indigo-300' }} flex items-center px-6 py-3 transition">
                    <i class="fa-solid fa-house {{ request()->routeIs('admin.dashboard') ? 'text-indigo-300' : 'text-gray-900' }}""></i>
                    <span class="pl-3">
                        Dashboard
                    </span>
                </a>
            </span>
            <span>
                <a href="{{ route('admin.categories') }}" class="{{ request()->routeIs('admin.categories') || request()->routeIs('admin.category.create') || request()->routeIs('admin.category.edit') || request()->routeIs('admin.category.show') ? 'bg-indigo-800 shadow-inner text-white' : 'hover:bg-indigo-300' }} flex items-center px-6 py-3 transition">
                    <i class="fa-solid fa-broom-ball {{ request()->routeIs('admin.categories') || request()->routeIs('admin.category.create') || request()->routeIs('admin.category.edit') || request()->routeIs('admin.category.show') ? 'text-indigo-300' : 'text-gray-900' }}"></i>
                    <span class="pl-3">
                        Categories
                    </span>
                </a>
            </span>
            <span>
                <a href="{{ route('admin.products') }}" class="{{ request()->routeIs('admin.products') || request()->routeIs('admin.product.create') || request()->routeIs('admin.product.edit') || request()->routeIs('admin.product.show') ? 'bg-indigo-800 shadow-inner text-white' : 'hover:bg-indigo-300' }} flex items-center px-6 py-3 transition">
                    <i class="fa-solid fa-mug-hot {{ request()->routeIs('admin.products') || request()->routeIs('admin.product.create') || request()->routeIs('admin.product.edit') || request()->routeIs('admin.product.show') ? 'text-indigo-300' : 'text-gray-900' }}""></i>
                    <span class="pl-3">
                        Products
                    </span>
                </a>
            </span>
            <span>
                <a href="{{ route('admin.orders') }}" class="{{ request()->routeIs('admin.orders') ? 'bg-indigo-800 shadow-inner text-white' : 'hover:bg-indigo-300' }} flex items-center px-6 py-3 transition">
                    <i class="fa-solid fa-cart-flatbed {{ request()->routeIs('admin.orders') ? 'text-indigo-300' : 'text-gray-900' }}""></i>
                    <span class="pl-3">
                        Orders
                    </span>
                </a>
            </span>
        </div>
    </div>
</div>
