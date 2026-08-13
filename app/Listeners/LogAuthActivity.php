<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Spatie\Activitylog\Models\Activity;

class LogAuthActivity
{
    public function handle(Login|Logout $event): void
    {
        $user = $event->user;

        activity('auth')
            ->causedBy($user)
            ->withProperties(['ip' => request()->ip(), 'user_agent' => substr(request()->userAgent() ?? '', 0, 200)])
            ->log($event instanceof Login ? "Login: {$user->name}" : "Logout: {$user->name}");
    }
}
