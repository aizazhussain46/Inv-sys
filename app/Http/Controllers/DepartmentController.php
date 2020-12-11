<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Department;
class DepartmentController extends Controller
{
    public function index()
    {
        $department = Department::all();
        return view('department', ['departments' => $department]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Department::create($request->all());
        if($create){
            return redirect()->back()->with('msg', 'Department Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add department, Try Again!');
        }
    }

    public function show($id)
    {
        $department = Department::find($id);
        return view('edit_department', ['department'=> $department]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Department::where('id', $id)->update(['department_name'=>$request->department_name]);
        if($update){
            return redirect()->back()->with('msg', 'Department Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update department, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Department::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Department Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete department, Try Again!');
    }
}
