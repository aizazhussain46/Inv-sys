<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Grn;
use App\Gin;
use App\Inventory;
use App\Employee;
use App\Category;
use App\Type;
use App\Year;
use App\User;
use App\Budgetitem as Budget;
class PDFController extends Controller
{
    public function generatePDF()
    {
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];
        $pdf = PDF::loadView('myPDF', $data);
  
        return $pdf->download('itsolutionstuff.pdf');
    }
    public function generateGRN($id, $from, $to)
    {
        $range = array('from'=>$from, 'to'=>$to);
        $grn = GRN::where('id',$id)->first();
        $inv = json_decode($grn->inv_id);
        $inventories = array();
        $user = '';
        
        foreach($inv as $inv_id){
            $inventory = Inventory::find($inv_id);
            $user = User::find($inventory->added_by);
            //$inventory->user = $user;
            $inventories[] = $inventory;
        }
        
        $data = array('inventories'=>$inventories, 'user'=>$user, 'grn_date'=>$grn->created_at, 'range'=>$range);
        //return view('grnreport', $data);
        $pdf = PDF::loadView('grnreport', $data)->setPaper('a4', 'landscape');
  
        return $pdf->download($grn->grn_no.'.pdf');
    }
    public function generateGIN($id, $from, $to)
    {
        $range = array('from'=>$from, 'to'=>$to);
        $gin = GIN::where('id',$id)->first();
        $inv = json_decode($gin->inv_id);
        $inventories = array();
        $employee = '';
        
        foreach($inv as $inv_id){
            $inventory = Inventory::find($inv_id);
            $employee = Employee::where('emp_code', $inventory->issued_to)->first();
            $inventory->employee = $employee;
            $inventories[] = $inventory;
        }
        $data = array('inventories'=>$inventories, 'employee'=>$employee, 'gin'=>$gin, 'range'=>$range);
        //return view('grnreport', $data);
        $pdf = PDF::loadView('ginreport', $data);
  
        return $pdf->download($gin->gin_no.'.pdf');
    }
    public function budgetexport($data) 
    {
        $budget = Budget::where('year_id', $data)->first();
        
        if(!empty($budget)){
            
            $types = Type::all();
            foreach($types as $type){
            $category = Category::where('status',1)->get();
            foreach($category as $cat){                
                $cat['unit_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('unit_price_dollar');
                $cat['unit_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('unit_price_pkr');
                $cat['total_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('total_price_dollar');
                $cat['total_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('total_price_pkr');
                $cat['qty'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('qty');
                $cat['consumed'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('consumed');
                $cat['remaining'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('remaining');
                }
            $type->categories = $category;    
            }
        }
        $year = Year::find($data);
        $pdf = PDF::loadView('summaryreport2', ['types'=>$types, 'year'=>$year->year])->setPaper('a4', 'landscape');
        return $pdf->download('Summaryreport_'.$year->year.'.pdf');
    }
    public function itemexport($data) 
    {
        $filters = json_decode($data);
        $types = Type::all();
        foreach($types as $type){
        $type->budgets = Budget::where('year_id', $filters->yearid)->where('category_id',$filters->catid)->where('type_id',$type->id)->get();
        }
        $year = Year::find($filters->yearid);
        $category = Category::find($filters->catid);
        $pdf = PDF::loadView('itemsreport', ['types'=>$types, 'year'=>$year->year, 'category'=>$category->category_name])->setPaper('a4', 'landscape');
        return $pdf->download($category->category_name.'_report_'.$year->year.'.pdf');
    }
    public function inventoryexport($data) 
    {
            $fields = (array)json_decode($data);
            $key = $fields['inout'][0]; 
            $op = $fields['inout'][1]; 
            $val = $fields['inout'][2];
            unset($fields['inout']); 
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $inventories = Inventory::where([[$fields]])->where($key, $op, $val)
                                        ->whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $inventories = Inventory::where([[$fields]])->where($key, $op, $val)
                                        ->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else if(!isset($fields['from_date']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $inventories = Inventory::where([[$fields]])->where($key, $op, $val)
                                        ->whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                        ->whereNotIn('status', [0])
                                        ->orderBy('id', 'desc')->get();
            }
            else{
                $inventories = Inventory::where([[$fields]])->where($key, $op, $val)->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
            //$inventories = Inventory::where([[$fields]])->orderBy('id', 'desc')->get();
            $pdf = PDF::loadView('inventoryreport', ['inventories'=>$inventories]);
            return $pdf->download('inventoryreport.pdf');
    }
}
