<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\UploadController;
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




Route::get('/restricted', function () {
    return view('restricted.denied');
});

Route::get('/allowed', function () {
    return view('restricted.allowed');
});

Route::get('/login', [UsersController::class, 'Index']);

Route::post('login', [UsersController::class, 'Login']);
Route::get('/logout', function () {
    if(session()->has('user'))
    {
        session()->pull('user');
    }
    return redirect('login');
});

Route::view('/AddMember', 'AddMember');
Route::post('/AddMember', [UsersController::class, 'AddMember']);

Route::view('/upload', 'upload'); 
Route::post('/upload', [UploadController::class, 'upload']);

Route::get('/list', [ItemController::class, 'show']);
Route::post('/delete/{id}', [ItemController::class, 'destroy']);

Route::post('/AddItem', [ItemController::class, 'AddItem']);
Route::get('/filter', [ItemController::class, 'filter']);
Route::get('/search',  [ItemController::class, 'search']);

Route::get('/list/{project}', [ItemController::class, 'setProject']);




