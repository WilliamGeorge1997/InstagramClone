@extends("layouts.main")
@section('title','posts')
@section('style')
<link rel="stylesheet" href="{{ asset('css/posts.css') }}">
@endsection
@section("content")

<div class="story-header ">
     @for($i = 0; $i < 6; $i++)
            <div class="d-flex flex-column mx-2">
                <img src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg " alt="Profile Picture" class="profile-picture">
            <h6 class="username">username</h6>
            </div>
     @endfor
    </div>




{{-- ======================================================================================== --}}

<div class="post-container">
  <div class="post-header">
    <img class="profile-pic" src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg " alt="Profile Picture">
    <div class="username">username</div>
  </div>
  <img class="post-image" src="https://e0.pxfuel.com/wallpapers/41/351/desktop-wallpaper-kumpulan-luffy-smiling-luffy-smile.jpg " alt="Post Image">

  <div class="likes-comments">
    <div class="d-flex justify-content-between">
        <div class="d-flex">
             <form action="" method="">
                <span class="like-btn"><svg aria-label="Like" class="x1lliihq x1n2onr6 xyb1xck" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24"><title>Like</title><path d="M16.792 3.904A4.989 4.989 0 0 1 21.5 9.122c0 3.072-2.652 4.959-5.197 7.222-2.512 2.243-3.865 3.469-4.303 3.752-.477-.309-2.143-1.823-4.303-3.752C5.141 14.072 2.5 12.167 2.5 9.122a4.989 4.989 0 0 1 4.708-5.218 4.21 4.21 0 0 1 3.675 1.941c.84 1.175.98 1.763 1.12 1.763s.278-.588 1.11-1.766a4.17 4.17 0 0 1 3.679-1.938m0-2a6.04 6.04 0 0 0-4.797 2.127 6.052 6.052 0 0 0-4.787-2.127A6.985 6.985 0 0 0 .5 9.122c0 3.61 2.55 5.827 5.015 7.97.283.246.569.494.853.747l1.027.918a44.998 44.998 0 0 0 3.518 3.018 2 2 0 0 0 2.174 0 45.263 45.263 0 0 0 3.626-3.115l.922-.824c.293-.26.59-.519.885-.774 2.334-2.025 4.98-4.32 4.98-7.94a6.985 6.985 0 0 0-6.708-7.218Z"></path></svg></span>
             </form>

             <form action="">
                <span class="comment-btn"><svg aria-label="Comment" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24"><title>Comment</title><path d="M20.656 17.008a9.993 9.993 0 1 0-3.59 3.615L22 22Z" fill="none" stroke="currentColor" stroke-linejoin="round" stroke-width="2"></path></svg></span>
             </form>
        </div>
        <form action="" method="">
            <span class="share-btn"><svg aria-label="Save" class="x1lliihq x1n2onr6 x5n08af" fill="currentColor" height="24" role="img" viewBox="0 0 24 24" width="24"><title>Save</title><polygon fill="none" points="20 21 12 13.44 4 21 4 3 20 3 20 21" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polygon></svg></span>
        </form>
    </div>
  </div>
  <div class="likes">
    <span>10 Likes</span>
</div>
  <div class="post-caption">
    <span class="username">username</span> Caption for the post goes here. #instagram #webdev
  </div>
  <form action="" method="" class="comment-container d-flex">
    <textarea name="comment" placeholder="Add a comment..." class="comment p-1" id="comment" cols="1" rows="1"></textarea>
    <button class="btn text-primary">Post</button>
</from>


</div>


@endsection
