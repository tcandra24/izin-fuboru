<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => ['guest']], function () {
    Route::get('/', function(){
      return redirect('/login');
    });
    Route::get('/login', [App\Http\Controllers\AuthController::class, 'index']);
    Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [ App\Http\Controllers\DashboardController::class, 'index' ])
    ->middleware('permission:dashboard.index');

    Route::get('/transactions/izin-keluar', [ App\Http\Controllers\TransactionsApprovalController::class, 'index' ])
    ->middleware('permission:transaction-izin-keluar.index');

    Route::get('/report/izin-keluar/export', [\App\Http\Controllers\TransactionsApprovalController::class, 'excel']);

    Route::get('/report/izin-keluar/pdf', [\App\Http\Controllers\TransactionsApprovalController::class, 'pdf']);

    Route::get('/izin-keluar/{kodeIzin}/edit', [ App\Http\Controllers\IzinController::class, 'edit' ])
    ->middleware('permission:izin-keluar.edit');

    Route::get('/izin-keluar', [ App\Http\Controllers\IzinController::class, 'index' ])
    ->middleware('permission:izin-keluar.index');

    Route::get('/profile/change-password', [ App\Http\Controllers\Profile\ChangePasswordController::class, 'index' ])
    ->middleware('permission:change-password.index');

    Route::patch('/profile/change-password', [ App\Http\Controllers\Profile\ChangePasswordController::class, 'update' ]);

    Route::post('/izin-keluar', [ App\Http\Controllers\IzinController::class, 'update' ]);

    Route::get('/log-approval', [ App\Http\Controllers\LogApprovalController::class, 'index' ])
    ->middleware('permission:log-approval.index');

    Route::resource('/pengguna', App\Http\Controllers\UserController::class, [ 'except' => [ 'show' ] ])
    ->middleware('permission:pengguna.index|pengguna.create|pengguna.edit|pengguna.delete');

    Route::get('/permissions', [ \App\Http\Controllers\PermissionController::class, 'index' ])
    ->middleware('permission:permissions.index');

    Route::resource('/roles', \App\Http\Controllers\RoleController::class, [ 'except' => [ 'show' ] ])
    ->middleware('permission:roles.index|roles.create|roles.edit|roles.delete');

    Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
});
