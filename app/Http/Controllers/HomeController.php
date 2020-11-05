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
use App\Manufacturer;

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



        // PREPORUCENO ------------------------------------------------------- //
        $specialOptionBlockTitle_Preporuceno = 'Preporučeno'; // Novo
        $optIDs = array(8); // Preporuceno

        $productFor_Preporuceno = SpecialOptionForProducts::SPECproductOptions_ByOPT_ID($optIDs);


        // NOVO ------------------------------------------------------- //
        $specialOptionBlockTitle_Novo = 'Novo'; // Novo
        $optIDs = array(7); // Novo

        $productFor_Novo = SpecialOptionForProducts::SPECproductOptions_ByOPT_ID($optIDs);


        // BANNERS -------------------------------------------------------------- //

        // Home Wide
        $banners_homeWide = Banner::allBannersByPosition(3);
        // Row 1
        $banners_homeRow_1 = Banner::allBannersByPosition(4);
        // Row 2
        $banners_homeRow_2 = Banner::allBannersByPosition(5);
        // Row 2 - company
        $banners_homeRow_3 = Banner::allBannersByPosition(6);

        // Manufacturers
        $manufacturers = Manufacturer::manufacturerALL();

        $nesto = 'dasdasd';


    	return view('home.index', compact('sliderHOME','favLIST',
                                            'banners_homeWide','banners_homeRow_1','banners_homeRow_2','banners_homeRow_3',
                                            'specialOptionBlockTitle_Novo','productFor_Novo',
                                            'specialOptionBlockTitle_Preporuceno','productFor_Preporuceno',
                                            'manufacturers'));
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
