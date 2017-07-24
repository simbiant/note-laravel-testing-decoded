# Acceptance Testing With Codeception

## Configuring
```
class_name: WebGuy
modules:
    enabled:
        - PhpBrowser
        - WebHelper
    config:
        PhpBrowser:
            url: 'http://localhost:8080'
```

## Generate a Test

### Manual Approach
```
<?php
$I = new WebGuy($scenario);
$I->wantTo('Check the home page for a welcome message');
$I->amOnPage('/');
$I->see('Welcome');
```
