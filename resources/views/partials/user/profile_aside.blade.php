<aside class="py-6 lg:col-span-3">
    <nav class="space-y-1">
        <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.edit') ? 'bg-sky-800 shadow-inner text-white' : 'text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} border-transparent group border-l-4 px-3 py-2 flex items-center text-sm font-medium" >
            <span class="truncate">
                Profile
            </span>
        </a>
        <a href="{{ route('profile.orders') }}" class="{{ request()->routeIs('profile.orders') ? 'bg-sky-800 shadow-inner text-white' : 'text-gray-900 hover:bg-gray-50 hover:text-gray-900' }} border-transparent group border-l-4 px-3 py-2 flex items-center text-sm font-medium" >
            <span class="truncate">
                Orders
            </span>
        </a>
    </nav>
</aside>
