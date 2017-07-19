# Test Databases
There are those who will tell you that under no circumstances should your unit test thouch the database. If a database call is necessary for your unit tests, then perhaps you should firsh consider redesigning.

## Test Databases
* You certainly don't want to be using the production database.

## Config For Laravel
Laravel Set `config/database.php`:
```
'testing' => [
    'driver' => 'sqlite',
    'database' => ':memory:',
 ],
```

Laravel Set `phpunit.xml`:
```
<php>
    <env name="DB_CONNECTION" value="testing"/>
    <env name="APP_ENV" value="testing"/>
    <env name="CACHE_DRIVER" value="array"/>
    <env name="SESSION_DRIVER" value="array"/>
    <env name="QUEUE_DRIVER" value="sync"/>
</php>
```

Laravel Create `tests\TestCase.php`:
```
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
```
