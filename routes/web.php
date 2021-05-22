<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\QurantextController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurahController;
use App\Http\Controllers\WordController;
use App\Http\Livewire;
use App\http\Controllers\TranslationController;
use App\Http\Controllers\PagerController;
use App\Http\Controllers\RootController;


// Route::get('/posts', function () {
//    return view('posts.index');
// });

Route::get('/home', function () {
    return view('layouts.home');
})->name('home');

Route::get('/dashboard', [DashboardController::class, 'index'])
->name('dashboard')
->middleware('auth');

Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/post', [PostController::class, 'index'])->name('posts');
Route::post('/post', [PostController::class, 'store']);

Route::get('/surah', [SurahController::class, 'index']);

Route::get('/translate', [TranslationController::class, 'index']);

Route::get('/showtest', function () {
    return view('translation.childtest');
});

Route::get('/live', function () {
    return view('translation.livetran');
});

route::get('/rooter', [RootController::class, 'index']);



// Route::get('/live', [App\Http\Livewire\Mycomponent::class]);
route::get('/word', [WordController::class, 'index']);

Route::get('/q', [QurantextController::class, 'index']);
Route::get('/pager', [PagerController::class, 'index']);

Route::get('/perpage', function () {
    return view('quran.perpage');
});
    
