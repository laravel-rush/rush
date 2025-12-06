<?php

use Illuminate\Support\Facades\Artisan;

test('first', function (): void {
    $exitCode = Artisan::call('make:entity Todo');

    expect($exitCode)->toBe(0);

    $output = Artisan::output();
    expect($output)->toContain('make entity Todo');
});
