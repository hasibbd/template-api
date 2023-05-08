<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Configuration\MenuAssignController;
use App\Http\Controllers\Configuration\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Configuration\MenuController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\UserController;
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

Route::middleware(['admin'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('user-list', [UserController::class, 'index'])->name('user-list.index');

    Route::get('menu-list', [MenuController::class, 'index']);
    Route::get('get-menu-list', [MenuController::class, 'getList']);
    Route::post('menu-store', [MenuController::class, 'store']);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile-info-change', [ProfileController::class, 'update']);

    Route::get('role', [RoleController::class, 'index'])->name('role.index');
    Route::post('role-store', [RoleController::class, 'store']);
    Route::get('role-show/{id}', [RoleController::class, 'edit']);
    Route::get('role-status/{id}', [RoleController::class, 'status']);
    Route::delete('role-delete/{id}', [RoleController::class, 'destroy']);

    Route::get('assign-menu/{id}', [MenuAssignController::class, 'index'])->name('assign-menu.index');
    Route::post('assign-menu-store', [MenuAssignController::class, 'store']);
    Route::get('assign-menu-show/{id}', [MenuAssignController::class, 'edit']);
    Route::get('assign-menu-status/{id}', [MenuAssignController::class, 'status']);
    Route::delete('assign-menu-delete/{id}', [MenuAssignController::class, 'destroy']);
});
Route::middleware(['user'])->group(function () {

});

Route::get('/', [AuthController::class, 'login'])->name('/');
Route::get('registration', [AuthController::class, 'registration']);
Route::get('forgot', [AuthController::class, 'forgot']);
Route::get('recover/{token}', [AuthController::class, 'recover']);

Route::post('user-create', [UserController::class, 'store']);
Route::post('user-forget', [UserController::class, 'forget']);
Route::post('reset-user-pass', [UserController::class, 'reset']);
Route::post('login-check', [DashboardController::class, 'index'])->middleware('login-check');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
