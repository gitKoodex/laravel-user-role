{{-- this file as simple as it can be. you can change it with your login ui just keep name of input as same as it is else are changeable--}}
{{-- I remove all blade themplate and just keep simple blade in this file--}}
<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>login</title>
    <style>
        .mt-4{
            margin-top:1.25rem;
        }
    </style>
</head>
<body>
<form method="POST" action="{{ route('login') }}">
@csrf

<!-- Email Address -->
    <div  class="mt-4">
        <lable for="email">{{__('email')}}:</lable>
        <input type="email" id="email" class="form-control" name="email" value="" required autofocus>
    </div>

    <!-- Password -->
    <div class="mt-4">
        <lable for="password">{{__('password')}}</lable>
        <input type="password" name="password" id="password" class="form-control" required autocomplete="current-password">
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif
            <input type="submit" value="{{__('log in')}}">
    </div>
    <p>
        this is design for check user and role word properly.
    </p>
    <p>
        visitor:
    </p>
    <p>
        email : kodexadmin@example.com
    </p>
    <p>
        password : kodexMahallo@#15adM1n
    </p>
    <hr/>
    <p>
        admin:
    </p>
    <p>
        email : kodexadmin2@example.com
    </p>
    <p>
        password : kodexMahallo@#15adM1n
    </p>
</form>
</body>
</html>

