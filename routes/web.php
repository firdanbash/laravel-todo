<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth');
})->name('login');
Route::middleware('auth')->group(function(){
    Route::get('/todo', function(){
        return view('todo-page');
    });
});
