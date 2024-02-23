<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link href="https://db.onlinewebfonts.com/c/6d32b8e06f40fb7698cfb714b9e7975d?family=Billabong+W00+Regular"
        rel="stylesheet">
</head>

</html>

<x-guest-layout>
    <h1 class="text-center fw-bold mb-2 fs-1" style="font-family: Billabong W00 Regular">Instagram</h1>

    <p class="text-center text-secondary"> Sign up to see photos and videos from your friends.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- fullName -->
        <div class="mt-4">
            {{-- <x-input-label for="fullname" :value="__('fullname')" /> --}}
            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name=" fullname" :value="old('fullname')"
                required autofocus autocomplete="fullname" placeholder="Fullname" />
            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
        </div>


        <!-- Name -->
        <div class="mt-4">
            {{-- <x-input-label for="username" :value="__('username')" /> --}}
            <x-text-input id="username" class="block mt-1 w-full" type="text" name=" username" :value="old('username')"
                required autofocus autocomplete="username" placeholder="Username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                required autocomplete="username" placeholder="Phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" placeholder="Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4 ">

            <x-primary-button class="">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-3 text-center">
            <a class=" underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>

<html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>
