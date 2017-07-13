# Test All The Things

## You Already Test
* This allows for a continuous testing cycle, where one of your test suites is triggered repeatedly as you develop your applications.
* When developers first discover the wonders of test-driven development, it’s like gaining entrance to a new and better world with less stress and insecurity.

## 6 Wins From TDD
### Security
Imagine making an edit, clicking save, and immediately receiving feedbakc on whether you screwed up.

### Contribution
I only need to follow a handful of steps:

* Clone the repository.
* Write a test that describes the bug.
* Make the necessary changes to fix it.
* Run the tests to ensure that everything returns green.
* Commit the changes, and submit my pull request.
* Tools [Gate](https://travis-ci.org/)

### Big-Boy Pants
* An interesting transition takes place, when you force yourself to think before coding: it actually improves the quality of the code.
* Write it as such, watch it fail, and then make it work.It's a beautiful thing!

### Testability Improves Architecture
* Tests encourage structure by making you design before coding.
* No longer will you get away with, out of laziness, making a method perform too many actions.

### Documentation
* A huge bonus to writing tests is that they provide free documentation for the system.
* You'll have a full understanding in no time!

### It's Fun
* Let's face it: we're geeks.
* And what geek doesn’t enjoy a good game？

## 6 Signs of Untestable Code
### New Operators
Testing in isolation requires that the class, itself, does not instaniate other objects.

##### Anti-pattern:
```
public function fetch($url)
{
    $file = new Filesystem;
    return $this->data = $file->get($url);
}
```

##### Better:

```
protected $file;
public function __construct(Filesystem $file)
{
    $this->file = $file;
}

pubilc function fetch($url)
{
    return $this->data = $this->file->get($url);
}
```

##### Test:
```
public function testFetchesData()
{
    $file = Mockery::mock('Filesystem');
    $file->shouldReceive('get')->once()->andReturn('foo');
    $someClass = new SomeClass($file);
    $data = $someClass->fetch('http://example.com');
    $this->assertEquals('foo', $data);
}
```

##### Tips:
Hunt down the new keyword in your classes like a hawk. They’re code smells in PHP (at least for 90% of the cases)!

### Control-Freak Constructors

##### Anti-pattern:
```
public function __construct(Filesystem $file, Cache $cache)
{
    $this->file = $file;
    $this->cache = $cache;
    $data = $this->file->get('http://example.com');
    $this->write($data);
}
```

##### Better:
```
public function __construct(Filesystem $file, Cache $cache)
{
    $this->file = $file;
    $this->cache = $cache;
}
```

The reason why we do this is because, when testing, you'll reepeatedly follow the same process:

* Arrange
* Action
* Assert

If a class' constructor is littered with its own actions and method calls, each test you write must account for these actions.

##### Tips:
Keep it simple: limit your constructors to dependency assignments.

### And, And, And
Calculating what responsibility a class should have can be a difficult thing at first. Sure, we hear and understand `The Single Responsiibility Principle`, but putting that knowledge into practice can be tough at first.

### Ways to Spot a Class With Too Many Responsibilities
* The simplest way to determine if you class is doing too much is to speak aloud what the class does.
* Train yourself to immediately analyze the number of lines in each method. A method should be limited to juest a few.
* If you're having trouble choosing a name for a class, this, too, just might be a sign that you've gone off track, and need to restructure.

##### Tips:
Tip: Reduce each class to being responsible for one thing. This is referred to as The Single Responsibility Principle.

### Too Many Paths? Polymorphism to the Rescue!
The easiest possible way to determine if a class could benefit from polymorphism is to hunt down switch statements (or too many repeated conditionals).

##### Bad:
```
function addYearlyInterest($balance)
{
    switch ($this->accountType) {
        case 'checking':
            $rate = $this->getCheckingInterestRate();
            break;
        case 'savings':
            $rate = $this->getSavingsInterestRate();
            break;
        // other types of accounts here
    }
    return $blance + ($balance * $rate);
}
```

##### Better:
```
interface BankInterestInterface {
    public function getRate();
}

class CheckingInterest implements BankInterestInterface {
    public function getRate()
    {
        return .01;
    }
}

class SavingsInterest implements BankInterestInterface {
    public function getRate()
    {
        return .03;
    }
}

function addYearlyInterest($balance, BankInterestInterface $interest)
{
    $rate = $interest->getRate();
    return $balance + ($balance * $rate);
}

$bank = new BankAccount;
$bank->addYearlyInterest(100, new CheckingInterest);
$bank->addYearlyInterest(100, new SavingsInterest);
```

##### Test:
```
public function testAddYearlyInterest()
{
    $interest = Mockery::mock('BankInterestInterface');
    $interest->shouldReceive('getRate')->once()->andReture(.03);
    $bank = new BankAccount;
    $newBalance = $bank->addYearlyInterest(100, $interest);
    $this->assertEquals(103, $newBalance);
}
```

##### Tips:
Polymorphism allows yo to split complex classes into small chunks, often referred to as sub-classes.Remember: the smaller the class, the easier it is to test.

### Too Many Dependencies
In the `Control Freak Constructor` tip, I noted that dependencies should be injected the class' constructor. `I usually re-evaluate any classes with more than four dependencies. [Taylor Otwell]`. If one of your classes lists too many dependencies, consider refactoring.

### Too Many Bug
Coupling refers to the degree in which tow components in your system are dependent upon one another. If removing one affects the other, then you've unfortunately written tightly coupled code that isn't easy to change.
When presented with such bugs, begin asking yourself how you can split the logic up into smaller (easier to test) classes.In addition to improved testability, one perk to this pattern is that it allows for significantly more readable production code.


## Test Jargon

### Unit Testing
Going over your classes and methods with a fine-tooth comb, ensuring that each piece of code works exactly like you expect. 80% of your tests will be in this style.

### Model Testing
Unit tests should be isolated from all external dependencies. Once you ignore this basic rule, you're no longer unit testing. You're writing integration tests.

### Integration Testing
If a unit test verifies that code works correctly in isolation, then an integration test will fall on the other end of the spectrum. These tests won't rely on mocks or stubs. As such, be sure to create a special test database.

### Functional (Controller) Testing
Think of functional testing as a way for you and your team to ensure that the code does what you expect. Functional tests typically won't require a server to be running.

### Acceptance Testing
Your software can pass all unit, functional, and integration tests, but still fail the acceptance tests, if the client or customer realizes that the feature doesn’t work as they expected.

## Are Tests Too Expensive?
No client is willing to double your budget for the sole purpose of providing you with more security. Test-driven development cycle reduces the length of time it takes to complete a project.
