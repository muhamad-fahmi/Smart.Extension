<?php

use App\Http\Controllers\Admin\DeviceCategoryController;
use App\Http\Controllers\Admin\DeviceController;
use App\Http\Controllers\Admin\DeviceSensorController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\HomeController as UserHomeController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\User\MyDeviceController;
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

// INDEX
Route::get('/', [PublicController::class, 'index']);
// AUTH
Route::post('/system/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/system/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/system/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/system/register', [AuthController::class, 'showregist'])->name('register');
Route::get('/system/register/verify/{id}', [AuthController::class, 'verify'])->name('verifikasi');


Route::group(['middleware' => 'auth'], function () {
    // ADMIN
    Route::prefix('system/admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/invoices/rejected', [HomeController::class, 'get_rejected'])->name('invoices.rejected');

        Route::prefix('/devices')->group(function () {
            Route::get('/manage', [DeviceController::class, 'index'])->name('device.manage');
            Route::get('/manage/{category_slug}', [DeviceController::class, 'show_by_category'])->name('device.show_by_category');
            Route::get('/create', [DeviceController::class, 'create'])->name('device.create');
            Route::post('/create', [DeviceController::class, 'store'])->name('device.store');
            Route::get('/{id}/edit', [DeviceController::class, 'edit'])->name('device.edit');
            Route::put('/update/{id}', [DeviceController::class, 'update'])->name('device.update');
            Route::delete('/delete/{id}', [DeviceController::class, 'destroy'])->name('device.delete');
        });

        Route::prefix('/device-category')->group(function () {
            Route::get('/manage', [DeviceCategoryController::class, 'index'])->name('device.category.manage');
            Route::get('/create', [DeviceCategoryController::class, 'create'])->name('device.category.create');
            Route::post('/create', [DeviceCategoryController::class, 'store'])->name('device.category.store');
            Route::get('/edit/{id}', [DeviceCategoryController::class, 'edit'])->name('device.category.edit');
            Route::put('/update/{id}', [DeviceCategoryController::class, 'update'])->name('device.category.update');
            Route::delete('/delete/{id}', [DeviceCategoryController::class, 'destroy'])->name('device.category.delete');
        });

        Route::prefix('/device-sensor')->group(function () {
            Route::get('/manage', [DeviceSensorController::class, 'index'])->name('device.sensor.manage');
            Route::get('/create', [DeviceSensorController::class, 'create'])->name('device.sensor.create');
            Route::post('/create', [DeviceSensorController::class, 'store'])->name('device.sensor.store');
            Route::get('/edit/{id}', [DeviceSensorController::class, 'edit'])->name('device.sensor.edit');
            Route::put('/update/{id}', [DeviceSensorController::class, 'update'])->name('device.sensor.update');
            Route::delete('/delete/{id}', [DeviceSensorController::class, 'destroy'])->name('device.sensor.delete');
        });

        Route::prefix('/user')->group(function () {
            Route::get('/manage', [UserController::class, 'index'])->name('user.manage');
            Route::put('/enable/{id}', [UserController::class, 'enable'])->name('user.enable');
            Route::put('/disable/{id}', [UserController::class, 'disable'])->name('user.disable');
        });


    });
    // CUSTOMER
    Route::prefix('system/customer')->name('customer.')->middleware('customer')->group(function () {
        Route::get('/dashboard', [UserHomeController::class, 'dashboard'])->name('dashboard');

        Route::prefix('/my-device')->group(function () {
            Route::get('/manage', [MyDeviceController::class, 'index'])->name('device.manage');
            Route::get('/create', [MyDeviceController::class, 'create'])->name('device.create');
            Route::get('/validate/{device_id}', [MyDeviceController::class, 'validate_device'])->name('device.validate');
            Route::post('/create', [MyDeviceController::class, 'store'])->name('device.store');
            Route::put('/update/{id}', [MyDeviceController::class, 'update'])->name('device.update');
            Route::delete('/delete/{id}', [MyDeviceController::class, 'delete'])->name('device.delete');
            Route::get('/show/{device_id}', [MyDeviceController::class, 'show_device'])->name('device.show');
            Route::get('/sensor/{device_id}', [MyDeviceController::class, 'sub'])->name('device.sub');
            Route::post('/sensor/{device_id}/{switch}', [MyDeviceController::class, 'pub'])->name('device.pub');


            Route::post('/reset/{device_id}', [MyDeviceController::class, 'reset'])->name('device.reset');
        });

    });

    // ERROR PERMISSION
    Route::get('error-permission', [ErrorController::class, 'error_permission'])->name('error-permission');
    // LOGOUT
    Route::get('/system/logout', [AuthController::class, 'logout'])->name('logout');
});