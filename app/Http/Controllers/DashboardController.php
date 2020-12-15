<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Inventory;
use App\User;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $inventory = Inventory::orderBy('id', 'desc')->limit(10)->get();
        
        foreach($inventory as $inv){
            $user = User::where('id', $inv->issued_to)->first();
            if($user){
                $inv['user'] = $user;
            }
        }
        return view('dashboard', ['inventories' => $inventory]);
    }
}
