<?php

use App\Http\Controllers\HospitalDetailsController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\UserDetailsController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/users_details', function(){
//     return view('user.details');
// });
Route::resource('/users_details', UserDetailsController::class);
// Route::resource('/hospital_details', HospitalDetailsController::class);
Route::get('/user_json', [UserDetailsController::class, 'userJson']);
Route::get('/show_map', [UserDetailsController::class, 'show_map']);
Route::get('/send_notification/{id}', [UserDetailsController::class, 'send_notification']);
Route::get('/show_notification', [UserDetailsController::class, 'show_notification']);
Route::get('/reset_pending/{id}', [UserDetailsController::class, 'reset_pending']);
Route::resource('/offer', OfferController::class);
Route::get('/book/{id}', [UserDetailsController::class, 'book']);


