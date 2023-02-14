<x-app-layout>
    <div class="py-12">

        <div class="bg-white transition-all duration-30 my-2 ease-linear p-3 rounded-md shadow-lg w-full">
            <div class="w-full">
                <h1 class="font-bold py-4 uppercase">Orders</h1>
                <div class="overflow-x-scroll">
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-blue-800 text-white">
                            <th class="text-left py-3 px-2 rounded-l-lg">Code</th>
                            <th class="text-left py-3 px-2">Name</th>
                            <th class="text-left py-3 px-2">Amount</th>
                            <th class="text-left py-3 px-2">Status</th>
                        </thead>
                        @foreach ($orders as $order)
                        <tr class="border-b border-gray-100">
                            <td class="py-3 px-2 font-bold">
                                <div class="inline-flex space-x-3 items-center">
                                    {{-- <span><img class="rounded-full w-8 h-8" src="https://images.generated.photos/tGiLEDiAbS6NdHAXAjCfpKoW05x2nq70NGmxjxzT5aU/rs:fit:256:256/czM6Ly9pY29uczgu/Z3Bob3Rvcy1wcm9k/LnBob3Rvcy92M18w/OTM4ODM1LmpwZw.jpg" alt=""></span> --}}
                                    <span>{{ $order->code }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-2">{{ $order->user->name }}</td>
                            <td class="py-3 px-2">{{ $order->amount_with_currency }}</td>
                            <td class="py-3 px-2" >
                                <span class="rounded capitalize {{ $order->status == 'paid' ? 'bg-green-600 text-gray-100' : '' }} py-1 px-2">{{ $order->status ?? 'pending' }}</span>
                            </td>
                        </tr>

                        @endforeach

                    </table>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>
