<?php

namespace App\Http\Controllers;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $link = Link::all();
        return view('link', ['links' => $link]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $link = Link::all();
        return view('add_link', ['links' => $link]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $create = Link::create(['url' => $request->url]);
        if($create){
            return redirect()->back()->with('msg', 'Link Added Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not add Link, Try Again!');
        }
    }

    public function show($id)
    {
        $link = Link::find($id);
        return view('edit_link', ['link'=> $link]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $update = Link::where('id', $id)->update(['url'=>$request->url]);
        if($update){
            return redirect()->back()->with('msg', 'Link Updated Successfully!');
        }
        else{
            return redirect()->back()->with('msg', 'Could not update Link, Try Again!');
        }
    }

    public function destroy($id)
    {
        $find = Link::find($id);
        return $find->delete() ? redirect()->back()->with('msg', 'Link Deleted Successfully!') : redirect()->back()->with('msg', 'Could not delete link, Try Again!');
    }
}
