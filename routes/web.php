<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LinkableObjectController;
use App\Http\Controllers\ObjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceOrderController;
use App\Http\Controllers\ObjectNumberController;

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

Route::get('/',  function () {
    return view('auth.login');
})->name('welcome');

Route::get('/registro',  function () {
    return view('auth.register');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/clients',  function () {
    return view('clients');
})->middleware(['auth', 'verified'])->name('clients');

Route::get('/clients/create',  function () {
    return view('create-clients');
})->middleware(['auth', 'verified'])->name('create-clients');

Route::get('/clients/search', [ClientController::class, 'search'])->middleware(['auth', 'verified']);
Route::get('/clients/phone-verification', [ClientController::class, 'PhoneVerification'])->middleware(['auth', 'verified']);
Route::post('/clients/create', [ClientController::class, 'store'])->middleware(['auth', 'verified']);

Route::get('/service-order',  function () {
    return view('service-order');
})->middleware(['auth', 'verified'])->name('service-order');

Route::get('/service-order/create',  function () {
    return view('create-service-order');
})->middleware(['auth', 'verified'])->name('create-service-order');

Route::get('/service-order/create/searchos', [ServiceOrderController::class, 'ServiceOrderVerification'])->middleware(['auth', 'verified']);
Route::get('/service-order/create/searchobject', [ObjectController::class, 'ObjectVerification'])->middleware(['auth', 'verified']);
Route::get('/service-order/create/listItems', [ItemController::class, 'fetchItems'])->middleware(['auth', 'verified']);
Route::get('/service-order/create/checkObjectNumber', [ObjectNumberController::class, 'ObjectNumberVBerification'])->middleware(['auth', 'verified']);
Route::get('/service-order/create/LoadLinkableObjects', [LinkableObjectController::class, 'LoadLinkableObjects'])->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
