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
    <div class="w-full h-fit p-12" x-data="paymentData">
        <div class="py-5 w-full mx-3 md:mx-auto md:max-w-7xl">
            <div class="px-5">
                <div class="mb-2">
                    <h1 class="text-3xl md:text-5xl font-bold text-gray-600">Checkout</h1>
                </div>
            </div>
            <div class="w-full bg-white shadow border-t border-b border-gray-200 rounded-md px-5 py-10 text-gray-800">
                <div class="w-full">
                    <div class="-mx-3 md:flex items-start">

                        <div class="px-3 md:w-7/12 lg:pr-10">
                            <div class="w-full mx-auto rounded-lg bg-white border border-gray-200 p-3 text-gray-800 font-light mb-6">
                                <div>
                                    <h2 class="text-lg font-medium text-gray-900">Contact information</h2>

                                    <div class="grid gap-4 grid-cols-2 md:grid-cols-4 mt-4">
                                        <div class="col-span-2">
                                            <x-input-label for="first-name" :value="__('First Name')" />
                                            <x-text-input id="first-name" x-model="contact.first_name" class="block mt-1 w-full" type="text" placeholder="first name" name="email" :value="old('first_name')" required />
                                            <x-input-error x-show="contact.first_name.length < 1" messages="First name required" class="mt-2" />
                                        </div>
                                        <div class="col-span-2">
                                            <x-input-label for="last-name" :value="__('Last Name')" />
                                            <x-text-input id="last-name" x-model="contact.last_name" class="block mt-1 w-full" type="text" placeholder="last name" name="last_name" :value="old('last_name')" required />
                                            <x-input-error x-show="contact.last_name.length < 1" messages="Last name required" class="mt-2" />
                                        </div>
                                        <div class="col-span-2">
                                            <x-input-label for="email" :value="__('Email Address')" />
                                            <x-text-input id="email" x-model="contact.email" class="block mt-1 w-full" type="email" placeholder="youremail.@domain.com" name="email" :value="old('email')" required />
                                            <x-input-error x-show="contact.email.length < 1" messages="Email required" class="mt-2" />
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="mt-8 flex justify-between p-3">
                                <p class="text-lg font-bold">Total</p>
                            <div class="">
                                <p class="mb-1 text-lg font-bold">GHC {{ $total }}</p>
                            </div>
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

                        <div class="px-3 md:w-5/12">
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
                                <button  x-on:click="onSubmit()" class="w-full flex justify-center items-center bg-indigo-500 hover:bg-indigo-700 focus:bg-indigo-700 text-white rounded-lg px-3 py-2 font-semibold">
                                    <span x-show="isLoading" class="animate-ping inline-flex w-4 h-4 rounded-full bg-white opacity-80"></span>
                                    <span>
                                        <i class="fa-solid fa-lock"></i> PAY NOW
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @push('custom-script')
        <script>
      document.addEventListener("alpine:init", () => {
         Alpine.data("paymentData", () => ({
            init() {
               console.log('Component mounted');
               this.getYears();
            },
            formatMomoNumber() {
               if (this.momoNumber.length > 10) {
                  return;
               }
               this.momoNumber = this.momoNumber.replace(/\W/gi, '').replace(/(.{3})/g, '$1 ');
            },
            // formatCardNumber() {
            //    if (this.cardNumber.length > 18) {
            //       return;
            //    }
            //    this.cardNumber = this.cardNumber.replace(/\W/gi, '').replace(/(.{4})/g, '$1 ');
            // },
            async isValid() {
                let self = this;
                if (self.contact.first_name == '') {
                    return false;
                }
                else if (self.contact.last_name == '') {
                    return false
                }
                else if (self.contact.email === '') {
                    return false;
                }
                else if (self.isCard) {
                    if (self.cardholder.length < 5) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Invalid Card Holder',
                            text: 'Card name invalid',
                            showConfirmButton: false,
                            timerProgressBar: false,
                        })
                        return false;
                    }
                    else if (self.cardNumber === '') {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Invalid Card Number',
                            text: 'Card Number required',
                            showConfirmButton: false,
                            timerProgressBar: false,
                        })
                        return false;
                    }
                    else if (self.expired.month === '' || self.expired.year === '') {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Required fields',
                            text: 'Month and year required',
                            showConfirmButton: false,
                            timerProgressBar: false,
                        })
                        return false;
                    }
                    else if (self.securityCode.length !== 3) {
                        return false;
                    }
                }
                else if(!self.isCard) {
                    if (self.selectedMethod === '') {
                        return false;
                    }
                    else if (self.momoNumber === '' || self.momoNumber.length < 10) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: 'Invalid Mobile Number',
                            text: 'Mobile Number is required and must be 10 digits',
                            showConfirmButton: false,
                            timerProgressBar: false,
                        })
                        return false;
                    }
                }
                return true;
            },
            cardColor(option) {
               if (option.name === 'MTN') {
                  this.cardBackColor = 'yellow'
               } else if (option.name === 'Vodafone') {
                  this.cardBackColor = 'red'
               } else {
                  this.cardBackColor = 'blue'
               }
               this.openDrop = false;
               this.selectedMethod = option.name;
               this.selectedValue = option.id;
            },
            getYears() {
               var currentYear = new Date().getFullYear(), years = [];
               endYear = currentYear + 10;

               while ( currentYear <= endYear ) {
                  years.push(currentYear++);
               }
               this.years = years
            },
            onSubmit() {
                    Swal.fire({
                         icon: 'info',
                         title: 'Checkout Maintenance',
                         text: 'Payment system is under maintenance. Check back in the next 24 hours',
                         showConfirmButton: true,
                         timerProgressBar: false,
                      })


                // if (!this.isValid()) {
                //     return;
                // } else {
                //     let self = this;
                //     self.isLoading = true;

                //     var jsonBody = {
                //         first_name: self.contact.first_name,
                //         last_name: self.contact.last_name,
                //         email: self.contact.email,
                //         cardOption: self.isCard,
                //         momoNumber: self.momoNumber,
                //         selectedValue: self.selectedValue,
                //         amount: {!! $total !!},
                //         cardholder: self.cardholder,
                //         cardNumber: self.cardNumber,
                //         expiredMonth: self.expired.month,
                //         expiredYear: self.expired.year,
                //         securityCode: self.securityCode,
                //     };
                //        fetch('/api/pay', {
                //           method: 'POST',
                //           headers: {
                //              'Content-Type': 'application/json',
                //              'X-CSRF-TOKEN': document.head.querySelector('meta[name=csrf-token]').content
                //           },
                //           body: JSON.stringify(jsonBody),
                //        })
                //        .then(response => response.json())
                //        .then(data => {
                //           self.isLoading = false;
                //         //   if (data.data.code !== 200) {
                //         //      Swal.fire({
                //         //         icon: 'error',
                //         //         title: data.data.status,
                //         //         text: data.data.reason,
                //         //         showConfirmButton: true,
                //         //         timerProgressBar: false,
                //         //      })
                //         //   }
                //         //   else {
                //         //      Swal.fire({
                //         //         icon: 'success',
                //         //         title: data.data.status,
                //         //         text: data.data.reason,
                //         //         timer: 3000,
                //         //         showConfirmButton: true,
                //         //         timerProgressBar: true,
                //         //      })
                //         //   }
                //           console.log('Success:', data);
                //        })
                //        .catch((error) => {
                //           self.isLoading = false;
                //           Swal.fire({
                //              icon: 'error',
                //              title: 'Unsuccessful',
                //              text: 'Sorry payment could not be processed',
                //              showConfirmButton: true,
                //              timerProgressBar: false,
                //           })
                //           console.log(error);
                //        });
                //     console.log(this.jsonBody);
                // }
                // else {
                //     let self = this;
                //     Swal.fire({
                //          icon: 'success',
                //          title: jsonBody.amount,
                //          text: 'Sorry payment could not be processed',
                //          showConfirmButton: true,
                //          timerProgressBar: false,
                //       })

                // }


            },
            options: [
               {
                  'id': 'MTN',
                  'name': 'MTN',
               },
               {
                  'id': 'VDF',
                  'name': 'Vodafone',
               },
               {
                  'id': 'ATL',
                  'name': 'Airtel',
               },
               {
                  'id': 'TGO',
                  'name': 'Tigo',
               },
            ],
            years: [],
            selectedMethod: '',
            selectedValue: '',
            momoNumber: '',
            cardholder: '',
            cardNumber: '',
            expired: {
               month: '',
               year: '',
            },
            securityCode: '',
            cardBackColor: 'gray',
            isLoading: false,
            isCard: true,
            openDrop: false,
            contact: {
                first_name: '',
                last_name: '',
                email: '',
            },
            shipping: {
                address: '',
                city: '',
                phone: '',
            },
         }));
      });
   </script>
    @endpush

</x-shop-layout>
