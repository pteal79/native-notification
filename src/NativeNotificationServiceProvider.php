<?php

namespace PTeal79\NativeNotification;

use Illuminate\Support\ServiceProvider;
use PTeal79\NativeNotification\Commands\CopyAssetsCommand;

class NativeNotificationServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(NativeNotification::class, function () {
            return new NativeNotification();
        });
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CopyAssetsCommand::class,
            ]);
        }
    }
}
