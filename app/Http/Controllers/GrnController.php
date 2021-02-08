<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Grn;
use App\Inventory;
class GrnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_grn(Request $request){
        $validator = Validator::make($request->all(), [
            'inventory_check' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $grn_no = date('dm').'001';
        // while(Grn::where('grn_no',$grn_no)->first()){
        while(Grn::whereRaw('to_char(grn_no) = '.$grn_no)->first()){
            $grn_no++;
        }
        $inv = $request->inventory_check;
        $fields = array('grn_no'=>$grn_no, 'inv_id'=>json_encode($inv));
        $create = Grn::create($fields);
        foreach($inv as $item){
            $update = Inventory::where('id', $item)->update(['status'=>2]);
        }
        if($create){
            return redirect()->back()->with('msg', 'Items Added in Inventory with GRN No : '.$grn_no);
        }
        else{
            return redirect()->back()->with('msg', 'Could not add items in inventory, Try Again!');
        }  
    }
    public function get_grns(){
        $fetch = GRN::orderByDesc('id')->get();
        return view('grns', ['grns' => $fetch]);
    }
    public function filter_grn(Request $request){
        $from = $request->from;
        $to = $request->to;
        $range = array('from'=>$from, 'to'=>$to);
        $fetch = GRN::whereBetween('created_at', [$from, $to])->orderByDesc('id')->get();
        return view('grns', ['grns' => $fetch, 'range'=>$range]);
    }
}
