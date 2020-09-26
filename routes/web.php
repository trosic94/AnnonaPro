<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

	// Route::get('/', function () {
	//     return view('welcome');
	// });

	Route::get('/', 'HomeController@index');
	Route::get('/home', 'HomeController@index');

	Route::get('products', 'CategoryController@index');
	Route::get('products/{categories}', 'CategoryController@categories')->where('categories','^[a-zA-Z0-9-_\/]+$');


	//pretraga
	Route::get('search', 'SearchController@search');
	Route::post('search', 'SearchController@search');


	//edukacija
	Route::get('edukacija', 'EdukacijaController@index');
	Route::get('edukacija/{post}', 'EdukacijaController@post')->where('post','^[a-zA-Z0-9-_\/]+$');

	//CART
	Route::get('cart', 'ProductController@cart');
	Route::post('add-to-cart', 'ProductController@addToCart');
	Route::post('remove-from-cart', 'ProductController@removeFromCart');
	Route::post('update-qty', 'ProductController@updateQTY');

	// favourites
	Route::post('fav-event', 'ProductFavouritesController@favEvent');
	Route::get('favourites', 'ProductFavouritesController@favList');

	// Banners
	Route::post('banner-click', 'BannerController@clickCount');

	//checkOut
	Route::get('checkout', 'OrderController@checkOut');
	Route::get('order-confirmed', 'OrderController@orderConfirmed');

	Route::get('process-payment', 'OrderController@quitPayment'); //odustaje od transakcije
	Route::post('process-payment', 'OrderController@procesPayment');

	// cookie check
	Route::post('cookie-privacy', 'CookieConfirmController@privacyConfirm');

	// Route::post('/password/reset', 'Auth\PasswordController@reset');
	
	//rute za kupce
	Route::group(['middleware' => 'auth'], function () {

		Route::get('profil', 'CustomerController@profil');
		Route::post('edit-profil', 'CustomerController@profilEdit');

		Route::get('profil/order-details/{id}', 'OrderController@orderDetails');
		Route::post('confirm-order', 'OrderController@confirmOrder');

		Route::get('logout', 'Auth\LoginController@logout');

	});

	//rute za Administraciju sajta
	Route::group(['prefix' => 'SDFSDf345345--DFgghjtyut-6'], function () {
		// App::setLocale('en');

		Route::post('products/insert', 'ProductController@storeProcessingInsert');
		Route::post('products/edit', 'ProductController@storeProcessingEdit');
		Route::post('products/attributes', 'ProductController@findeAttributes');

		Route::post('slide/delete', 'Voyager\V_SlidersItemsController@deleteSlide');
		Route::post('slide/insert', 'Voyager\V_SlidersItemsController@insertSlide');
		Route::post('slide/edit', 'Voyager\V_SlidersItemsController@editSlide');

		Route::post('banners/insert', 'BannerController@storeProcessingInsert');
		Route::post('banners/edit', 'BannerController@storeProcessingEdit');

	    Voyager::routes();
	});


//IMPORT ------------------------------------------------ //
//KATEGORIJE
Route::get('/compLand-CATMNF', function() {

    $exitCode = Artisan::call('import:CompLand_CATMNF');
    return '<h1>All Done!!</h1>';
});

//PROIZVODI
Route::get('/compLand-PROD', function() {

    $exitCode = Artisan::call('import:CompLand_PROD',['range' => '17200|17500' ]);

    return '<h1>All Done!!</h1>';
});

//SLIKE
Route::get('/compLand-IMG', function() {

    $exitCode = Artisan::call('import:CompLand_IMG');

    return $exitCode;
    return '<h1>All Done!!</h1>';
});

//IMPORT ------------------------------------------------ //



//clear ALL --------------------------------------------- //
//Set ALL
Route::get('/set-all', function() {
    $cacheClear = Artisan::call('cache:clear');
    $viewClear = Artisan::call('view:clear');
    $configClear = Artisan::call('config:cache');
    $optimize = Artisan::call('optimize');
    $routeClear = Artisan::call('route:clear');


    return '<h1>All Done!!</h1>';
});
//clear ALL --------------------------------------------- //


	Route::post('/posalji-kontakt', 'PageController@contactForm');
	
	Route::get('/{pageSlug}', 'PageController@page');