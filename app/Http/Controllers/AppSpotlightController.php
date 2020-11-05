<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\AppSpotlight;
use App\Category;
use App\Product;

class AppSpotlightController extends Controller
{
    public function categoriesExport(Request $request)
    {

    	// Basic LOY data
    	$useLOY_DATA = AppSpotlight::first();

    	// SHOP category
    	$shopCAT = Category::shopCAT();

    	// CATEGORIES for Export ---------------------------------------------- //
    	$mainCATs = Category::categoriesByParentCAT($shopCAT);

    	$catForExport = array();

    	// EXPORT CAT to SpotLight
    	$exportDATA = array();
    	$exportDATA['apikey'] = $useLOY_DATA->api_key;
    	
    	// priprema podataka za export
    	foreach ($mainCATs as $cKey => $cat) {

    		$exportDATA['stavke'][$cKey]['p_sifrakat_partnera'] = ''.$cat->cat_id.'';
    		$exportDATA['stavke'][$cKey]['p_naziv'] = $cat->cat_name;

    	}

    	$exportINFO = AppSpotlight::catExport($useLOY_DATA->api_base_url,$exportDATA);

    	return  redirect(url()->previous())
                ->with([
                    'message'    => "Export done!",
                    'alert-type' => 'success',
                ]);
    }

    public function productExport(Request $request)
    {

    	// Basic LOY data
    	$useLOY_DATA = AppSpotlight::first();

    	// SHOP category
    	$shopCAT = Category::shopCAT();

    	// CATEGORIES for Export ---------------------------------------------- //
    	$mainCATs = Category::categoriesByParentCAT($shopCAT)->pluck('cat_id');

    	foreach ($mainCATs as $cKey => $cat) {

    		$allCAT_w_Child = Category::getAllChildCAT_IDs($cat);

            if ($allCAT_w_Child):
                $CATsForSearch = $allCAT_w_Child;
            else:
                $CATsForSearch = array($cat);
            endif;

    		$productsFor_CAT = Product::productsBy_CAT_IDs_ALL($CATsForSearch);

	    	$exportDATA = array();
	    	$exportDATA['apikey'] = $useLOY_DATA->api_key;

    		foreach ($productsFor_CAT as $pKey => $product) {
    			$exportDATA['stavke'][$pKey]['p_sifra'] = $product->prod_sku;
    			$exportDATA['stavke'][$pKey]['p_barkod'] = $product->prod_sku;
    			$exportDATA['stavke'][$pKey]['p_kategorija'] = $cat;
    			$exportDATA['stavke'][$pKey]['p_naziv'] = $product->prod_title;
    		}

    		$exportINFO = AppSpotlight::productExport($useLOY_DATA->api_base_url,$exportDATA);

    	}		

    	return  redirect(url()->previous())
                ->with([
                    'message'    => "Export done!",
                    'alert-type' => 'success',
                ]);
    }


}
