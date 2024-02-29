@extends('layouts.profile')
@section('title', 'posts')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/posts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">

@endsection
@section('content')
    {{-- ======================================================================================== --}}

    <div class="row align-items-center bg-danger">
        <div class="col-md-3 col-12">
            <div class="text-center">
                <img src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg"
                    alt="Profile Picture" class="rounded-circle" style=" width: 150px; height: 150px;">
            </div>
        </div>
        <div class="col-md-9  px-5 text-start col-12">
            <p class="fs-5 my-0 "> {{ $posts->first()->user->username }} </p>
            <p class="fs-5 my-0">{{ count($posts) }}</p>
            <p class="fs-5 my-0 ">posts</p>
            <button type="submit" class="btn btn-primary col-12 my-3">
                follow
            </button>
        </div>
    </div>

    <hr class="mt-3">
    @if (count($posts) == 3)
        <div>
            <div
                class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x6s0dn4 x1oa3qoh x1nhvcw1">
                <div class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xvkph5b x1dtbblo x7i73kt x14n70j1 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x6s0dn4 x1oa3qoh x1nhvcw1"
                    style="max-width: 350px;">
                    <div aria-label="empty-state-icon-button"
                        class="x1i10hfl x1qjc9v5 xjbqb8w xjqpnuy xa49m3k xqeqjp1 x2hbi6w x13fuv20 xu3j5b3 x1q0q8m5 x26u7qi x972fbf xcfux6l x1qhh985 xm0m39n x9f619 x1ypdohk xdl72j9 x2lah0s xe8uvvx xdj266r x11i5rnm xat24cr x1mh8g0r x2lwn1j xeuugli xexx8yu x4uap5 x18d9i69 xkhd6sd x1n2onr6 x16tdsg8 x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1o1ewxj x3x9cwd x1e5q0jg x13rtm0m x3nfvp2 x1q0g3np x87ps6o x1lku1pv x1a2a7pz"
                        role="button" tabindex="0">
                        <div class="_9zli"></div>
                    </div>
                    <div
                        class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh xqui205 x1hq5gj4 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1">
                        <span
                            class="x1lliihq x1plvlek xryxfnj x1n2onr6 x193iq5w xeuugli x1fj9vlw x13faqbe x1vvkbs x1s928wv xhkezso x1gmr53x x1cpjm7i x1fgarty x1943h6x x1i0vuye xggs18q xuv8nkb x5n08af x2b8uid xudqn12 xw06pyt x10wh9bi x1wdrske x8viiok x18hxmgj"
                            dir="auto"
                            style="line-height: var(--base-line-clamp-line-height); --base-line-clamp-line-height: 36px;">Share
                            Photos</span>
                    </div>
                    <div
                        class="x9f619 xjbqb8w x78zum5 x168nmei x13lgxp2 x5pf9jr xo71vjh x1hq5gj4 x1n2onr6 x1plvlek xryxfnj x1c4vz4f x2lah0s xdt5ytf xqjyukv x1qjc9v5 x1oa3qoh x1nhvcw1">
                        <span
                            class="x1lliihq x1plvlek xryxfnj x1n2onr6 x193iq5w xeuugli x1fj9vlw x13faqbe x1vvkbs x1s928wv xhkezso x1gmr53x x1cpjm7i x1fgarty x1943h6x x1i0vuye xvs91rp xo1l8bm x5n08af x2b8uid x1tu3fi x3x7a5m x10wh9bi x1wdrske x8viiok x18hxmgj"
                            dir="auto"
                            style="line-height: var(--base-line-clamp-line-height); --base-line-clamp-line-height: 18px;">When
                            you share photos, they will appear on your profile.</span>
                    </div>
                    <div class="x1i10hfl xjqpnuy xa49m3k xqeqjp1 x2hbi6w xdl72j9 x2lah0s xe8uvvx xdj266r x11i5rnm xat24cr x1mh8g0r x2lwn1j xeuugli x1hl2dhg xggy1nq x1ja2u2z x1t137rt x1q0g3np x1lku1pv x1a2a7pz x6s0dn4 xjyslct x1ejq31n xd10rxx x1sy0etr x17r0tee x9f619 x1ypdohk x1f6kntn xwhw2v2 xl56j7k x17ydfre x2b8uid xlyipyv x87ps6o x14atkfc xcdnw81 x1i0vuye xjbqb8w xm3z3ea x1x8b98j x131883w x16mih1h x972fbf xcfux6l x1qhh985 xm0m39n xt7dq6l xexx8yu x4uap5 x18d9i69 xkhd6sd x1n2onr6 x1n5bzlp x173jzuc x1yc6y37 x3nfvp2"
                        role="button" tabindex="0">Share your first photo</div>
                </div>
            </div>
        </div>
    @else
        <div class="row row-cols-xl-4 align-items-center row-cols-md-2">
            @foreach ($posts as $post)
                <div class="col mb-4"> <!-- Add mb-* class here -->
                    <div class="card border-0 position-relative post-disc">
                        <img src="{{ Storage::url($post->media->first()->media) }}" class="w-100" alt="">
                        <div class="position-absolute d-flex align-items-center justify-content-center">
                            <svg aria-label="Like" class="x1lliihq x1n2onr6 xyb1xck" fill="#fff" height="24"
                                role="img" viewBox="0 0 24 24" width="24">
                            </svg>
                            <svg aria-label="Comment" class="x1lliihq x1n2onr6 x5n08af" fill="#fff" height="24"
                                role="img" viewBox="0 0 24 24" width="24">
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif
@endsection
