<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaypalController;

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

Route::get('/', [HomeController::class, "index"])->name("index");
Route::get('/index', [HomeController::class, "index"])->name("index");
Route::get('/cars', [HomeController::class, "searchCars"])->name("searchCars");
Route::get('/cars/filtered', [HomeController::class, "searchFilters"])->name("searchFilters");

Route::get('/login', [HomeController::class, "login"])->name("login");
Route::post('/login', [HomeController::class, "checkLogin"])->name("log");

Route::get('/register', [HomeController::class, "register"])->name("register");
Route::post('/register', [HomeController::class, "checkRegister"])->name("reg");

Route::get('/index', [HomeController::class, "logout"])->name("logout");

Route::get('/{id}/details', [HomeController::class, "details"])->name("details")->middleware('auth');
Route::get('/{id}/edit', [HomeController::class, "edit"])->name("edit")->middleware('auth');
Route::post('/{id}/edit', [HomeController::class, "updateCar"])->name("edit.update")->middleware('auth');


Route::get('/create', [HomeController::class, "create"])->name("create")->middleware('auth');
Route::post('/create', [HomeController::class, "addCar"])->name("create.add")->middleware('auth');

Route::get('/account', [HomeController::class, "account"])->name("account")->middleware('auth');

Route::get('/settings', [HomeController::class, "settings"])->name("settings")->middleware('auth');
Route::post('/settings', [HomeController::class, "updateUser"])->name("settings.update")->middleware('auth');

Route::get('/contact', [HomeController::class, "contact"])->name("contact");
Route::post('/contact', [HomeController::class, 'send'])->name('contact.send');

Route::post('/paypal/payment/{id}', [PaypalController::class, "payment"])->name('payment');
Route::get('/success', [PaypalController::class, 'success'])->name('success')->middleware('auth');
Route::get('/paypal/cancel', [PaypalController::class, "cancel"])->name('cancel');


