<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    require __DIR__.'/admin.php';
});

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin auth


//end admin auth