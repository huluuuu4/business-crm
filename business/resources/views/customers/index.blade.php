<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Customers') }}
            </h2>
            <a href="{{ route('customers.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                + Add Customer
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <form method="GET" action="{{ route('customers.index') }}">
                        <div class="flex items-center mb-4">
                            <input type="text" name="search" placeholder="Search by name or email..." class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" value="{{ request('search') }}">
                            <x-primary-button class="ml-3">Search</x-primary-button>
                        </div>
                    </form>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Name</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Email</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Phone</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Status</th>
                                    <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-700">
                                @forelse ($customers as $customer)
                                    <tr class="border-b">
                                        <td class="py-3 px-4">
                                            <a href="{{ route('customers.show', $customer) }}" class="font-medium text-indigo-600 hover:underline">
                                                {{ $customer->first_name }} {{ $customer->last_name }}
                                            </a>
                                        </td>
                                        <td class="py-3 px-4">{{ $customer->email }}</td>
                                        <td class="py-3 px-4">{{ $customer->phone_number ?? 'N/A' }}</td>
                                        <td class="py-3 px-4">
                                            <span class="bg-blue-200 text-blue-600 py-1 px-3 rounded-full text-xs">{{ $customer->status }}</span>
                                        </td>
                                        <td class="py-3 px-4">
                                            <div class="flex items-center space-x-4">
                                                <a href="{{ route('customers.edit', $customer) }}" class="font-medium text-indigo-600 hover:text-indigo-900">Edit</a>
                                                @can('is-admin')
                                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="font-medium text-red-600 hover:text-red-900">Delete</button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-4 px-4 text-center text-gray-500">No customers found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $customers->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>