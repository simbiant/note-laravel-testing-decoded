# Introducing PHPUnit

## Colors
Where Are The Colors? In the next chapter, we’ll dig more deeply into PHPUnit’s configuration options. Until then, use the --colors option to request colored output: vendor/bin/phpunit --colors tests.

## Decoding A Test Class Structure
* File Nameing: Notice that we're following a FooTest.php convention. Convention over configuration.
* Matching: The name of the class is the same as the file name.
* Inheritance: The class extends `PHPUnit_Framework_TestCase`. When testing in Laravel, we typically extend Laravel’s `TestCase`.
* Method Naming: Every test should be contained within a method that has a descriptive name, and begins with the word, test.

## Test Logic
### assertTrue
```
$this->assertTrue(ACTUAL, OPTIONAL MESSAGE);
```

### assertFalse
```
$this->assertFalse(ACTUAL, OPTIONAL MESSAGE);
```

### assertEquals
```
$this->assertEquals(EXPECTED, ACTUAL, OPTIONAL MESSAGE);
```

### assertSame
`assertEquals` will break down as soon as you need to compare with strict equality.

```
$this->assertSame(EXPECTED, ACTUAL, OPTIONAL MESSAGE);
```

### assertContains
You have a list of names, and need to prove that the array contains a specific value.

```
$this->assertContains(NEEDLE, HAYSTACK, OPTIONAL MESSAGE);
```

### assertArrayHasKeys
```
$this->assertArrayHasKeys(NEEDLE, HAYSTACK, OPTIONAL MESSAGE);
```

### assertInternalType
```
$this->assertInternalType(EXPECTED, ACTUAL, MESSAGE);
```

### assertInstanceOf
```
$this->assertInstanceOf(EXPECTED, ACTUAL, MESSAGE);
```

### Asserting Exceptions
use doc-blocks to assert exceptions.
```
/**
 * @expectedException EXCEPTION_NAMES
 */
```
