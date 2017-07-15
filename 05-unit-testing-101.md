# Unit Testing 101

## Unit Testing

### Arrange, Act, Assert
Unit test three simple actions.
* Arrange(Given): Set the stage, instantiate objects, pass in mocks.
* Act(When): Execute the thing that you wish to test.
* Assert(Then): Compare your expected output to what was returned.

### Testing in Isolation
* A core fundamental to successful unit testing is to test in isolation.

### Tests Should Not Be Order-Dependent
* Your tests should never be dependent upon previous tests.

### Test-Driven Development
* Write a Failing Test.
* Make it Pass.
* Refactor.

### Behavior-Driven Development
If you write TDD well - by describing the behavior of your code - then chances are, you're following the rules of BDD.

### Slime
Slime is nothing more than a bit of jargon thant refers to returning a dummy value for the sole purpose of making a test pass.

### Generalize
Generalize as a way to specify when it's necessary to remove slime, in favor of real production code.

### Making the Test Pass (TDD)
* Write a test that defines how you want to interact with your code.
* Watch it fail.
* Write the necessary production code to make it pass.
* Refactor.

### Testing Classes
* Instantiate the class.
* Call the desired method.
* Write an assertion.
