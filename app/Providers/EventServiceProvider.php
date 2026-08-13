<?php

namespace App\Providers;

use App\Listeners\LogAuthActivity;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Login::class  => [LogAuthActivity::class],
        Logout::class => [LogAuthActivity::class],
    ];

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
