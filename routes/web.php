<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ModelController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\MakeController;
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


// Route::get('/', function () {
//     //return view('welcome');
//     return redirect('login');
// });

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');

//Route::get('/dashboard', [DashboardController::class, 'index']);
Route::middleware(['auth:sanctum', 'verified'])->resource('/category', CategoryController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/branch', BranchController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/department', DepartmentController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/location', LocationController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/model', ModelController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/role', RoleController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/store', StoreController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/user', UserController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/inventory', InventoryController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/vendor', VendorController::class);
Route::middleware(['auth:sanctum', 'verified'])->resource('/make', MakeController::class);

/* Forms */
Route::middleware(['auth:sanctum', 'verified'])->get('/add_category', [FormController::class, 'add_category']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_branch', [FormController::class, 'add_branch']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_department', [FormController::class, 'add_department']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_location', [FormController::class, 'add_location']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_model', [FormController::class, 'add_model']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_role', [FormController::class, 'add_role']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_store', [FormController::class, 'add_store']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_user', [FormController::class, 'add_user']);
Route::get('/add_inventory', [FormController::class, 'add_inventory']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_vendor', [FormController::class, 'add_vendor']);
Route::middleware(['auth:sanctum', 'verified'])->get('/add_make', [FormController::class, 'add_make']);
Route::middleware(['auth:sanctum', 'verified'])->get('/issue_inventory', [FormController::class, 'issue_inventory']);