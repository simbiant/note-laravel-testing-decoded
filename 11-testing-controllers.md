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
