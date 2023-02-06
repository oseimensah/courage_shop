<div>
    <header class="py-4 shadow-sm bg-white">
        <div class="container flex items-center justify-between">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo/logo.jpg') }}" alt="Logo" class="w-32">
            </a>

            <div class="w-full max-w-xl relative flex">
                <span class="absolute left-4 top-3 text-lg text-gray-400">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </span>
                <input type="text" name="search" id="search"
                    class="w-full border border-primary border-r-0 pl-12 py-3 pr-3 rounded-l-md focus:outline-none"
                    placeholder="search">
                <button
                    class="bg-primary border border-primary text-white px-8 rounded-r-md hover:bg-transparent hover:text-primary transition">Search</button>
            </div>

            <div class="flex items-center space-x-4">
                <a href="#" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fa-regular fa-heart"></i>
                    </div>
                    <div class="text-xs leading-3">Wishlist</div>
                    <div class="absolute right-0 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">8</div>
                </a>
                <a href="#" class="text-center text-gray-700 hover:text-primary transition relative">
                    <div class="text-2xl">
                        <i class="fa-solid fa-bag-shopping"></i>
                    </div>
                    <div class="text-xs leading-3">Cart</div>
                    <div
                        class="absolute -right-3 -top-1 w-5 h-5 rounded-full flex items-center justify-center bg-primary text-white text-xs">
                        2</div>
                </a>
                <div class="text-center text-gray-700 transition relative group cursor-pointer">
                    <div class="text-2xl">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div class="text-xs leading-3">Account</div>
                    {{-- drop down --}}
                    <div class="absolute w-full min-w-fit left-0 text-xs top-full bg-white shadow-lg py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                        <a href="{{ route('login') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 hover:shadow-inner transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 hover:shadow-inner transition">
                            Register
                        </a>
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 hover:bg-gray-100 hover:shadow-inner transition">
                            Dashboard
                        </a>
                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 hover:shadow-inner transition">
                            Orders
                        </a>
                        <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 hover:shadow-inner transition">
                            Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</div>
