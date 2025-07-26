<div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach ($stages as $stage)
            <div class="bg-gray-100 rounded-lg p-4">
                <h3 class="font-bold text-lg text-gray-800 mb-4">{{ $stage }}</h3>
                <div class="space-y-4 min-h-[100px]">
                    @if(isset($deals[$stage]))
                        @foreach ($deals[$stage] as $deal)
                            <div class="relative">
                                <div wire:click="selectDeal({{ $deal->id }})" class="bg-white p-4 rounded-lg shadow cursor-pointer hover:bg-gray-50">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h4 class="font-bold">{{ $deal->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $deal->customer->first_name }} {{ $deal->customer->last_name }}</p>
                                        </div>

                                        {{-- Corrected Note Popover --}}
                                        <div x-data="{ open: false }" @mouseenter="open = true; $wire.openNotesModal({{ $deal->id }})" @mouseleave="open = false" class="relative">
                                            <button class="text-gray-400 hover:text-gray-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                                            </button>

                                            <div x-show="open"
                                                 x-transition
                                                 class="absolute top-0 right-8 bg-white rounded-lg shadow-lg p-4 z-20 w-64 border">
                                                @if ($notesModalDeal && $notesModalDeal->id === $deal->id)
                                                    <h5 class="text-sm font-bold mb-2">Notes</h5>
                                                    <div class="space-y-2 max-h-40 overflow-y-auto mb-2 text-xs">
                                                        @forelse ($notesModalDeal->notes as $note)
                                                            <div class="bg-gray-50 p-2 rounded">
                                                                <p>{{ $note->body }}</p>
                                                                <p class="text-gray-500 text-right">- {{ $note->user->name }}</p>
                                                            </div>
                                                        @empty
                                                            <p class="text-gray-500">No notes yet.</p>
                                                        @endforelse
                                                    </div>
                                                    <form wire:submit.prevent="addNote">
                                                        <textarea wire:model="newNoteBody" rows="2" class="w-full border-gray-300 rounded-md text-sm" placeholder="Add note..."></textarea>
                                                        <button type="submit" class="mt-2 px-3 py-1 bg-indigo-600 text-white text-xs rounded-md">Save</button>
                                                    </form>
                                                @else
                                                    <p class="text-xs text-gray-500">Loading notes...</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-800 mt-2">${{ number_format($deal->value, 2) }}</p>
                                </div>

                                @if ($selectedDealId === $deal->id)
                                    <div class="absolute top-0 right-0 -mr-32 bg-white rounded-lg shadow-lg p-2 z-10 w-32">
                                        <h5 class="text-xs font-bold mb-1 px-2">Move to:</h5>
                                        @foreach ($stages as $potentialStage)
                                            @if ($potentialStage !== $stage)
                                                <button wire:click.prevent="updateStage('{{ $potentialStage }}')" class="w-full text-left text-sm px-2 py-1 hover:bg-gray-100 rounded">
                                                    {{ $potentialStage }}
                                                </button>
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>