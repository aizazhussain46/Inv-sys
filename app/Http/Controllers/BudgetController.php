<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BudgetExport;
use App\Exports\ItemsExport;
use App\Category;
use App\Subcategory;
use App\User;
use App\Year;
use App\Dollar;
use App\Type;
use App\Budgetitem as Budget;
class BudgetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'sub_cat_id' => 'required|not_in:0',
            'dept_id' => 'required|not_in:0',
            'type_id' => 'required|not_in:0',
            'year_id' => 'required|not_in:0',
            'unit_dollar' => 'required',
            'unit_pkr' => 'required',
            'qty' => 'required',
            'total_dollar' => 'required',
            'total_pkr' => 'required',  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $year = Year::where('id',$request->year_id)->first();
        if($year->locked == 1){
            return redirect()->back()->with('msg', 'Sorry, You can not add item in Locked Budget');
        }
        $fields = array(
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->sub_cat_id,
            'dept_id' => $request->dept_id,
            'department' => $request->department,
            'type_id' => $request->type_id,
            'year_id' => $request->year_id,
            'description' => $request->description,
            'unit_price_dollar' => $request->unit_dollar,
            'unit_price_pkr' => $request->unit_dollar*$request->unit_pkr,
            'qty' => $request->qty,
            'total_price_dollar' => $request->total_dollar,
            'total_price_pkr' => $request->total_pkr,
            'remarks' => $request->remarks
        );
        $create = Budget::create($fields);
        if($create){
            return redirect()->back()->with('msg', 'Budget Item Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add budget item, Try Again!');
        }
    }

    public function show($id)
    {
        $data = array();
        $budget = Budget::find($id);
        $data['budget'] = $budget;
        $data['categories'] = Category::where('status',1)->get();
        $data['subcategories'] = Subcategory::where('status',1)->get();
        $data['types'] = Type::all();
        $data['years'] = Year::where('locked', null)->get();
        $data['pkr'] = Dollar::where('year_id', $budget->year_id)->first();
        // echo "<pre>";
        // print_r($data);
        return view('edit_budget', $data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'sub_cat_id' => 'required|not_in:0',
            'dept_id' => 'required|not_in:0',
            'type_id' => 'required|not_in:0',
            'year_id' => 'required|not_in:0',
            'unit_dollar' => 'required',
            'unit_pkr' => 'required',
            'qty' => 'required',
            'total_dollar' => 'required',
            'total_pkr' => 'required',  
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $fields = array(
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->sub_cat_id,
            'dept_id' => $request->dept_id,
            'department' => $request->department,
            'type_id' => $request->type_id,
            'year_id' => $request->year_id,
            'description' => $request->description,
            'unit_price_dollar' => $request->unit_dollar,
            'unit_price_pkr' => $request->unit_dollar*$request->unit_pkr,
            'qty' => $request->qty,
            'total_price_dollar' => $request->total_dollar,
            'total_price_pkr' => $request->total_pkr,
            'remarks' => $request->remarks
        );
        $create = Budget::where('id',$id)->update($fields);
        if($create){
            return redirect()->back()->with('msg', 'Budget Item Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update budget item, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Budget::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Budget Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete budget, Try Again!');
    }
    public function budget_by_year(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|not_in:0',
            'year_id' => 'required|not_in:0'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $data = array();
        $data['years'] = Year::all();
        $data['categories'] = Category::where('status',1)->get();
        $data['budgets'] = Budget::where('year_id', $request->year_id)->where('category_id',$request->category_id)->get();
        $data['filter'] = Year::find($request->year_id);
        $data['filters'] = (object)array('catid'=>$request->category_id, 'yearid'=>$request->year_id);
        return view('show_budget', $data);
    }
    public function summary_by_year(Request $request)
    {
        $budget = Budget::where('year_id', $request->year_id)->first();
        
        if(!empty($budget)){
            $category = Category::where('status',1)->get();
            foreach($category as $cat){
                $cat['unit_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $request->year_id)->sum('unit_price_dollar');
                $cat['unit_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $request->year_id)->sum('unit_price_pkr');
                $cat['total_price_dollar'] = Budget::where('category_id', $cat->id)->where('year_id', $request->year_id)->sum('total_price_dollar');
                $cat['total_price_pkr'] = Budget::where('category_id', $cat->id)->where('year_id', $request->year_id)->sum('total_price_pkr');
                $cat['consumed'] = Budget::where('category_id', $cat->id)->where('year_id', $request->year_id)->sum('consumed');
                $cat['remaining'] = Budget::where('category_id', $cat->id)->where('year_id', $request->year_id)->sum('remaining');
            }
        }
        else{
            $category = array();
        }
        return view('summary', ['filter'=>$request->year_id,'categories'=>$category, 'years'=>Year::all()]);
    }
    public function lock_budget($id)
    {
        $budget = Budget::where('year_id', $id)->first();
        
        if(!empty($budget)){
            $year = Year::where('id',$id)->update(['locked'=>1]);
            if($year){
                return redirect()->back()->with('msg', 'Budget Locked Successfully!');
            }
            else{
                return redirect()->back()->with('msg', 'Could not lock budget, Try Again!');
            }
        }
        else{
            return redirect()->back()->with('msg', 'No any budget found in selected year, Kindly add budget and try again!');
        }    
    }


    public function budgetexport($data) 
    {
        $year = Year::find($data);
        return Excel::download(new BudgetExport($data), 'budgetsummary_'.$year->year.'.xlsx'); 
    }
    public function itemexport($data) 
    {
        $filters = json_decode($data);
        $year = Year::find($filters->yearid);
        $category = Category::find($filters->catid);
        return Excel::download(new ItemsExport($data), 'Itemsexport_'.$category->category_name.'_'.$year->year.'.xlsx'); 
    }
}
