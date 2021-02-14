<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Transaction;
use DB;
use App\Supplier;

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
        $transaction = DB::table('transactions')
        ->select('transactions.*','items.name')
        ->join('items','transactions.item_id','=','items.id')
        ->orderBy('transactions.id','DESC')
        ->skip(0)
        ->take(5)
        ->get();
        $suppliers = Supplier::pluck('supplier_name');
        // $batchTrans = DB::table('batch_transactions')
        // ->select('*')
        // ->orderBy('id','DESC')
        // ->skip(0)
        // ->take(5)
        // ->get();
        return view('home')->with('title',$title)->with('items',$items)->with('transaction',$transaction)->with('suppliers',$suppliers);
    }
}
