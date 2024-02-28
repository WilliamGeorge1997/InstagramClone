

@extends("layouts.profile")
@section('title','Create post')



@section("content")
    <form action="{{route('posts.store')}}"  method="post"  enctype="multipart/form-data">
        @csrf
        postid<input name ="postid" type="number"><br>
        userid<input name ="userid" type="number"><br>
        caption<input name="caption" type="text"><br>
        tag<input name="tagBody" type="text"><br>
        media<input name="media[]" type="file" multiple><br>
        <button type="submit">submit</button>
          @if ($errors->any() )
      @foreach($errors->all() as $error)
      <p>{{$error}}</p>
      @endforeach
          @endif
    </form>
    @endsection
