<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Makee;

class MakeController extends Controller
{
    public function index()
    {
        $make = Makee::all();
        return view('make', ['makes' => $make]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'make_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Makee::create($request->all());
        if($create){
            return redirect()->back()->with('msg', 'Make Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add make, Try Again!');
        }
    }

    public function show($id)
    {
        $make = Makee::find($id);
        return view('edit_make', ['make'=> $make]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'make_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Makee::where('id', $id)->update(['make_name'=>$request->make_name]);
        if($update){
            return redirect()->back()->with('msg', 'Make Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update make, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Makee::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Make Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete make, Try Again!');

    }
}
