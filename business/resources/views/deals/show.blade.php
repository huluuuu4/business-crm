<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Deal: {{ $deal->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-6">

            <div class="lg:col-span-1 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">Deal Information</h3>
                    <p class="mt-2 text-sm text-gray-600"><strong>Customer:</strong> {{ $deal->customer->first_name }} {{ $deal->customer->last_name }}</p>
                    <p class="mt-1 text-sm text-gray-600"><strong>Value:</strong> ${{ number_format($deal->value, 2) }}</p>
                    <p class="mt-1 text-sm text-gray-600"><strong>Stage:</strong> {{ $deal->stage }}</p>
                    <p class="mt-1 text-sm text-gray-600"><strong>Expected Close:</strong> {{ \Carbon\Carbon::parse($deal->expected_close_date)->format('M d, Y') }}</p>
                </div>
            </div>

            <div class="lg:col-span-2 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h3 class="text-lg font-medium text-gray-900">Activity Notes</h3>
                    
                    <form method="POST" action="{{ route('notes.store', $deal) }}" class="mt-4">
                        @csrf
                        <textarea name="body" rows="3" class="block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Add a note..."></textarea>
                        <x-primary-button class="mt-2">Save Note</x-primary-button>
                    </form>

                    <div class="mt-6 space-y-4">
                        @forelse ($deal->notes as $note)
                            <div class="p-4 bg-gray-50 rounded-lg">
                                <p class="text-sm text-gray-800">{{ $note->body }}</p>
                                <p class="text-xs text-gray-500 mt-2">
                                    - by {{ $note->user->name }} on {{ $note->created_at->format('M d, Y \a\t h:ia') }}
                                </p>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500">No notes yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>