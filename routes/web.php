<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdmitCardController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::resource('class', App\Http\Controllers\ClazzController::class);

Route::resource('admitCard', AdmitCardController::class);

Route::controller(AdmitCardController::class)->group(function(){
    
    Route::get('/', 'admin_homepage');
    
	Route::get('/admitCard/upload-image/{admitCard}', 'upload_image')->name('admitCard.upload_image');
	
	Route::post('/admitCard/save-image/{admitCard}', 'save_image')->name('admitCard.save_image');
	
	Route::get('/admitCards','admit_cards')->name('admitCard.admit_cards');
	
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');