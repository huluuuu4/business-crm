<?php

namespace App\Livewire;

use Livewire\Component;

class NotificationBell extends Component
{
    public function markAsRead($notificationId)
    {
        $notification = auth()->user()->notifications()->findOrFail($notificationId);
        $notification->markAsRead();

        // Redirect the user after marking as read
        return redirect($notification->data['link']);
    }

    public function render()
    {
        return view('livewire.notification-bell', [
            'notifications' => auth()->user()->unreadNotifications,
        ]);
    }
}