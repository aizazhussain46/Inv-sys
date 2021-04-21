<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Subcategory;
use App\Location;
use App\Department;
use App\Branch;
use App\Store;
use App\Modal;
use App\Makee;
use App\Vendor;
use App\Devicetype;
use App\Itemnature;
use App\Inventorytype;
use App\Role;
use App\User;
use App\Issue;
use App\Transfer;
use App\Rturn;
use App\Inventory;
use App\Repairing;
use App\Employee;
use App\Year;
use App\Dollar;
use App\Type;
use App\Budgetitem as Budget;
class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add_category(){
        return view('add_category');
    }
    public function add_subcategory(){
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('add_subcategory', ['categories' => $category]);
    }
    public function add_branch(){
        return view('add_branch');
    }
    public function add_department(){
        return view('add_department');
    }
    public function add_location(){
        return view('add_location');
    }
    public function add_model(){
        $make = Makee::where('status',1)->orderBy('make_name', 'asc')->get();
        return view('add_model', ['makes' => $make]);
    }
    public function add_role(){
        return view('add_role');
    }
    public function add_devicetype(){
        return view('add_devicetype');
    }
    public function add_itemnature(){
        return view('add_itemnature');
    }
    public function add_inventorytype(){
        return view('add_inventorytype');
    }
    public function add_dollar_price(){
        $year = Year::orderBy('year', 'asc')->get();
        return view('add_dollar_price', ['years' => $year]);
    }
    public function add_year(){
        return view('add_year');
    }
    public function add_type(){
        return view('add_type');
    }
    public function add_budget(){
        $data = array();
        $data['categories'] = Category::where('status',1)->orderBy('category_name', 'asc')->get();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        $data['types'] = Type::orderBy('type', 'asc')->get();
        $data['years'] = Year::where('locked', null)->orderBy('year', 'asc')->get();
        return view('add_budget', $data);
    }
    public function show_budget(){
        $data = array();
        $data['years'] = Year::orderBy('year', 'asc')->get();
        $data['categories'] = Category::where('status',1)->orderBy('category_name', 'asc')->get();
        $data['budgets'] = array();
        $data['filters'] = (object)array('catid'=>'', 'yearid'=>'');
        return view('show_budget', $data);
    }
    public function summary(){
        
        return view('summary', ['filter'=>'', 'types'=>array(), 'years'=>Year::orderBy('year', 'asc')->get()]);
    }

    public function add_store(){
        $user = User::where('role_id',2)->orderBy('name', 'asc')->get();
        $location = Location::orderBy('location', 'asc')->get();
        return view('add_store', ['users' => $user, 'locations' => $location]);
    }
    public function add_user(){
        $role = Role::orderBy('role', 'asc')->get();
        return view('add_user', ['roles'=>$role]);
    }
    public function add_employee(){
        return view('add_employee');
    }
    public function add_inventory(){
        $data = array();
        $data['categories'] = Category::where('status',1)->orderBy('category_name', 'asc')->get();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        // $data['departments'] = Department::where('status',1)->get();
        $data['locations'] = Location::orderBy('location', 'asc')->get();
        // $data['branches'] = Branch::where('status',1)->get();
        $data['stores'] = Store::orderBy('store_name', 'asc')->get();
        $data['models'] = Modal::where('status',1)->orderBy('model_name', 'asc')->get();
        $data['makes'] = Makee::where('status',1)->orderBy('make_name', 'asc')->get();
        $data['vendors'] = Vendor::orderBy('vendor_name', 'asc')->get();
        $data['devicetypes'] = Devicetype::where('status',1)->orderBy('devicetype_name', 'asc')->get();
        $data['itemnatures'] = Itemnature::where('status',1)->orderBy('itemnature_name', 'asc')->get();
        $data['inventorytypes'] = Inventorytype::where('status',1)->orderBy('inventorytype_name', 'asc')->get();
        return view('add_inventory', $data);
    }
    public function add_with_grn(){
        $data = array();
        $data['categories'] = Category::where('status',1)->orderBy('category_name', 'asc')->get();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        // $data['departments'] = Department::where('status',1)->get();
        $data['locations'] = Location::orderBy('location', 'asc')->get();
        // $data['branches'] = Branch::where('status',1)->get();
        $data['stores'] = Store::orderBy('store_name', 'asc')->get();
        $data['models'] = Modal::where('status',1)->orderBy('model_name', 'asc')->get();
        $data['makes'] = Makee::where('status',1)->orderBy('make_name', 'asc')->get();
        $data['vendors'] = Vendor::orderBy('vendor_name', 'asc')->get();
        $data['devicetypes'] = Devicetype::where('status',1)->orderBy('devicetype_name', 'asc')->get();
        $data['itemnatures'] = Itemnature::where('status',1)->orderBy('itemnature_name', 'asc')->get();
        $data['inventorytypes'] = Inventorytype::where('status',1)->orderBy('inventorytype_name', 'asc')->get();
        return view('addwithgrn', $data);
    }
    public function add_make(){
        return view('add_make');
    }
    public function add_vendor(){
        return view('add_vendor');
    }
    public function issue_inventory(){
        $inventory = Inventory::where('issued_to', NULL)->whereIn('status', [1,2])->orderBy('id', 'desc')->get();
        $year = Year::where('locked', null)->orderBy('year', 'asc')->get();
        $categories = Category::where('status',1)->orderBy('category_name', 'asc')->get();
        return view('issue_inventory', ['years'=> $year,'inventories' => $inventory, 'categories' => $categories]);
    }
    public function submitt_issue(Request $request){
        
        $validator = Validator::make($request->all(), [
            'inv_id' => 'required',
            'employee_code' => 'required',
            'year_id' => 'required',
            'budget_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $employee = Employee::where('emp_code',$request->employee_code)->first();
        $dept_id = $employee->dept_id;
        
            $budget = Budget::where('dept_id', $dept_id)->where('year_id', $request->year_id)->whereIn('id', $request->budget_id)->get(); 
        
            if(empty($budget)){
                return redirect()->back()->with('msg','Budget not available in this employee`s department');
            }
        //echo "<pre>";
        $itemnames = null;
        $itemsin = null;
        $available = false;
        $loggedin_user = Auth::id();
        foreach($request->inv_id as $id){
            $inventory = Inventory::find($id);
            $budgets = Budget::where('dept_id', $dept_id)->where('year_id', $request->year_id)->where('subcategory_id', $inventory->subcategory_id)->whereIn('id', $request->budget_id)->get();
              
                if(count($budgets) == 0){
                    $itemnames .= $inventory->subcategory->sub_cat_name.', ';
                }   
                else{
                    foreach($budgets as $b){
                        if($b->consumed < $b->qty){
                            $budget = $b;
                            break;
                        }
                        else{
                            $budget = $b;
                        }
                    }
                     
                    if($budget->consumed >= $budget->qty){
                        $itemnames .= $inventory->subcategory->sub_cat_name.', ';
                        
                    }
                    else{
                        $b_fields = array(
                                    'consumed' => $budget->consumed+1,
                                    'remaining' => $budget->remaining-1
                        );
                        $available = true;
                    $itemsin .= $inventory->subcategory->sub_cat_name.', ';
                    $b_fields = array(
                               'consumed' => $budget->consumed+1,
                               'remaining' => $budget->remaining-1
                                );
                    $b_update = Budget::where('id',$budget->id)->update($b_fields);
                    $update = Inventory::where('id',$id)->update(['issued_to'=>$request->employee_code, 'year_id'=>$request->year_id, 'issued_by'=>$loggedin_user]);
                    $insert = Issue::create(['employee_id'=>$request->employee_code, 'inventory_id'=>$id, 'year_id'=>$request->year_id, 'remarks'=>$request->remarks]);
                    }
                }
        }
        
        $itemnames = rtrim($itemnames, ", ");
        $itemsin = rtrim($itemsin, ", ");
        
        if($available == true && $itemnames == null){
            return redirect()->back()->with('msg','Selected inventory issued to '.$employee->name);
        }
        else if($available == true && $itemnames != null){
            return redirect()->back()->with('msg', $itemsin.' issued to '.$employee->name.', '.$itemnames.' not available in budget!');
        }
        else{
            return redirect()->back()->with('msg','Budget not available for selected inventory');
        }
    }
    public function issue_with_gin(){
        $inventory = Inventory::where('issued_to', NULL)->whereIn('status', [1,2])->orderBy('id', 'desc')->get();
        $year = Year::where('locked', null)->orderBy('year', 'asc')->get();
        $categories = Category::where('status',1)->orderBy('category_name', 'asc')->get();
        return view('issuewithgin', ['years'=> $year,'inventories' => $inventory, 'categories' => $categories]);
    }
    public function submit_gin(Request $request){
        
        $validator = Validator::make($request->all(), [
            'inv_id' => 'required',
            'employee_code' => 'required',
            'year_id' => 'required',
            'budget_id' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $employee = Employee::where('emp_code',$request->employee_code)->first();
        $dept_id = $employee->dept_id;
        
            $budget = Budget::where('dept_id', $dept_id)->where('year_id', $request->year_id)->whereIn('id', $request->budget_id)->get(); 
            if(empty($budget)){
                return redirect()->back()->with('msg','Budget not available in this employee`s department');
            }
        
        $itemnames = null;
        $itemsin = null;
        $available = false;
        $loggedin_user = Auth::id();
        foreach($request->inv_id as $id){
            $inventory = Inventory::find($id);
            $budgets = Budget::where('dept_id', $dept_id)->where('year_id', $request->year_id)->where('subcategory_id', $inventory->subcategory_id)->whereIn('id', $request->budget_id)->get();
            if(count($budgets) == 0){
                $itemnames .= $inventory->subcategory->sub_cat_name.', ';
            }
            else{
                foreach($budgets as $b){
                    if($b->consumed < $b->qty){
                        $budget = $b;
                        break;
                    }
                    else{
                        $budget = $b;
                    }
                }
                if($budget->consumed >= $budget->qty){
                    $itemnames .= $inventory->subcategory->sub_cat_name.', ';
                }
                else{
                    $b_fields = array(
                                'consumed' => $budget->consumed+1,
                                'remaining' => $budget->remaining-1
                    );
                    $available = true;
                $itemsin .= $inventory->subcategory->sub_cat_name.', ';
                $b_fields = array(
                           'consumed' => $budget->consumed+1,
                           'remaining' => $budget->remaining-1
                            );
                $b_update = Budget::where('id',$budget->id)->update($b_fields);
                $update = Inventory::where('id',$id)->update(['issued_to'=>$request->employee_code, 'year_id'=>$request->year_id, 'issued_by'=>$loggedin_user, 'status'=>3]);
                $insert = Issue::create(['employee_id'=>$request->employee_code, 'inventory_id'=>$id, 'year_id'=>$request->year_id, 'remarks'=>$request->remarks]);
                }
            }
        }
        $itemnames = rtrim($itemnames, ", ");
        $itemsin = rtrim($itemsin, ", ");
        
        if($available == true && $itemnames == null){
            return redirect()->back()->with('msg','Selected inventory issued to '.$employee->name);
        }
        else if($available == true && $itemnames != null){
            return redirect()->back()->with('msg', $itemsin.' issued to '.$employee->name.', '.$itemnames.' not available in budget!');
        }
        else{
            return redirect()->back()->with('msg','Budget not available for selected inventory');
        }
    }
    public function transfer_inventory(){
        $inventory = Inventory::whereNotNull('issued_to')->orderBy('id', 'desc')->get();
        foreach($inventory as $inv){
            $user = Employee::where('emp_code', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        return view('transfer_inventory', ['inventories' => $inventory]);
    }
    public function filter_inventory(Request $request){
        $validator = Validator::make($request->all(), [
            'from_employee_code' => 'required' 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $inventory = Inventory::where('issued_to', $request->from_employee_code)->orderBy('id', 'desc')->get();
        foreach($inventory as $inv){
            $user = Employee::where('emp_code', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        $emp = Employee::where('emp_code', $request->from_employee_code)->first();
        return view('transfer_inventory', ['inventories' => $inventory, 'filter'=>1, 'from_emp'=>$emp]);
    }
    public function submitt_transfer(Request $request){
        
        $validator = Validator::make($request->all(), [
            'inv_id' => 'required',
            'to_employee_code' => 'required'  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $to_employee = Employee::where('emp_code',$request->to_employee_code)->first();
        if(!$to_employee){
            return redirect()->back()->with('to_emp_code','to employee code does not exists');
        }
        $loggedin_user = Auth::id();

        foreach($request->inv_id as $id){
            $update = Inventory::where('id',$id)->update(['issued_to'=>$request->to_employee_code, 'issued_by'=>$request->$loggedin_user]);
            $insert = Transfer::create(['from_employee_id'=>$request->from_employee_code, 'to_employee_id'=>$request->to_employee_code, 'inventory_id'=>$id, 'remarks'=>$request->remarks]);
        }
        return redirect('transfer_inventory')->with('msg','Inventory transfered to '.$to_employee->name);
    }
    public function return_inventory(){
        $inventory = Inventory::whereNotNull('issued_to')->orderBy('id', 'desc')->get();
        foreach($inventory as $inv){
            $user = Employee::where('emp_code', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        return view('return_inventory', ['inventories' => $inventory]);
    }
    public function filter_return(Request $request){
        $validator = Validator::make($request->all(), [
            'employee_code' => 'required' 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $inventory = Inventory::where('issued_to', $request->employee_code)->orderBy('id', 'desc')->get();
        foreach($inventory as $inv){
            $user = Employee::where('emp_code', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        $emp = Employee::where('emp_code', $request->employee_code)->first();
        return view('return_inventory', ['inventories' => $inventory, 'filter'=>1, 'emp_code'=>$emp]);
    }
    public function submitt_return(Request $request){
        
        $validator = Validator::make($request->all(), [
            'inv_id' => 'required',
            'employee_code' => 'required'  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        foreach($request->inv_id as $id){
            $update = Inventory::where('id',$id)->update(['issued_to'=>null, 'status'=>'2']);
            $insert = Rturn::create(['employee_id'=>$request->employee_code, 'inventory_id'=>$id, 'remarks'=>$request->remarks]);
        }
        return redirect('return_inventory')->with('msg','Inventory Returned!');
    }
    public function repair(){
        $inventory = Inventory::orderBy('id', 'desc')->select('id','product_sn')->get();
        $categories = Category::where('status',1)->orderBy('category_name', 'asc')->get();
        return view('repair_inventory', ['categories'=>$categories, 'inventories' => $inventory]);
    }
    public function repair_inventory(Request $request){
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'date' => 'required',
            'actual_price_value' => 'required',
            'price_value' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = $request->all();
        $fields['price_value'] = str_replace(",", "", $fields['price_value']);
        $fields['actual_price_value'] = str_replace(",", "", $fields['actual_price_value']);
        $repair = Repairing::create($fields);
        if($repair){
            return redirect()->back()->with('msg', 'Repairing asset Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add repairing asset, Try Again!');
        }
    }
    public function pendings()
    {
        $inventory = Inventory::where('status', 0)->orderBy('id', 'desc')->get();
        return view('addtogrn', ['inventories' => $inventory]);
    }
    public function pending_gins()
    {
        $inventory = Inventory::where('status', 3)->orderBy('id', 'desc')->get();
        return view('addtogin', ['inventories' => $inventory]);
    }
    public function model_by_make($id)
    {
        $get = Modal::where('make_id', $id)->where('status', 1)->orderBy('model_name', 'asc')->get();
        return $get;
    }
    public function subcat_by_category($id)
    {
        $get = Subcategory::where('category_id', $id)->where('status', 1)->orderBy('sub_cat_name', 'asc')->get();
        return $get;
    }
    public function pkr_by_year($id)
    {
        $get = Dollar::where('year_id', $id)->first();
        return $get;
    }
}
