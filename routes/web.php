<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;



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

// page de connexion
Route::get('/', 'HomeController@index')->name('index'); 

Route::get('/home', 'HomeController@home')->name('home');



Auth::routes();


Route::resource('/message', 'MessageController');

Route::resource('/commentaire', 'CommentsController');


// Route::get('/zoomHubb', [App\Http\Controllers\MessageController::class, 'zoomHubb'])->name('message.zoom');



// Route::get account

Route::get('user/account', [App\Http\Controllers\UserController::class, 'showAccount'])->name('user.account');

// afficher formulaire modif
Route::get('user/update', [App\Http\Controllers\UserController::class, 'showUpdatePage'])->name('user.update');

// valider les modifs
Route::put('user/update', [App\Http\Controllers\UserController::class, 'update'])->name('user.update');

// afficher formulaire modification mot de passe
Route::get('user/editPassword', [App\Http\Controllers\UserController::class, 'showUpdatePagePassword'])->name('user.updatePassword');

// valider les modifs mot de passe
Route::put('user/editPassword', [App\Http\Controllers\UserController::class, 'updatePassword'])->name('user.updatePassword');



//recherche 
Route::get('/search', [App\Http\Controllers\MessageController::class, 'search'])->name('message.search');










