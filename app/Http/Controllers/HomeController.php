<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Supplier;
use App\Transaction;
use DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'H5 Warehouse System';
        $items = Item::all();
        $transaction = Transaction::with('item')->get();
        $suppliers = Supplier::pluck('supplier_name');

        return view('home')->with('title',$title)->with('items',$items)->with('transaction',$transaction)->with('suppliers',$suppliers);
    }
    public function crud(){
     
        // if(request()->ajax()){
            
        //     return Item::latest()->get();
        // }
        return view('sample');
    }
    // public function view_items(){
    //     return Transaction::latest()->get();
    // }
}
