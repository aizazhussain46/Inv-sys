<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('user', ['users' => $user]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'role_id' => 'required|not_in:0'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $fields = $request->all();
        $fields['password'] = bcrypt($request->password);
        
        $create = User::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'User Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add user, Try Again!');
        }
    }

    public function show($id)
    {
        $role = Role::all();
        $user = User::find($id);
        return view('edit_user', ['user' => $user, 'roles' => $role]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'confirm_password' => 'same:password',
            'role_id' => 'required|not_in:0'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $fields = array('name'=>$request->name, 'email' => $request->email, 'role_id' => $request->role_id);
        if($request->password){
            $fields['password'] = bcrypt($request->password);
        }
        
        $update = User::where('id', $id)->update($fields);
        if($update){
            return redirect()->back()->with('msg', 'User Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update user, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = User::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'User Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete user, Try Again!');
    }
}
