<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
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
class InventoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $inventory = Inventory::orderBy('id', 'desc')->get();
       
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
            'product_sn' => 'required',
            'item_price' => 'required'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = $request->all();
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
        $data['inventory'] = Inventory::find($id);
        return view('edit_inventory', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'subcategory_id' => 'required|not_in:0',
            'product_sn' => 'required',
            'item_price' => 'required'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $arr = array();
        $arr['category_id'] = $request->category_id;
        $arr['subcategory_id'] = $request->sub_cat_id;
        $arr['location_id'] = $request->location_id;
        $arr['department_id'] = $request->department_id;
        $arr['branch_id'] = $request->branch_id;
        $arr['store_id'] = $request->store_id;
        $arr['product_sn'] = $request->product_sn;
        $arr['model_id'] = $request->model_id;
        $arr['make_id'] = $request->make_id;
        $arr['vendor_id'] = $request->vendor_id;
        $arr['device_type_id'] = $request->device_type_id;
        $arr['inventory_type_id'] = $request->inventory_type_id;
        $arr['item_nature_id'] = $request->item_nature_id;
        $arr['purchase_date'] = $request->purchase_date;
        $arr['remarks'] = $request->remarks;
        $arr['item_price'] = $request->item_price;
        $arr['delivery_challan'] = $request->delivery_challan;
        $arr['delivery_challan_date'] = $request->delivery_challan_date;
        $arr['invoice_number'] = $request->invoice_number;
        $arr['invoice_date'] = $request->invoice_date;
        $arr['other_accessories'] = $request->other_accessories;
        $arr['good_condition'] = $request->good_condition;
        $arr['verification'] = $request->verification;
        $arr['purpose'] = $request->purpose;

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
}
