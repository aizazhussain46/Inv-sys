<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Store;
class StoreController extends Controller
{
    public function index()
    {
        $store = Store::all();
        return view('store', ['stores' => $store]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Store::create($request->all());
        if($create){
            return redirect()->back()->with('msg', 'Store Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add store, Try Again!');
        }
    }

    public function show($id)
    {
        $store = Store::find($id);
        return view('edit_store', ['store'=> $store]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Store::where('id', $id)->update(['store_name'=>$request->store_name]);
        if($update){
            return redirect()->back()->with('msg', 'Store Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update store, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Store::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Store Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete store, Try Again!');
    }
}
