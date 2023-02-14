@if ($cart_value > 0)
      <div class="absolute right-0 w-full m-1 bg-white origin-top-right rounded-b-md shadow-lg md:max-w-sm max-h-3/5 overflow-y-scroll overflow-x-hidden">
         <ul class="block bg-white">
            @foreach($cart as $key => $product)
            <li class="grid grid-cols-8 overflow-hidden col-gap-6 border-b border-gray-100 py-4 px-2">
               <img class="block col-span-2 w-full h-20 rounded bg-gray-50" src="{{ $product['image'] }}" alt="img product" />
               <div class="col-span-6">
                  <div class="flex">
                     <h6 class="text-sm font-semibold text-gray-800 flex-grow">{{ $product['name'] }}</h6>
                     <button wire:click.prevent="removeFromCart({{ $key }})">
                        <svg class="w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M10 8.586L2.929 1.515 1.515 2.929 8.586 10l-7.071 7.071 1.414 1.414L10 11.414l7.071 7.071 1.414-1.414L11.414 10l7.071-7.071-1.414-1.414L10 8.586z"
                        />
                        </svg>
                     </button>
                  </div>
                  <p class="text-xs mr-6 truncate text-gray-600">{{ $product['product_description'] != null ? $product['product_description'] : "Description not Available" }}</p>
                  <p class="flex mt-3">
                     <input type="number" min="1" wire:model="cart.{{ $key }}.quantity"
                     wire:keydown.arrow-up="calculateSubTotal({{ $key }})"
                     wire:keydown.arrow-down="calculateSubTotal({{ $key }})"
                     wire:click="calculateSubTotal({{ $key }})"
                      class="input-group-sm p-1 w-16 text-xs rounded text-center items-center border border-gray-200" value="{{ $product['quantity'] }}">
                     {{-- <span class="my-auto text-sm text-gray-800 ml-3" wire:model="cart.{{ $key }}.product_amount">GHS {{ $product['product_cost'] }}</span> --}}
                     <span class="my-auto text-sm text-gray-800 ml-3">GHS {{ $product['amount'] }}</span>
                  </p>
               </div>
            </li>
            @endforeach
         </ul>

         <div class="bg-white rounded-b-md shadow">
            <div class="flex justify-between border-b">
               <div class="lg:px-4 lg:py-2 m-2 text-sm lg:text-md font-bold text-center text-gray-800">
                 Total
               </div>
               <div class="lg:px-4 lg:py-2 m-2 lg:text-md font-bold text-sm text-center text-gray-900">
                 GHS {{ $total }}
               </div>
            </div>


            <button class="flex justify-center w-full rounded-b-md shadow py-3 font-medium text-white uppercase bg-gray-600 item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
               <span wire:click="makeOrder({{ $total }})" class="my-auto ml-3 text-sm">order now</span>
            </button>
         </div>
      </div>
      @else
      <div class="absolute right-0 w-full m-1 bg-white origin-top-right rounded-b-sm shadow-lg md:max-w-xs max-h-3/5 overflow-hidden">
         <div class="text-xs text-center font-medium tracking-wide leading-5 py-6">Cart Empty</div>
      </div>
      @endif
