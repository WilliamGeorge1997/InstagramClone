    @extends('layouts.profile')
    @section('title', 'Edit Profile')
    @section('content')
    
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card w-100">
                    {{-- <div class="card-header">Edit Profile</div> --}}
                    <div class="card-body ">
                        <form action=" {{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            {{-- ! change picture  --}}
                            <div class="d-flex mb-3 justify-content-between align-items-center border rounded-2 p-2">
                                <div class="text-center ">
                                    <img src=" {{ $profileInfo->first()->avatar ? Storage::url($profileInfo->first()->avatar) : 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_640.png'  }}"
                                        alt="Profile Picture" class="rounded-circle"
                                        style=" width: 75px; height: 75px;">
                                    <span class="ms-2 fs-5 fw-bold" >{{$user->username}}</span>
                                </div>

                                <div class=" d-md-flex justify-content-md-end">
                                    <label for="formFileMultiple" class="form-label btn btn-primary rounded-4 align-middle "
                                        style="cursor: pointer">Change photo</label>
                                    <input class="form-control" type="file" id="formFileMultiple" style="display: none"
                                        name="avatar">
                                </div>
                            </div>

                            {{-- ! username  --}}
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="username" value="{{ $user->username }}">
                                <label for="floatingSelect">User name</label>
                            </div>

                            {{-- ! email  --}}
                            <div class=" form-floating mb-2">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">
                                <label for="floatingSelect">Email</label>
                            </div>

                            {{-- ! phone  --}}
                            <div class="form-floating mb-2">
                                <input type="text" class="form-control" name="phone" value="{{ $user->phone }}">
                                <label for="floatingSelect">Phone</label>
                            </div>

                            {{-- ! password  --}}
                            <div class=" form-floating mb-2">
                                <input type="password" class="form-control" name="password">
                                <label for="floatingSelect">Password</label>
                                @if ($errors->has('password'))
                                <div class="alert alert-danger mt-2" role="alert">
                                    @foreach ($errors->get('password') as $error)
                                        {{ $error }}
                                    @endforeach
                                </div>
                            @endif
                                                        </div>

                            {{-- ! gender select  --}}
                            <div class="  mb-2">
                                <div class="form-floating">
                                    <select class="form-select" name="gender">
                                        <option value="">Select your gender</option>
                                        <option value="male" @if ($profileInfo->first()->gender == 'male') selected @endif>male
                                        </option>
                                        <option value="female" @if ($profileInfo->first()->gender == 'female') selected @endif>female
                                        </option>
                                    </select>
                                    <label for="floatingSelect">Gender</label>
                                </div>
                            </div>

                            {{-- ! bio  --}}
                            <div class=" form-floating mb-2">
                                <textarea class="form-control d-flex" id="bio" style="resize: none" rows="3" name ="bio"
                                    placeholder="Enter your bio">{{ $profileInfo->first()->bio }}</textarea>
                                <label for="floatingSelect"> Enter your bio</label>
                            </div>

                            {{-- ! website  --}}
                            <div class=" form-floating mb-2">
                                <input type="text" class="form-control" name="website" placeholder="Website"
                                    value="{{ $profileInfo->first()->website }}">
                                <label for="floatingSelect">Enter your Website</label>
                            </div>
                            <input type="submit" class="btn btn-primary" name="submit">
                        </form>
                    </div>
                </div>
            </div>
        @endsection
