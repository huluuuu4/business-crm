<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewUserPendingApproval extends Notification
{
    use Queueable;

    public function __construct(public User $newUser)
    {
    }

    // Change the channel from 'mail' to 'database'
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    // Define the data to be stored in the database
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->newUser->name . ' has registered and is awaiting approval.',
            'link' => route('superadmin.dashboard'),
            'user_id' => $this->newUser->id,
        ];
    }
}