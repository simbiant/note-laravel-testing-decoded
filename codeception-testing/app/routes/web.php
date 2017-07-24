<?php

Route::get('admin', ['before' => 'auth', function ()
{
    return '<h1>Admin Area</h1>';
}]);

Route::get('login', function ()
{
    return view('sessions.create');
});

Route::resource('sessions', 'SessionsController');
