<?php

namespace Way\Generators;

use Illuminate\Support\ServiceProvider;
use Way\Generators\Commands\ModelGeneratorCommand;
use Way\Generators\Generators\ModelGenerator;

class GeneratorsServiceProvider extends ServiceProvider
{
    protected $defer = false;

    public function boot()
    {

    }

    public function register()
    {
        $this->registerModelGeneratorCommand();
        $this->commands(ModelGeneratorCommand::class);
    }

    protected function registerModelGeneratorCommand()
    {
        $this->app->singleton(ModelGeneratorCommand::class, function ($app) {
            return new ModelGeneratorCommand(new ModelGenerator($app['files']));
        });
    }
}
