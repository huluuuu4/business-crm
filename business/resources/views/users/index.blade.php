<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('User Management') }}</h2>
            <a href="{{ route('users.create') }}" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">+ Add User</a>
        </div>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead><tr><th class="py-3 px-4">Name</th><th class="py-3 px-4">Email</th><th class="py-3 px-4">Role</th></tr></thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr><td class="py-3 px-4">{{ $user->name }}</td><td class="py-3 px-4">{{ $user->email }}</td><td class="py-3 px-4">{{ $user->role }}</td></tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="mt-4">{{ $users->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>