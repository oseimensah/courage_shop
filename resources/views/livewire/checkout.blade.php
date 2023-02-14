<div class="py-5 w-full mx-3 md:mx-auto md:max-w-7xl">
    <div class="px-5">
        <div class="mb-2">
            <h1 class="text-3xl md:text-5xl font-bold text-gray-600">Checkout</h1>
        </div>
    </div>
    <div class="w-full bg-white shadow border-t border-b border-gray-200 rounded-md px-5 py-10 text-gray-800">
        <form id="paymentForm" class="w-full">
            <div class="-mx-3 md:flex items-start">

                <div class="px-3 w-full lg:pr-10">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-3 text-gray-800 font-light mb-6">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Contact information</h2>

                            <div class="grid gap-4 grid-cols-2 md:grid-cols-4 mt-4">
                                <div class="col-span-2">
                                    <x-input-label for="first-name" :value="__('First Name')" />
                                    <x-text-input id="first-name" class="block mt-1 w-full" type="text" placeholder="first name" name="first_name" :value="old('first_name', auth()->user()->profile->first_name)" required />
                                    {{-- <x-input-error messages="First name required" class="mt-2" /> --}}
                                </div>
                                <div class="col-span-2">
                                    <x-input-label for="last-name" :value="__('Last Name')" />
                                    <x-text-input id="last-name" class="block mt-1 w-full" type="text" placeholder="last name" name="last_name" :value="old('last_name', auth()->user()->profile->last_name)" required />
                                    {{-- <x-input-error messages="Last name required" class="mt-2" /> --}}
                                </div>
                                <div class="col-span-2">
                                    <x-input-label for="email" :value="__('Email Address')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" placeholder="youremail.@domain.com" name="email" :value="old('email', auth()->user()->email)" required />
                                    {{-- <x-input-error messages="Email required" class="mt-2" /> --}}
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="mt-8 flex justify-between p-3">
                        <p class="text-lg font-bold">Total</p>
                        <div class="">
                            <p class="mb-1 text-lg font-bold"> {{ $order->amount_with_currency }}</p>
                        </div>
                    </div>
                    <div class="w-full">
                        <button type="submit" onclick="payWithPaystack()" class="w-full flex justify-center items-center bg-blue-800 hover:bg-blue-700 focus:bg-blue-700 text-white text-sm rounded-lg px-3 py-1.5 font-semibold">
                            {{-- <span class="animate-ping inline-flex w-4 h-4 rounded-full bg-white opacity-80"></span> --}}
                            <span class="flex space-x-3 items-center">
                                <i class="fa-solid fa-lock"></i> <span>PAY NOW</span>
                            </span>
                        </button>
                    </div>

                    {{-- <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-3 text-gray-800 font-light mb-6">
                        <div>
                            <h2 class="text-lg font-medium text-gray-900">Shipping information</h2>

                            <div class="grid gap-4 grid-cols-2 md:grid-cols-4 mt-4">
                                <div class="col-span-2">
                                    <x-input-label for="address" :value="__('Address')" />
                                    <x-text-input id="address" class="block mt-1 w-full" type="text" placeholder="Address" name="address" :value="old('address')" required />
                                </div>
                                <div class="col-span-2">
                                    <x-input-label for="city" :value="__('City')" />
                                    <x-text-input id="city" class="block mt-1 w-full" type="text" placeholder="City" name="city" :value="old('city')" />
                                </div>
                                <div class="col-span-2">
                                    <x-input-label for="phone" :value="__('Phone')" />
                                    <x-text-input id="phone" class="block mt-1 w-full" inputmode="numeric" type="text" placeholder="Phone" name="phone" :value="old('phone')" required />
                                </div>
                            </div>

                        </div>
                    </div> --}}

                </div>

                {{-- <div class="px-3 md:w-5/12">
                    <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 text-gray-800 font-light mb-6">
                        <div class="p-3">
                            <div class="w-full flex justify-between my-2 space-x-2 bg-gray-700 p-1 rounded">
                                <div @click.prevent="isCard = true" :class="isCard ? 'bg-white text-gray-600' : 'bg-transparent text-white'" class="p-1 cursor-pointer font-semibold rounded w-full text-center text-sm uppercase">card</div>
                                <div @click.prevent="isCard = false" :class="!isCard ? 'bg-white text-gray-600' : 'bg-transparent text-white'" class="p-1 cursor-pointer font-semibold rounded w-full text-center text-sm uppercase">momo</div>
                            </div>
                        </div>


                        <div class="w-full p-3">
                            <div x-show="isCard"  x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90">
                                <div class="mb-3">
                                    <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Name on card</label>
                                    <div>
                                        <input x-model="cardholder" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="John Smith" type="text"/>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Card number</label>
                                    <div>
                                        <input x-model="cardNumber" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="0000 0000 0000 0000" type="text"/>
                                    </div>
                                </div>
                                <div class="mb-3 -mx-2 flex items-end">
                                    <div class="px-2 w-1/4">
                                        <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Expiration date</label>
                                        <div>
                                            <select x-model="expired.month" class="form-select w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="px-2 w-1/4">
                                        <select x-model="expired.year" class="form-select w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors cursor-pointer">
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                            <option value="2025">2025</option>
                                            <option value="2026">2026</option>
                                            <option value="2027">2027</option>
                                            <option value="2028">2028</option>
                                            <option value="2029">2029</option>
                                            <option value="2020">2030</option>
                                            <option value="2021">2031</option>
                                            <option value="2022">2032</option>
                                        </select>
                                    </div>
                                    <div class="px-2 w-1/4">
                                        <label class="text-gray-600 font-semibold text-sm mb-2 ml-1">Security code</label>
                                        <div>
                                            <input x-model="securityCode" class="w-full px-3 py-2 mb-1 border border-gray-200 rounded-md focus:outline-none focus:border-indigo-500 transition-colors" placeholder="000" type="text"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="w-full p-3" x-show="!isCard" x-transition:enter="transition ease-out duration-300" x-transition:leave="transition ease-in-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90">
                            <div class="w-full relative">
                                <button @click="openDrop = !openDrop" @click.away="openDrop = false"  class="focus:outline-none w-full capitalize focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 focus:bg-gray-100 p-4 shadow rounded bg-white text-sm font-medium leading-none text-gray-800 flex items-center justify-between cursor-pointer">
                                    <span x-text="selectedMethod !== '' ? selectedMethod : `Provider`"></span>
                                    <div>
                                        <div x-show="openDrop">
                                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.00016 0.666664L9.66683 5.33333L0.333496 5.33333L5.00016 0.666664Z" fill="#1F2937" />
                                            </svg>
                                        </div>
                                        <div x-show="!openDrop">
                                            <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.00016 5.33333L0.333496 0.666664H9.66683L5.00016 5.33333Z" fill="#1F2937" />
                                            </svg>
                                        </div>
                                    </div>
                                </button>

                                <div x-show="openDrop" class="w-64 mt-2 bg-white shadow rounded absolute">
                                    <div class="flex-col overflow-y-scroll">
                                        <template x-for="(option, index) in options" :key="option.id">
                                            <p x-text="option.name" @click.prevent="cardColor(option)" @keydown.enter="cardColor(option)" :class="selectedMethod === option.name ? 'bg-red-100' : ''" class="cursor-pointer w-full px-4 py-2 text-sm uppercase hover:bg-red-400 hover:text-white rounded"></p>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="my-3">
                                <input
                                    inputmode="numeric" type="text"
                                    class="block w-full px-5 py-2 border rounded-lg bg-white placeholder-gray-400 text-gray-700 focus:ring-0 focus:outline-none"
                                    placeholder="&#149;&#149;&#149; &#149;&#149;&#149; &#149;&#149;&#149;&#149;"
                                    x-model="momoNumber"
                                    x-on:change="formatMomoNumber()"
                                    x-on:keydown="formatMomoNumber()"
                                    x-on:keyup="isValid()"
                                    maxlength="12"/>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <button  x-on:click="onSubmit()" class="w-full flex justify-center items-center bg-blue-800 hover:bg-blue-700 focus:bg-blue-700 text-white text-sm rounded-lg px-3 py-1.5 font-semibold">
                            <span x-show="isLoading" class="animate-ping inline-flex w-4 h-4 rounded-full bg-white opacity-80"></span>
                            <span>
                                <i class="fa-solid fa-lock"></i> PAY NOW
                            </span>
                        </button>
                    </div>
                </div> --}}
            </div>

        </div>
    </div>
</div>
