<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Supplier;
use Exception;

class SupplierController extends Controller
{
    public function store(Request $request){
    	// echo "asd";
    	$new = new Supplier;
    	$new->supplier_name = $request->input('name');
    	try{
    		$new->save();
    		return "Successfully added!";
    	}
    	catch(Exception $e){
    		return $e->getMessage();
    	}

    }
}
