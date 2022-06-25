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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/client')->group(function(){

    Route::get('/home', [\App\Http\Controllers\Client::class, 'index'])->name('client.home');
    Route::match(['get','post'] ,'/add', [\App\Http\Controllers\Client::class, 'addClient'])->name('client.add');
    
});

Route::prefix('/category')->group(function(){

    Route::get('/home', [\App\Http\Controllers\Category::class, 'index'])->name('category.home');
    Route::match(['get','post'] ,'/add', [\App\Http\Controllers\Category::class, 'add'])->name('category.add');
    Route::match(['get','post'] ,'/edit', [\App\Http\Controllers\Category::class, 'edit'])->name('category.edit');
    
});

Route::prefix('/neighborhood')->group(function(){

    Route::get('/home', [\App\Http\Controllers\Neighborhood::class, 'index'])->name('neighborhood.home');
    Route::match(['get','post'] ,'/add', [\App\Http\Controllers\Neighborhood::class, 'add'])->name('neighborhood.add');
    Route::match(['get','post'] ,'/edit', [\App\Http\Controllers\Neighborhood::class, 'edit'])->name('neighborhood.edit');
    
});

Route::group(['middleware' => ['auth:engineer']], function() {
    /**
     * Logout Routes
     */
    //Route::get('/logout', 'LogoutController@perform')->name('logout.perform');
    //Route::get('/engineer', [\App\Http\Controllers\Engineer::class, 'home']);
});