<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container row row-col-3 mx-auto my-4 justify-content-around ">
        @foreach ($posts as $post)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <a class="card-title fs-2" href="{{route('posts.show',$post->id)}}">caption : {{$post->caption}}</a>
              <h6 class="card-subtitle mb-2 text-body-secondary fs-4">user_id : {{$post->user_id}}</h6>
              <p class="card-text fs-6">post_id: {{$post->id}}</p></p>
           <div class="d-flex align-items-center">
            <p>tagname: {{$post->tag->first()->tag_id}}</p>
              <p>mediapath: {{$post->media->first()->media}}</p>
           <a href="{{route('posts.edit',$post->id)}}" class="btn btn-primary m-1">Edit</a>
                <form action="{{url("/posts/$post->id")}}" method="post">
        @csrf
        @method("delete")
                <input type="submit" class="btn btn-danger m-1" value="Delete">
        </form>
        </div>
               {{-- <p class="card-text">published at : {{$post->published_at}}</p> --}}
            </div>
          </div>
        @endforeach
</body>
</html>
