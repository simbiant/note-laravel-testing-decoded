# Test-Driving Artisan Commands Exercise

## Commands 101

### Scaffolding
* `php artisan make:command <name>`
* add this to `app/Console/Kernel.php` `protected $commands = []`.

### Arguments
```
protected function getArguments()
{
    return [
        ['name', InputArgument::REQUIRED, 'Name of the user'],
        ['password', InputArgument::REQUIRED, 'Password of the user'],
    ];
}

// Get argument
public function handle()
{
    $name = $this->argument('name');
    $password = $this->argument('password');
    // info(), error(), line()
    $this->info("The name that you want to add is {$name}.");
}
```

Options
```
protected function getOptions()
{
    return [
        [
            'Name of the option',
            'Optional alias --path becomes -p',
            'Option VALUE_OPTIONAL, VALUE_REQUIRED, VALUE_NONE, VALUE_IS_ARRAY',
            'Description for help dialog',
            'Optional default value'
        ]
        [
            'path',
            'p',
            InputOption::VALUE_OPTIONAL,
            'Path to models directory',
            'app/models'
        ]
    ];
}
```

### Single Responsibility Principle
A command class is responsible for running a command; it shouldn’t be concerned with manipulating the file system, or modifying a database record, or compiling templates.

## Exercise
* See `commands-tesing/packages/way/generators`
* Packages
* Command
* ServiceProvider
* Write `config/app.php` `'providers' => []`
* Testing Artisan Commands

### composer.json
```
"require": {"illuminate/console": "4.0.x" },
"require-dev": {"mockery/mockery": "dev-master" }
```

### Planning
* Before writing a test, it’s always a smart idea to determine what you expect to happen.
* It will forces you to think before you write.
