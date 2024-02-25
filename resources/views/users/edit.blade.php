<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    {{-- <div class="card-header">Edit Profile</div> --}}
                    <div class="card-body">
                        <form action=" {{ route('users.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- ! change picture  --}}
                            <div class="d-flex mb-3 justify-content-between align-items-center border rounded-2 p-2">
                                <div class="text-center ">
                                    <img src="{{ isset($profileInfo->first()->avatar) ? asset('storage/' . $profileInfo->first()->avatar) : asset('storage/default-avatar.png')  }}"
                                        alt="Profile Picture" class="rounded-circle"
                                        style=" width: 75px; height: 75px;">
                                    <span class="ms-2 fs-5 fw-bold" >{{$user->username}}</span>
                                </div>

                                <div class=" d-md-flex justify-content-md-end">
                                    <label for="formFileMultiple"
                                        class="form-label btn btn-primary rounded-4 align-middle "
                                        style="cursor: pointer">Change photo</label>
                                    <input class="form-control" type="file" id="formFileMultiple"
                                        style="display: none" name="avatar">
                                </div>
                            </div>

                            {{-- ! gender select  --}}
                            <div class="  mb-3">
                                <div class="form-floating">
                                    <select class="form-select" id="floatingSelect" name="gender">
                                        <option value="male" >male</option>
                                        <option value="female" @if($profileInfo->first()->gender == "female") 
                                            selected @endif>female</option>
                                    </select>
                                    <label for="floatingSelect">Gender</label>
                                </div>
                            </div>

                            {{-- ! bio  --}}
                            <div class="mb-3">
                                <textarea class="form-control d-flex" id="bio" style="resize: none" rows="3" name ="bio"
                                    placeholder="Enter your bio">{{($profileInfo->first()->bio) }}</textarea>
                                {{-- <span class="text-muted">150</span> --}}
                            </div>

                            {{-- ! website  --}}
                            <div class="mb-3">
                                <input type="text" class="form-control" name="website" placeholder= "website"
                                    value="{{($profileInfo->first()->website) }}">
                            </div>

                            <input type="submit" class="btn btn-primary" name="submit">
                        </form>
                    </div>
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
