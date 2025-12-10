<?php

declare(strict_types=1);

namespace LaravelRush\Rush\Services;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final readonly class TwigService
{
    private FilesystemLoader $loader;

    private Environment $twig;

    public function __construct()
    {
        $this->loader = new FilesystemLoader(
            __DIR__.'/../templates'
        );
        $this->twig = new Environment($this->loader, [
            'debug' => false,
            'autoescape' => false,
        ]);
    }

    /**
     * @param  array<int, array{name: string, type: string}>  $properties
     */
    public function renderMigration(string $table_name, array $properties): string
    {
        return $this->twig->render('/migration/migration.twig', [
            'table_name' => $table_name,
            'properties' => $properties,
        ]);
    }
}
