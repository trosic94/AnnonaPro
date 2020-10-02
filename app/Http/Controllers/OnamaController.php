<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Banner;
use App\Category;
use App\Post;

class OnamaController extends Controller
{
    public function index()
	{
        $title = 'O nama';
        $metaTitle = 'O nama';
		$slug = array(
            '0' => array(
                'slug' => '/',
                'title' => trans('shop.title_home'),
                'active' => '',
            ),
            '1' => array(
                'slug' => trans('shop.slug_url_onama'),
                'title' => trans('shop.slug_title_onama'),
                'active' => 'active',
            )
        );
        // Current category
    
        
    	return view('onama',compact('title','slug','metaTitle'));
    }

}
