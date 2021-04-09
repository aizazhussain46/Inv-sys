<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Devicetype;
class DevicetypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $devicetype = Devicetype::orderBy('devicetype_name', 'asc')->get();
        return view('devicetype', ['devicetypes' => $devicetype]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'devicetype_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('devicetype_name'=>$request->devicetype_name, 'status'=>1);
        $create = Devicetype::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Devicetype Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add devicetype, Try Again!');
        }
    }

    public function show($id)
    {
        $devicetype = Devicetype::find($id);
        return view('edit_devicetype', ['devicetype'=> $devicetype]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'devicetype_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Devicetype::where('id', $id)->update(['devicetype_name'=>$request->devicetype_name, 'status'=>$request->status]);
        if($update){
            return redirect()->back()->with('msg', 'Devicetype Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update devicetype, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Devicetype::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Devicetype Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete devicetype, Try Again!');
    }
}
