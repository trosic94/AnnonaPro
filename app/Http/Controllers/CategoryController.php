<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\AttributesProduct;
use App\AttributesCategory;
use App\Manufacturer;
use App\ProductImages;
use App\RatingOption;
use App\RatingVote;
use App\Order;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Banner;

use URL;
use Redirect;
use Auth;

class CategoryController extends Controller
{
 	public function index()
    {
    	
    	$title = 'Proizvodi';
    	$intro = 'Pregled svih proizvoda';

        $slug = array(
            '0' => array(
                'slug' => '/',
                'title' => trans('shop.title_home'),
                'active' => '',
            ),
            '1' => array(
                'slug' => trans('shop.slug_url_products'),
                'title' => trans('shop.slug_title_products'),
                'active' => 'active',
            )
        );

        // FAV proizvodi
        $favSESS = Session::get('fav');

        $favLIST = array();

        if ($favSESS):
            $favLIST = $favSESS;
        endif;

        // spremam search request za priakaz na rezultatu
        $searchREQ['mfc'] = array();
        $searchREQ['available'] = '';
        $searchREQ['price'] = array();

        // Current category
        $CATCurrent = 3;

        // aktivna kategorija PROIZVODI
    	$category = Category::where('id',$CATCurrent)->first();

        // Meta Tagovi postavljeni za odabranu kategoriju
        $metaTitle = $category->name;
        $metaDescription = $category->meta_description;
        $metaKeywords = $category->meta_keywords;

        // LEFT
        $navCategory = Category::nav_catForParent(3);


        // MANUFACTURERS
        $manufacturers = Manufacturer::manufacturersByCAT(3);

        // svi proizvodi
        $allProducts = Product::allProducts();

        // Home Wide
        $banners_homeWide = Banner::allBannersByPosition(7);



    	return view('category.index', compact('intro','title','slug','searchREQ','favLIST','category','CATCurrent','metaTitle','metaDescription','metaKeywords',
                                                'navCategory','manufacturers',
                                                'allProducts','banners_homeWide'));
    }

