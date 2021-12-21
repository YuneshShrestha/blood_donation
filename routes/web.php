<?php

use App\Http\Controllers\HospitalDetailsController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Route::get('/users_details', function(){
//     return view('user.details');
// });
Route::resource('/users_details', UserDetailsController::class);
Route::resource('/hospital_details', HospitalDetailsController::class);
