<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDO;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Input;

class Import_ComputerLand extends Model
{
    public static function saveIMGonSERVER($productID,$sku)
    {

		try {

		    $soapUrl = 'http://b2b.computerland.rs/b2b/services/stock-webservice?wsdl';

		    $ver =array(
		        'arg0' => $sku,
		        'arg1' => '4',
		    );

		    $client = new \SoapClient($soapUrl);
		    $getItemImage = $client->getItemImage($ver);

		    if (array_key_exists('item_image',$getItemImage->return->item_image)):

			    // DOWNLOAD img to server
			    // $base64 = base64_encode($getItemImage->return->item_image->item_image);

	      //       $IMGname = $productID.'_'.$sku.'.jpg';

	      //       $img = Image::make($getItemImage->return->item_image->item_image);

	      //       $path = public_path('storage/products/'.$IMGname);

	      //       $img->save($path);

	      //       return $IMGname;

		    	// INSERT encoded IMG
		    	return base64_encode($getItemImage->return->item_image->item_image);

	        endif;

		} catch(SoapFault $e) {

		    //hvatam gresku
		    echo $e->getMessage();

		}

    }
}
