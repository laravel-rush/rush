<?php

declare(strict_types=1);

use Illuminate\Support\Facades\File;

it("return's correct status code", function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'description')
        ->expectsQuestion('Field type (enter ? to see all types)', 'text')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null)
        ->assertExitCode(0);
});

it("create's migration file", function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'description')
        ->expectsQuestion('Field type (enter ? to see all types)', 'text')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null)
        ->assertExitCode(0);

    expect(
        File::exists(database_path('/migrations').'/'.date('Y_m_d_His').'_create_todos_table.php')
    )->toBeTrue();
});

it('throws an error if type is unavailable', function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')

        ->expectsQuestion('Field type (enter ? to see all types)', 'sdklfjsldfjldsf')
        ->expectsOutputToContain('[ERROR] Invalid type "sdklfjsldfjldsf".')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')

        ->expectsQuestion('New property name (press <return> to stop adding fields)', null)
        ->assertExitCode(0);
});

it("create's model file", function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'description')
        ->expectsQuestion('Field type (enter ? to see all types)', 'text')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null)
        ->assertExitCode(0);

    expect(
        File::exists(base_path('/app/Models/').'Todo.php')
    )->toBeTrue();
});

it("create's Factory", function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'description')
        ->expectsQuestion('Field type (enter ? to see all types)', 'text')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null)
        ->assertExitCode(0);

    expect(
        File::exists(database_path('/factories/').'TodoFactory.php')
    )->toBeTrue();
});

// shapshot tests
