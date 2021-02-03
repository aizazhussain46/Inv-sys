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
        $data['categories'] = Category::where('status',1)->get();
        $data['locations'] = Location::all();
        $data['productsns'] = Inventory::whereNotIn('status', [0])->get();
        $data['invtypes'] = Inventorytype::where('status', 1)->get();
        $data['makes'] = Makee::where('status',1)->get();
        $data['stores'] = Store::all();
        $data['employees'] = Employee::all();
        $data['itemnatures'] = Itemnature::where('status',1)->get();
        $data['vendors'] = Vendor::all();
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
        date_default_timezone_set('Asia/karachi');
        $data = array();
        $data['locations'] = Location::all();
        $data['stores'] = Store::all();
        $data['filters'] = array();
        if(empty($request->all())){
            $data['inventories'] = array();
        }
        else{

        }
        return view('balancereport', $data);
    }
}
