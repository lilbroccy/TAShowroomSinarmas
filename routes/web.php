<?php

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CarUnitController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CheckUnitController;
use App\Http\Controllers\PengajuanTitipanController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Route untuk mengirim email tautan reset password
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Route untuk menampilkan form reset password
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Auth::routes(['verify' => true]);

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Tautan verifikasi telah dikirim!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('showRegisterForm');
Route::post('/register', [AuthController::class, 'registerUser'])->name('registerUser');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
// Auth routes
Route::middleware('web')->group(function () {
    Route::post('/loginUser', [AuthController::class, 'login'])->name('loginUser');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Routes that require email verification
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    // Add other routes that require email verification here
});

Route::get('/get-car-units-detail/{id}', [HomeController::class, 'getDetail'])->name('car-units.detail');
Route::get('/car-units/detail/{id}', [HomeController::class, 'getCarDetail'])->name('car.detail');

Route::post('/car-units/detail/check-unit', [CheckUnitController::class, 'store'])->name('check-unit');
Route::get('/car-units/detail/check-booking', [CheckUnitController::class, 'checkBooking']);


//Dashboard Admin
Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

Route::get      ('/admin/dashboard/car-units', [CarUnitController::class, 'index'])->name('dashboard.car-units');
Route::post     ('/admin/dashboard/car-units/add', [CarUnitController::class, 'store'])->name('dashboard.car-units.add');
Route::get      ('/admin/dashboard/car-units/{carUnitId}/upload', [PhotoController::class, 'index'])->name('dashboard.car-units-photos');
Route::post     ('/admin/dashboard/car-units/{carUnitId}/upload-photos', [PhotoController::class, 'store']);
Route::delete   ('/admin/dashboard/car-units/{id}/delete', [CarUnitController::class, 'destroy']);
Route::put      ('/admin/dashboard/car-units/{id}/update', [CarUnitController::class, 'update']);
Route::delete   ('admin/dashboard/car-units/{carUnitId}/photos/{photoId}', [PhotoController::class, 'deletePhoto'])->name('car-units.photos.delete');


Route::get      ('/admin/dashboard/categories', [CategoryController::class, 'index'])->name('dashboard.categories');
Route::post     ('/admin/dashboard/categories/add', [CategoryController::class, 'store'])->name('dashboard.categories.add');
Route::delete   ('/admin/dashboard/categories/{id}/delete', [CategoryController::class, 'destroy']);
Route::put      ('/admin/dashboard/categories/{id}/update', [CategoryController::class, 'update']);

Route::get      ('/admin/dashboard/brands', [BrandController::class, 'index'])->name('dashboard.brands');
Route::post     ('/admin/dashboard/brands/add', [BrandController::class, 'store'])->name('dashboard.brands.add');
Route::delete   ('/admin/dashboard/brands/{id}/delete', [BrandController::class, 'destroy']);
Route::put      ('/admin/dashboard/brands/{id}/update', [BrandController::class, 'update']);

Route::get      ('/admin/dashboard/check-units', [CheckUnitController::class, 'index'])->name('dashboard.check-units');
Route::get      ('/admin/dashboard/check-units/{checkUnitId}', [CheckUnitController::class, 'show'])->name('check-units.detail');
Route::post     ('/rubah-status-check-unit', [CheckUnitController::class, 'rubahStatusCheckUnit']);
Route::put      ('/update-check-unit-status/{id}', [CheckUnitController::class, 'updateStatus']);

Route::get      ('/admin/dashboard/sales', [SaleController::class, 'index'])->name('dashboard.sales');
Route::get      ('/admin/dashboard/sales-titipan', [SaleController::class, 'indexTitipan'])->name('dashboard.sales-titipan');
Route::post     ('/save-sales-data', [SaleController::class, 'save']);
Route::post     ('/sales/store', [SaleController::class, 'store'])->name('sales.store');

Route::get('/api/categories', [CategoryController::class, 'getCategory']);
Route::get('/api/brands', [BrandController::class, 'getBrand']);

Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');

Route::post     ('/profile/update', [UserController::class, 'update'])->name('profile.update');
Route::get      ('/admin/dashboard/users', [UserController::class, 'index'])->name('dashboard.users');
Route::delete   ('/admin/dashboard/users/{id}/delete', [UserController::class, 'destroy']);
Route::put      ('/admin/dashboard/users/{id}/update', [UserController::class, 'update_table']);

Route::get      ('/admin/dashboard/data-mobil-titipan', [PengajuanTitipanController::class, 'index'])->name('dashboard.titipan');
Route::post     ('/pengajuan-titipan', [PengajuanTitipanController::class, 'store'])->name('pengajuan.store');
Route::post     ('/ubah-status-car-unit', [PengajuanTitipanController::class, 'changeStatus']);