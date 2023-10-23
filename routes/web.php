<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProjectsController;

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

Route::get('/', [ProjectsController::class, 'listUniqueItems']);
Route::get('/home', [ProjectsController::class, 'listUniqueItems']);

Route::get('/about', function () {
    return view('about');
});
Route::get('/contacts', function () {
    return view('contacts');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/delete/{id}', [ItemController::class, 'destroy']);
Route::post('/update/{id}', [ItemController::class, 'update']);
Route::post('/addItem', [ItemController::class, 'addItem']);

Route::middleware('auth')->group(function () {
    //Breeze Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //My routes
    Route::get('/list', [ItemController::class, 'show']);



    Route::post('/AddItem', [ItemController::class, 'AddItem']);
    Route::get('/filter', [ItemController::class, 'filter']);
    Route::get('/search',  [ItemController::class, 'search']);

    Route::get('/list/{project}', [ItemController::class, 'setProject']);

    Route::get("logs", [LogController::class, "index"]);

});

require __DIR__.'/auth.php';
