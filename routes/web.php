<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Routes;
use App\Http\Controllers\MailController;


Route::get('/', [PostController::class, 'index'])->name('post.index');

Route::get('post/create', [PostController::class, 'create'])->name('post.create');

Route::get('post/{slug}', [PostController::class, 'show'])->name('post.show');

Route::post('/posts', [PostController::class,'store'])->name('post.store');

Route::get('post/{slug}/edit', [PostController::class,'edit'])->name('post.edit');

Route::put('/post/{slug}', [PostController::class,'update'])->name('post.update');

Route::delete('post/{post}', [PostController::class,'destroy'])->name('post.destroy');

Route::get('search', [PostController::class,'search'])->name('post.search');

Route::get('author/{id}', [PostController::class,'author'])->name('post.author');

//________________________________________
Route::post('/comment',[CommentController::class,'store'])->name('comment.store');

Route::delete('comment/{id}', [CommentController::class,'destroy'])->name('comment.destroy');
//________________________________________

Route::post('/upload-photo',[HomeController::class,'uploadPhoto'])->name('uploadphoto');
//________________________________________
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::resource('tags', TagController::class)->middleware('can:admin-control');

//________________________________________

Route::resource('category', CategoryController::class)->middleware('can:admin-control');;




Route::resource('/user', UserController::class)->middleware('can:admin-control');


Route::get('/contact', function(){
  return view('contact.contact');
});
Route::get('/about', function(){
  return view('about.about');
});