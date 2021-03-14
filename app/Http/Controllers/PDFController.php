<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Subcategory;
use App\Grn;
use App\Gin;
use App\Inventory;
use App\Employee;
use App\Category;
use App\Type;
use App\Year;
use App\User;
use App\Budgetitem as Budget;
use App\Issue;
use App\Vendor;
use App\Repairing;
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
                $consumed_price_dollar = 0;
                $consumed_price_pkr = 0;
                $remaining_price_dollar = 0;
                $remaining_price_pkr = 0; 
                $fetch = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->get();               
                foreach($fetch as $get){
                    $consumed_price_dollar += $get->unit_price_dollar*$get->consumed;
                    $consumed_price_pkr += $get->unit_price_pkr*$get->consumed;
                    $remaining_price_dollar += $get->unit_price_dollar*$get->remaining;
                    $remaining_price_pkr += $get->unit_price_pkr*$get->remaining; 
                }
                $cat['unit_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('unit_price_dollar');
                $cat['unit_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('unit_price_pkr');
                $cat['total_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('total_price_dollar');
                $cat['total_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('total_price_pkr');
                $cat['qty'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('qty');
                $cat['consumed'] = Budget::where('category_id', $cat->id)->where('year_id', $data)->where('type_id', $type->id)->sum('consumed');
                $cat['consumed_price_dollar'] = $consumed_price_dollar;
                $cat['consumed_price_pkr'] = $consumed_price_pkr;
                $cat['remaining_price_dollar'] = $remaining_price_dollar;
                $cat['remaining_price_pkr'] = $remaining_price_pkr;
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
            $pdf = PDF::loadView('inventoryreport', ['inventories'=>$inventories])->setPaper('a4', 'landscape');
            return $pdf->download('inventoryreport.pdf');
    }
    public function balanceexport($data) 
    {
        $fields = (array)json_decode($data);
        $subcategories = Subcategory::where('status',1)->get();
            foreach($subcategories as $subcat){
                $subcat->rem = Inventory::where([[$fields]])->where('subcategory_id', $subcat->id)->where('issued_to', NULL)->count();
                $subcat->out = Inventory::where([[$fields]])->where('subcategory_id', $subcat->id)->whereNotNull('issued_to')->count();
            }
        //return $subcategories;    
        $pdf = PDF::loadView('balanceexport', ['subcategories'=>$subcategories]);
        return $pdf->download('balancereport.pdf');    
    }
    public function editlogsexport($data) 
    {
        date_default_timezone_set('Asia/karachi');
        $fields = (array)json_decode($data);
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
            $pdf = PDF::loadView('inventorylogsreport', ['inventories'=>$inventories])->setPaper('a4', 'landscape');
            return $pdf->download('inventory_editlogs_report.pdf');
    }
    public function inventoryinexport($data) 
    {
        date_default_timezone_set('Asia/karachi');
        
            $fields = (array)json_decode($data);
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
            foreach($inventories as $inv){
                $inv->added_by = User::find($inv->added_by);
            }
            
            $pdf = PDF::loadView('inventoryinreport', ['inventories'=>$inventories])->setPaper('a4', 'landscape');
            return $pdf->download('inventory_in_report.pdf');
    }
    public function inventoryoutexport($data) 
    {
        date_default_timezone_set('Asia/karachi');
            $fields = (array)json_decode($data);
            $key = $fields['inout'][0]; 
            $op = $fields['inout'][1]; 
            $val = $fields['inout'][2];
            unset($fields['inout']); 
            if(isset($fields['from_issuance']) || isset($fields['to_issuance'])){

                if(isset($fields['from_issuance']) && isset($fields['to_issuance'])){
                    $from = $fields['from_issuance'];
                    $to = strtotime($fields['to_issuance'].'+1 day');
                    unset($fields['from_issuance']);
                    unset($fields['to_issuance']);
                    $issue = Issue::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', $to)])
                                            ->select('inventory_id')
                                            ->orderBy('id', 'desc')->get();
                }
                else if(isset($fields['from_issuance']) && !isset($fields['to_issuance'])){
                    $from = $fields['from_issuance'];
                    unset($fields['from_issuance']);
                    $issue = Issue::where([[$fields]])->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])
                                            ->select('inventory_id')
                                            ->orderBy('id', 'desc')->get();
                }
                else if(!isset($fields['from_issuance']) && isset($fields['to_issuance'])){
                    $to = strtotime($fields['to_issuance'].'+1 day');
                    unset($fields['to_issuance']);
                    $issue = Issue::where([[$fields]])->whereBetween('updated_at', ['', date('Y-m-d', $to)])
                                            ->select('inventory_id')
                                            ->orderBy('id', 'desc')->get();
                }

                $ids = array();
                foreach($issue as $iss){
                    $ids[] = $iss->inventory_id;
                }
                $inventories = Inventory::where([[$fields]])->where($key, $op, $val)->whereIn('id', $ids)->orderBy('id', 'desc')->get();
            }
            else{
                $inventories = Inventory::where([[$fields]])->where($key, $op, $val)->whereNotIn('status', [0])->orderBy('id', 'desc')->get();
            }
            foreach($inventories as $inv){
                $inv->added_by = User::find($inv->added_by);
                $inv->issued_by = User::find($inv->issued_by);
                $inv->issue_date = Issue::where('inventory_id', $inv->id)->select('created_at')->orderBy('id', 'desc')->first();
            }
            $pdf = PDF::loadView('inventoryoutreport', ['inventories'=>$inventories])->setPaper('a4', 'landscape');
            return $pdf->download('inventory_out_report.pdf');
    }

    public function bincardexport($data) 
    {
        date_default_timezone_set('Asia/karachi');
        $fields = (array)json_decode($data);
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
            if(!empty($inventories)){
                foreach($inventories as $inventory){
                    $inventory->repairing = Repairing::where('item_id',$inventory->id)->first();
                    $inventory->added_by = User::where('id',$inventory->added_by)->first();
                }
            }
            $pdf = PDF::loadView('bincardreport', ['inventories'=>$inventories])->setPaper('a4', 'landscape');
            return $pdf->download('bin_card_report.pdf');
    }
    public function repairingexport($data) 
    {
        date_default_timezone_set('Asia/karachi');
        $fields = (array)json_decode($data);
        $repairs = Repairing::where([[$fields]])->orderBy('id', 'desc')->get();
            $pdf = PDF::loadView('repairingreport', ['repairs'=>$repairs])->setPaper('a4', 'landscape');
            return $pdf->download('asset_repairing_report.pdf');
    }
    public function disposalexport($data) 
    {
        date_default_timezone_set('Asia/karachi');
        $fields = (array)json_decode($data);
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
            if(!empty($inventories)){
                foreach($inventories as $inventory){
                    $inventory->added_by = User::where('id',$inventory->added_by)->first();
                }
            }
            $pdf = PDF::loadView('disposalreport', ['inventories'=>$inventories])->setPaper('a4', 'landscape');
            return $pdf->download('disposal_report.pdf');
    }
    public function vendor_buyingexport($data) 
    {
        date_default_timezone_set('Asia/karachi');
        $fields = (array)json_decode($data);
        
            if(empty($fields['subcategory_id'])){
                $subcat = Subcategory::where('status',1)->get();
            }
            else{
                $subcat = Subcategory::where('id',$fields['subcategory_id'])->get();
            }
            
            $array = array();
            $i = 0;
            foreach($subcat as $sub){
            
            if(isset($fields['from_date']) && isset($fields['to_date'])){
                $from = $fields['from_date'];
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['from_date']);
                unset($fields['to_date']);
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $fields['vendor_id'])->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereBetween('updated_at', [$from, date('Y-m-d', $to)])->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereBetween('updated_at', [$from, date('Y-m-d', $to)])->whereNotIn('status', [0])->sum('item_price');
                
            }
            else if(isset($fields['from_date']) && !isset($fields['to_date'])){
                $from = $fields['from_date'];
                unset($fields['from_date']);
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $fields['vendor_id'])->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereBetween('updated_at', [$from, date('Y-m-d', strtotime('+1 day'))])->whereNotIn('status', [0])->sum('item_price');
                
            }
            else if(!isset($fields['from_d ate']) && isset($fields['to_date'])){
                $to = strtotime($fields['to_date'].'+1 day');
                unset($fields['to_date']);
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $fields['vendor_id'])->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereBetween('updated_at', ['', date('Y-m-d', $to)])->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereBetween('updated_at', ['', date('Y-m-d', $to)])->whereNotIn('status', [0])->sum('item_price');
                
            }
            else{
                $array[$i]['subcategory'] = $sub->sub_cat_name;
                $array[$i]['vendor'] = Vendor::where('id', $fields['vendor_id'])->select('vendor_name')->first();
                $array[$i]['total_items'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereNotIn('status', [0])->count();
                $array[$i]['amount'] = Inventory::where('subcategory_id',$sub->id)->where('vendor_id',$fields['vendor_id'])->whereNotIn('status', [0])->sum('item_price');
            }
            if($array[$i]['total_items'] == 0){
                unset($array[$i]);
            }
            $i++;
        }
        $inventories = $array;
        $pdf = PDF::loadView('vendorbuyingreport', ['inventories'=>$inventories])->setPaper('a4', 'landscape');
        return $pdf->download('vendor_buying_report.pdf');
    }
}
