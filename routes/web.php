<?php

use App\Http\Controllers\GSPDashboard;
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
//Auth
Route::post('/gsp-auth', [App\Http\Controllers\GSPAuth::class, 'auth'])->name('gsp-auth');
Route::get('/dashboard', [App\Http\Controllers\GSPDashboard::class, 'dashboard'])->name('dashboard');

//Categories
Route::get('/categories', [App\Http\Controllers\GSPDashboard::class, 'categories'])->name('categories');
Route::post('/add-new-category',[App\Http\Controllers\GSPDashboard::class, 'newcategory'])->name('add-new-category');

//Charges
Route::get('/charges', [App\Http\Controllers\GSPDashboard::class, 'charges'])->name('charges');
Route::post('/add-new-charge',[App\Http\Controllers\GSPDashboard::class, 'newcharge'])->name('add-new-charge');

//Check in
Route::get('/check-in', [App\Http\Controllers\GSPDashboard::class, 'checkin'])->name('check-in');
Route::post('/check-in', [App\Http\Controllers\GSPDashboard::class, 'bookcar'])->name('check-in');

//check out
Route::get('/check-out', [App\Http\Controllers\GSPDashboard::class, 'checkout'])->name('check-out');
Route::post('/check-out', [App\Http\Controllers\GSPDashboard::class, 'toagari'])->name('check-out');

//Parking status
Route::get('/parking-status', [App\Http\Controllers\GSPDashboard::class, 'parkingstatus'])->name('parking-status');
Route::post('/check-status', [App\Http\Controllers\GSPDashboard::class, 'chackstatus'])->name('check-status');

//waiver
Route::get('/waiver', [App\Http\Controllers\GSPDashboard::class, 'waiver'])->name('waiver');
Route::post('/waiver', [App\Http\Controllers\GSPDashboard::class, 'waiverpenalties'])->name('waiver');

//Payments

Route::get('/payments', [App\Http\Controllers\GSPDashboard::class, 'payments'])->name('payments');
Route::post('/payments', [App\Http\Controllers\GSPDashboard::class, 'postpayments'])->name('payments');
Route::get('/checkin-postpay', [App\Http\Controllers\GSPDashboard::class, 'checkinpostpay'])->name('checkin-postpay');
Route::post('/pushpayment',[App\Http\Controllers\GSPDashboard::class, 'pushpayment'])->name('pushpayment');




//GSPReports
Route::get('/checkin', [App\Http\Controllers\GSPReports::class, 'checkin'])->name('checkin');
Route::get('/checkout', [App\Http\Controllers\GSPReports::class, 'checkout'])->name('checkout');
Route::get('/waivers', [App\Http\Controllers\GSPReports::class, 'waivers'])->name('waivers');
