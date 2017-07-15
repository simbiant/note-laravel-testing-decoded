# Making PHPUnit Less Verbose

## Importing Assertions as Functions
If you wish to remove the $this portion. you can include `vendor/phpunit/phpunit/PHPUnit/Framework/Assert/Functions.php`, get the assertions as simple function.

```
$name = 'Doug';
assertEquals('Doug', $name);
```

If you like Laravel elegantly, you can use `Laravel-Test-Helpers`, the library that bring the the Laravel fell to your testing:

```
Should::equal(4, 2 + 2);
Should::beTrue(true);
Assert::greaterThan(20, 21);
```

