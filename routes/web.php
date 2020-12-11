<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\BranchController;
// use App\Http\Controllers\DepartmentController;
// use App\Http\Controllers\LocationController;
// use App\Http\Controllers\ModelController;
// use App\Http\Controllers\RoleController;
// use App\Http\Controllers\StoreController;
use App\Http\Controllers\FormController;
// use App\Http\Controllers\UserController;
// use App\Http\Controllers\InventoryController;
// use App\Http\Controllers\VendorController;
// use App\Http\Controllers\MakeController;
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
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('/category', CategoryController::class);
Route::resource('/branch', BranchController::class);
Route::resource('/department', DepartmentController::class);
Route::resource('/location', LocationController::class);
Route::resource('/model', ModelController::class);
Route::resource('/role', RoleController::class);
Route::resource('/store', StoreController::class);
Route::resource('/user', UserController::class);
Route::resource('/inventory', InventoryController::class);
Route::resource('/vendor', VendorController::class);
Route::resource('/make', MakeController::class);

/* Forms */
Route::get('/add_category', [FormController::class, 'add_category']);
Route::get('/add_branch', [FormController::class, 'add_branch']);
Route::get('/add_department', [FormController::class, 'add_department']);
Route::get('/add_location', [FormController::class, 'add_location']);
Route::get('/add_model', [FormController::class, 'add_model']);
Route::get('/add_role', [FormController::class, 'add_role']);
Route::get('/add_store', [FormController::class, 'add_store']);
Route::get('/add_user', [FormController::class, 'add_user']);
Route::get('/add_inventory', [FormController::class, 'add_inventory']);
Route::get('/add_vendor', [FormController::class, 'add_vendor']);
Route::get('/add_make', [FormController::class, 'add_make']);
Route::get('/issue_inventory', [FormController::class, 'issue_inventory']);