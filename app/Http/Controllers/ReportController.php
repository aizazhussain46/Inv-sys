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
        $data = array();
        $data['categories'] = Category::where('status',1)->get();
        $data['locations'] = Location::all();
        $data['invtypes'] = Inventorytype::where('status', 1)->get();
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
                $to = $fields['to_date'];
                unset($fields['from_date']);
                unset($fields['to_date']);
                $data['inventories'] = Inventory::where([[$fields]])
                                        ->whereBetween('created_at', [$from, $to])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = date('Y-m-d', strtotime($fields['from_date'].' -1 day'));
                unset($fields['from_date']);
                $data['inventories'] = Inventory::where([[$fields]])
                                        ->whereBetween('created_at', [$from, date('Y-m-d')])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(!isset($fields['from_date']) && isset($fields['to_date'])){
                $to = $fields['to_date'];
                unset($fields['to_date']);
                $data['inventories'] = Inventory::where([[$fields]])
                                        ->whereBetween('created_at', ['', $to])
                                        ->orderBy('id', 'desc')->get();
            }
            else{
                $data['inventories'] = Inventory::where([[$fields]])->orderBy('id', 'desc')->get();
            }
        }
        return $data;
        //return view('show_inventorylist', $data);
        
    }
}