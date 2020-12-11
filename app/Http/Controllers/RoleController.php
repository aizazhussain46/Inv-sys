<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Role;
class RoleController extends Controller
{
    public function index()
    {
        $role = Role::all();
        return view('role', ['roles' => $role]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Role::create($request->all());
        if($create){
            return redirect()->back()->with('msg', 'Role Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add role, Try Again!');
        }
    }

    public function show($id)
    {
        $role = Role::find($id);
        return view('edit_role', ['role'=> $role]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Role::where('id', $id)->update(['role'=>$request->role]);
        if($update){
            return redirect()->back()->with('msg', 'Role Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update role, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Role::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Role Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete role, Try Again!');
    }
}
