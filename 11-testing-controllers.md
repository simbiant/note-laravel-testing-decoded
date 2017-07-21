# Testing Controllers
* Should a controller test verify text on the page?
* Should it touch the database?
* Should it ensure that variables exist in the view?
* etc?

## What Does a Controller Do?
There are two core areas of focus:
* Direct traffic, by serving as the application's HTTP interface.
* Controllers should tell, rather than ask.(Fat Model => Skinny Controller).

## 3 Steps to Testing Controllers
The process of testing a controller (or any class, really) can be divided into three pieces.
* Isolate(Arrange): Mock all dependencies.
* Call(Act): Trigger the desired controller method.
* Ensure(Assert): Perform assertions, verifying that the stage has benn set properly.

## Laravel's Helper Assertions
* assertViewHas
* assertResponseOk
* assertRedirectedTo
* assertRedirectedToRoute
* assertRedirectedToAction
* assertSessionHas
* assertSessionHasErrors

## Mocking the Database
* See `09-test-database.md`

## Required Refactoring
* Move the class to `__construct()`.
* Use `$app->instance` and `mockery`

## The IoC Container
Laravel’s IoC container drastically eases the process of injecting dependencies into your classes.

```
$this->app->instance('Post', $this->mock);
```

## Redirections
```
$this->assertRedirectedToRoute('posts.index');
```

## Paths
There should be two separate paths through the `store` method, dependent upon whether the validation passes:
* Redirect back to `Create Post` form, and display the form validation errors.
* Redirect to the collection, or the named route `posts.index`.
* Use `assertRedirectedToRoute` and `assertSessionHasErrors`.

## Repositories
Repositories represent the data access layer of your application.

## BaseModel
* See `controllers-tesing\app\Models\BaseModel.php`

## Ensure View Contains Text
Because Laravel offers Symfony’s `DomCrawler` component out of the box, if needed, you also have the ability to inspect the DOM when calling routes.

