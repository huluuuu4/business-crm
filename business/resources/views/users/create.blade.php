<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Create New User') }}</h2></x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('users.store') }}">
                        @csrf
                        <div><x-input-label for="name" value="Name" /><x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus /></div>
                        <div class="mt-4"><x-input-label for="email" value="Email" /><x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required /></div>
                        <div class="mt-4"><x-input-label for="role" value="Role" /><select name="role" id="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"><option value="User">User</option><option value="Admin">Admin</option></select></div>
                        <div class="mt-4"><x-input-label for="password" value="Password" /><x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required /></div>
                        <div class="mt-4"><x-input-label for="password_confirmation" value="Confirm Password" /><x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required /></div>
                        <div class="flex items-center justify-end mt-4"><x-primary-button>{{ __('Create User') }}</x-primary-button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>