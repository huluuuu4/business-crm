<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Superadmin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if (session()->has('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded-lg">{{ session('success') }}</div>
            @endif
            @if (session()->has('error'))
                <div class="p-4 bg-red-100 text-red-700 rounded-lg">{{ session('error') }}</div>
            @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Pending Approval</h3>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-2 px-4 text-left">Name</th>
                                    <th class="py-2 px-4 text-left">Email</th>
                                    <th class="py-2 px-4 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pendingUsers as $user)
                                    <tr wire:key="pending-{{ $user->id }}">
                                        <td class="px-4 py-2">{{ $user->name }}</td>
                                        <td class="px-4 py-2">{{ $user->email }}</td>
                                        <td class="px-4 py-2">
                                            <button wire:click="approveUser({{ $user->id }})" class="px-3 py-1 bg-green-500 text-white text-lg rounded hover:bg-green-600">👍</button>
                                             <button wire:click="disapproveUser({{ $user->id }})" wire:confirm="Are you sure you want to deny and delete this user?" class="px-3 py-1 bg-red-500 text-white text-lg rounded hover:bg-red-600">👎</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="3" class="text-center py-4">No users pending approval.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $pendingUsers->links() }}</div>
                </div>
            </div>
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Approved Users</h3>
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-2 px-4 text-left">Name</th>
                                    <th class="py-2 px-4 text-left">Email</th>
                                    <th class="py-2 px-4 text-left">Role</th>
                                    <th class="py-2 px-4 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($approvedUsers as $user)
                                    <tr class="border-b @if($highlight === $user->id) bg-yellow-100 @endif" wire:key="approved-{{ $user->id }}">
                                        <td class="px-4 py-2">{{ $user->name }}</td>
                                        <td class="px-4 py-2">{{ $user->email }}</td>
                                        <td class="px-4 py-2">{{ $user->role }}</td>
                                        <td class="px-4 py-2 flex space-x-2">
                                            <button wire:click="editUser({{ $user->id }})" class="px-2 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">Edit</button>
                                            <button wire:click="deleteUser({{ $user->id }})" wire:confirm="Are you sure you want to delete this user?" class="px-2 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">Delete</button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center py-4">No approved users found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">{{ $approvedUsers->links() }}</div>
                </div>
            </div>
        </div>
    </div>

    @if ($showEditModal)
        <div class="fixed z-10 inset-0 overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen">
                <div class="fixed inset-0 transition-opacity" aria-hidden="true"><div class="absolute inset-0 bg-gray-500 opacity-75"></div></div>
                <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                    <form wire:submit.prevent="updateUserRole" class="p-6">
                        <h3 class="text-lg font-medium text-gray-900">Edit User Role: {{ $editingUser->name }}</h3>
                        <div class="mt-4">
                            <label for="newRole" class="block text-sm font-medium text-gray-700">Role</label>
                            <select wire:model="newRole" id="newRole" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                                <option value="customer">Customer</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Superadmin</option>
                            </select>
                        </div>
                        <div class="mt-6 bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 font-medium text-white hover:bg-indigo-700">Save Changes</button>
                            <button wire:click="$set('showEditModal', false)" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white font-medium text-gray-700 hover:bg-gray-50 sm:mt-0 sm:ml-3 sm:w-auto">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>