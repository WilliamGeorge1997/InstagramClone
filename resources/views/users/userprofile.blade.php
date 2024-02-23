<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Custom CSS can be added here */
    </style>
</head>

<body>
    {{-- @extends('layouts.main')
    @section('content') --}}
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2">
                <p class="text-center fs-1">sidebar</p>
            </div>
            <div class="col-md-10">
                <div class="row align-items-center">
                    <div class="col-md-3">
                        <!-- Profile Picture -->
                        <div class="text-center">
                            <img src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg "
                                alt="Profile Picture" class="rounded-circle" style=" width: 150px; height: 150px;">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <!-- Username -->
                        <section class="d-flex flex-column mb-3">
                            <div class="row align-items-center">
                                <span class="fs-4 col-4">{{ $user->username }}</span>
                                <!-- Edit Profile Button -->
                                <a href=" {{ route('users.edit', $user->id) }}" class="btn btn-primary col-2">Edit
                                    Profile</a>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <!-- Posts -->
                                    <p>50 <strong>Posts</strong> </p>
                                </div>
                                <!-- Followers, Following, Posts -->
                                <div class="col">
                                    <!-- Followers -->
                                    <p> 1000 <strong>Followers</strong> </p>
                                </div>
                                <div class="col">
                                    <!-- Following -->
                                    <p>500 <strong>Following</strong> </p>
                                </div>
                            </div>
                        </section>
                        <!-- Bio -->
                        <p class="m-0">{{ $profileInfo->first()->bio }}</p>
                        <p class="m-0">{{ $profileInfo->first()->website }}</p>
                    </div>
                    <hr class="mt-3">
                </div>
            </div>
        </div>
    </div>
    {{-- @endsection --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
