<?php

namespace App\Http\Controllers;

use TCG\Voyager\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use PDO;
use Carbon\Carbon;

use Auth;

use App\Home;
use App\Sliders;
use App\SlidersItems;
use App\Product;
use App\SpecialOptionForProducts;
use App\Banner;

use App\NewsletterSubscriber;


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

        $optIDs = array(8); // opcije za 4xTAB 

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
        // Row 2 - company
        $banners_homeRow_3 = Banner::allBannersByPosition(6);

        $nesto = 'dasdasd';


    	return view('home.index', compact('sliderHOME','favLIST',
                                            'specialOptions_tabs','productWithSelectedOptions_groupped',
                                            'productsFor_Row1','productsFor_Row2',
                                            'banners_homeWide','banners_homeRow_1','banners_homeRow_2','banners_homeRow_3',
                                            'nesto'));
    }


    public function subscribeToNewsletter(Request $request){
        $this->validateContact($request);
        $email = $request->email;
        if (!Auth::guest()){
            $ulogovan = Auth::user();
            $ulogovan_ID = $ulogovan->id;
            $daLiPostojiPrijavaZaNL = NewsletterSubscriber::where('user_id',$ulogovan->id)->first();

            if (!$daLiPostojiPrijavaZaNL):
                    $prijavljujemNaListu = NewsletterSubscriber::insert([
                        'user_id' => $ulogovan->id,
                        'email' => $email,
                        'status' => 1
                    ]);
            else:
              return  redirect()->to('/')->with('emailDuplicate', 'Korisnik je već prijaveljen');  
            endif;
        }else{

            $daLiPostojiPrijavaZaNL = NewsletterSubscriber::where('email',$email)->first();
            if ($daLiPostojiPrijavaZaNL){
              return  redirect()->to('/')->with('emailDuplicate', 'Email je već prijaveljen');    
            }else {
                $prijavljujemNaListu = NewsletterSubscriber::insert([
                        'user_id' => null,
                        'email' => $email,
                        'status' => 1
                    ]);
        } 
            }

           


        return  redirect()->to('/')->with('mailSentFooter', 'Uspesno ste se prijavili.');

    }
    public function validateContact($request)
    {
        return $this->validate($request, [
            'email' => 'required|email'
        ]);
    }
}
