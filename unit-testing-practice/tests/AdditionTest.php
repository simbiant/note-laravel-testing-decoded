<?php

use App\Addition;
use App\MyClass;

class AddtionTest extends PHPUnit_Framework_TestCase
{
    public function testFindsTheSumOfNumbers()
    {
        $addition = new Addition;
        $sum = $addition->run(5, 0);

        $this->assertEquals(5, $sum);
    }

    public function testPartialMockExample()
    {
        $mock = Mockery::mock('App\MyClass[getOption]');
        $mock->shouldReceive('getOption')->once()->andReturn(1000);
        $mock->fire();
    }

    public function testPartialMockExampleTwo()
    {
        $mock = Mockery::mock('MyClass')->makePartial();
        $mock->shouldReceive('getOption')->once()->andReturn(10000);
        $mock->fire();
    }
}
