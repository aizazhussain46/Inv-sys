<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Modal;
class modelController extends Controller
{
    public function index()
    {
        $model = Modal::all();
        return view('model', ['models' => $model]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'model_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Modal::create($request->all());
        if($create){
            return redirect()->back()->with('msg', 'Model Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add model, Try Again!');
        }
    }

    public function show($id)
    {
        $model = Modal::find($id);
        return view('edit_model', ['model'=> $model]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'model_name' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Modal::where('id', $id)->update(['model_name'=>$request->model_name]);
        if($update){
            return redirect()->back()->with('msg', 'Model Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update model, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Modal::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Model Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete model, Try Again!');
    }
}
