<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
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
    return view('welcome');
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

Route::post('posts/share', [PostController::class, 'share'])->name('posts.share');

Route::resource('posts', PostController::class);

Route::post('/posts/{post}/comment', [CommentController::class, 'store'])->name('posts.comment.store');

Route::resource('users', UserController::class);
Route::post('users/{id}/block', [UserController::class, 'blockUser'])->name('users.block');
Route::post('users/{id}/unblock', [UserController::class, 'unblockUser'])->name('users.unblock');

Route::post('/users/{user}/follow', [FollowStatusController::class, 'followUser'])->name('users.follow');
Route::delete('/users/{user}/unfollow', [FollowStatusController::class, 'followUser'])->name('users.unfollow');

Route::get('/users/{id}/followings', [FollowStatusController::class , 'followingUsers'])->name('users.followings');
Route::get('/users/{id}/followers', [FollowStatusController::class , 'followerUsers'])->name('users.followers');


Route::middleware(['auth'])->group(function () {
    Route::post('/block/{user}', [BlockController::class, 'block'])->name('block');
    Route::post('/unblock/{user}', [BlockController::class, 'unblock'])->name('unblock');
});

Route::get('/search', [UserController::class, 'search'])->name('users.search');

require __DIR__ . '/auth.php';
