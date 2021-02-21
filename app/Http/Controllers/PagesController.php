<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Transaction;
use App\Supplier;
class PagesController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }
    public function inventory(){
    	$items = Item::all();
    	return view('pages.inventory')->with('items',$items);
    }
    public function index(){
    
    	return view('pages.index');
    }
    public function about(){
    	return view('pages.about');
    }
    public function suppliers(Request $request){
   
    	$supplier = Supplier::find(($request->supplier+1));
    	$info = Item::where('supplier_id',$supplier->id)->with('transactions','supplier')->get();

    	$items = Item::where('supplier_id',$supplier->id)->get();
  
    	$items = $items->map(function($item) use($supplier){

    		$total_import = Transaction::whereHas('item',function($q) use ($supplier){
    		$q->where('supplier_id',$supplier->id)
    		->where('action','!=','EXPORT STOCK');
	    	})->count();

	    	$total_export = Transaction::whereHas('item',function($q) use ($supplier){
	    		$q->where('supplier_id',$supplier->id)
	    		->where('action','EXPORT STOCK');
	    	})->count();

	    	return collect(['name'=>$item->name,'total_import'=>$total_import,'total_export'=>$total_export,'stock'=>$item->stock,'created_at'=>$item->created_at,'posted_by'=>$item->posted_by,'unit'=>$item->unit]); 

    	});

    	$transactions = Transaction::whereHas('item',function($q) use ($supplier){
    		$q->where('supplier_id',$supplier->id);
    	})->get();
    
    	
		return view('pages.suppliers')->with('info',$info)->with('items',$items)->with('transactions',$transactions);
    }
}
