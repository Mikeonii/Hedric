<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Transaction;
use DB;
class itemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $items = Item::all();
        return view('items.index')->with('items',$items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
           return('stored');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return redirect('/items');
    }

    public function store(Request $request){
        if($request->ajax()){
        $product_name = strtoupper($request->product_name);
        $stock = $request->stock;
        $unit = strtoupper($request->unit);
        $from = strtoupper($request->from);
        $user = auth()->user()->name;

        $item = new Item;
        $item->name = $product_name;
        $item->stock = $stock;
        $item->from = $from;
        $item->posted_by = $user;
        $item->unit = $unit;
        $item->save();
        return('success');
        }
    }
    public function import(Request $request){
        if($request->ajax()){

         $item_id = $request->item_id;
         $quantity = $request->import_number;
       
         $items = Item::find($item_id);
         //get current stock
         $current = $items->stock;
         //add current to request 
         $new_stock = $quantity+$current;
         //update stock
         $items->stock = $new_stock;

         $items->save();
       

        return('success');
        }
        else{
            return('failed');
        }
    }

    public function export(Request $request){
         if($request->ajax()){

         $item_id = $request->item_id;
         $quantity = $request->import_number;
        
        
         $items = Item::find($item_id);
         //get current stock
         $current = $items->stock;
         //add current to request 
         $new_stock = $current-$quantity;
         //update stock
         $items->stock = $new_stock;
       
         $items->save();
       

        return('success');
        }
        else{
            return('failed');
        }
    }
}
