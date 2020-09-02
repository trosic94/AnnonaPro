<?php

namespace App\Providers;

use App\Category;
use App\Product;
use App\Material;
use App\Dimension;
use App\Order;
use App\ProductFavourites;
use App\Banner;

use Illuminate\Support\Facades\View;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Session;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        //\Illuminate\Support\Facades\URL::forceScheme('https');

        DB::listen(function($query) {
            Log::info(
                $query->sql,
                $query->bindings,
                $query->time
            );
        });

        //BRENDIRANJE
        View::composer(array('includes.page'), function($view)
        {
            $banners_BrandLeft = array();
            $banners_BrandRight = array();

            $banners_BrandLeft = Banner::allBannersByPosition(1);
            $banners_BrandRight = Banner::allBannersByPosition(2);

            $banners['left'] = $banners_BrandLeft; 
            $banners['right'] = $banners_BrandRight;

            $view->with('banners', $banners);
        });

        //PROFIL
        View::composer(array('includes.my_profile'), function($view)
        {

            $orders = array();

            if (Auth::guest()):

                $userDATA['msg'] = trans('shop.profile_title');

            else:

                $ulogovan = Auth::user();
                $userDATA['msg'] = trans('shop.title_hello').' '.$ulogovan->name;
                $userDATA['customer']['name'] = $ulogovan->name;
                $userDATA['customer']['last_name'] = $ulogovan->name;

                $orders = Order::orderDATAbyUser($ulogovan->id);

            endif;

            $userDATA['orders'] = $orders;

            $view->with('userDATA', $userDATA);
        });

        //PROFIL
        View::composer(array('includes.my_cart'), function($view)
        {

            $cartVIEW = '';

            $cardDATA = 0;

            $cartDATA['products'] = '';

            $cartDATA['count'] = 0;

            $addToCart['total'] = 0;

            // postavljam vrednost za DISCOUNT
            $ulogovan = Auth::user();

            if ($ulogovan):
                $cartDATA['discount'] = $ulogovan->discount;
            else:
                $cartDATA['discount'] = 1;
            endif;  

            if (Session::has('crt')):

                $crtSES = Session::get('crt');

                // broj proizvoda u korpi
                $cartCOUNT = 0;
                for ($p=0; $p < count($crtSES['products']); $p++) { 
                    $cartCOUNT = $cartCOUNT + $crtSES['products'][$p]['quantity'];
                }

                // prikaz korpe iz sesije
                $addToCart['products'] = $crtSES['products'];

                for ($c=0; $c < count($addToCart['products']); $c++) { 

                    $cartVIEW .= '<div name="row_'.$addToCart['products'][$c]['prod_id'].'" id="cartPRODrow" class="row fadeInRight wow fast">';

                    $cartVIEW .= '  <div id="cartTXT" class="col-sm-8">';
                    $cartVIEW .= '      <h3>'.$addToCart['products'][$c]['prod_title'].'</h3>';

                    $cartVIEW .= '      <div class="priceWrap">';
                    if ($addToCart['products'][$c]['prod_price_with_discount'] != null):
                        $cartVIEW .= '  <span class="fullPrice">'.number_format($addToCart['products'][$c]['prod_price'],0,"",".").' '.setting('site.valuta').'</span>';

                        $fullAmount = $addToCart['products'][$c]['quantity'] * $addToCart['products'][$c]['prod_price_with_discount'];
                        $cartVIEW .= '  <div id="finalAmount"><span class="qty">'.$addToCart['products'][$c]['quantity'].'</span> x <span class="discountPrice">'.number_format($addToCart['products'][$c]['prod_price_with_discount'],0,"",".").' '.setting('site.valuta').'</span></div>';

                    else:

                        $fullAmount = $addToCart['products'][$c]['quantity'] * $addToCart['products'][$c]['prod_price'];
                        $cartVIEW .= '  <div id="finalAmount"><span class="qty">'.$addToCart['products'][$c]['quantity'].'</span> x <span class="singlePrice">'.number_format($addToCart['products'][$c]['prod_price'],0,"",".").' '.setting('site.valuta').'</span></div>';

                    endif;
                    $cartVIEW .= '      </div>';
                    $cartVIEW .= '  </div>';

                    $cartVIEW .= '  <div id="cartIMG" class="col-sm-4">';
                    if ($addToCart['products'][$c]['prod_image'] != null):
                        $imgFILE = $addToCart['products'][$c]['prod_image'];
                    else:
                        $imgFILE = 'no_image.jpg';
                    endif;
                    $cartVIEW .= '  <img src="/storage/products/'.$imgFILE.'" alt="'.$addToCart['products'][$c]['prod_title'].'">';
                    $cartVIEW .= '  </div>';

                    $cartVIEW .= '</div>';

                    // Kreiram TOTAL za KORPU
                    $addToCart['total'] = $addToCart['total'] + $fullAmount;

                }

                $cartDATA['count'] = $cartCOUNT;

                if ($cartDATA['count'] > 0):

                    $cartVIEW .= '<div id="cartDISCOUNT" class="row rounded-pill">';
                    $cartVIEW .= '  <div class="col">';
                    $cartVIEW .= '  <div id="cartDISCOUNTtxt">'.trans('shop.my_cart_discount').'</div>';
                    $cartVIEW .= '  </div>';
                    $cartVIEW .= '  <div class="col text-right">';
                    $cartVIEW .= '  <span>'.$cartDATA['discount'].'%</span>';
                    $cartVIEW .= '  </div>';
                    $cartVIEW .= '</div>';

                    // racunam TOTAL ako postoji DISCOUNT
                    if ($cartDATA['discount'] > 0):
                        $total = $addToCart['total'] - ($addToCart['total']/100)*$cartDATA['discount'];
                    else:
                        $total = $addToCart['total'];
                    endif;

                    $cartVIEW .= '<div id="cartTOTAL" class="row rounded-pill">';
                    $cartVIEW .= '  <div class="col">';
                    $cartVIEW .= '  <div id="cartTOTALtxt">'.trans('shop.my_cart_total').'</div>';
                    $cartVIEW .= '  </div>';
                    $cartVIEW .= '  <div class="col text-right">';
                    $cartVIEW .= '  <span id="cartAmount_modal">'.number_format($total,0,"",".").'</span> <span>'.setting('site.valuta').'</span>';
                    $cartVIEW .= '  </div>';
                    $cartVIEW .= '</div>';

                endif;

                $cartDATA['products'] = $cartVIEW;

            endif;           

            $view->with('cartDATA', $cartDATA);
        });

        //FAVOURITES
        View::composer(array('includes.my_favourites'), function($view)
        {
            $favouritesCNT = 0;
            $favFromSES_cnt = 0;
            $favFromSES = array();
            $fullFAV = array();

            if (Session::has('fav')):

                $favFromSES = Session::get('fav');
                $favFromSES_cnt = count(Session::get('fav'));

            endif;

            if (!Auth::guest()):

                $ulogovan = Auth::user();

                // da li ima FAV u DB?
                $favFromDB = ProductFavourites::where('user_id',$ulogovan->id)->pluck('product_id')->toArray();

                // merge za FAV iz SES i iz DB
                $fullFAV = array_unique(array_merge($favFromDB,$favFromSES), SORT_REGULAR);

                // korekcija kljuceva
                $fullFAV = array_values($fullFAV);

                $addFAVtoDB = ProductFavourites::addFAVtiDB($fullFAV);

                // novi CNT za FAV
                $favouritesCNT = count($fullFAV);

                // kreira se nova SES za FAV
                Session::put('fav',$fullFAV);

            else:

                $favouritesCNT =  $favFromSES_cnt;

            endif;

            $view->with('favouritesCNT', $favouritesCNT);
        });

        // //moja korpa
        // View::composer(array('product.cart','order.checkout'), function($view)
        // {
        //     //podaci iz sesije
        //     $cartSES = Session::get('atc');

        //     $cartData = array();
        //     $cartCNT = 0;
        //     if (count($cartSES) >0):
        //         for ($s=0; $s<count($cartSES); $s++) {
                    
        //             //product INFO
        //             $productData = Product::where('id',$cartSES[$s]['id'])->first();
        //             $cartData[$cartCNT]['product']['id'] = $productData->id;
        //             $cartData[$cartCNT]['product']['sku'] = $productData->sku;
        //             $cartData[$cartCNT]['product']['title'] = $productData->title;
        //             $cartData[$cartCNT]['product']['slug'] = $productData->slug;
        //             $cartData[$cartCNT]['product']['image'] = $productData->image;
        //             $cartData[$cartCNT]['product']['category_id'] = $productData->category_id;

        //             //material INFO
        //             if (isset($cartSES[$s]['materijal'])):
        //             $materialEXPL = explode('|', $cartSES[$s]['materijal']);
        //             $materialData = Material::where('id',$materialEXPL[0])->first();
        //             $cartData[$cartCNT]['material']['id'] = $materialData->id;
        //             $cartData[$cartCNT]['material']['name'] = $materialData->name;
        //             $cartData[$cartCNT]['material']['price'] = $materialData->price;
        //             endif;

        //             //dimensions INFO
        //             if (isset($cartSES[$s]['dimanzije'])):
        //             $dimensionsEXPL = explode('|', $cartSES[$s]['dimanzije']);
        //             $dimeinsionsData = Dimension::where('id',$dimensionsEXPL[0])->first();
        //             $cartData[$cartCNT]['dimensions']['id'] = $dimeinsionsData->id;
        //             $cartData[$cartCNT]['dimensions']['value'] = $dimeinsionsData->value;
        //             $cartData[$cartCNT]['dimensions']['width'] = $dimeinsionsData->width;
        //             $cartData[$cartCNT]['dimensions']['height'] = $dimeinsionsData->height;
        //             endif;

        //             //order INFO
        //             $cartData[$cartCNT]['order']['kolicina'] = $cartSES[$s]['kolicina'];
        //             if (isset($cartSES[$s]['materijal']) && isset($cartSES[$s]['dimanzije'])):
        //                 $cartData[$cartCNT]['order']['total'] = ceil($cartData[$cartCNT]['material']['price'] * $cartData[$cartCNT]['dimensions']['width'] * $cartData[$cartCNT]['dimensions']['height'] * $cartSES[$s]['kolicina']);
        //             else:
        //                 $cartData[$cartCNT]['order']['total'] = ceil($cartSES[$s]['cena']);
        //             endif;

        //             $cartCNT++;
        //         }
        //     endif;

        //     $view->with('myCart', $cartData);
        // });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
