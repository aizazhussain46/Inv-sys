<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Itemnature;
class ItemnatureController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $itemnature = Itemnature::all();
        return view('itemnature', ['itemnatures' => $itemnature]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'itemnature_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('itemnature_name'=>$request->itemnature_name, 'status'=>1);
        $create = Itemnature::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Itemnature Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add itemnature, Try Again!');
        }
    }

    public function show($id)
    {
        $itemnature = Itemnature::find($id);
        return view('edit_itemnature', ['itemnature'=> $itemnature]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'itemnature_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Itemnature::where('id', $id)->update(['itemnature_name'=>$request->itemnature_name, 'status'=>$request->status]);
        if($update){
            return redirect()->back()->with('msg', 'Itemnature Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update itemnature, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Itemnature::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Itemnature Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete itemnature, Try Again!');
    }
}
