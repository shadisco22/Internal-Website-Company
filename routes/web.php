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

        Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

        Route::get('/employees', [EmployeeController::class, 'index'])->name('employee.index');

        Route::get('/department', [DepartmentController::class, 'index'])->name('department');
        Route::put('/department/store', [DepartmentController::class, 'store'])->name('department.store');

    });
});



require __DIR__ . '/auth.php';
