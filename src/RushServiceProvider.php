<?php

declare(strict_types=1);

namespace LaravelRush\Rush;

use Illuminate\Support\ServiceProvider;
use LaravelRush\Rush\Commands\MakeEntityCommand;

class RushServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeEntityCommand::class,
            ]);
        }
    }
}
