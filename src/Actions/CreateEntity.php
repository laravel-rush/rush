<?php

declare(strict_types=1);

namespace LaravelRush\Rush\Actions;

use Illuminate\Support\Facades\Artisan;

final readonly class CreateEntity
{
    public function __construct(
        private CreateMigration $createMigration,
        private CreateModel $createModel
    ) {}

    /**
     * @param  array<int, array{name: string, type: string}>  $properties
     */
    public function handle(string $entity_name, array $properties): void
    {
        $this->createMigration->handle($entity_name, $properties);
        $this->createModel->handle($entity_name, $properties);

        Artisan::call("make:factory {$entity_name}Factory");
    }
}
