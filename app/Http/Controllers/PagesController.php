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

    	$items  = $items->map(function($item){
    		
    		$total_import = Transaction::select('quantity')->whereHas('item',function($q) use($item){
    		$q->where('action','!=','EXPORT STOCK')
    		->where('item_id',$item->id);
	    	})->sum('quantity');

	    	$total_export = Transaction::select('quantity')->whereHas('item',function($q) use($item){
	    	$q->where('action','EXPORT STOCK')
	    	->where('item_id',$item->id);
	    	})->sum('quantity');

	    	return collect([
	    		'id'=>$item->id,
	    		'name'=>$item->name,
	    		'supplier_name'=>$item->supplier->supplier_name,
	    		'total_import'=>$total_import,
	    		'total_export'=>$total_export,
	    		'stock'=>$item->stock,
	    		'created_at'=>$item->created_at,
	    		'posted_by'=>$item->posted_by,
	    		'unit'=>$item->unit,
	    		'unit_price'=>$item->unit_price]);
    	});
    	// return $items;
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

    		$total_import = Transaction::whereHas('item',function($q) use ($supplier,$item){
    		$q->where('supplier_id',$supplier->id)
    		->where('item_id',$item->id)
    		->where('action','!=','EXPORT STOCK');
	    	})->sum('quantity');

	    	$total_export = Transaction::whereHas('item',function($q) use ($supplier,$item){
	    		$q->where('supplier_id',$supplier->id)
	    		->where('item_id',$item->id)
	    		->where('action','EXPORT STOCK');
	    	})->sum('quantity');

	    	return collect([
	    		'name'=>$item->name,
	    		'total_import'=>$total_import,
	    		'total_export'=>$total_export,
	    		'stock'=>$item->stock,
	    		'created_at'=>$item->created_at,
	    		'posted_by'=>$item->posted_by,
	    		'unit'=>$item->unit,
	    		'unit_price'=>$item->unit_price
	    	]); 

    	});

    	$transactions = Transaction::whereHas('item',function($q) use ($supplier){
    		$q->where('supplier_id',$supplier->id);
    	})->get();
    
    	
		return view('pages.suppliers')->with('info',$info)->with('items',$items)->with('transactions',$transactions);
    }
    public function show_item($id){
        $item = Item::findOrFail($id);
        $transactions = Transaction::where('item_id', $id)->get();
        return view('pages.item')->with('item',$item)->with('transactions',$transactions);
    }
}
