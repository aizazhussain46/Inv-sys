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
use App\Http\Controllers\ApiController;
use App\Http\Controllers\PDFController;
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
Route::resource('/sub_category', SubcategoryController::class)->middleware('role:1');
//Route::resource('/branch', BranchController::class)->middleware('role:1');
//Route::resource('/department', DepartmentController::class)->middleware('role:1');
Route::resource('/location', LocationController::class)->middleware('role:1');
Route::resource('/link', LinkController::class)->middleware('role:1');
Route::resource('/model', modelController::class)->middleware('role:1');
Route::resource('/role', RoleController::class)->middleware('role:1');
Route::resource('/store', StoreController::class)->middleware('role:1');
Route::resource('/user', UserController::class)->middleware('role:1');
Route::resource('/employee', EmployeeController::class)->middleware('role:1');
Route::resource('/inventory', InventoryController::class);
Route::resource('/vendor', VendorController::class)->middleware('role:1');
Route::resource('/make', MakeController::class)->middleware('role:1');
Route::resource('/devicetype', DevicetypeController::class)->middleware('role:1');
Route::resource('/itemnature', ItemnatureController::class)->middleware('role:1');
Route::resource('/inventorytype', InventorytypeController::class)->middleware('role:1');
Route::resource('/dollars', DollarController::class);
Route::resource('/types', TypeController::class);
Route::resource('/years', YearController::class);
Route::resource('/budget', BudgetController::class);

/* Forms */
Route::get('/add_category', [FormController::class, 'add_category'])->middleware('role:1');
Route::get('/add_subcategory', [FormController::class, 'add_subcategory'])->middleware('role:1');
//Route::get('/add_branch', [FormController::class, 'add_branch'])->middleware('role:1');
//Route::get('/add_department', [FormController::class, 'add_department'])->middleware('role:1');
Route::get('/add_location', [FormController::class, 'add_location'])->middleware('role:1');
Route::get('/add_model', [FormController::class, 'add_model'])->middleware('role:1');
//Route::get('/add_role', [FormController::class, 'add_role'])->middleware('role:1');
Route::get('/add_store', [FormController::class, 'add_store'])->middleware('role:1');
Route::get('/add_user', [FormController::class, 'add_user'])->middleware('role:1');
Route::get('/add_vendor', [FormController::class, 'add_vendor'])->middleware('role:1');
Route::get('/add_make', [FormController::class, 'add_make'])->middleware('role:1');
Route::get('/add_employee', [FormController::class, 'add_employee'])->middleware('role:1');
Route::get('/add_devicetype', [FormController::class, 'add_devicetype'])->middleware('role:1');
Route::get('/add_itemnature', [FormController::class, 'add_itemnature'])->middleware('role:1');
Route::get('/add_inventorytype', [FormController::class, 'add_inventorytype'])->middleware('role:1');
Route::get('/model_by_make/{id}', [FormController::class, 'model_by_make']);
Route::get('/subcat_by_category/{id}', [FormController::class, 'subcat_by_category']);
Route::get('/get_grns', 'GrnController@get_grns')->middleware('role:1');
Route::post('/filter_grn', 'GrnController@filter_grn')->middleware('role:1');
Route::get('/get_gins', 'GinController@get_gins')->middleware('role:1');
Route::post('/filter_gin', 'GinController@filter_gin')->middleware('role:1');
Route::get('generate-grn/{id}/{from}/{to}','PDFController@generateGRN')->middleware('role:1');
Route::get('generate-gin/{id}/{from}/{to}','PDFController@generateGIN')->middleware('role:1');

Route::get('/add_inventory', [FormController::class, 'add_inventory']);
Route::get('/add_with_grn', [FormController::class, 'add_with_grn']);
Route::get('/pendings', [FormController::class, 'pendings']);
Route::get('/pending_gins', [FormController::class, 'pending_gins']);
Route::get('/issue_inventory', [FormController::class, 'issue_inventory']);
Route::get('/issue_with_gin', [FormController::class, 'issue_with_gin']);
Route::get('/transfer_inventory', [FormController::class, 'transfer_inventory']);
Route::get('/return_inventory', [FormController::class, 'return_inventory']);
Route::get('/repair', [FormController::class, 'repair']);
Route::get('/add_dollar_price', [FormController::class, 'add_dollar_price']);
Route::get('/add_year', [FormController::class, 'add_year']);
Route::get('/add_type', [FormController::class, 'add_type']);
Route::get('/add_budget', [FormController::class, 'add_budget']);
Route::get('/show_budget', [FormController::class, 'show_budget']);
Route::get('/summary', [FormController::class, 'summary']);
Route::get('/pkr_by_year/{id}', [FormController::class, 'pkr_by_year']);
Route::get('/budget_by_year', 'BudgetController@budget_by_year');
Route::post('/summary_by_year', 'BudgetController@summary_by_year');
Route::get('/lock_budget/{id}', 'BudgetController@lock_budget');

Route::post('/issue', 'FormController@submitt_issue');
Route::post('/submit_gin', 'FormController@submit_gin');
Route::post('/transfer', 'FormController@submitt_transfer');
Route::get('/filter_inventory', 'FormController@filter_inventory');
Route::post('/return', 'FormController@submitt_return');
Route::get('/filter_return', 'FormController@filter_return');
Route::post('/repair_inventory', 'FormController@repair_inventory');
Route::post('/process_to_grn', 'GrnController@create_grn');
Route::post('/process_to_gin', 'GinController@create_gin');

Route::get('/get_employee/{id}', 'EmployeeController@get_employee');
Route::get('generate-pdf','PDFController@generatePDF');

Route::get('budgetexport/{data}','PDFController@budgetexport');
Route::get('itemexport/{data}','PDFController@itemexport');

Route::get('/show_inventory_list', 'ReportController@show_inventory');
Route::get('inventoryexport/{data}','PDFController@inventoryexport');
Route::get('/item_detail/{id}', 'InventoryController@item_detail');
Route::get('/balance_report', 'ReportController@balance_report');
Route::get('/balanceexport/{data}','PDFController@balanceexport');
Route::get('/check_product/{pro}', 'InventoryController@check_product');
Route::get('/get_price/{id}', 'InventoryController@get_price');
Route::get('/get_inv_items/{id}', 'InventoryController@get_inv_items');
Route::get('/get_budget_items/{year_id}/{inv_id}/{dept_id}', 'BudgetController@get_budget_items');

Route::get('/edit_logs', 'ReportController@edit_logs');
Route::get('/editlogsexport/{data}','PDFController@editlogsexport');
Route::get('/inventory_in', 'ReportController@inventory_in');
Route::get('/inventoryinexport/{data}','PDFController@inventoryinexport');
Route::get('/inventory_out', 'ReportController@inventory_out');
Route::get('/inventoryoutexport/{data}','PDFController@inventoryoutexport');
Route::get('/bin_card', 'ReportController@bin_card');
Route::get('/bincardexport/{data}','PDFController@bincardexport');
Route::get('/asset_repairing', 'ReportController@asset_repairing');
Route::get('/repairingexport/{data}','PDFController@repairingexport');
Route::get('/disposal', 'ReportController@disposal');
Route::get('/disposalexport/{data}','PDFController@disposalexport');
Route::get('/vendor_buying', 'ReportController@vendor_buying');
Route::get('/vendor_buyingexport/{data}','PDFController@vendor_buyingexport');

Route::get('/activeinactive/{id}/{data}','UserController@activeinactive');

