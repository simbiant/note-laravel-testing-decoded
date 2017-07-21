<?php
namespace Way\Generators\Tests\Commands;

use Way\Generators\Commands\ModelGeneratorCommand;
use Symfony\Component\Console\Tester\CommandTester;

class ModelGeneratorCommandTest extends PHPUnit_Framework_TestCase
{
    public function testOutput()
    {
        $tester = new CommandTester(new ModelGeneratorCommand);
        $tester->execute(['name' => 'foo']);
        $this->assertEquals("The name argument is foo\n", $tester->getDisplay());
    }

    public function testGeneratesModelSuccessfully()
    {
        $gen = Mockery::mock(ModelGenerator::class);
        $gen->shouldReceive('make')
            ->once()
            ->with('app/models/Foo.php')
            ->andReturn(true);

        $command = new ModelGeneratorCommand($gen);
        $tester = new CommandTester($command);
        $tester->execute(['name' => 'foo']);

        $this->assertEquals('Created app/models/Foo.php\n', $tester->getDisplay());
    }

    public function testAlertsUserIfModelGenerationFails()
    {
        $gen = Mockery::mock(ModelGenerator::class);
        $gen->shouldReceive('make')
            ->once()
            ->with('app/models/Foo.php')
            ->andReturn(false);

        $command = new ModelGeneratorCommand($gen);
        $tester  = new CommandTester($command);
        $tester->execute(['name' => 'foo']);

        $this->assertEquals('Could not create app/models/Foo.php\n', $tester->getDisplay());
    }

    public function testCanAcceptCustomPathToModelsDirectory()
    {
        $gen = Mockery::mock(ModelGenerator::class);
        $gen->shouldReceive('make')
            ->once()
            ->with('app/foo/models/Foo.php');

        $command = new ModelGeneratorCommand($gen);
        $tester = new CommandTester($command);
        $tester->execute(['name' => 'foo', '--path' => 'app/foo/models']);
    }
}
