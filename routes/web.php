<?php

use App\Http\Controllers\DepartmentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController as HomeController;
use App\Http\Controllers\EmployeeController as EmployeeController;

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

        Route::get('admin/employees', [EmployeeController::class, 'index'])->name('employee.index');
        Route::get('admin/employees/show', [EmployeeController::class, 'show'])->name('employee.show');
        Route::put('admin/employees/store', [EmployeeController::class, 'store'])->name('employee.store');

        Route::get('admin/department', [DepartmentController::class, 'index'])->name('department');
        Route::put('admin/department/store', [DepartmentController::class, 'store'])->name('department.store');
    });
});



require __DIR__ . '/auth.php';
