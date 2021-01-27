<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BatchTransaction;

class BatchTransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->ajax()){
        $product_name = strtoupper($request->product_name);
        $stock = $request->stock;
        $unit = strtoupper($request->unit);
        $action = strtoupper($request->action);
        $from = $request->from;

        $batch = new BatchTransaction;
        $batch->product_name = $product_name;
        $batch->stock = $stock;
        $batch->unit = $unit;
        $batch->from = $from;
        $batch->performed_by = auth()->user()->name;
        $batch->action = $action;
        
        $batch->save();

        return('Import Success');
        }
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
}
