<?php

class PracticeTest extends PHPUnit_Framework_TestCase
{
    public function testHelloWorld()
    {
        $greeting = 'Hello, World.';
        $this->assertTrue($greeting === 'Hello, World.');
    }

    public function testTwoPlusTwo()
    {
        $result = 2 + 2;
        $this->assertEquals(4, $result);
    }

    public function testAssertSame()
    {
        $actual = 0;
        $this->assertSame(0, $actual);
    }

    public function testLaravelDevsIncludesDayle()
    {
        $names = ['Taylor', 'Shawn', 'Dayle'];
        $this->assertContains('Dayle', $names);
    }

    public function testFamilyRequiresParent()
    {
        $family = [
            'parents'  => 'Joe',
            'children' => ['Timmy', 'Suzy']
        ];

        $this->assertArrayHasKey('parents', $family);
    }

    public function testFamilyRequireArray()
    {
        $family = [
            'parents'  => 'Joe',
            'children' => ['Timmy', 'Suzy']
        ];

        $this->assertInternalType('array', $family['children']);
    }

    public function testAgeRequireInteger()
    {
        $age = 25;
        $this->assertInternalType('integer', $age);
    }

    public function testStampMustBeInstanceOfDateTime()
    {
        $data = new PracticeTest();
        $this->assertInstanceOf(PHPUnit_Framework_TestCase::class, $data);
    }

    /**
     * @expectedException Exception
     * @expectedExceptionCode 520
     */
    public function testExceptionHasErrorcode520()
    {
        throw new Exception('I love you', 520);
    }
}
