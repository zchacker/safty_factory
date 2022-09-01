<?php

use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('home');
});


Route::match(['get', 'post'], '/login', [\App\Http\Controllers\Auth::class, 'login'])->name('login');




//Route::group(['middleware' => ['auth', 'user']], function () {

    Route::prefix('/client')->group(function () {

        Route::get('/home', [\App\Http\Controllers\Client::class, 'index'])->name('client.home');
        Route::get('/rejected', [\App\Http\Controllers\Client::class, 'rejected'])->name('client.rejected');
        Route::get('/accepted', [\App\Http\Controllers\Client::class, 'accepted'])->name('client.accepted');
        Route::get('/deleteClient', [\App\Http\Controllers\Client::class, 'deleteClient'])->name('client.deleteClient');

        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Client::class, 'addClient'])->name('client.add');
        Route::match(['get', 'post'], '/edit', [\App\Http\Controllers\Client::class, 'editClient'])->name('client.edit');
        Route::post('/sendToEngineer', [\App\Http\Controllers\Client::class, 'sendToEngineer'])->name('client.sendToEngineer');
        Route::get('/logout', [\App\Http\Controllers\Client::class, 'logout'])->name('client.logout');
    });

    Route::prefix('/category')->group(function () {

        Route::get('/home', [\App\Http\Controllers\Category::class, 'index'])->name('category.home');
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Category::class, 'add'])->name('category.add');
        Route::match(['get', 'post'], '/edit', [\App\Http\Controllers\Category::class, 'edit'])->name('category.edit');
        Route::get('/delete', [\App\Http\Controllers\Category::class, 'delete'])->name('category.delete');
    });

    Route::prefix('/neighborhood')->group(function () {

        Route::get('/home', [\App\Http\Controllers\Neighborhood::class, 'index'])->name('neighborhood.home');
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Neighborhood::class, 'add'])->name('neighborhood.add');
        Route::match(['get', 'post'], '/edit', [\App\Http\Controllers\Neighborhood::class, 'edit'])->name('neighborhood.edit');
        Route::get('/delete', [\App\Http\Controllers\Neighborhood::class, 'delete'])->name('neighborhood.delete');
    });

    Route::prefix('/section')->group(function () {

        Route::get('/home', [\App\Http\Controllers\Section::class, 'index'])->name('section.home');
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Section::class, 'add'])->name('section.add');
        Route::match(['get', 'post'], '/edit', [\App\Http\Controllers\Section::class, 'edit'])->name('section.edit');
        Route::get('/delete', [\App\Http\Controllers\Section::class, 'delete'])->name('section.delete');
    });

    Route::prefix('/service')->group(function () {

        Route::get('/home', [\App\Http\Controllers\Service::class, 'index'])->name('service.home');
        Route::match(['get', 'post'], '/add', [\App\Http\Controllers\Service::class, 'add'])->name('service.add');
        Route::match(['get', 'post'], '/edit', [\App\Http\Controllers\Service::class, 'edit'])->name('service.edit');
        Route::get('/delete', [\App\Http\Controllers\Service::class, 'delete'])->name('service.delete');
    });

//});

//Route::group(['middleware' => ['auth', 'engineer']], function () {
    Route::prefix('/engineer')->group(function () {

        Route::get('/home', [\App\Http\Controllers\Engineer::class, 'home'])->name('engineer.home');
        Route::get('/completed', [\App\Http\Controllers\Engineer::class, 'completed'])->name('engineer.completed');
        Route::get('/uncompleted', [\App\Http\Controllers\Engineer::class, 'uncompleted'])->name('engineer.uncompleted');
        Route::match(['get', 'post'], '/details', [\App\Http\Controllers\Engineer::class, 'details'])->name('engineer.details');
        Route::match(['get', 'post'], '/price_offer/{client_id?}', [\App\Http\Controllers\Engineer::class, 'price_offer'])->name('engineer.price_offer');
        Route::get('/logout', [\App\Http\Controllers\Engineer::class, 'logout'])->name('engineer.logout');
    });
//});

// Route::group(['middleware' => ['auth:engineer']], function () {
//     /**
//      * Logout Routes
//      */
//     //Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
//     //Route::get('/engineer', [\App\Http\Controllers\Engineer::class, 'home']);
// });
