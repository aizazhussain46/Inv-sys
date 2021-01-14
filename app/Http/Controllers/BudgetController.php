<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $fields = array(
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_cat_id,
            'dept_id' => $request->dept_id,
            'department' => $request->department,
            'type_id' => $request->type_id,
            'year_id' => $request->year_id,
            'description' => $request->description,
            'unit_price_dollar' => $request->unit_dollar,
            'unit_price_pkr' => $request->unit_pkr,
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
        //
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
