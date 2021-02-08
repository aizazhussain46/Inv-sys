<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Gin;
use App\Inventory;
class GinController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create_gin(Request $request){
        $validator = Validator::make($request->all(), [
            'inventory_check' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $gin_no = date('dm').'001';
        // while(Gin::where('gin_no',$gin_no)->first()){
            while(Gin::whereRaw('to_char(gin_no) = '.$gin_no)->first()){
                $gin_no++;
            }
        $inv = $request->inventory_check;
        $fields = array('gin_no'=>$gin_no, 'inv_id'=>json_encode($inv));
        $create = Gin::create($fields);
        foreach($inv as $item){
            $update = Inventory::where('id', $item)->update(['status'=>4]);
        }
        if($create){
            return redirect()->back()->with('msg', 'Items Issued with GIN No : '.$gin_no);
        }
        else{
            return redirect()->back()->with('msg', 'Could not issue items, Try Again!');
        }  
    }
    public function get_gins(){
        $fetch = GIN::orderByDesc('id')->get();
        return view('gins', ['gins' => $fetch]);
    }
    public function filter_gin(Request $request){
        $from = $request->from;
        $to = $request->to;
        $range = array('from'=>$from, 'to'=>$to);
        $fetch = GIN::whereBetween('created_at', [$from, $to])->orderByDesc('id')->get();
        return view('gins', ['gins' => $fetch, 'range'=>$range]);
    }
}
