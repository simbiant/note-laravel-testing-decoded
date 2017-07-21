# The IoC Container
An understanding of the IoC pattern is paramount to building flexible and testable applications in Laravel.

## Dependency Injection?
* Dependency injection is a pattern for inserting a class’ dependencies through its `constructor` or `setter`, rather than hardcoding them.
* Think of dependency injection as a way to allow your future self to inject mocks in place of those dependencies, for testing purposes.

### Constructor Injection
```
public function __construct(Validator $validator)
{
    $this->validator = $validator;
}
```

### Setter Injection
```
public fucntion setValidator(Validator $validator)
{
    $this->validator = $validator;
}
```

##### Bad
```
class MyCommand
{
    public function fire()
    {
        $generator = new ModelGenerator;
    }
}
```

##### Good
```
class MyCommand
{
    protected $generator;
    public function __construct(ModelGenerator $generator)
    {
        $this->generator = $generator;
    }
    public function fire()
    {
        return $this->generator->make() ? 'foo' : 'bar';
    }
}
```

##### Test
```
public function testFire()
{
    $gen = Mockery::mock('ModelGenerator');
    $gen->shouldReceive('make')->once()->andReturn(true);
    $command = new MyCommand($gen);
    $this->assertEquals('foo', $command->fire());
}
```

## Resolving
```
<?php
class UsersController extends BaseController
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }
}
```

### Solution 1:Defaults
```
// First
$this = new Thing;
// Seconde
$this = new Thing(new Dependency, new OtherDependency);

// Code
function __construct(User $user = null, Book $book = null)
{
    $this->user = $user;
    $this->book = $book;
}
```

### Solution 2:Resolving
```
// Code
public function index()
{
    $users = App::make('User')->all();
    return view('users.index', ['users' => $users]);
}

// Test
public function testIndex()
{
    App::instance('User', Mockery::mock(['all' => 'foo']));
    $this->call('GET', 'users');
}

// Test
class UsersControllerTest extends TestCase
{
    public function mock($class)
    {
        $this->mock = Mockery();
        App::instance($class, $this->mock);
    }
    public function testIndex()
    {
        $this->mock->shouldReceive('all')->once();
        $this->call('GET', 'users');
    }
}
```

##### App Bindings
```
// Bind
App::bind('foo', function () { return new IKnowKungFoo; });
App::bind('foo', 'IKnowKungFoo');
// Create
App::make('foo');
App::make('IKnowKungFoo');
```

##### Interfaces
```
class OrdersController
{
    public function __construct(OrderRepositoryInterface $order)
    {
        $this->order = $order;
    }
}

// Bind
App::bind('OrderRepositoryInterface', 'EloquentOrderRepositoryy');
```

##### Automatic Resolution
```
// Bad
App::bind('UsersController', function () {
    $repository = new Repositories\User;
    $validator  = new Services\Validators\User;
    return new UsersController($repository, $validator);
});

// Laravel will automatic resolution
public function __construct(UserRepository $user, Validator $validator){}
```
