<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarUnitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\BookingController;


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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

//Auth
Route::middleware('web')->group(function () {
    Route::post('/loginUser', [AuthController::class, 'login'])->name('loginUser');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


//Home User
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/get-car-units-detail/{id}', [HomeController::class, 'getDetail'])->name('car-units.detail');

//Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('tampilan-admin.dashboard');
})->name('dashboard');

Route::get ('/admin/dashboard/car-units', [CarUnitController::class, 'index'])->name('dashboard.car-units');
Route::post ('/admin/dashboard/car-units/add', [CarUnitController::class, 'store'])->name('dashboard.car-units.add');
Route::get ('/admin/dashboard/car-units/{carUnitId}/upload', [PhotoController::class, 'index']);
Route::post('/admin/dashboard/car-units/{carUnitId}/upload', [PhotoController::class, 'store']);



Route::get('/api/categories', [CategoryController::class, 'index']);
Route::get('/api/brands', [BrandController::class, 'index']);