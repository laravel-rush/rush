<?php

declare(strict_types=1);

namespace LaravelRush\Rush\Actions;

use LaravelRush\Rush\Services\TwigService;
use Str;

final readonly class EditMigration
{
    public function __construct(
        private TwigService $service
    ) {}

    /**
     * @param  array<int, array{name: string, type: string}>  $properties
     */
    public function handle(string $entity_name, array $properties): void
    {
        $table_name = Str::snake(Str::plural($entity_name));

        $code = $this->service->updateMigration($table_name, $properties);

        $filename = date('Y_m_d_His').'_edit_'.$table_name.'_table.php';
        file_put_contents(database_path('migrations')."/{$filename}", $code);
    }
}
