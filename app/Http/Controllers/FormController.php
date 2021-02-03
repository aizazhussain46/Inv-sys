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
        $category = Category::all();
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
        $make = Makee::where('status',1)->get();
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
        $year = Year::all();
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
        $data['categories'] = Category::where('status',1)->get();
        $data['subcategories'] = Subcategory::where('status',1)->get();
        $data['types'] = Type::all();
        $data['years'] = Year::where('locked', null)->get();
        return view('add_budget', $data);
    }
    public function show_budget(){
        $data = array();
        $data['years'] = Year::all();
        $data['categories'] = Category::where('status',1)->get();
        $data['budgets'] = array();
        $data['filters'] = (object)array('catid'=>'', 'yearid'=>'');
        return view('show_budget', $data);
    }
    public function summary(){
        
        return view('summary', ['filter'=>'', 'types'=>array(), 'years'=>Year::all()]);
    }

    public function add_store(){
        $user = User::where('role_id',2)->get();
        $location = Location::all();
        return view('add_store', ['users' => $user, 'locations' => $location]);
    }
    public function add_user(){
        $role = Role::all();
        return view('add_user', ['roles'=>$role]);
    }
    public function add_employee(){
        return view('add_employee');
    }
    public function add_inventory(){
        $data = array();
        $data['categories'] = Category::where('status',1)->get();
        $data['subcategories'] = Subcategory::where('status',1)->get();
        // $data['departments'] = Department::where('status',1)->get();
        $data['locations'] = Location::all();
        // $data['branches'] = Branch::where('status',1)->get();
        $data['stores'] = Store::all();
        $data['models'] = Modal::where('status',1)->get();
        $data['makes'] = Makee::where('status',1)->get();
        $data['vendors'] = Vendor::all();
        $data['devicetypes'] = Devicetype::where('status',1)->get();
        $data['itemnatures'] = Itemnature::where('status',1)->get();
        $data['inventorytypes'] = Inventorytype::where('status',1)->get();
        return view('add_inventory', $data);
    }
    public function add_with_grn(){
        $data = array();
        $data['categories'] = Category::where('status',1)->get();
        $data['subcategories'] = Subcategory::where('status',1)->get();
        // $data['departments'] = Department::where('status',1)->get();
        $data['locations'] = Location::all();
        // $data['branches'] = Branch::where('status',1)->get();
        $data['stores'] = Store::all();
        $data['models'] = Modal::where('status',1)->get();
        $data['makes'] = Makee::where('status',1)->get();
        $data['vendors'] = Vendor::all();
        $data['devicetypes'] = Devicetype::where('status',1)->get();
        $data['itemnatures'] = Itemnature::where('status',1)->get();
        $data['inventorytypes'] = Inventorytype::where('status',1)->get();
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
        return view('issue_inventory', ['inventories' => $inventory]);
    }
    public function submitt_issue(Request $request){
        
        $validator = Validator::make($request->all(), [
            'inv_id' => 'required',
            'employee_code' => 'required'  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $employee = Employee::where('emp_code',$request->employee_code)->first();
        if(!$employee){
            return redirect()->back()->with('emp_code','employee code does not exists');
        }
        $loggedin_user = Auth::id();

        foreach($request->inv_id as $id){
            $update = Inventory::where('id',$id)->update(['issued_to'=>$request->employee_code, 'issued_by'=>$request->$loggedin_user]);
            $insert = Issue::create(['employee_id'=>$request->employee_code, 'inventory_id'=>$id, 'remarks'=>$request->remarks]);
        }
        return redirect()->back()->with('msg','Inventory issued to '.$employee->name);
    }
    public function issue_with_gin(){
        $inventory = Inventory::where('issued_to', NULL)->whereIn('status', [1,2])->orderBy('id', 'desc')->get();
        return view('issuewithgin', ['inventories' => $inventory]);
    }
    public function submit_gin(Request $request){
        
        $validator = Validator::make($request->all(), [
            'inv_id' => 'required',
            'employee_code' => 'required'  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $employee = Employee::where('emp_code',$request->employee_code)->first();
        if(!$employee){
            return redirect()->back()->with('emp_code','employee code does not exists');
        }
        $loggedin_user = Auth::id();

        foreach($request->inv_id as $id){
            $update = Inventory::where('id',$id)->update(['issued_to'=>$request->employee_code, 'issued_by'=>$request->$loggedin_user, 'status'=>3]);
            $insert = Issue::create(['employee_id'=>$request->employee_code, 'inventory_id'=>$id, 'remarks'=>$request->remarks]);
        }
        return redirect()->back()->with('msg','Inventory issued to '.$employee->name);
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
            $update = Inventory::where('id',$id)->update(['issued_to'=>null]);
            $insert = Rturn::create(['employee_id'=>$request->employee_code, 'inventory_id'=>$id, 'remarks'=>$request->remarks]);
        }
        return redirect('return_inventory')->with('msg','Inventory Returned!');
    }
    public function repair(){
        $inventory = Inventory::orderBy('id', 'desc')->select('id','product_sn')->get();
        
        return view('repair_inventory', ['inventories' => $inventory]);
    }
    public function repair_inventory(Request $request){
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
            'date' => 'required',
            'actual_price_value' => 'required',
            'price_value' => 'required',  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $repair = Repairing::create($request->all());
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
        $get = Modal::where('make_id', $id)->where('status', 1)->get();
        return $get;
    }
    public function subcat_by_category($id)
    {
        $get = Subcategory::where('category_id', $id)->where('status', 1)->get();
        return $get;
    }
    public function pkr_by_year($id)
    {
        $get = Dollar::where('year_id', $id)->first();
        return $get;
    }
}
