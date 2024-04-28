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
Route::get('/car-units/detail/{id}', [HomeController::class, 'getCarDetail'])->name('car.detail');

//Dashboard Admin
Route::get('/admin/dashboard', function () {
    return view('tampilan-admin.dashboard');
})->name('dashboard');

Route::get      ('/admin/dashboard/car-units', [CarUnitController::class, 'index'])->name('dashboard.car-units');
Route::post     ('/admin/dashboard/car-units/add', [CarUnitController::class, 'store'])->name('dashboard.car-units.add');
Route::get      ('/admin/dashboard/car-units/{carUnitId}/upload', [PhotoController::class, 'index']);
Route::post     ('/admin/dashboard/car-units/{carUnitId}/upload', [PhotoController::class, 'store']);
Route::delete   ('/admin/dashboard/car-units/{id}/delete', [CarUnitController::class, 'destroy']);
Route::put      ('/admin/dashboard/car-units/{id}/update', [CarUnitController::class, 'update']);

Route::get      ('/admin/dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
Route::post     ('/admin/dashboard/categories/add', [CategoryController::class, 'store'])->name('dashboard.categories.add');
Route::delete   ('/admin/dashboard/categories/{id}/delete', [CategoryController::class, 'destroy']);
Route::put      ('/admin/dashboard/categories/{id}/update', [CategoryController::class, 'update']);

Route::get      ('/admin/dashboard/brands', [BrandController::class, 'index'])->name('dashboard.brands');
Route::post     ('/admin/dashboard/brands/add', [BrandController::class, 'store'])->name('dashboard.brands.add');
Route::delete   ('/admin/dashboard/brands/{id}/delete', [BrandController::class, 'destroy']);
Route::put      ('/admin/dashboard/brands/{id}/update', [BrandController::class, 'update']);


Route::get('/api/categories', [CategoryController::class, 'getCategory']);
Route::get('/api/brands', [BrandController::class, 'getBrand']);