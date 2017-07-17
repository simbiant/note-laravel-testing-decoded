<?php

use App\Addition;

class AddtionTest extends PHPUnit_Framework_TestCase
{
    public function testFindsTheSumOfNumbers()
    {
        $addition = new Addition;
        $sum = $addition->run(5, 0);

        $this->assertEquals(5, $sum);
    }
}
