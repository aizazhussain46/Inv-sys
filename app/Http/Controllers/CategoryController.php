<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $category = Category::orderBy('category_name', 'asc')->get();
        return view('categories', ['categories' => $category]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'threshold' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array('category_name'=>$request->category_name,'threshold'=>$request->threshold,'status'=>1);
        $create = Category::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Category Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add category, Try Again!');
        }
    }

    public function show($id)
    {
        $category = Category::find($id);
        return view('edit_category', ['category'=> $category]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'threshold' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Category::where('id', $id)->update(['category_name'=>$request->category_name, 'threshold'=>$request->threshold, 'status'=>$request->status]);
        if($update){
            return redirect()->back()->with('msg', 'Category Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update category, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Category::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Category Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete category, Try Again!');
    }
}
