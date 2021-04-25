<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Resigned_employee as Resigned;

class ResignedController extends Controller
{
    public function index()
    {
        $resigned = Resigned::all();
        return view('resigned_emp', ['resigned'=>$resigned]);
    }

    public function store(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'emp_code' => 'required',
        //     'resign_date' => 'required',
        //     'effective_from' => 'required',
        //     'done_date' => 'required' 
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator);
        // }   

        // $fields = array(
        //     'emp_code' => $request->emp_code,
        //     'resign_date' => $request->resign_date,
        //     'effective_from' => $request->effective_from,
        //     'done_date' => $request->done_date,
        //     'remarks' => $request->remarks,
        //     'status' => 0
        // );

        // $create = Resigned::create($fields);
        // if($create){
        //     return redirect()->back()->with('msg', 'Record Added Successfully!');
        // }
        // else{
        //     return redirect()->back()->with('msg', 'Could not add record, Try Again!');
        // }
    }

    public function show($id)
    {
        $show = Resigned::where('id',$id)->update(['status'=>1]);
        if($show){
            return redirect()->back()->with('msg', 'Status Changed!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not change status, Try Again!');
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
