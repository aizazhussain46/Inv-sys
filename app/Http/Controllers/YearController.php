<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Year;
class YearController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $year = Year::all();
        return view('year', ['years' => $year]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('year'=>$request->year);
        $create = Year::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Year Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add year, Try Again!');
        }
    }

    public function show($id)
    {
       $year = Year::find($id);
       return view('edit_year', ['year' => $year]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('year'=>$request->year);
        $update = Year::where('id', $id)->update($fields);
        if($update){
            return redirect()->back()->with('msg', 'Year Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update year, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Year::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Year Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete year, Try Again!');
    }
}
