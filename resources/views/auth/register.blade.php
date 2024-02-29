<x-guest-layout>
    {{-- !logo --}}
    <div aria-disabled="false" role="button" tabindex="0" style="cursor: pointer;" class=" mb-2 text-center">
        <i data-visualcompletion="css-img" aria-label="Instagram" class="" role="img"
            style="background-image: url(&quot;https://static.cdninstagram.com/rsrc.php/v3/ys/r/WBLlWbPOKZ9.png&quot;); background-position: 0px 0px; background-size: 176px 264px; width: 174px; height: 50px; background-repeat: no-repeat; display: inline-block;"></i>
    </div>

    <p class="text-center text-secondary p-0 m-0"> Sign up to see photos and videos from your friends.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- fullName -->
        <div class="mt-3">
            {{-- <x-input-label for="fullname" :value="__('fullname')" /> --}}
            <x-text-input id="fullname" class="block mt-1 w-full" type="text" name=" fullname" :value="old('fullname')"
                required autofocus autocomplete="fullname" placeholder="Fullname" />
            <x-input-error :messages="$errors->get('fullname')" class="mt-2" />
        </div>


        <!-- Name -->
        <div class="mt-3">
            {{-- <x-input-label for="username" :value="__('username')" /> --}}
            <x-text-input id="username" class="block mt-1 w-full" type="text" name=" username" :value="old('username')"
                required autofocus autocomplete="username" placeholder="Username" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-3">
            {{-- <x-input-label for="email" :value="__('Email')" /> --}}
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autocomplete="username" placeholder="Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="mt-3">
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                required autocomplete="username" placeholder="Phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-3">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" placeholder="Password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-3">
            {{-- <x-input-label for="password_confirmation" :value="__('Confirm Password')" /> --}}

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-3 ">

            <x-primary-button class="">
                {{ __('Register') }}
            </x-primary-button>
        </div>

        <div class="mt-3 text-center">
            <a class=" text-muted text-decoration-none" href="{{ route('login') }}">
                <span class="text-primary">Already registered?</span>
            </a>
        </div>
    </form>
</x-guest-layout>
