<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Transaction;
use DB;
use Exception;
use App\Exports\ItemsExport;
use Maatwebsite\Excel\Facades\Excel;

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
      
        $user = auth()->user()->name;
        // check if exist 
        $exist = Item::where('name','=',$request->input('product_name'))->where('supplier_id',$request->input('supplier_id'))->count();
        
        if($exist > 0){
            return "Item already exist!";
        }
        else{
            $item = new Item;
            $item->name = strtoupper($request->input('product_name'));
            $item->unit_price = $request->input('unit_price');
            $item->stock = $request->input('stock');
            $item->supplier_id = ($request->input('supplier')+1);
            $item->posted_by = strtoupper($user);
            $item->unit = strtoupper($request->input('unit'));
            // add transaction

            try{
                $item->save();
                return $this->add_to_transaction($item,"import item","0","0");
            }
            catch(Exception $e){
                return $e->getMessage();
            }   
        }
     
      
    }
    // add to transaction
    public function add_to_transaction($item,$action,$add_quantity,$export_quantity){
    
        $trans = new Transaction;
        // return $item;
        $trans->unit = $item->unit;
        $trans->item_id = $item->id;
        $trans->supplier_id = $item->supplier_id;
        $trans->action = strtoupper($action);
        $trans->performed_by = auth()->user()->name;
        // if import
        if($add_quantity > 0 && $export_quantity == 0){
            $trans->quantity = $add_quantity;
        }
        // if export
        else if($add_quantity == 0 && $export_quantity > 0){
            $trans->quantity = $export_quantity;
        }
        // if new item
        else{
            $trans->quantity = $item->stock;
        }
        
        try{
            $trans->save();
            return "successfully added!";
        }
        catch(Exception $e){
            return $e->getMessage();
        }

    }
    public function add_stocks(Request $request){

        $item = Item::findOrFail($request->input('item_id'));
        $new_stock = ($item->stock+$request->input('import_number'));
        $item->stock = strval($new_stock);

        try{
            $item->save();
            // add to transaction
            return $this->add_to_transaction($item,"add stock",$request->input('import_number'),'0');

        }
        catch(Exception $e){
            return $e->getMessage();
        }
        
    }

    public function export(Request $request){

        $item = Item::find($request->input('item_id'));
        $new_stock = ($item->stock - $request->input('export_number'));

        $item->stock = strval($new_stock);

        try{
            $item->save();
            // add to transaction
            return $this->add_to_transaction($item,"export stock",'0',$request->input('export_number'));
        }
        catch(Exception $e){
            return $e->getMessage();
        }
    }
    // export excel file
    public function export_excel(){

        $items = Item::all();
        // return Excel::download(new ItemsExport,'items.xlsx');
        // return view('pages.export')->with('items',$items);
        return Excel::download(new ItemsExport($items),'items.xlsx');

    }
}
