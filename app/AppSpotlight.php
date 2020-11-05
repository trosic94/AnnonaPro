<?php

namespace App;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class AppSpotlight extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'app_spotlight';

    public static function useLOY()
    {

    	$useLOY_DATA = AppSpotlight::first();

    	return $useLOY_DATA;
    }

    public static function APIurl()
    {

    	$appAll = AppSpotlight::first();

    	$APIurl = $appAll->api_base_url;

    	return $APIurl;
    }


    public static function userData() {

    	$apiURL = 'user-data';

    	$loyDATA = AppSpotlight::useLOY();
    	$ulogovan = Auth::user();

    	$data = array(
			"apikey" => $loyDATA->api_key,
			"barcode" => $ulogovan->loy_barcode
    	);

		$ch = curl_init($loyDATA->api_base_url.''.$apiURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);

		$userDATA = json_decode($result);

		return $userDATA;
	}

	// Coupons - Obicni kuponi
    public static function couponsData() {

    	$apiURL = 'coupons';

    	$loyDATA = AppSpotlight::useLOY();
    	$ulogovan = Auth::user();

    	$data = array(
			"apikey" => $loyDATA->api_key,
			"barcode" => $ulogovan->loy_barcode
    	);

		$ch = curl_init($loyDATA->api_base_url.''.$apiURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);

		$couponsData = json_decode($result);

		return $couponsData;
	}

	// Coupons - Challenge Quantity
    public static function couponsData_challengeQuantity($baseURL,$apikey,$barcode) {

    	$apiURL = 'challenge-quantity';

    	$data = array(
			"apikey" => $apikey,
			"barcode" => $barcode
    	);

		$ch = curl_init($baseURL.''.$apiURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);

		$couponsData = json_decode($result);

		return $couponsData;
	}

	// Coupons - Challenge Amount
    public static function couponsData_challengeAmount($baseURL,$apikey,$barcode) {

    	$apiURL = 'challenge-amount';

    	$data = array(
			"apikey" => $apikey,
			"barcode" => $barcode
    	);

		$ch = curl_init($baseURL.''.$apiURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);

		$couponsData = json_decode($result);

		return $couponsData;
	}


	public static function catExport($baseURL,$exportDATA) {

		$apiURL = 'int/product-category-refresh';

		$ch = curl_init($baseURL.''.$apiURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($exportDATA));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);

		curl_close($ch);

		return $result;

	}


	public static function productExport($baseURL,$exportDATA) {

		$apiURL = 'int/product-refresh';

		$ch = curl_init($baseURL.''.$apiURL);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($exportDATA));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

		$result = curl_exec($ch);

		curl_close($ch);

		return $result;

	}


}