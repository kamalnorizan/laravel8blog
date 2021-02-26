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

// Route::get('/post',[App\Http\Controllers\PostController::class,'index'])->name('posts.index');
// Route::get('/post/create',[App\Http\Controllers\PostController::class,'create'])->name('posts.create');
// Route::post('/post',[App\Http\Controllers\PostController::class,'store'])->name('posts.store');
// Route::get('/post/{post}/edit',[App\Http\Controllers\PostController::class,'edit'])->name('posts.edit');
// Route::put('/post/{post}',[App\Http\Controllers\PostController::class,'update'])->name('posts.update');
Route::resource('posts', PostController::class)->except(['show','destroy']);
Route::get('/post/delete/{post}',[App\Http\Controllers\PostController::class,'destroy'])->name('posts.delete');

Route::get('/category',[App\Http\Controllers\CategoryController::class,'index'])->name('category.index');
Route::get('/category/create',[App\Http\Controllers\CategoryController::class,'create'])->name('category.create');
Route::post('/category',[App\Http\Controllers\CategoryController::class,'store'])->name('category.store');
Route::get('/category/{category}/edit',[App\Http\Controllers\CategoryController::class,'edit'])->name('category.edit');
Route::put('/category/{category}',[App\Http\Controllers\CategoryController::class,'update'])->name('category.update');

//comment
Route::post('/comment', [App\Http\Controllers\CommentController::class,'store'])->name('comment.store');
Route::post('/comment/update', [App\Http\Controllers\CommentController::class,'update'])->name('comment.update');
Route::delete('/comment/{comment}', [App\Http\Controllers\CommentController::class, 'destroy'])->name('comment.delete');
