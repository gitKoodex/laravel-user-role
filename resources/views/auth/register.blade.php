<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>register</title>
</head>
<body>
        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
            <div>
                <lable for="name">{{__("name")}}</lable>
                <input type="text" name="name" id="name" value="{{old('name')}}" required autofocus>
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <lable for="email">{{__("email")}}</lable>
                <input type="text" name="email" id="name" value="{{old("email")}}" required>
            </div>

            <!-- Password -->
            <div class="mt-4">
                <lable for="password">{{__("password")}}</lable>
                <input type="text" id="password" name="password" required autocomplete="new-password">
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <lable for="password_confirmation">{{__('Confirm Password')}}</lable>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
                <input type="submit" value="{{__("Register")}}">
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>

</body>
</html>
