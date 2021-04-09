<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $employee = Employee::orderBy('name', 'asc')->get();
        return view('employee', ['employees' => $employee]);
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'emp_code' => 'required',
            'name' => 'required',
            'branch_id' => 'required|not_in:null',
            'location' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'hod' => 'required',
            'status' => 'required',
            'email' => 'required|unique:employees'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        
        $fields = $request->all();
        if($fields['branch_id'] != 0){
            $fields['dept_id'] = $fields['branch_id'];
            $fields['department'] = $fields['branch'];
        }
        $create = Employee::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Employee Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add employee, Try Again!');
        }
    }

    public function show($id)
    {
        $employee = Employee::find($id);
        return view('edit_employee', ['employee' => $employee]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'branch' => 'required|not_in:null',
            'location' => 'required',
            'department' => 'required',
            'designation' => 'required',
            'hod' => 'required',
            'status' => 'required',
            'email' => 'required' 
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $fields = $request->all();
        $update = Employee::where('id', $id)->update($fields);
        if($update){
            return redirect()->back()->with('msg', 'Employee Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update employee, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Employee::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Employee Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete employee, Try Again!');
    }
    public function get_employee($id){
        $find = Employee::where('emp_code', $id)->first();
        return $find??0;
    }
}
