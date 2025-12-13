<?php

declare(strict_types=1);

namespace LaravelRush\Rush\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use LaravelRush\Rush\Actions\CreateEntity;

final class MakeEntityCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:entity {name}';

    /**
     * @var string
     */
    protected $description = 'Create entity';

    public function handle(CreateEntity $action): int
    {
        /** @var string $entity_name */
        $entity_name = $this->argument('name');

        $model = app_path('Models/').$entity_name.'.php';

        if (! File::exists($model)) {
            $properties = $this->askUser();

            $action->handle($entity_name, $properties);

            return 0;
        }

        $this->error('file already exists');

        return 1;
    }

    /**
     * @return array<int, array{name: string, type: string}>
     */
    private function askUser(): array
    {
        $properties = [];

        /** @var string[] $types */
        $types = config()->array('_internal.types.titles');

        while (true) {
            /** @var ?string $property_name */
            $property_name = $this->ask('New property name (press <return> to stop adding fields)');

            if ($property_name === null) {
                break;
            }

            do {
                /** @var string $property_type */
                $property_type = $this->ask('Field type (enter ? to see all types)', 'string');

                if (! in_array($property_type, $types, true)) {
                    $this->error("[ERROR] Invalid type \"{$property_type}\". ");

                    $property_type = null;
                }

            } while (! $property_type);

            $properties[] = [
                'name' => $property_name,
                'type' => $property_type,
            ];
        }

        return $properties;
    }
}
