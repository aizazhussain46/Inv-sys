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
use App\Budgetitem as Budget;
use App\Issue;
use App\Repairing;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show_inventory(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        $data['locations'] = Location::orderBy('location', 'asc')->get();
        $data['filters'] = array();
        if(empty($request->all())){
            $data['inventories'] = array();
        }
        else{
            $fields = array_filter($request->all());
            $key = null; 
            $op = null; 
            $val = null; 
            unset($fields['_token']);
            if(isset($fields['inout'])){
                if($fields['inout'] == 'in'){
                    $fields['issued_to'] = null;
                }
                else{
                    $key = 'issued_to'; 
                    $op = '>'; 
                    $val = 0; 
                }
            }
            
            $fields['inout'] = array($key,$op,$val);
            $data['filters'] = $fields;
            unset($fields['inout']);
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $data['inventories'] = Inventory::where([[$fields]])->where($key, $op, $val)
                                        ->whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $data['inventories'] = Inventory::where([[$fields]])->where($key, $op, $val)
                                        ->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(!isset($fields['from_date']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $data['inventories'] = Inventory::where([[$fields]])->where($key, $op, $val)
                                        ->whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else{
                $data['inventories'] = Inventory::where([[$fields]])->where($key, $op, $val)->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
        }
        //return $data;
        return view('show_inventorylist', $data);
    }
    public function balance_report(Request $request)
    {
        $data = array();
        $data['locations'] = Location::orderBy('location', 'asc')->get();
        $data['stores'] = Store::orderBy('store_name', 'asc')->get();
        $fields = array_filter($request->all());
        unset($fields['_token']);
        $data['filters'] = $fields;
        if(empty($request->all())){
            $subcategories = array();
        }
        else{
            $subcategories = Subcategory::where('status',1)->get();
            foreach($subcategories as $subcat){
                $subcat->rem = Inventory::where([[$fields]])->where('subcategory_id', $subcat->id)->where('issued_to', NULL)->count();
                $subcat->out = Inventory::where([[$fields]])->where('subcategory_id', $subcat->id)->whereNotNull('issued_to')->count();
            }
        }
        $data['subcategories'] = $subcategories;
        return view('balancereport', $data);
    }

    public function edit_logs(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['productsns'] = Inventory::whereNotIn('status', [0])->get();
        $data['filters'] = array();
        if(empty($request->all())){
            $data['inventories'] = array();
        }
        else{
            $fields = array_filter($request->all());
            unset($fields['_token']);
            $data['filters'] = $fields;
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $data['inventories'] = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $data['inventories'] = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(!isset($fields['from_date']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $data['inventories'] = Inventory::where([[$fields]])->whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else{
                $data['inventories'] = Inventory::where([[$fields]])->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
        }
        return view('show_editlogs', $data);
    }
    public function inventory_in(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        $data['locations'] = Location::orderBy('location', 'asc')->get();
        $data['invtypes'] = Inventorytype::where('status', 1)->orderBy('inventorytype_name', 'asc')->get();
        $data['makes'] = Makee::where('status',1)->orderBy('make_name', 'asc')->get();
        $data['stores'] = Store::orderBy('store_name', 'asc')->get();
        $data['itemnatures'] = Itemnature::where('status',1)->orderBy('itemnature_name', 'asc')->get();
        $data['vendors'] = Vendor::orderBy('vendor_name', 'asc')->get();
        $data['filters'] = array();

        $invs = array();
        if(empty($request->all())){
            $data['inventories'] = array();
        }
        else{
            $fields = array_filter($request->all());
            unset($fields['_token']);
            $fields['issued_to'] = null;
            $data['filters'] = $fields;
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $data['inventories'] = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $data['inventories'] = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(!isset($fields['from_date']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $invs = Inventory::where([[$fields]])->whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else{
                $invs = Inventory::where([[$fields]])->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
            foreach($invs as $inv){
                $inv->added_by = User::find($inv->added_by);
            }
            $data['inventories'] = $invs;
        }
        return view('show_inventoryin', $data);
    }
    public function inventory_out(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        $data['locations'] = Location::orderBy('location', 'asc')->get();
        $data['invtypes'] = Inventorytype::where('status', 1)->orderBy('inventorytype_name', 'asc')->get();
        $data['makes'] = Makee::where('status',1)->orderBy('make_name', 'asc')->get();
        $data['stores'] = Store::orderBy('store_name', 'asc')->get();
        $data['employees'] = Employee::orderBy('name', 'asc')->get();
        $data['itemnatures'] = Itemnature::where('status',1)->orderBy('itemnature_name', 'asc')->get();
        $data['vendors'] = Vendor::orderBy('vendor_name', 'asc')->get();
        $data['filters'] = array();

        $invs = array();
        if(empty($request->all())){
            $data['inventories'] = array();
        }
        else{
            $fields = array_filter($request->all());
            $key = null; 
            $op = null; 
            $val = null; 
            unset($fields['_token']);
            if(!isset($fields['issued_to'])){
                $key = 'issued_to'; 
                $op = '>'; 
                $val = 0; 
            }
            
            $fields['inout'] = array($key,$op,$val);
            $data['filters'] = $fields;
            unset($fields['inout']);
            if(isset($fields['from_issuance']) || isset($fields['to_issuance'])){

                if(isset($fields['from_issuance']) && isset($fields['to_issuance'])){
                    $from = $fields['from_issuance'];
                    $to = strtotime($fields['to_issuance'].'+1 day');
                    unset($fields['from_issuance']);
                    unset($fields['to_issuance']);
                    $issue = Issue::whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                            ->select('inventory_id')
                                            ->orderBy('id', 'desc')->get();
                }
                else if(isset($fields['from_issuance']) && !isset($fields['to_issuance'])){
                    $from = $fields['from_issuance'];
                    unset($fields['from_issuance']);
                    $issue = Issue::whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                            ->select('inventory_id')
                                            ->orderBy('id', 'desc')->get();
                }
                else if(!isset($fields['from_issuance']) && isset($fields['to_issuance'])){
                    $to = strtotime($fields['to_issuance'].'+1 day');
                    unset($fields['to_issuance']);
                    $issue = Issue::whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                            ->select('inventory_id')
                                            ->orderBy('id', 'desc')->get();
                }
            
                $ids = array();
                foreach($issue as $iss){
                    $ids[] = $iss->inventory_id;
                }
                $invs = Inventory::where([[$fields]])->where($key, $op, $val)->whereIn('id', $ids)->orderBy('id', 'desc')->get();
            }
            else{
                $invs = Inventory::where([[$fields]])->where($key, $op, $val)->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
            foreach($invs as $inv){
                $inv->added_by = User::find($inv->added_by);
                $inv->issued_by = User::find($inv->issued_by);
                $inv->issue_date = Issue::where('inventory_id', $inv->id)->select('created_at')->orderBy('id', 'desc')->first();
            }
            $data['inventories'] = $invs;
        }
        return view('show_inventoryout', $data);
    }

    public function bin_card(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['productsns'] = Inventory::whereNotIn('status', [0])->get();
        $data['filters'] = array();
        if(empty($request->all())){
            $inventories = array();
        }
        else{
            $fields = array_filter($request->all());
            unset($fields['_token']);
            $data['filters'] = $fields;
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $inventories = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $inventories = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(!isset($fields['from_date']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $inventories = Inventory::where([[$fields]])->whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else{
                $inventories = Inventory::where([[$fields]])->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
        }
        if(!empty($inventories)){
            foreach($inventories as $inventory){
                $inventory->repairing = Repairing::where('item_id',$inventory->id)->first();
                $inventory->added_by = User::where('id',$inventory->added_by)->first();
            }
        }
        $data['inventories'] = $inventories;
        return view('show_bincard', $data);
    }
    public function asset_repairing(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        $data['filters'] = array();
        if(empty($request->all())){
            $repairs = array();
        }
        else{
            $fields = array_filter($request->all());
            unset($fields['_token']);
            $data['filters'] = $fields;
            $repairs = Repairing::where([[$fields]])->orderBy('id', 'desc')->get();
        }
        $data['repairs'] = $repairs;
        return view('show_repairings', $data);
    }
    public function disposal(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        $data['invtypes'] = Inventorytype::where('status', 1)->orderBy('inventorytype_name', 'asc')->get();
        $data['filters'] = array();
        if(empty($request->all())){
            $inventories = array();
        }
        else{
            $fields = array_filter($request->all());
            unset($fields['_token']);
            $data['filters'] = $fields;
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $inventories = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $inventories = Inventory::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(!isset($fields['from_d ate']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $inventories = Inventory::where([[$fields]])->whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else{
                $inventories = Inventory::where([[$fields]])->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
        }
        if(!empty($inventories)){
            foreach($inventories as $inventory){
               $inventory->added_by = User::where('id',$inventory->added_by)->first();
            }
        }
        $data['inventories'] = $inventories;
        return view('show_disposal', $data);
    }
    public function vendor_buying(Request $request)
    {
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $array = array();
        $data['subcategories'] = Subcategory::where('status',1)->orderBy('sub_cat_name', 'asc')->get();
        $data['vendors'] = Vendor::orderBy('vendor_name', 'asc')->get();
        $data['filters'] = array();
        if(empty($request->all())){
            $inventories = array();
        }
        else{
            $validator = Validator::make($request->all(), [
                'vendor_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
            $fields = array_filter($request->all());
            unset($fields['_token']);
            $data['filters'] = $fields;
            if(empty($request->subcategory_id)){
                $subcat = Subcategory::where('status',1)->get();
            }
            else{
                $subcat = Subcategory::where('id',$request->subcategory_id)->get();
            }
            
            $i = 0;
            foreach($subcat as $sub){
            
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $request->vendor_id)->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereBetween('updated_at', [$from, date('Y-m-d', $to)])->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereBetween('updated_at', [$from, date('Y-m-d', $to)])->whereNotIn('status', [0])->sum('item_price');
                
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $request->vendor_id)->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])->whereNotIn('status', [0])->sum('item_price');
                
            }
            else if(!isset($fields['from_d ate']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $request->vendor_id)->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereBetween('updated_at', ['', date('Y-m-d', $to)])->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereBetween('updated_at', ['', date('Y-m-d', $to)])->whereNotIn('status', [0])->sum('item_price');
                
            }
            else{
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $request->vendor_id)->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$request->vendor_id)->whereNotIn('status', [0])->sum('item_price');
            }
            if($array[$i]['total_items'] == 0){
                unset($array[$i]);
            }
            $i++;
        }
        }
        
        $data['inventories'] = $array;
        return view('show_vendorbuying', $data);
    }
}
