<?php

namespace App\Http\Controllers;

use TCG\Voyager\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PDO;
use Carbon\Carbon;

use App\Home;
use App\Sliders;
use App\SlidersItems;
use App\Product;
use App\SpecialOptionForProducts;
use App\Banner;

class HomeController extends Controller
{
    public function index()
    {

        // FAV proizvodi
        $favSESS = Session::get('fav');

        $favLIST = array();

        if ($favSESS):
            $favLIST = $favSESS;
        endif;
    	
    	// SLIDER ----------------------------------------------------- //

    	$sliderHOME = DB::table('sliders_items as SI')
    					->where('SI.slider_id',1)
    					->select(
    						'SI.image as image',
    						'SI.title as title',
    						'SI.text as text',
    						'SI.url as url',
    						'SI.url_target as url_target'
    					)
    					->orderBy('slide_order','ASC')
    					->get();


        // 4 tabs - Special PRoduct Options --------------------------- //

        $optIDs = array(1,2,3,4); // opcije za 4xTAB 

        $specialOptions_tabs = DB::table('special_options as SO')
                                ->whereIn('id',$optIDs)
                                ->get();

        $productWithSelectedOptions_all = SpecialOptionForProducts::SPECproductOptions_ByOPT_ID($optIDs);

        $productWithSelectedOptions_groupped = $productWithSelectedOptions_all->groupBy('sop_id')->toArray();

        // row 1 - Special PRoduct Options --------------------------- //
        $optIDs = array(5); // opcije za ROW 1 

        $productsFor_Row1 = SpecialOptionForProducts::SPECproductOptions_ByOPT_ID($optIDs);

        // row 2 - Special PRoduct Options --------------------------- //
        $optIDs = array(6); // opcije za ROW 1 

        $productsFor_Row2 = SpecialOptionForProducts::SPECproductOptions_ByOPT_ID($optIDs);


        // BANNERS -------------------------------------------------------------- //

        // Home Wide
        $banners_homeWide = Banner::allBannersByPosition(3);
        // Row 1
        $banners_homeRow_1 = Banner::allBannersByPosition(4);
        // Row 2
        $banners_homeRow_2 = Banner::allBannersByPosition(5);

        $nesto = 'dasdasd';


    	return view('home.index', compact('sliderHOME','favLIST',
                                            'specialOptions_tabs','productWithSelectedOptions_groupped',
                                            'productsFor_Row1','productsFor_Row2',
                                            'banners_homeWide','banners_homeRow_1','banners_homeRow_2',
                                            'nesto'));
    }
}
