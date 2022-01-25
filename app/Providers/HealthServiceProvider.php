<?php

namespace App\Providers;

use Spatie\Health\Facades\Health;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\PingCheck;
use Spatie\Health\Checks\Checks\CacheCheck;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;

class HealthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
            CacheCheck::new(),
            DebugModeCheck::new(),
            EnvironmentCheck::new(),
            PingCheck::new(),
            ScheduleCheck::new(),
        ]);
    }
}
