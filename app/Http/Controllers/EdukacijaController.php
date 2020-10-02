<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Banner;
use App\Category;
use App\Post;

class EdukacijaController extends Controller
{
    public function index()
	{
        $title = 'Edukacija';
        $metaTitle = 'Edukacija';
		$IdKategorijeEdukacija = 83;
		$slug = array(
            '0' => array(
                'slug' => '/',
                'title' => trans('shop.title_home'),
                'active' => '',
            ),
            '1' => array(
                'slug' => trans('shop.slug_url_edukacija'),
                'title' => trans('shop.slug_title_edukacija'),
                'active' => 'active',
            )
        );
        // Current category
        $CATCurrent = $IdKategorijeEdukacija;


        // aktivna kategorija PROIZVODI
    	$category = Category::where('parent_id',$CATCurrent)->first()->toArray();
    	$Post = Post::where('category_id',$category['id'])->first()->toArray();


        $navCategory = Category::edu_MainCategories($IdKategorijeEdukacija);
        
    	return view('edukacija.index',compact('slug','navCategory','CATCurrent','Post','title','metaTitle'));
    }

    public function post($post)
    {

    	$IdKategorijeEdukacija = 83;
    	// fetch current CAT from url
        $postFromURL = explode('/', $post);
        $postSlug = end($postFromURL);
        $Post = Post::getPostBySlug($postSlug);
        $navCategory = Category::edu_MainCategories($IdKategorijeEdukacija);

        $title = 'Edukacija - '.$Post['title'];
        $metaTitle = 'Edukacija - '.$Post['title'];

    	$slug = array(
            '0' => array(
                'slug' => '/',
                'title' => trans('shop.title_home'),
                'active' => '',
            ),
            '1' => array(
                'slug' => trans('shop.slug_url_edukacija'),
                'title' => trans('shop.slug_title_edukacija'),
                'active' => '',
            ),
            '2' => array(
                'slug' => "/edukacija/{$Post['slug']}",
                'title' => $Post['title'],
                'active' => 'active',
            )
        );



        return view('edukacija.index',compact('slug','navCategory','Post','title','metaTitle'));
    }
}
