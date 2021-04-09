<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Inventory;
use App\Category;
use App\Subcategory;
use App\Location;
use App\Department;
use App\Branch;
use App\Store;
use App\Devicetype;
use App\Itemnature;
use App\Inventorytype;
use App\Modal;
use App\User;
use App\Makee;
use App\Vendor;
use App\Employee;
use App\Budgetitem as Budget;
class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $inventory = Inventory::whereNotIn('status', [0])->orderBy('id', 'desc')->get();
       
        foreach($inventory as $inv){
            $user = Employee::where('emp_code', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        return view('inventory', ['inventories' => $inventory]);
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'required|not_in:0',
            'product_sn' => 'required|unique:inventories',
            'item_price' => 'required',
            'dollar_rate' => 'required'  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        // $budget = Budget::where('subcategory_id', $request->subcategory_id)->first();
        // if($budget){
        //     if($budget->consumed >= $budget->qty){
        //         return redirect()->back()->with('msg', 'Selected item is out of stock in budget!');
        //     }
        //     else{
        //         $b_fields = array(
        //             'consumed' => $budget->consumed+1,
        //             'remaining' => $budget->remaining-1
        //         );
        //         $update = Budget::where('id',$budget->id)->update($b_fields);
        //      }
        // }
        // else{
        //     return redirect()->back()->with('msg', 'Selected item is out of stock in budget!');
        // }    
        
        $fields = $request->all();
        $fields['item_price'] = str_replace(",", "", $fields['item_price']);
        $fields['dollar_rate'] = str_replace(",", "", $fields['dollar_rate']);
        $loggedin_user = Auth::id();
        $fields['added_by'] = $loggedin_user;
        $create = Inventory::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Inventory Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add inventory, Try Again!');
        }  
    }

    public function show($id)
    {
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
        $inventory = Inventory::find($id);
        $inventory->item_price = number_format($inventory->item_price);
        $inventory->dollar_rate = number_format($inventory->dollar_rate);
        $data['inventory'] = $inventory;
        return view('edit_inventory', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'required|not_in:0',
            'product_sn' => 'required',
            'item_price' => 'required',
            'dollar_rate' => 'required'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $arr = array();
        $arr['category_id'] = $request->category_id;
        $arr['subcategory_id'] = $request->subcategory_id;
        $arr['location_id'] = $request->location_id;
        $arr['department_id'] = $request->department_id;
        $arr['branch_id'] = $request->branch_id;
        $arr['store_id'] = $request->store_id;
        $arr['product_sn'] = $request->product_sn;
        $arr['model_id'] = $request->model_id;
        $arr['make_id'] = $request->make_id;
        $arr['vendor_id'] = $request->vendor_id;
        $arr['devicetype_id'] = $request->devicetype_id;
        $arr['inventorytype_id'] = $request->inventorytype_id;
        $arr['itemnature_id'] = $request->itemnature_id;
        $arr['purchase_date'] = $request->purchase_date;
        $arr['remarks'] = $request->remarks;
         $arr['item_price'] = str_replace(",", "", $request->item_price);
        $arr['dollar_rate'] = str_replace(",", "", $request->dollar_rate);
        $arr['delivery_challan'] = $request->delivery_challan;
        $arr['delivery_challan_date'] = $request->delivery_challan_date;
        $arr['invoice_number'] = $request->invoice_number;
        $arr['invoice_date'] = $request->invoice_date;
        $arr['other_accessories'] = $request->other_accessories;
        $arr['good_condition'] = $request->good_condition;
        $arr['verification'] = $request->verification;
        $arr['purpose'] = $request->purpose;
        $arr['po_number'] = $request->po_number;
        $arr['warrenty_period'] = $request->warrenty_period;
        $arr['insurance'] = $request->insurance;
        $arr['licence_key'] = $request->licence_key;
        $arr['sla'] = $request->sla;
        $arr['warrenty_check'] = $request->warrenty_check;
        $arr['operating_system'] = $request->operating_system;
        $arr['SAP_tag'] = $request->SAP_tag;
        $arr['capacity'] = $request->capacity;
        $arr['hard_drive'] = $request->hard_drive;
        $arr['processor'] = $request->processor;
        $arr['process_generation'] = $request->process_generation;
        $arr['display_type'] = $request->display_type;
        $arr['DVD_rom'] = $request->DVD_rom;
        $arr['RAM'] = $request->RAM;
        
        $update = Inventory::where('id', $id)->update($arr);
        if($update){
            return redirect()->back()->with('msg', 'Inventory Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update inventory, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Inventory::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Inventory Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete inventory, Try Again!');

    }

    public function item_detail($id)
    {
        $inventory = Inventory::find($id);
        $user = Employee::where('emp_code', $inventory->issued_to)->first();
            if($user){
                $inventory->user = $user;
            }
        //return $data;
        return view('inventorydetail', ['inventory' => $inventory]);
    }
    public function check_product($pro)
    {
        $inventory = Inventory::where('product_sn', $pro)->first();
        if($inventory){
            return 1;
        }
        else{
            return 0;
        }
        return view('inventorydetail', ['inventory' => $inventory]);
    }
    public function get_price($id)
    {
        $inventory = Inventory::find($id);
        return number_format($inventory->item_price);
    }
    public function get_inv_items($id)
    {
        $inventories = Inventory::where('subcategory_id',$id)->get();
        return $inventories;
    }
}
