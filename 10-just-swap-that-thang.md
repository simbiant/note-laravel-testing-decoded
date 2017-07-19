# Just Swap That Thang

## Mockery
* Every Laravel facade extends a parent Facade class that offers, among other things, a shouldReceive method.
* When called, Laravel will automatically swap out the registered instance with a mock.
* See `vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php`

## Testing
When unit testing, we can mock the File class:
```
public function testCreateFile()
{
    File::shouldReceive('put')->once();
    $this->call('GET', 'foo');
}
```

## Mocking Events
```
public function destroy($id)
{
    $user = $this->user->findOrFail($id);
    $user->delete();
    Event::fire('cancellation', ['user' => $user]);
    return Redirect::home();
}

public function testDestroyUser()
{
    Event::shouldReceive('fire')
        ->once()
        ->with(['cancellation', Mockery::any()]);
    $this->call('DELETE', '/users/1');
}
```
