<x-shop-layout>
    @section('title', 'Checkout - Purely Ghanaian')
    @push('custom-style')
    <style>
        .form-radio {
          -webkit-appearance: none;
             -moz-appearance: none;
                  appearance: none;
          -webkit-print-color-adjust: exact;
                  color-adjust: exact;
          display: inline-block;
          vertical-align: middle;
          background-origin: border-box;
          -webkit-user-select: none;
             -moz-user-select: none;
              -ms-user-select: none;
                  user-select: none;
          flex-shrink: 0;
          border-radius: 100%;
          border-width: 2px;
        }

        .form-radio:checked {
          background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
          border-color: transparent;
          background-color: currentColor;
          background-size: 100% 100%;
          background-position: center;
          background-repeat: no-repeat;
        }

        @media not print {
          .form-radio::-ms-check {
            border-width: 1px;
            color: transparent;
            background: inherit;
            border-color: inherit;
            border-radius: inherit;
          }
        }

        .form-radio:focus {
          outline: none;
        }

        .form-select {
          background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23a0aec0'%3e%3cpath d='M15.3 9.3a1 1 0 0 1 1.4 1.4l-4 4a1 1 0 0 1-1.4 0l-4-4a1 1 0 0 1 1.4-1.4l3.3 3.29 3.3-3.3z'/%3e%3c/svg%3e");
          -webkit-appearance: none;
             -moz-appearance: none;
                  appearance: none;
          -webkit-print-color-adjust: exact;
                  color-adjust: exact;
          background-repeat: no-repeat;
          padding-top: 0.5rem;
          padding-right: 2.5rem;
          padding-bottom: 0.5rem;
          padding-left: 0.75rem;
          font-size: 1rem;
          line-height: 1.5;
          background-position: right 0.5rem center;
          background-size: 1.5em 1.5em;
        }

        .form-select::-ms-expand {
          color: #a0aec0;
          border: none;
        }

        @media not print {
          .form-select::-ms-expand {
            display: none;
          }
        }

        @media print and (-ms-high-contrast: active), print and (-ms-high-contrast: none) {
          .form-select {
            padding-right: 0.75rem;
          }
        }
    </style>
    @endpush

    <div class="w-full h-fit p-12">
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
                                <button type="submit" onclick.prevent="payWithPaystack()" class="w-full flex justify-center items-center bg-blue-800 hover:bg-blue-700 focus:bg-blue-700 text-white text-sm rounded-lg px-3 py-1.5 font-semibold">
                                    {{-- <span class="animate-ping inline-flex w-4 h-4 rounded-full bg-white opacity-80"></span> --}}
                                    <span class="flex space-x-3 items-center">
                                        <i class="fa-solid fa-lock"></i> <span>PAY NOW</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@push('custom-script')
<script src="https://js.paystack.co/v1/inline.js" defer></script>
<script>

    const paymentForm = document.getElementById('paymentForm');

    paymentForm.addEventListener("submit", function(event) {
        event.preventDefault();

          const handler = PaystackPop.setup({
            key: '{!! config('paystack.public_key') !!}', // Replace with your public key
            email: document.getElementById("email").value,
            amount: parseFloat({!! $order->amount !!}) * 100,
            // ref: ''+Math.floor((Math.random() * 1000000000) + 1),
            // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
            // label: "Optional string that replaces customer email"
            currency: 'GHS',
            onClose: () => {
                Swal.fire({
                    icon: 'error',
                    text: "Payment could not be processed. Window closed.",
                    showConfirmButton: false,
                    background: "#F50E3E",
                    // color: "#fff",
                    timer: 1500,
                    position: "top-end",
                    timerProgressBar: true,
                });
            },
            callback: (response) => {
              const message = 'Payment complete! Reference: ' + response.reference;
              window.location.replace('/shop/payment/complete?transaction_id=' + response.reference + '&order_id=' + {!! $order->id !!} + '&amount=' + {!! $order->amount !!});
            //   alert(message);
            }
          });
        handler.openIframe();
    });

    // paymentForm.addEventListener("submit", payWithPaystack, false);
    // function payWithPaystack(e) {
    // //   e.preventDefault();


    // }

</script>
@endpush

{{-- //   window.location.replace('{!! route('payment.store', ['transaction_id' => response.reference, 'order_id' => $order->id, 'amount' => $order->amount]) !!}'); --}}
</x-shop-layout>
