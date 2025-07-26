<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
         <!-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-4">
            <div class="p-4 bg-yellow-200 text-yellow-800 rounded-lg">
                <strong>DEBUGGING:</strong> My current role is: [{{ Auth::user()->role }}]
            </div>
        </div> -->

        <div class="max-w-7xl mx-auto sm-px-6 lg-px-8">
            @if (auth()->user()->role === 'Admin')
                {{-- This is what Admins will see --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-medium">Admin Dashboard</h3>
                        <p class="mt-2">Welcome, Admin. You can manage users from your navigation link.</p>
                    </div>
                </div>
            @else
                {{-- This is what regular Users will see --}}
                <livewire:deals-pipeline />
            @endif
        </div>
    </div>
</x-app-layout>