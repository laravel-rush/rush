<?php

namespace LaravelRush\Rush\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

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

    public function handle(): int
    {
        // TODO if name === ask
        /** @var string $entity_name */
        $entity_name = $this->argument('name');
        $properties = [];

        while (true) {
            $property_name = $this->ask('New property name (press <return> to stop adding fields)');

            if ($property_name === null) {
                break;
            }
            // TODO проверка на существование типа данных

            $property_type = $this->ask('Field type (enter ? to see all types)', 'string');

            $properties[] = [
                'name' => $property_name,
                'type' => $property_type,
            ];
        }

        // Artisan::call("make:model {$entity_name}");

        // Изменить debug на false
        $loader = new FilesystemLoader(
            __DIR__.'/../templates/migration'
        );
        $twig = new Environment($loader, [
            'debug' => true,
            'cache' => 'cache/twig',
            'autoescape' => false,
        ]);

        $table_name = Str::snake(Str::plural($entity_name));

        $code = $twig->render('migration.twig', [
            'table_name' => $table_name,
            'properties' => $properties,
        ]);

        $filename = date('Y_m_d_His').'_create_'.$table_name.'_table.php';
        file_put_contents(database_path('migrations')."/{$filename}", $code);

        return 0;
    }
}
