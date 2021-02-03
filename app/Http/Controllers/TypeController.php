<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Type;
class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $type = Type::all();
        return view('type', ['types' => $type]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('type'=>$request->type);
        $create = Type::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Type Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add type, Try Again!');
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $find = Type::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Type Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete type, Try Again!');
    }
}
