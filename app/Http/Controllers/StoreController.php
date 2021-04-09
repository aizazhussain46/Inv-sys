<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Store;
use App\User;
use App\Location;
class StoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $store = Store::all();
        foreach($store as $st){
            $user = User::where('id', $st->emp_id)->first();
            if($user){
                $st['user'] = $user->name;
            }
        }
        
        return view('store', ['stores' => $store]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'required',
            'location_id' => 'required|not_in:null',
            'administrator' => 'required|not_in:null',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('store_name'=>$request->store_name, 'location_id'=>$request->location_id, 'emp_id'=>$request->administrator);
        $create = Store::create($fields);
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
        $location = Location::orderBy('location', 'asc')->get();
        $user = User::where('status',1)->where('role_id',2)->orderBy('name', 'asc')->get();
        return view('edit_store', ['store'=> $store, 'users' => $user, 'locations' => $location]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'store_name' => 'required',
            'location_id' => 'required|not_in:null',
            'administrator' => 'required|not_in:null',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('store_name'=>$request->store_name, 'location_id'=>$request->location_id, 'emp_id'=>$request->administrator);
        $update = Store::where('id', $id)->update($fields);
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
