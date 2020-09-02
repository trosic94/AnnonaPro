<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class BaseController extends Controller
{

  public function __construct()
  {

    parent::__construct();
    
  	$shared = array();
	
	//oznake za navigaciju
    $catOznake = Category::catOznake();
    $shared['catOznake'] = $catOznake;
  
    // Sharing is caring
    //View::share('catOznake', $catOznake);
    View::share('shared', $shared);
  }
}
