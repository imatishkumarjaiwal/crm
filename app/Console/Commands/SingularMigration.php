<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SingularMigration extends Command
{
    protected $signature = 'make:singular-migration {name} {--model} {--controller} {--view}';
    protected $description = 'Create a singular migration file, optionally with a model, controller, and view';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $this->createMigration($name);

        if ($this->option('model')) {
            $this->call('make:model', ['name' => $name]);
        }

        if ($this->option('controller')) {
            $this->call('make:controller', ['name' => $name . 'Controller']);
        }

        if ($this->option('view')) {
            $this->createView($name);
        }

        $this->info('Migration, model, controller, and view created successfully!');
    }

    protected function createMigration($name)
    {
        $tableName = Str::snake($name);
        $className = Str::studly($name);

        $stub = file_get_contents(base_path('stubs/migration.stub'));
        $stub = str_replace(['{{class}}', '{{table}}'], [$className, $tableName], $stub);

        $timestamp = date('Y_m_d_His');
        $path = base_path("database/migrations/{$timestamp}_create_{$tableName}_table.php");
        file_put_contents($path, $stub);
    }

    protected function createView($name)
    {
        $viewName = Str::snake($name);
        $viewPath = resource_path("views/{$viewName}.blade.php");
        
        $viewStub = file_get_contents(base_path('stubs/view.stub'));
        $viewStub = str_replace(['{{name}}'], [$name], $viewStub);

        file_put_contents($viewPath, $viewStub);
    }
}
