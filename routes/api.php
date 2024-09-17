<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SideNavController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('profileData', [ApiController::class, 'ProfileData'])->name('profileData');
Route::post('login', [ApiController::class, 'login'])->name('login');
Route::post('menus', [ApiController::class, 'menuData'])->name('menus');

// Screen Routes
Route::get('screens', [ApiController::class, 'screenData'])->name('screens');
Route::post('create-update-screen', [ApiController::class, 'createUpdateScreen'])->name('create-update-screen');
Route::get('screens/{id}/edit', [ApiController::class, 'edit'])->name('screens.edit');
Route::delete('screens/{id}', [ApiController::class, 'destroy'])->name('screens.destroy');

// Screen Permission Routes
Route::get('roles', [ApiController::class, 'roleList']);
Route::post('create-update-screen-permission', [ApiController::class, 'createUpdateScreenPermission'])->name('create-update-screen-permission');
Route::get('screen-permissions', [ApiController::class, 'screenPermissionData'])->name('screen-permissions');
Route::get('permissions/{id}/edit', [ApiController::class, 'editPermission']);
Route::delete('permissions/{id}/delete', [ApiController::class, 'deletePermission']);

// Menu Items
Route::get('menuitems', [ApiController::class, 'menuItems'])->name('menuitems');
Route::post('create-update-menu-item', [ApiController::class, 'createUpdateMenuItem']);
Route::get('menuItems/{id}/edit', [ApiController::class, 'editMenuItem']);
Route::delete('menuItems/{id}/delete', [ApiController::class, 'deleteMenuItem']);

Route::post('menu', [MenuController::class, 'menuList'])->name('menu');

