<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Category;
use App\Subcategory;
class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = Subcategory::all();
        return view('subcategories', ['subcategories' => $category]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:null',
            'sub_cat_name' => 'required',
            'threshold' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('category_id'=>$request->category_id,'sub_cat_name'=>$request->sub_cat_name,'threshold'=>$request->threshold,'status'=>1);
        $create = Subcategory::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Sub Category Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add sub category, Try Again!');
        }
    }

    public function show($id)
    {
        $subcategory = Subcategory::find($id);
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('edit_subcategory', ['categories'=> $category, 'subcategory'=> $subcategory]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'sub_cat_name' => 'required',
            'threshold' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Subcategory::where('id', $id)->update(['category_id'=>$request->category_id,'sub_cat_name'=>$request->sub_cat_name, 'threshold'=>$request->threshold, 'status'=>$request->status]);
        if($update){
            return redirect()->back()->with('msg', 'Sub Category Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update sub category, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Subcategory::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Sub Category Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete sub category, Try Again!');
    }
}
