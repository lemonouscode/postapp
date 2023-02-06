<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/createpost', function () {
    return view('createpost');
})->middleware('protectadmin');

Route::get('/signin', function () {
    return view('signin');
});

Route::get('/posts', [PostController::class, 'index']);
Route::get('/posts/{id}', [PostController::class, 'show']);

Route::get('/myposts',[PostController::class,'myposts']);

Route::get('/posts', [PostController::class,'index']);
Route::post('/createpost', [PostController::class, 'store']);
Route::get('signup', [AuthController::class, 'getSignUp']);
Route::get('signin', [AuthController::class, 'getSignIn']);
Route::get('signout', [AuthController::class, 'signout']);
Route::post('/signup', [AuthController::class, 'signUp']);
Route::post('/signin', [AuthController::class, 'signin']);



Route::post('/deletepost/{id}', [PostController::class, 'destroy']);