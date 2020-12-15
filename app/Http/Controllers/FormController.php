<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Location;
use App\Department;
use App\Branch;
use App\Store;
use App\Modal;
use App\Makee;
use App\Vendor;
use App\Role;
use App\User;
use App\Issue;
use App\Transfer;
use App\Inventory;
use App\Repairing;
class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add_category(){
        return view('add_category');
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
        return view('add_model');
    }
    public function add_role(){
        return view('add_role');
    }
    public function add_store(){
        return view('add_store');
    }
    public function add_user(){
        $role = Role::all();
        return view('add_user', ['roles'=>$role]);
    }
    public function add_inventory(){
        $data = array();
        $data['categories'] = Category::all();
        $data['departments'] = Department::all();
        $data['locations'] = Location::all();
        $data['branches'] = Branch::all();
        $data['stores'] = Store::all();
        $data['models'] = Modal::all();
        $data['makes'] = Makee::all();
        $data['vendors'] = Vendor::all();
        return view('add_inventory', $data);
    }
    public function add_make(){
        return view('add_make');
    }
    public function add_vendor(){
        return view('add_vendor');
    }
    public function issue_inventory(){
        $inventory = Inventory::where('issued_to', NULL)->orderBy('id', 'desc')->get();
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
        $employee = User::where(['id'=>$request->employee_code, 'role_id'=>2])->first();
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
    public function transfer_inventory(){
        $inventory = Inventory::whereNotNull('issued_to')->orderBy('id', 'desc')->get();
        foreach($inventory as $inv){
            $user = User::where('id', $inv->issued_to)->first();
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
            $user = User::where('id', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        $emp = User::find($request->from_employee_code);
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
        $to_employee = User::where(['id'=>$request->to_employee_code, 'role_id'=>2])->first();
        if(!$to_employee){
            return redirect()->back()->with('to_emp_code','to employee code does not exists');
        }
        $loggedin_user = Auth::id();

        foreach($request->inv_id as $id){
            $update = Inventory::where('id',$id)->update(['issued_to'=>$request->to_employee_code, 'issued_by'=>$request->$loggedin_user]);
            $insert = Transfer::create(['from_employee_id'=>$request->from_employee, 'to_employee_id'=>$request->to_employee_code, 'inventory_id'=>$id, 'remarks'=>$request->remarks]);
        }
        return redirect('transfer_inventory')->with('msg','Inventory transfered to '.$to_employee->name);
    }
    public function return_inventory(){
        $inventory = Inventory::whereNotNull('issued_to')->orderBy('id', 'desc')->get();
        foreach($inventory as $inv){
            $user = User::where('id', $inv->issued_to)->first();
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
            $user = User::where('id', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        $emp = User::find($request->employee_code);
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
            $insert = Transfer::create(['employee_id'=>$request->employee_code, 'inventory_id'=>$id, 'remarks'=>$request->remarks]);
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
}
