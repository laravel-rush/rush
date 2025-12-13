<?php

// TODO

it("return's correct status code if entity already exists", function (): void {
    $this->artisan('make:entity Todo')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', 'title')
        ->expectsQuestion('Field type (enter ? to see all types)', 'string')
        ->expectsQuestion('New property name (press <return> to stop adding fields)', null);


    $this->artisan('make:entity Todo')->assertExitCode(1);    
});