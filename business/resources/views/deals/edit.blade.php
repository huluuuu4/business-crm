<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Deal: ') }} {{ $deal->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('deals.update', $deal) }}">
                        @csrf
                        @method('PUT') {{-- Specify the update method --}}

                        <div>
                            <x-input-label for="name" :value="__('Deal Name')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $deal->name)" required autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="value" :value="__('Value ($)')" />
                            <x-text-input id="value" class="block mt-1 w-full" type="number" name="value" step="0.01" :value="old('value', $deal->value)" required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="stage" :value="__('Stage')" />
                            <select name="stage" id="stage" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach(['Lead', 'Contacted', 'Demo Scheduled', 'Proposal Sent', 'Won', 'Lost'] as $stage)
                                    <option value="{{ $stage }}" @selected(old('stage', $deal->stage) == $stage)>
                                        {{ $stage }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="expected_close_date" :value="__('Expected Close Date')" />
                            <x-text-input id="expected_close_date" class="block mt-1 w-full" type="date" name="expected_close_date" :value="old('expected_close_date', $deal->expected_close_date)" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Update Deal') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>