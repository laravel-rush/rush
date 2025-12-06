<?php

use Illuminate\Support\Facades\Artisan;

test('first', function (): void {
    $exitCode = Artisan::call('make:entity Todo');

    expect($exitCode)->toBe(0);
});

it("return's correct status code", function (): void {

    $this->artisan('command:name')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'description')
        ->expectsQuestion('Field type (enter ? to see all types)', 'text')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null)
        ->assertExitCode(0);
});
