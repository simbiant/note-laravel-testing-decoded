# Testing Models

## What to Test
* Validations
* Scopes
* Accessors and Mutators
* Associations/Relationships
* Custom Methods

## Accessors and Mutators
In Laravel, to transform a model's attributes when getting or setting, we use the following syntax. Use Facade::shouldReceive().

```
public function getAgeAttribute($age) {};
public function setAgeAttribute($age) {};
```

## Custom Methods
##### Code:
```
class Article extends Eloquent
{
    public function meta()
    {
        return sprintf(
            '"%s" was written by %s.',
            $this->title,
            $this->author
        );
    }
}
```

##### Test:
```
class AricleTest extends TestCase
{
    public function testGetsReadableMetaData()
    {
        $article = new Article;
        $article->title = 'My First Article';
        $article->author = 'Perd Hapley';
        $this->assertEquals(
            '"My First Article" was written by Perd Hapley.',
            $article->meta()
        );
    }
}
```

## Simple Query Methods

The best choice (integration test) is to:
* Insert a couple of test records into the DB
* Call the method (without mocking)
* Verify that the correct record was returned

##### Code:

```
class User extends Eloquent
{
    public function getOldest()
    {
        return $this->orderBy('age', 'desc')->first();
    }
}
```

##### Test:
```
public function testGetsOldestUser()
{
    Factory::create('User', ['age' => 20]);
    Factory::create('User', ['age' => 30]);
    $oldest = (new User)->getOldest();
    $this->assertEquals(30, $oldest->age);
}
```

## Validations
* use `Validate` Facade
* See `model-testing-practice`

## Helper
* See `model-testing-practice/helpers/Helpers.php`

## Factories
* Laravel can create an object with all of the necessary fields, and insert it to the DB.
* We also need to have the option of overriding one or more fields’ default value.

## Laravel Test Helpers
* A Factory utility.
* Various Model test helpers (assertValid, assertBelongsTo, etc).
* Assert and Should PHPUnit wrappers.

### Factories
##### Models
```
$user = Factory::user(['default' => null]);
$user = Factory::make(Models\User::class, ['default' => null]);
$user = Factory::create(Models\User::class, ['default' => null]);
````

### Test Helpers
##### assertValid and assertNotValid
* See `model-testing-practice/helpers/ModelHelpers.php`

##### Asserting Relationships
* `assertBelongsTo()`
* `assertHasOne()`
* `assertHasMany()`
