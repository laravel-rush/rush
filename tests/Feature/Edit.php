<?php

use Illuminate\Support\Facades\File;

it("return's correct status code if entity already exists", function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null);


    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'amount')
        ->expectsQuestion('Field type (enter ? to see all types)', 'integer')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null);
        
    expect(
        File::exists(database_path('migrations/').date('Y_m_d_His').'_edit_todos_table.php')
    )->toBeTrue();
});

