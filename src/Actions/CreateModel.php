<?php

declare(strict_types=1);

namespace LaravelRush\Rush\Actions;

use LaravelRush\Rush\Services\TwigService;

final readonly class CreateModel
{
    public function __construct(
        private TwigService $service
    ) {}

    /**
     * @param  array<int, array{name: string, type: string}>  $properties
     */
    public function handle(string $entity_name, array $properties): void
    {
        $code = $this->service->renderModel($entity_name, $properties);

        $filename = $entity_name.'.php';

        file_put_contents(base_path('/app/Models/')."{$filename}", $code);
    }
}
