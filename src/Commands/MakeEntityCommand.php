<?php

namespace LaravelRush\Rush\Commands;

use Illuminate\Console\Command;

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
        /**
         * @var string $name
         */
        $name = $this->argument('name');

        $this->info("make entity {$name}");

        return 0;
    }
}
