<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SampleController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Facades\CustomFacade;

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
    return view('welcome1');
});

Route::get('/sample', [SampleController::class, 'index']);

Route::get('home', [HomeController::class, 'index']);

Route::get('login', [LoginController::class, 'index']);

Route::post('login', [LoginController::class, 'loginHandler'])->name('loginHandle');

Route::post('/uploadfile', [ImageController::class, 'imageHandle'])->name('imageHandle');

Route::get('/success', function () {
    return '<h1>Image Upload Success</h1>';
})->name('success');

Route::get('/download', [ImageController::class, 'download'])->name('download');

Route::get('/posts/trashed', [PostController::class, 'trashed'])->name('posts.trashed');             //place before resource route
Route::get('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
Route::delete('/posts/{id}/force-delete', [PostController::class, 'forceDelete'])->name('posts.force_delete');
Route::resource('posts', PostController::class);

Route::get('/check', function () {
    return CustomFacade::SomeMethod();
});

Route::get('/blog', [BlogController::class, 'index']);

Route::get('/slug', function () {
    $title = "Demystifying Artificial Intelligence: Exploring the Future of Intelligent Technology";

    $slug = slugCustom($title);
    return $slug;
});

// Route::get('/user/{id}', function ($id) {
//     return User::find($id);
// });

// Route::get('/user/{user}', function (User $user) {
//     return $user;
// });

Route::get('/user/{user:email}', function (User $user) {
    return $user;
});

Route::get('/unavailable', function () {
    return view('unavailable');
})->name('unavailable');

Route::group(["middleware" => "authCheck"], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });

    Route::get('/profile', function () {
        return view('profile');
    });
});