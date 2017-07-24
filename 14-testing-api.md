# Testing API

## Three Components to Writing an API in Laravel
* Authentication
* Route Prefixing
* Return JSON

## Cofing
##### Database
```
'tesing' => ['driver'   => 'sqlite', 'database' => ':memory:', 'prefix'   => '' ]
```

##### Enable Filters
```
public function setUp() { Route::enableFilters(); }
```


