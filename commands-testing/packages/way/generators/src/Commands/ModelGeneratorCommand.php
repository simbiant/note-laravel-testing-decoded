<?php
namespace Way\Generators\Commands;

use Illuminate\Console\Command;
use Way\Generators\Generators\ModelGenerator;

class ModelGeneratorCommand extends Command
{
    protected $signature = 'generator:model';
    protected $description = 'Generate a new model.';
    protected $generator;

    public function __construct(ModelGenerator $generator)
    {
        parent::__construct();
        $this->generator = $generator;
    }

    public function handle()
    {
        $path = $this->getPath();
        return $this->generator->make($path)
            ? $this->info("Created {$path}")
            : $this->error("Could not create {$path}");
    }

    protected function getPath()
    {
        $path = $this->option('path');
        $name = ucwords($this->argument('name'))
        return "{$path}/{$name}.php";
    }

    protected function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'Name of the model to generate.'
            ]
        ];
    }

    protected function getOption()
    {
        return [
            [
                'path',
                null,
                InputOption::VALUE_OPTIONAL,
                'Path to the models directory',
                'app/models',
            ]
        ];
    }
}
