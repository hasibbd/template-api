<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
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


Route::middleware(['permission-check'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('user-list', [ListController::class, 'index'])->name('user-list.index');
    Route::get('menu-list', [MenuController::class, 'index']);
    Route::get('get-menu-list', [MenuController::class, 'getList']);
    Route::post('menu-store', [MenuController::class, 'store']);
    Route::get('profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('profile-info-change', [ProfileController::class, 'update']);
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

Route::group(['middleware' => ['auth']], function() {
   // Route::resource('users', UserController::class);
    Route::get('role-list', [RoleController::class, 'index'])->name('role-list.index');
    Route::get('role-status/{id}', [RoleController::class, 'status']);
    Route::post('role-permission-store', [RoleController::class, 'storePermission']);
    Route::get('role-show/{id}', [RoleController::class, 'show']);
    Route::get('all-role-show', [RoleController::class, 'showAll']);
    Route::get('permission-list', [PermissionController::class, 'index'])->name('permission-list.index');
    Route::get('permission-status/{id}', [PermissionController::class, 'status']);
    Route::get('permission-show/{id}', [PermissionController::class, 'show']);
    Route::delete('permission-delete/{id}', [PermissionController::class, 'destroy']);
    Route::post('permission-store', [PermissionController::class, 'store']);


    Route::get('privilege-list', [PermissionController::class, 'index2'])->name('privilege-list.index');
   // Route::resource('roles', RoleController::class);
   // Route::resource('permissions', PermissionController::class);
});
