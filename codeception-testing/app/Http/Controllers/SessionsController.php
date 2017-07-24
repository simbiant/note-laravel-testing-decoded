<?php

use Illuminate\Routing\Controller;

class SessionsController extends Controller
{
    public function store()
    {
        $creds = [
            'email'    => Input::get('email'),
            'password' => Input::get('password')
        ];

        if(Auth::attempt($creds)) return Redirect::to('admin');
        return Redirect::to('login')
            ->withInput()
            ->with('message', 'Invalid Credentials');
    }
}
