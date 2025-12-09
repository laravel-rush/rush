<?php

declare(strict_types=1);

namespace Tests;

use Illuminate\Support\Facades\File;
use LaravelRush\Rush\RushServiceProvider;
use Orchestra\Testbench\TestCase as TestbenchTestCase;

class TestCase extends TestbenchTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->configurePaths();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->clearPaths();
    }

    /**
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            RushServiceProvider::class,
        ];
    }

    private function configurePaths(): void
    {
        $migrations_path = database_path('migrations');

        File::makeDirectory($migrations_path, 0755, true);
    }

    private function clearPaths(): void
    {
        $migrations_path = database_path();

        File::deleteDirectory($migrations_path);
    }
}
