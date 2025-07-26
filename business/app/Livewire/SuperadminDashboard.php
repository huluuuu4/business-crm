<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class SuperadminDashboard extends Component
{
    use WithPagination;

    // Properties for editing a user's role
    #[URL]
     public ?int $highlight = null;
    public bool $showEditModal = false;
    public ?User $editingUser = null;
    public string $newRole = '';

    public function mount()
    {
        if (!in_array(auth()->user()->role, ['superadmin', 'admin'])) {
        abort(403);
    }
    }

    public function approveUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->is_approved = true;
            $user->save();
            session()->flash('success', 'User approved successfully.');
        }
    }

    // Method to open the edit modal
    public function editUser(User $user)
    {
        $this->editingUser = $user;
        $this->newRole = $user->role;
        $this->showEditModal = true;
    }

    // Method to save the updated role
    public function updateUserRole()
    {
        if ($this->editingUser) {
            $this->validate(['newRole' => 'required|in:superadmin,admin,customer']);
            $this->editingUser->role = $this->newRole;
            $this->editingUser->save();
            $this->showEditModal = false;
            session()->flash('success', 'User role updated successfully.');
        }
    }

    // Method to delete a user
    public function deleteUser(User $user)
    {
        // Prevent a superadmin from deleting their own account
        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete your own account.');
            return;
        }

        $user->delete();
        session()->flash('success', 'User deleted successfully.');
    }
     public function disapproveUser($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->delete();
            session()->flash('success', 'User registration has been denied and deleted.');
        }
    }

    public function render()
    {
        return view('livewire.superadmin-dashboard', [
            'pendingUsers' => User::where('is_approved', false)->paginate(5, ['*'], 'pendingPage'),
            'approvedUsers' => User::where('is_approved', true)->paginate(10, ['*'], 'approvedPage'),
        ])->layout('layouts.superadmin');
    }
}