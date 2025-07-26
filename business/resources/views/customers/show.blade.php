<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $customer->first_name }} {{ $customer->last_name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Customer Details Card --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-lg font-medium text-gray-900">Customer Information</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Email: {{ $customer->email }}
                    </p>
                    <p class="mt-1 text-sm text-gray-600">
                        Phone: {{ $customer->phone_number ?? 'N/A' }}
                    </p>
                </div>
            </div>

            {{-- Deals Section --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Deals</h3>
                    {{-- This button will link to a route we will create in the next step --}}
                    <a href="{{ route('deals.create', $customer) }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        + Add New Deal
                    </a>
                </div>
                
                {{-- Deals Table --}}
                <div class="mt-6">
                   <table class="min-w-full bg-white">
    <thead class="bg-gray-50">
        <tr>
            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deal Name</th>
            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Value</th>
            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stage</th>
            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Close Date</th>
            <th class="py-3 px-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th> {{-- Add this --}}
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @forelse($customer->deals as $deal)
            <tr>
                <td class="py-4 px-4 whitespace-nowrap">{{ $deal->name }}</td>
                <td class="py-4 px-4 whitespace-nowrap">${{ number_format($deal->value, 2) }}</td>
                <td class="py-4 px-4 whitespace-nowrap">{{ $deal->stage }}</td>
                <td class="py-4 px-4 whitespace-nowrap">{{ \Carbon\Carbon::parse($deal->expected_close_date)->format('M d, Y') }}</td>
                {{-- Add this cell for the actions --}}
                <td class="py-4 px-4 whitespace-nowrap text-sm font-medium">
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('deals.edit', $deal) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                         @can('is-admin')
                        <form action="{{ route('deals.destroy', $deal) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                        </form>
                        @endcan
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="py-4 px-4 text-center text-gray-500">No deals found for this customer.</td> {{-- Update colspan --}}
            </tr>
        @endforelse
    </tbody>
</table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>