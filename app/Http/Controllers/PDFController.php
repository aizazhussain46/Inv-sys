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
        $employee = '';
        
        foreach($inv as $inv_id){
            $inventory = Inventory::find($inv_id);
            $employee = Employee::where('emp_code', $inventory->issued_to)->first();
            $inventory->employee = $employee;
            $inventories[] = $inventory;
        }
        $data = array('inventories'=>$inventories, 'employee'=>$employee, 'grn_date'=>$grn->created_at, 'range'=>$range);
        //return view('grnreport', $data);
        $pdf = PDF::loadView('grnreport', $data);
  
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
                $cat['consumed'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('consumed');
                $cat['remaining'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('remaining');
                }
            $type->categories = $category;    
            }
        }
        $year = Year::find($data);
        $pdf = PDF::loadView('summaryreport', ['types'=>$types, 'year'=>$year->year]);
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
        $pdf = PDF::loadView('itemsreport', ['types'=>$types, 'year'=>$year->year, 'category'=>$category->category_name]);
        return $pdf->download($category->category_name.'_report_'.$year->year.'.pdf');
    }
}
