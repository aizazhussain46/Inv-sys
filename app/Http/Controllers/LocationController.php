<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Location;
class LocationController extends Controller
{
    public function index()
    {
        $location = Location::all();
        return view('location', ['locations' => $location]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Location::create($request->all());
        if($create){
            return redirect()->back()->with('msg', 'Location Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add location, Try Again!');
        }
    }

    public function show($id)
    {
        $location = Location::find($id);
        return view('edit_location', ['location'=> $location]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'location' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Location::where('id', $id)->update(['location'=>$request->location]);
        if($update){
            return redirect()->back()->with('msg', 'Location Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update location, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Location::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Location Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete location, Try Again!');
    }
}
