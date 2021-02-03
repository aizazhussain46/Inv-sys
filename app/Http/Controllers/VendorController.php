<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Vendor;

class VendorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $vendor = Vendor::all();
        return view('vendor', ['vendors' => $vendor]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array(
            'vendor_name'=>$request->vendor_name, 
            'address'=>$request->address, 
            'contact_person'=>$request->contact_person,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'cell' => $request->cell,
        );
        
        $create = Vendor::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Vendor Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add vendor, Try Again!');
        }
    }

    public function show($id)
    {
        $vendor = Vendor::find($id);
        return view('edit_vendor', ['vendor'=> $vendor]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array(
            'vendor_name'=>$request->vendor_name, 
            'address'=>$request->address, 
            'contact_person'=>$request->contact_person,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'cell' => $request->cell,
        );
        $update = Vendor::where('id', $id)->update($fields);
        if($update){
            return redirect()->back()->with('msg', 'Vendor Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update vendor, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Vendor::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Vendor Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete vendor, Try Again!');

    }
}
