<?php
 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\RoleController;
use App\Http\Middleware\CheckRole;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function () {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
});

Route::group([
    'middleware' => ['api', 'auth:api'],
    'prefix' => 'employees'
], function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('{id}', [EmployeeController::class, 'tampil']);

    Route::middleware(CheckRole::class.':admin,manager')->group(function (){
        Route::post('/', [EmployeeController::class, 'tambah']);
        Route::put('{id}', [EmployeeController::class, 'edit']);
        Route::put('{id}', [EmployeeController::class, 'hapus']);
    });
});

Route::group([
    'middleware' => ['api', 'auth:api', CheckRole::class.':admin,manager'],
    'prefix' => 'companies'
], function () {
    Route::get('/', [CompanyController::class, 'index']);
    Route::get('{id}', [CompanyController::class, 'show']);
    Route::post('/', [CompanyController::class, 'tambah']);
    Route::put('{id}', [CompanyController::class, 'edit']);
    Route::put('{id}', [CompanyController::class, 'hapus']);
});

Route::group([
    'middleware' => ['api', 'auth:api', CheckRole::class.':admin,manager'],
    'prefix' => 'roles'
], function () {
    Route::get('/', [RoleController::class, 'index']);
    Route::get('{id}', [RoleController::class, 'show']);
    Route::post('/', [RoleController::class, 'tambah']);
    Route::put('{id}', [RoleController::class, 'edit']);
    Route::put('{id}', [RoleController::class, 'hapus']);
});