<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Inventorytype;
class InventorytypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $inventorytype = Inventorytype::all();
        return view('inventorytype', ['inventorytypes' => $inventorytype]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inventorytype_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('inventorytype_name'=>$request->inventorytype_name, 'status'=>1);
        $create = Inventorytype::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Inventorytype Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add inventorytype, Try Again!');
        }
    }

    public function show($id)
    {
        $inventorytype = Inventorytype::find($id);
        return view('edit_inventorytype', ['inventorytype'=> $inventorytype]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'inventorytype_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Inventorytype::where('id', $id)->update(['inventorytype_name'=>$request->inventorytype_name, 'status'=>$request->status]);
        if($update){
            return redirect()->back()->with('msg', 'Inventorytype Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update inventorytype, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Inventorytype::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Inventorytype Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete inventorytype, Try Again!');
    }
}
