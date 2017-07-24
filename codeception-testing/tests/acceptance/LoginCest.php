<?php

class LoginCest
{
    public function logsInUserWithProperCredentials(WebGuy $I)
    {
        $I->am('Site Owner');
        $I->wantTo('login to a password-protected area');
        $I->lookForwardTo('perform administrative tasks');

        $I->amOnPage('/admin');
        $I->seeCurrentUrlEquals('/login');

        $I->fillField('email', 'jeffrey@envato.com');
        $I->fillField('password', '1324');
        $I->click('Login');

        $I->seeCurrentUrlEquals('/admin');
        $I->see('Admin Area', 'h1');
    }

    public function loginWithInvalidCredentials(WebGuy $I)
    {
        $I->amOnPage('/login');
        $I->click('Login');
        $I->seeCurrentUrlEquals('/login');
        $I->see('Invalid Credentials', '.flash');
    }
}
