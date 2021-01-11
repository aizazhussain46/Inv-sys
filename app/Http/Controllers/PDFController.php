<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use App\Grn;
use App\Gin;
use App\Inventory;
use App\Employee;
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
}
