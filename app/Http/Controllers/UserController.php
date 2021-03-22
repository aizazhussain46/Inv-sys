<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Role;
use App\User;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user = User::all();
        return view('user', ['users' => $user]);
    }

    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'emp_no' => 'required',
            'name' => 'required',
            'location' => 'required|not_in:null',
            'department' => 'required|not_in:null',
            'designation' => 'required|not_in:null',
            'hdd' => 'required|not_in:null',
            'status' => 'required|not_in:null',
            'email' => 'required|unique:users',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
            'role_id' => 'required|not_in:null'   
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $fields = $request->all();
        $fields['password'] = bcrypt($request->password);
        $fields['isactive'] = 1;
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
        return view('edit_user', ['user' => User::find($id), 'roles' => Role::all()]);
    }

    public function update(Request $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'emp_no' => 'required',
        //     'name' => 'required',
        //     'branch' => 'required|not_in:null',
        //     'location' => 'required|not_in:null',
        //     'contact' => 'required',
        //     'department' => 'required|not_in:null',
        //     'designation' => 'required|not_in:null',
        //     'hdd' => 'required|not_in:null',
        //     'status' => 'required|not_in:null',
        //     'email' => 'required',
        //     'confirm_password' => 'same:password',
        //     'role_id' => 'required|not_in:null'   
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator);
        // }

        $fields = array(
            // 'name'=>$request->name, 
            // 'email' => $request->email, 
            'role_id' => $request->role_id,
            // 'emp_no' => $request->emp_no,
            // 'branch' => $request->branch,
            // 'location' => $request->location,
            // 'contact' => $request->contact,
            // 'department' => $request->department,
            // 'designation' => $request->designation,
            // 'hdd' => $request->hdd,
            // 'status' => $request->status,
        );
        if($request->password){
            $fields['password'] = bcrypt($request->password);
        }
        
        $update = User::where('id', $id)->update($fields);
        if($update){
            return redirect()->back()->with('msg', 'Password Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update Password, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = User::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'User Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete user, Try Again!');
    }


    public function activeinactive($id, $data)
    {
        if($data == 1 || $data == 0){
            $update = User::where('id', $id)->update(['isactive'=>$data]);
            if($data == 1){
                return redirect()->back()->with('msg', 'User Activated Successfully!');
            }
            else{
                return redirect()->back()->with('msg', 'User Deactivated');
            }
        }
        else{
            return redirect()->back()->with('msg', 'Nothing update. Try again!');
        }
        
    }
}
