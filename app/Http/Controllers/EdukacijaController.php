<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdukacijaController extends Controller
{
    public function index()
    {
    	return view('category.index');
    }
}
