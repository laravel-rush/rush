<?php

namespace Tests;

use LaravelRush\Rush\RushServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    /**
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            RushServiceProvider::class,
        ];
    }
}
