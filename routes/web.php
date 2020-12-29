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
    return redirect('login');
    //return view('welcome');
});

Auth::routes();


Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

Route::resource('/category', CategoryController::class)->middleware('role:1');
//Route::resource('/branch', BranchController::class)->middleware('role:1');
//Route::resource('/department', DepartmentController::class)->middleware('role:1');
//Route::resource('/location', LocationController::class)->middleware('role:1');
Route::resource('/model', ModelController::class)->middleware('role:1');
Route::resource('/role', RoleController::class)->middleware('role:1');
Route::resource('/store', StoreController::class)->middleware('role:1');
Route::resource('/user', UserController::class)->middleware('role:1');
Route::resource('/inventory', InventoryController::class);
Route::resource('/vendor', VendorController::class)->middleware('role:1');
Route::resource('/make', MakeController::class)->middleware('role:1');

/* Forms */
Route::get('/add_category', [FormController::class, 'add_category'])->middleware('role:1');
//Route::get('/add_branch', [FormController::class, 'add_branch'])->middleware('role:1');
//Route::get('/add_department', [FormController::class, 'add_department'])->middleware('role:1');
//Route::get('/add_location', [FormController::class, 'add_location'])->middleware('role:1');
Route::get('/add_model', [FormController::class, 'add_model'])->middleware('role:1');
Route::get('/add_role', [FormController::class, 'add_role'])->middleware('role:1');
Route::get('/add_store', [FormController::class, 'add_store'])->middleware('role:1');
Route::get('/add_user', [FormController::class, 'add_user'])->middleware('role:1');
Route::get('/add_vendor', [FormController::class, 'add_vendor'])->middleware('role:1');
Route::get('/add_make', [FormController::class, 'add_make'])->middleware('role:1');

Route::get('/add_inventory', [FormController::class, 'add_inventory']);
Route::get('/add_with_grn', [FormController::class, 'add_with_grn']);
Route::get('/pendings', [FormController::class, 'pendings']);
Route::get('/pending_gins', [FormController::class, 'pending_gins']);
Route::get('/issue_inventory', [FormController::class, 'issue_inventory']);
Route::get('/issue_with_gin', [FormController::class, 'issue_with_gin']);
Route::get('/transfer_inventory', [FormController::class, 'transfer_inventory']);
Route::get('/return_inventory', [FormController::class, 'return_inventory']);
Route::get('/repair', [FormController::class, 'repair']);

Route::post('/issue', 'FormController@submitt_issue');
Route::post('/submit_gin', 'FormController@submit_gin');
Route::post('/transfer', 'FormController@submitt_transfer');
Route::get('/filter_inventory', 'FormController@filter_inventory');
Route::post('/return', 'FormController@submitt_return');
Route::get('/filter_return', 'FormController@filter_return');
Route::post('/repair_inventory', 'FormController@repair_inventory');
Route::post('/process_to_grn', 'GrnController@create_grn');
Route::post('/process_to_gin', 'GinController@create_gin');
