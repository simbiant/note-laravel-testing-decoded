# Easier Testing with Mockery

## Mocking Decoded
* A mock object is nothing more than a bit of test jargon that refers to simulating the behavior of real objects.
* Mocking refers to the process of defining expectations and ensuring desired behavior.
* Stubs is simply a dummy set of data.

## Dependency Injection
* Injecting a class’s dependencies through its constructor method, rather than hard-coding them.
* This beneficial to test, we can easy to replace thet instance with the mocked.
* `How might I test this?`
* Can use setter instead construct.
* Can use manually instantiating.

```
// Manually Instantiating
class Generator
{
    public function __construct(File $file = null)
    {
        $this->file = $file ?: new File;
    }
}
// Use
new Generator;
new Generator(new File);
new Generator($mockedFile);
```

## Some Problem
Though the tests pass, they're incorrectly touching the filesystem. we can user `Mockery` solution the problem.
* A class may be mocked using the readable Mockery::mock() method.
* Use the shouldReceive(METHOD) and with(ARG) methods.


## Use Mockery
### Simple Mock Objects
```
public function testSimpleMocks()
{
    $user = Mockery::mock(['getFullName' => 'jeffrey Way']);
    $user->getFullName(); // Jeffrey Way
}
```

### Return Value From Mocked Methods
* See `easier-tesing-with-mockery/tests/GeneratorTest@testDoesNotOverwriteFile`

### Expectations
To assert that you require the method to be called once, or potentially more times, a handful of options are available:

```
$mock->shouldReceive('method')->once();
$mock->shouldReceive('method')->times(1);
$mock->shouldReceive('method')->atLeast()->times(1);
```

The necessary arguments:
```
$mock->shouldReceive('get')->withAnyArgs()->once(); // the default
$mock->shouldReceive('get')->with('foo.txt')->once();
$mock->shouldReceive('put')->with('foo.txt', 'foo bar')->once();
```

Arguments type:
```
$mock->shouldReceive('get')->with(Mockery::type('string'))->once();
```

Regular expression：
```
$mockedFile->shouldReceive('put')->with('/\.txt$/', Mockery::any())->once();
```

Acceptable value:
```
mockedFile->shouldReceive('get')->with(Mockery::anyOf('log.txt', 'cache.txt'))->once();
```

Return:
```
$mock->shouldReceive('method')->once()->andReturn(false);
```

Error:
```
ockery\Exception\NoMatchingExpectationException: No matching handler found...
```

### Partial Mocks
You only need to mock a single method, rather than the entire object.

```
public function testPartialMockExample()
{
    $mock = Mockery::mock('MyClass[getOption, fire]');
    $mock->shouldReceive('getOption')->once()->andReturn(1000);
    // more code ...
}

// Other Method
public function testPartialMockExampleTwo()
{
    $mock = Mockery::mock('MyClass')->makePartial();
    $mock->shouldReceive('getOption')->once()->andReturn(1000);
    $mock->fire();
}
```

## Hamcrest
It is a tool and once installed, you may use a more human-readable notation to define your tests.
