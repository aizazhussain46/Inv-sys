<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Category;
use App\Models\Location;
use App\Models\Department;
use App\Models\Branch;
use App\Models\Store;
use App\Models\Modal;
use App\Models\Makee;
use App\Models\Vendor;
class InventoryController extends Controller
{
    
    public function index()
    {
        $inventory = Inventory::orderBy('id', 'desc')->get();
        return view('inventory', ['inventories' => $inventory]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'product_sn' => 'required',
            'item_price' => 'required'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $create = Inventory::create($request->all());
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
        $data['categories'] = Category::all();
        $data['departments'] = Department::all();
        $data['locations'] = Location::all();
        $data['branches'] = Branch::all();
        $data['stores'] = Store::all();
        $data['models'] = Modal::all();
        $data['makes'] = Makee::all();
        $data['vendors'] = Vendor::all();
        $data['inventory'] = Inventory::find($id);
        return view('edit_inventory', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'product_sn' => 'required',
            'item_price' => 'required'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $arr = array();
        $arr['category_id'] = $request->category_id;
        $arr['location_id'] = $request->location_id;
        $arr['department_id'] = $request->department_id;
        $arr['branch_id'] = $request->branch_id;
        $arr['store_id'] = $request->store_id;
        $arr['product_sn'] = $request->product_sn;
        $arr['model_id'] = $request->model_id;
        $arr['make_id'] = $request->make_id;
        $arr['vendor_id'] = $request->vendor_id;
        $arr['device_type'] = $request->device_type;
        $arr['item_nature'] = $request->item_nature;
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
