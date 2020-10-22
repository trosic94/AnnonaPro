<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Page;


use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ContentController extends Controller
{
 	public function procesContent($pageSlug)
    {
   	
        // proveri da li postoji kategorija sa SLUGom
        $category = Category::where('slug',$pageSlug)->first();

        if ($category):

			$slug = array(
		        '0' => array(
		            'slug' => '/',
		            'title' => trans('shop.title_home'),
		            'active' => '',
		        ),
		        '1' => array(
		            'slug' => $category->slug,
		            'title' => $category->name,
		            'active' => 'active',
		        )
		    );

			switch ($category->id) {
				case 96:
					// Salon
					$tmpl = 'category_salon';

					//Content
					$subCAT = Category::where('parent_id',$category->id)->orderBy('order','ASC')->get();
					$subCAT_IDs = $subCAT->pluck('id')->toArray();

					// Postovi iz odabranih kategorija
					$posts = Post::whereIn('category_id',$subCAT_IDs)->where('status','PUBLISHED')->get();


					break;
				
				default:
					$tmpl = 'category';
					break;
			}

        	

        	return view('content.'.$tmpl, compact('slug','category','subCAT','subCAT_IDs','posts'));
        endif;

    	$page = Page::where('slug',$pageSlug)->first();

        if ($page):
            $metaTitle = $page->title;
            $metaDescription = $page->meta_description;
            $metaKeywords = $page->meta_keywords;

            return view('page.static', compact('page','metaTitle','metaDescription','metaKeywords'));
        else:
            return abort(404);
        endif;

    }


 	public function usluga(Request $request)
    {

    	$postDATA = Post::where('id',request('contentID'))->first();

    	$html = '';

        $html .= '<img src="/storage/'.$postDATA->image.'" alt="'.$postDATA->title.'" class="img-fluid">';
        $html .= '<h4>'.$postDATA->title.'</h4>';
        $html .= '<div>'.$postDATA->body.'</div>';

    	return $html;
    }
}
