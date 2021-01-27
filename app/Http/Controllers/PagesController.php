<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Items;
use App\Transaction;
class PagesController extends Controller
{
    public function index(){
    
    	return view('pages.index');
    }

    public function about(){
    	return view('pages.about');
    }
}
