<?php

declare(strict_types=1);

namespace LaravelRush\Rush;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;
use LaravelRush\Rush\Commands\MakeEntityCommand;

final class RushServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        Config::set('_internal.types',
            require __DIR__.'/../config/types.php'
        );
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeEntityCommand::class,
            ]);
        }
    }
}
