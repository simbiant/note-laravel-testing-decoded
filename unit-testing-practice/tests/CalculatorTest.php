<?php
use App\Calculator;
use App\Addition;
use App\Multiplication;

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->calc = new Calculator;
    }

    public function testResultDefaultsToNull()
    {
        $this->assertNull($this->calc->getResult());
    }

    public function testAddsNumbers()
    {
        $mock = Mockery::mock(Addition::class);
        $mock->shouldReceive('run')->once()->with(5, 0)->andReturn(5);

        $this->calc->setOperands(5);
        $this->calc->setOperation($mock);
        $result = $this->calc->calculate();

        $this->assertEquals(5, $result);
    }

    public function testAcceptsMultipleAddsArgs()
    {
        $mock = Mockery::mock(Addition::class);
        $mock->shouldReceive('run')
            ->times(4)
            ->andReturn(1, 3, 6, 10);

        $this->calc->setOperands(1, 2, 3, 4);
        $this->calc->setOperation($mock);
        $result = $this->calc->calculate();

        $this->assertEquals(10, $result);
    }

    public function testMultipliesNumbers()
    {
        $mock = Mockery::mock(Multiplication::class);
        $mock->shouldReceive('run')
            ->times(3)
            ->andReturn(2, 6, 30);

        $this->calc->setOperands(2, 3, 5);
        $this->calc->setOperation($mock);
        $result = $this->calc->calculate();

        $this->assertEquals(30, $result);
    }
}
