<?php

declare(strict_types=1);

namespace LaravelRush\Rush\Actions;

use Illuminate\Support\Str;
use LaravelRush\Rush\Services\TwigService;

final readonly class CreateMigration
{
    public function __construct(
        private TwigService $service
    ) {}

    /**
     * @param  array{name: string, type: string}  $properties
     */
    public function handle(string $entity_name, array $properties): void
    {
        $table_name = Str::snake(Str::plural($entity_name));

        $code = $this->service->renderMigration($table_name, $properties);

        $filename = date('Y_m_d_His').'_create_'.$table_name.'_table.php';
        file_put_contents(database_path('migrations')."/{$filename}", $code);
    }
}
