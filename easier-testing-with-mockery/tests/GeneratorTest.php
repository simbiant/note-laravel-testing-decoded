<?php

class GeneratorTest extends PHPUnit_Framework_TestCase
{
    // Though the test pass, they're incorrectly touching the filesystem.
    // public function testItWorks()
    // {
    //     $file = new File;
    //     $generator = new Generator($file);
    //     $generator->file();
    // }
    //
    public function tearDown()
    {
        Mockery::close();
    }

    public function testItWorks()
    {
        $path = 'foo.txt';
        $mockedFile = Mockery::mock('File');
        $mockedFile->shouldReceive('put')
            ->with('foo.txt', 'foo bar')
            ->once();

        $generator = new Generator($mockedFile);
        $generator->fire($path);
    }

    public function testDoesNotOverwriteFile()
    {
        $path = 'foo.txt';
        $mockedFile = Mockery::mock(File::class);

        $mockedFile->shouldReceive('exists')->with($path)->once()->andReturn(true);
        $mockedFile->shouldReceive('put')->never();

        $generator = new Generator($mockedFile);
        $generator->fire($path);
    }
}
