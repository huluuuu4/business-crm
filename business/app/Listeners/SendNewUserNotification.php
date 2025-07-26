<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUserPendingApproval;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotification
{
    public function handle(Registered $event): void
    {
        dd('Listener is running!');
        // Find all superadmin users
        $superadmins = User::where('role', 'superadmin')->get();
        
        // Send the notification to each superadmin
        Notification::send($superadmins, new NewUserPendingApproval($event->user));
    }
}