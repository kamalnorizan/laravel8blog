<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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

// DB::listen(function ($event) {
//     dump($event->sql);
// });

Route::get('/', function () {
    return view('welcome');
});

Route::get('/exercise', function () {
    return view('exercise');
});

Route::get('/hello', [HomeController::class,'index']);
Route::get('/exercisecontroller', [HomeController::class,'exercise']);

Auth::routes(['register'=>false]);


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('posts', PostController::class)->except(['index','show','destroy','store']);

    Route::get('/posts', [App\Http\Controllers\PostController::class,'index'])->name('posts.index')->middleware(['role_or_permission:publisher|show post|edit post|delete post|create post']);

    Route::post('/posts',[App\Http\Controllers\PostController::class,'store'])->name('posts.store')->middleware('checkpublishdate');
    Route::get('/posts/delete/{post}',[App\Http\Controllers\PostController::class,'destroy'])->name('posts.delete');

    Route::get('/category',[App\Http\Controllers\CategoryController::class,'index'])->name('category.index');
    Route::get('/category/create',[App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
    Route::post('/category',[App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
    Route::get('/category/{category}/edit',[App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
    Route::put('/category/{category}',[App\Http\Controllers\CategoryController::class,'update'])->name('category.update');

    //comment
    Route::post('/comment', [App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
    Route::post('/comment/update', [App\Http\Controllers\CommentController::class,'update'])->name('comment.update');
    Route::delete('/comment/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.delete');


    Route::get('/user',[App\Http\Controllers\UserController::class,'index'])->name('user.index');
    Route::post('/user/assignpermissiontorole',[App\Http\Controllers\UserController::class,'assignpermissiontorole'])->name('user.assignpermissiontorole');
    Route::post('/user/assignroletouser',[App\Http\Controllers\UserController::class,'assignroletouser'])->name('user.assignroletouser');
});
