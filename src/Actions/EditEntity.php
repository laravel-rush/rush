<?php

declare(strict_types=1);

namespace LaravelRush\Rush\Actions;

final readonly class EditEntity
{
    public function __construct(
        private EditMigration $editMigration
    ) {}

    /**
     * @param  array<int, array{name: string, type: string}>  $properties
     */
    public function handle(string $entity_name, array $properties): void
    {
        $this->editMigration->handle($entity_name, $properties);
    }
}
