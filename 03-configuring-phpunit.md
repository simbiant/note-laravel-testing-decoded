# Configuring PHPUnit

## Options
* Technicolor: `phpunit --colors`
* Bootstrapping: `phpunit --bootstrap='vendor/autoload.php'`
* Output Formats: `tap`, `testdox`

## XML Configuration File
Instead, leverage PHPUnit's ability to read a configuration file. Within the root of your project, create `phpunit.xml` file. Example: [Gate](./lesson/phpunit.xml).

## Continuous Testings
* Watching Files
* Triggering Multiple Files
