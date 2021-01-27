<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use DB;
use App\Item;
use App\BatchTransaction;
class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batch = BatchTransaction::all();
         $item = DB::table('transactions')
        ->select('transactions.*','items.name')
        ->join('items','transactions.product_id','=','items.id')
        ->orderBy('transactions.id','DESC')
        
        ->get();
        return view('transactions.index')->with('batch', $batch)->with('item',$item);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
       
        $trans = new Transaction;
        $trans->unit = $request->unit;
        $trans->product_id = $request->item_id;
        $trans->action =$request->action;;
        $trans->performed_by = auth()->user()->name;
        $trans->quantity = $request->import_number;
        $trans->to = strtoupper($request->to);
        $trans->save();

        return('success');
    }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function batch(Request $request){
      
       
    }
}