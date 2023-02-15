<x-app-layout>
    <div class="py-12">
        <div class="flex-auto px-0 pt-0 pb-8 mt-8">
            <div class="p-0 overflow-x-auto">
                @if(count($users) > 0)
                <div class="overflow-hidden m-3 shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-300">
                      <thead class="bg-gray-50">
                        <tr>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Address</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Phone</th>
                          <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th>
                          <th scope="col" class="relative py-3.5 pl-3 pr-4 sm:pr-6">
                            <span class="sr-only">Action</span>
                          </th>
                        </tr>
                      </thead>
                      <tbody class="divide-y divide-gray-200 bg-white">
                          @foreach ($users as $user)
                          <tr class="overflow-x-scroll">
                            <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900">{{ $user->name }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->email }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->profile->address ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $user->profile->phone ?? 'N/A' }}</td>
                            <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ count($user->roles) > 0 ? $user->roles[0]->name : 'N/A' }}</td>
                            <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6">
                                <p class="flex space-x-3">
                                      <form action="{{ route('admin.user.delete',$user->id) }}" method="POST">
                                          @csrf
                                          <button type="submit" class="rounded bg-red-100 hover:bg-red-600 text-gray-800 hover:text-white py-1 px-2 cursor-pointer">
                                              <i class="fa-solid fa-trash-can"></i>
                                          </button>
                                      </form>
                                </p>
                            </td>
                          </tr>
                          @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="p-3 pb-12">
                    <div class="bg-white p-3 rounded-md shadow-lg w-full flex justify-between">
                        <div class="py-16 flex justify-center items-center w-full">
                            <h2>
                                No account data available
                            </h2>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
