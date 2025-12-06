<?php

namespace LaravelRush\Rush\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MakeEntityCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'make:entity {name}';

    /**
     * @var string
     */
    protected $description = 'Create entity';

    /**
     * @return array{type: mixed[][]}
     */
    public function handle(): array
    {
        $entity_name = $this->argument('name');
        $properties = [];

        while (true) {
            $property_name = $this->ask('New property name (press <return> to stop adding fields)');

            if ($property_name === null) {
                break;
            }

            $property_type = $this->ask('Field type (enter ? to see all types)', 'string');

            $properties[] = [$property_name => ['type' => $property_type]];
        }

        Artisan::call("make:model {$entity_name}");

        return $properties;
    }
}
