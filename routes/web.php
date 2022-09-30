<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as HomeController;
use App\Http\Controllers\EmployeeController as EmployeeController;
use App\Http\Controllers\NotificationController as NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\ReceiptController;

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



Route::group(['middleware' => 'auth'], function () {
    Route::group([
        'perfix' => '/superadmin',
        'middleware' => 'is_superadmin',
        'as'         => 'superadmin.',
    ], function () {

        Route::get('superadmin/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('superadmin/profile', [ProfileController::class, 'index'])->name('profile.index');

        Route::get('superadmin/employees', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('superadmin/employees/show', [EmployeeController::class, 'show'])->name('employee.show');
        Route::put('superadmin/employees/store', [EmployeeController::class, 'store'])->name('employee.store');

        Route::get('superadmin/department', [DepartmentController::class, 'index'])->name('department');
        Route::put('superadmin/department/store', [DepartmentController::class, 'store'])->name('department.store');
    });

    Route::group([
        'perfix' => '/admin',
        'middleware' => 'is_admin',
        'as'         => 'admin.',
    ], function () {

        Route::get('admin/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('admin/profile', [ProfileController::class, 'index'])->name('profile.index');

        Route::get('admin/employees', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('admin/employees/show', [EmployeeController::class, 'show'])->name('employee.show');
        Route::put('admin/employees/store', [EmployeeController::class, 'store'])->name('employee.store');

        Route::get('admin/department', [DepartmentController::class, 'index'])->name('department');
        Route::put('admin/department/store', [DepartmentController::class, 'store'])->name('department.store');

        Route::get('admin/make_request', [NotificationController::class, 'index'])->name('notification');
        Route::put('admin/make_request/store', [NotificationController::class, 'store'])->name('notification.store');
    });

    Route::group([
        'perfix' => '/employee',
        'middleware' => 'is_employee',
        'as'         => 'employee.',
    ], function () {

        Route::get('employee/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('employee/profile', [ProfileController::class, 'index'])->name('profile.index');


        Route::get('employee/request/index', [RequestController::class, 'index'])->name('dashboard.index');
        Route::get('employee/request/show_request', [RequestController::class, 'show'])->name('dashboard.show');
        Route::get('employee/request/show_orders', [RequestController::class, 'show_orders'])->name('dashboard.orders');
        Route::get('employee/receipts', [ReceiptController::class, 'index'])->name('dashboard.receipts');
        Route::get('employee/receipts/pay/{id}', [ReceiptController::class, 'pay'])->name('receipts.pay');
        Route::get('employee/request/show_orders/delete/{id}', [RequestController::class, 'delete_accepted_request'])->name('dashboard.orders.delete');
                Route::get('employee/Request/inprogress_orders', [RequestController::class, 'inprogress_orders'])->name('dashboard.inprogress_orders');



        Route::get('employee/make_request', [NotificationController::class, 'index'])->name('notification');
        Route::get('employee/notification_details/{id}', [NotificationController::class, 'show'])->name('notification.details');
        Route::get('employee/notification_details/{id}/accept', [NotificationController::class, 'accept'])->name('notification.details.accept');

        Route::get('employee/make_offer/{id}', [OfferController::class, 'index'])->name('offer');
        Route::get('employee/show_offers/{id}', [OfferController::class, 'show'])->name('offer.show');

        Route::get('employee/send_to_manager/{id}', [NotificationController::class, 'send_to_manager'])->name('notification.send_to_manager');
        Route::put('employee/make_request/store', [NotificationController::class, 'store'])->name('notification.store');
        Route::put('employee/make_offer/{id}/store', [OfferController::class, 'store'])->name('offer.store');
    });

    Route::group([
        'perfix' => '/manager',
        'middleware' => 'is_manager',
        'as'         => 'manager.',
    ], function () {

        Route::get('manager/profile', [ProfileController::class, 'index'])->name('profile.index');

        Route::get('manager/dashboard', [HomeController::class, 'index'])->name('dashboard');
        Route::get('manager/notification_details/{id}', [NotificationController::class, 'show'])->name('notification.details');
        Route::get('manager/notification_details/{id}/dismiss', [NotificationController::class, 'dismiss'])->name('notification.details.dismiss');
        Route::get('manager/notification_details/{id}/approve', [NotificationController::class, 'approve'])->name('notification.details.approve');
        Route::put('manager/notification_details_for_order/{id}/approve', [NotificationController::class, 'approve'])->name('notification.order.details.approve');

        Route::get('manager/request/index', [RequestController::class, 'index'])->name('dashboard.index');
        Route::get('manager/request/show_request', [RequestController::class, 'show'])->name('dashboard.show');

        Route::get('manager/make_request', [NotificationController::class, 'index'])->name('notification');
        Route::put('manager/make_request/store', [NotificationController::class, 'store'])->name('notification.store');

        Route::get('manager/nostification_details_for_order/{id}', [NotificationController::class, 'show'])->name('notification.order.details');
    });
});



require __DIR__ . '/auth.php';
