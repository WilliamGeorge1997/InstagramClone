<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikePostController;
use App\Http\Controllers\SavedPostController;
use App\Http\Controllers\FollowStatusController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('posts/{tag}/tagPage', [PostController::class, 'tag'])->name('posts.tag');
Route::get('posts/{id}/user', [PostController::class, 'postsByUserId'])->name('posts.profile');

// Route::post('/share', [PostController::class, 'share'])->name('share');
Route::match(['get', 'post'], 'share', [PostController::class, 'share'])->name('posts.share');

Route::resource('posts', PostController::class);



Route::resource('users', UserController::class);


Route::get('/users/{id}/followings', [FollowStatusController::class, 'followingUsers'])->name('users.followings');
Route::get('/users/{id}/followers', [FollowStatusController::class, 'followerUsers'])->name('users.followers');

Route::get('/users/{id}/followings', [FollowStatusController::class, 'followingUsers'])->name('users.followings');
Route::get('/users/{id}/followers', [FollowStatusController::class, 'followerUsers'])->name('users.followers');



Route::middleware(['auth'])->group(function () {
    Route::post('/users/{user}/follow', [FollowStatusController::class, 'followUser'])->name('users.follow');
    Route::delete('/users/{user}/unfollow', [FollowStatusController::class, 'followUser'])->name('users.unfollow');
    Route::post('users/{id}/block', [BlockController::class, 'blockUser'])->name('users.block');
    Route::get('users/{id}/blocked', [BlockController::class, 'showBlockedUsers'])->name('users.blocked');
    Route::DELETE('users/{id}/unblock', [BlockController::class, 'unblockUser'])->name('users.unblock');


    // -------------------------- Likes ----------------------------

    Route::post('/posts/{post}/like', [LikeController::class, 'likePost'])->name('posts.like');
    Route::delete('/posts/{post}/unlike', [LikeController::class, 'unlikePost'])->name('posts.unlike');
    Route::post('/comments/{comment}/like', [LikeController::class, 'likeComment'])->name('comments.like');
    Route::delete('/comments/{comment}/unlike', [LikeController::class, 'unlikeComment'])->name('comments.unlike');

    // -------------------------- Comments ----------------------------
    // comments for posts
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('posts.comment.destroy');

    Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comment.store');

    // ----------------------------------- saved-posts -----------------------
    // store saved post
    Route::post('/posts/{id}/save', [SavedPostController::class, 'store'])->name('saved.posts.store');

    // show saved posts
    Route::get('/saved-posts',  [PostController::class, 'showSavedPosts'])->name('posts.saved-posts'); // middleware

    // Delete saved post
    Route::delete('/saved-posts/{id}', [SavedPostController::class, 'destroy'])->name('saved-posts.destroy'); // middleware

});

Route::get('/search', [UserController::class, 'search'])->name('users.search');

require __DIR__ . '/auth.php';



Route::middleware(['web', 'auth', 'verified'])->group(function () {
    Route::post('/update-email', [UserController::class, 'updateEmail'])->name('update.email');
});