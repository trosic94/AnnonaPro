<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Banner;
use App\Category;
use App\Post;
use App\Page;

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

        // PAGE - O nama        
        $oNama_page = Page::getPageBySlug('o-nama');

        // POSTS iz kategorije "O nama ID93"
        $oNama_posts = Post::getPostsByCatID(93);
        
    	return view('o-nama.onama',compact('title','slug','metaTitle',
                                            'oNama_page','oNama_posts'));
    }

}
