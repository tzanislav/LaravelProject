<?php

use App\Http\Controllers\APIController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\execute;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\AdminController;

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

Route::get('/execute', [execute::class, 'execute']);

Route::get('/search',  [ItemController::class, 'Search']);
Route::get('/ClearSearch', [ItemController::class, 'ClearSearch']);


Route::get('/AddFilter', [ItemController::class, 'AddFilter']);
Route::get('/RemoveFilter', [ItemController::class, 'RemoveFilter']);
Route::get('/ClearFilter', [ItemController::class, 'ClearFilters']);
Route::get('/list', [ItemController::class, 'show']);
Route::get('/list/{project}', [ItemController::class, 'setProject']);

//API
Route::get('/api/data', [APIController::class, 'getData']);
Route::get('/api/categories', [APIController::class, 'getCategories']);
Route::get('/api/companies', [APIController::class, 'getCompanies']);
Route::get('/api/statues', [APIController::class, 'getStatues']);

//Upload
Route::get('upload', [ FileUploadController::class, 'showUploadForm' ]);
Route::post('upload', [ FileUploadController::class, 'uploadFile' ]);





Route::middleware('auth')->group(function () {
    //Breeze Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //My routes    
    Route::post('/editItem', [ItemController::class, 'EditItem']);
    Route::post('/deleteItem', [ItemController::class, 'DeleteItem']);
    Route::get("logs", [LogController::class, "index"]);

    //Admin
    Route::get('/admin', [AdminController::class, 'Index']);
    Route::post('/admin/{id}', [AdminController::class, 'Update']);
});

require __DIR__.'/auth.php';
