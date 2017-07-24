<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    @if (Session::has('message'))
        <div class="flash">
            {{ Session::get('message') }}
        </div>
    @endif

    {{ Form::open(['method' => 'post', 'route' => 'sessions.store']) }}
        <div>
            {{ Form::label('email', 'Email') }}
            {{ Form::text('email') }}
        </div>

        <div>
            {{ Form::label('password', 'Password') }}
            {{ Form::password('password') }}
        </div>

        <div>
            {{ Form::submit('Login') }}
        </div>
    {{ Form::close() }}
</body>
</html>
