<?php
function array_until($stopPoint, $arr)
{
    $index = array_search($stopPoint, $arr);

    if(false === $index) {
        throw new InvalidArgumentException('Key does not exist in array');
    }

    return array_slice($arr, 0, $index);
}

class Unit101Test extends PHPUnit_Framework_TestCase
{
    public function testFetchesItemsInArrayUntilValue()
    {
        $names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];
        $result = array_until('Matthew', $names);
        $expected = ['Taylor', 'Dayle'];
        $this->assertEquals($expected, $result);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testThrowsExceptionIfValueDoesNotExist()
    {
        // Arrange
        $names = ['Taylor', 'Dayle', 'Matthew', 'Shawn', 'Neil'];
        // Act
        $result = array_until('Bob', $names);
        // Assert an exception should be throw
    }

    public function testGeneratesAnchorTag()
    {
        $actual = link_me_to('/dogs/1', 'Show Dog');
        $expect = "<a href='http://:/dogs/1'>Show Dog</a>";
        $this->assertEquals($expect, $actual);
    }
}
