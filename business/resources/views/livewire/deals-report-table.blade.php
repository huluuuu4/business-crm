<div>
    <h3 class="text-lg font-medium text-gray-900 mb-4 mt-8">All Deals Report</h3>

    <div class="mb-4">
        <input 
            wire:model.live.debounce.300ms="search" 
            type="text" 
            placeholder="Search deals by name..." 
            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white">
            <thead class="bg-gray-200">
                <tr>
                    <th wire:click="sortBy('name')" class="cursor-pointer py-3 px-4 uppercase font-semibold text-sm text-left">Deal Name</th>
                    <th wire:click="sortBy('customer_id')" class="cursor-pointer py-3 px-4 uppercase font-semibold text-sm text-left">Customer</th>
                    <th wire:click="sortBy('value')" class="cursor-pointer py-3 px-4 uppercase font-semibold text-sm text-left">Value</th>
                    <th wire:click="sortBy('stage')" class="cursor-pointer py-3 px-4 uppercase font-semibold text-sm text-left">Stage</th>
                    <th wire:click="sortBy('created_at')" class="cursor-pointer py-3 px-4 uppercase font-semibold text-sm text-left">Date Added</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($deals as $deal)
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $deal->name }}</td>
                        <td class="py-3 px-4">{{ $deal->customer->first_name }} {{ $deal->customer->last_name }}</td>
                        <td class="py-3 px-4">${{ number_format($deal->value, 2) }}</td>
                        <td class="py-3 px-4">{{ $deal->stage }}</td>
                        <td class="py-3 px-4">{{ $deal->created_at->format('M d, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="py-4 px-4 text-center text-gray-500">No deals found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $deals->links() }}
    </div>
</div>