    public function categories($categories)
    {

        // fetch current CAT from url
        $catFromURL = explode('/', $categories);
        $category = end($catFromURL);

        $intro = 'Pregled proizvoda iz odabrane glavne kategorije';

        // FAV proizvodi
        $favSESS = Session::get('fav');

        $favLIST = array();

        if ($favSESS):
            $favLIST = $favSESS;
        endif;

        // spremam search request za priakaz na rezultatu
        $searchREQ['mfc'] = array();
        $searchREQ['available'] = '';
        $searchREQ['price'] = array();

        // current CAT data
        $currentCAT = DB::table('categories as CAT')
                                ->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id')
                                ->where('CAT.slug',$category)
                                ->select(
                                    'CAT.id as id',
                                    'CAT.name as name',
                                    'CAT.slug as slug',
                                    'CAT.parent_id as parent_id',
                                    'CAT.meta_description as meta_description',
                                    'CAT.meta_keywords as meta_keywords',
                                    'PCAT.name as pcat_name',
                                    'PCAT.slug as pcat_slug'
                                )
                                ->first();

        if ($currentCAT):

            // SLUG for BreadCrumb
            $slug = array(
                '0' => array(
                    'slug' => '/',
                    'title' => trans('shop.title_home'),
                    'active' => '',
                ),
                '1' => array(
                    'slug' => trans('shop.slug_url_products'),
                    'title' => trans('shop.slug_title_products'),
                    'active' => '',
                )
            );

            if ($currentCAT->parent_id == 3):
                $slug[2] = array(
                    'slug' => trans('shop.slug_url_products').'/'.$currentCAT->slug,
                    'title' => $currentCAT->name,
                    'active' => 'active',
                );

            else:
                $slug[2] = array(
                        'slug' => trans('shop.slug_url_products').'/'.$currentCAT->pcat_slug,
                        'title' => $currentCAT->pcat_name,
                        'active' => '',
                    );

                $slug[3] = array(
                        'slug' => trans('shop.slug_url_products').'/'.$currentCAT->pcat_slug.'/'.$currentCAT->slug,
                        'title' => $currentCAT->name,
                        'active' => 'active',
                    );
            endif;

            // page META data
            $metaTitle = $currentCAT->name;
            $metaDescription = $currentCAT->meta_description;
            $metaKeywords = $currentCAT->meta_keywords;

            // Current category
            $CATCurrent = $currentCAT->id;

            // LEFT
            $navCategory = Category::nav_catForParent($currentCAT->id);

            // MANUFACTURERS
            $manufacturers = Manufacturer::manufacturersByCAT($currentCAT->id);

            //Da li postoje podredjene kategoriej
            $numberOfChildCATs = Category::where('parent_id',$currentCAT->id)->count();

            // PRODUCTS
            if ($currentCAT->parent_id == 3 && $numberOfChildCATs != 0):
                $productsFor_CAT = Product::productsFor_MainCAT($currentCAT->id);
            else:
                $productsFor_CAT = Product::productsFor_CAT($currentCAT->id);
            endif;

        // Home Wide
        $banners_homeWide = Banner::allBannersByPosition(7);
            return view('category.category', compact('intro','slug','favLIST','searchREQ','currentCAT','CATCurrent','metaTitle','metaDescription','metaKeywords',
                                                        'navCategory','manufacturers',
                                                        'productsFor_CAT','banners_homeWide'));

        else:

            // podaci o ulogovanom
            $ulogovan = Auth::user();

            // PRODUCT data
            $productDATA = Product::productDATA_bySLUG($category);

            // SLUG for BreadCrumb
            $slug = array(
                '0' => array(
                    'slug' => '/',
                    'title' => trans('shop.title_home'),
                    'active' => '',
                ),
                '1' => array(
                    'slug' => trans('shop.slug_url_products'),
                    'title' => trans('shop.slug_title_products'),
                    'active' => '',
                )
            );

            if ($productDATA->pcat_id == 3):
                $slug[2] = array(
                    'slug' => trans('shop.slug_url_products').'/'.$productDATA->cat_slug,
                    'title' => $productDATA->cat_name,
                    'active' => '',
                );
                $slug[3] = array(
                    'slug' => trans('shop.slug_url_products').'/'.$productDATA->cat_slug.'/'.$productDATA->prod_slug,
                    'title' => $productDATA->prod_title,
                    'active' => 'active',
                );

            else:
                $slug[2] = array(
                    'slug' => trans('shop.slug_url_products').'/'.$productDATA->pcat_slug,
                    'title' => $productDATA->pcat_name,
                    'active' => '',
                    );

                $slug[3] = array(
                    'slug' => trans('shop.slug_url_products').'/'.$productDATA->pcat_slug.'/'.$productDATA->cat_slug,
                    'title' => $productDATA->cat_name,
                    'active' => '',
                    );

                $slug[4] = array(
                    'slug' => trans('shop.slug_url_products').'/'.$productDATA->pcat_slug.'/'.$productDATA->cat_slug.'/'.$productDATA->prod_slug,
                    'title' => $productDATA->prod_title,
                    'active' => 'active',
                );
            endif;

            // page META data
            $metaTitle = $productDATA->prod_title;
            $metaDescription = $productDATA->prod_meta_description;
            $metaKeywords = $productDATA->prod_meta_keywords;

            // Product images
            $productImages = ProductImages::where('product_id',$productDATA->prod_id)->orderBy('image_order', 'ASC')->get()->toArray();


            // ATRIBUTi za PROIZVOD
            $allAttributesForProduct = AttributesCategory::attributesDATA_for_Category($productDATA->prod_cat_id);

            // odabrane VREDNOSTI ATRIBUTA za PROIZVOD
            $odabraneVrednostiAtributaZaProizvod = AttributesProduct::selectedAttributesValue_ForProduct($productDATA->prod_id);

            // product rating
            $daLiMozeDaOcenjujeIKomentarise = 0;
            $daLiJeKupioProizvod = array();

            $ratingOptions = RatingOption::productRating();
            $productRate = round(RatingVote::productRate($productDATA->prod_id), 1);
            $ratingComments = RatingVote::ratingComments($productDATA->prod_id);

            if (!Auth::guest()):

                $daLiJeKupioProizvod = Order::ifProductOrderedByCustomer($productDATA->prod_id,$ulogovan->id);

                if ($daLiJeKupioProizvod):

                    $daLiMozeDaOcenjujeIKomentarise = 1;

                endif;

            endif;

            return view('product.index', compact('intro','slug','favLIST','metaTitle','metaDescription','metaKeywords',
                                                    'productDATA','selectedAttributes','allAttributesForProduct','odabraneVrednostiAtributaZaProizvod','productImages',
                                                    'ratingOptions','productRate','ratingComments','daLiJeKupioProizvod','daLiMozeDaOcenjujeIKomentarise'));


        endif;
    }

}
