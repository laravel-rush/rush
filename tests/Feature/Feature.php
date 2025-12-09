<?php

declare(strict_types=1);

it("return's correct status code", function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'description')
        ->expectsQuestion('Field type (enter ? to see all types)', 'text')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null)
        ->assertExitCode(0);
});
