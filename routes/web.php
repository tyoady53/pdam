<?php

use App\Http\Controllers\BenchMarkScoreController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\CustomerBillingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MasterBillingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SetupProgramController;
use App\Http\Controllers\UserController;

Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register',         [RegisterController::class, 'create'])->middleware('guest')->name('register');
	Route::post('/register',        [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
	Route::get('/login',            [LoginController::class, 'show'])->middleware('guest')->name('login');
	Route::post('/login',           [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
	Route::get('/reset-password',   [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
	Route::post('/reset-password',  [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
	Route::get('/change-password',  [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
	Route::get('/dashboard',        [HomeController::class, 'index'])->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality',  [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl',              [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile',          [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile',         [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static',   [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static',   [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static',   [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}',           [PageController::class, 'index'])->name('page');
	Route::post('logout',           [LoginController::class, 'logout'])->name('logout');

    Route::prefix('setup')->group(function () {
        Route::get('/index',        [SetupProgramController::class, 'index'])->name('setup.index');
        Route::post('/update',      [SetupProgramController::class, 'update'])->name('setup.update');
    });

    Route::prefix('report')->group(function () {
        Route::get('/index',        [HomeController::class, 'report'])->name('report.index');
        Route::get('/print',        [HomeController::class, 'report_print'])->name('report.print');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/index',            [CustomerController::class, 'index'])->name('customer.index');
        Route::get('/edit/{slug}',      [CustomerController::class, 'edit'])->name('customer.edit');
        Route::get('/create',           [CustomerController::class, 'create'])->name('customer.create');
        Route::post('/update/{slug}',   [CustomerController::class, 'update'])->name('customer.update');
        Route::post('/store',           [CustomerController::class, 'store'])->name('customer.store');
    });

    Route::prefix('billing')->group(function () {
        Route::get('/index',                        [CustomerBillingController::class, 'index'])->name('billing.index');
        Route::get('/edit/{slug}',                  [CustomerBillingController::class, 'edit'])->name('billing.edit');
        Route::get('/create/{slug}',                [CustomerBillingController::class, 'create'])->name('billing.create');
        Route::post('/update/{slug}',               [CustomerBillingController::class, 'update'])->name('billing.update');
        Route::post('/store/{slug}',                [CustomerBillingController::class, 'store'])->name('billing.store');
        Route::get('/pay/{slug}',                   [CustomerBillingController::class, 'show'])->name('billing.pay');
        Route::get('/pay/print/{slug}/{date}',      [CustomerBillingController::class, 'print'])->name('billing.print');
        Route::get('/pay/payment/{slug}/{date}',    [CustomerBillingController::class, 'payment'])->name('billing.payment');
        Route::get('/pay/kwitansi/{slug}/{date}',   [CustomerBillingController::class, 'kwitansi'])->name('billing.kwitansi');
    });

    Route::prefix('payment')->group(function () {
        Route::get('/index',            [PaymentController::class, 'index'] )->name('payment.index');
        Route::get('/edit/{slug}',      [PaymentController::class, 'edit']  )->name('payment.edit');
        Route::get('/create',           [PaymentController::class, 'create'])->name('payment.create');
        Route::post('/update/{slug}',   [PaymentController::class, 'update'])->name('payment.update');
        Route::post('/store',           [PaymentController::class, 'store'] )->name('payment.store');
        Route::post('/payment/{id}',    [PaymentController::class, 'payment'] )->name('payment.payment');
        Route::post('/pays/{id}',       [PaymentController::class, 'pays'] )->name('payment.pays');
        Route::get('/print/{id}',       [PaymentController::class, 'print'] )->name('payment.print');
        Route::get('/sync',             [PaymentController::class, 'sync'] )->name('payment.sync');
        Route::get('/get/{id}',         [PaymentController::class, 'get'] )->name('payment.get');
    });

    Route::prefix('master-bill')->group(function () {
        Route::get('/index',            [MasterBillingController::class, 'index'])->name('master-bill.index');
        Route::get('/edit/{slug}',      [MasterBillingController::class, 'edit'])->name('master-bill.edit');
        Route::get('/create',           [MasterBillingController::class, 'create'])->name('master-bill.create');
        Route::post('/update/{slug}',   [MasterBillingController::class, 'update'])->name('master-bill.update');
        Route::post('/store',           [MasterBillingController::class, 'store'])->name('master-bill.store');
    });

    Route::prefix('user')->group(function () {
        Route::get('/index',            [UserController::class, 'index'])->name('user.index');
        Route::get('/edit/{slug}',      [UserController::class, 'edit'])->name('user.edit');
        Route::get('/create',           [UserController::class, 'create'])->name('user.create');
        Route::post('/update/{slug}',   [UserController::class, 'update'])->name('user.update');
        Route::post('/store',           [UserController::class, 'store'])->name('user.store');
        Route::post('/change_password', [UserController::class, 'change_password'])->name('user.change_password');
        Route::get('/reset_pass/{id}',  [UserController::class, 'reset_password'])->name('user.reset_password');
    });

    Route::prefix('role')->group(function () {
        Route::get('/index',            [RoleController::class, 'index'])->name('role.index');
        Route::get('/create',           [RoleController::class, 'create'])->name('role.create');
        Route::get('/edit/{slug}',      [RoleController::class, 'edit'])->name('role.edit');
        Route::post('/store',           [RoleController::class, 'store'])->name('role.store');
        Route::post('/update/{slug}',   [RoleController::class, 'update'])->name('role.update');
        Route::get('/show',             [RoleController::class, 'show'])->name('role.show');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/index',            [PermissionController::class, 'index'])->name('permission.index');
        Route::get('/create',           [PermissionController::class, 'create'])->name('permission.create');
        Route::get('/edit/{slug}',      [PermissionController::class, 'edit'])->name('permission.edit');
        Route::post('/store',           [PermissionController::class, 'store'])->name('permission.store');
        Route::post('/update/{slug}',   [PermissionController::class, 'update'])->name('permission.update');
        Route::get('/show',             [PermissionController::class, 'show'])->name('permission.show');
    });
});
