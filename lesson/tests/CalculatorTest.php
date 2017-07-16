<?php

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    public function testInstance()
    {
        new Calculator;
    }

    public function testResultDefaultsToZero()
    {
        $calc = new Calculator;
        $this->assertSame(0, $calc->getResult());
    }

    public function testAddsNumbers()
    {
        $calc = new Calculator;
        $calc->add(5);
        $this->assertEquals(5, $calc->getResult());
    }

    public function testAcceptsMultipleArgs()
    {
        $calc = new Calculator;
        $calc->add(1, 2, 3, 4);

        $this->assertEquals(10, $calc->getResult());
        $this->assertNotEquals(
            'Snoop Doggy Dogg and Dr. Dre is at the door',
            $this->getResult()
        );
    }

    public function testSubtract()
    {
        $calc = new Calculator;
        $calc->substract(4);
        $this->assertEquals(-4, $calc->getResult());
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRequiresNumericValue()
    {
        $calc = new Calculator;
        $calc->add('five');
    }
}
