<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Branch;
class BranchController extends Controller
{
    public function index()
    {
        $branch = Branch::all();
        return view('branch', ['branches' => $branch]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'branch_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Branch::create($request->all());
        if($create){
            return redirect()->back()->with('msg', 'Branch Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add branch, Try Again!');
        }
    }

    public function show($id)
    {
        $branch = Branch::find($id);
        return view('edit_branch', ['branch'=> $branch]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'branch_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Branch::where('id', $id)->update(['branch_name'=>$request->branch_name]);
        if($update){
            return redirect()->back()->with('msg', 'Branch Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update branch, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Branch::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Branch Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete branch, Try Again!');
    }
}
