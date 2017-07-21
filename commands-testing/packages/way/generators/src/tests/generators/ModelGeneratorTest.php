<?php

use Illuminate\Filesystem\Filesystem;
use Mockery as M;
use Way\Generators\Generators\ModelGenerator;

class ModelGeneratorTest extends PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        M::close();
    }

    public function testCanGeneratorModelUsingTemplate()
    {

        $path = 'app/models/Foo.php';
        $content = file_get_contents(__DIR__.'/stubs/model.txt')

        $file = M::mock(Filesystem::class);
        $file->shouldReceive('put')->once()->with($path, $content);

        $gen = new ModelGenerator($file);
        $gen->make($path);
    }
}
