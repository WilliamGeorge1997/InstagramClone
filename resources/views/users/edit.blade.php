

    @extends('layouts.main')
    @section('content')
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
                                    <img src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg "
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

                            <input type="email" name="email">
                            <input type="submit" class="btn btn-primary" name="submit">
                        </form>
                    </div>
                </div>
            </div>

    @endsection

