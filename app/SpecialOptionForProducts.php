<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpecialOptionForProducts extends Model
{
    protected $table = 'special_options_products';

    public static function SelectedSpecialDisplayOptionsForProduct($productID)
    {
    	$displayOptions = DB::table('special_options_products as SOP')
    							->join('special_options as SO','SO.id','SOP.special_options_id')
    							->where('SOP.product_id',$productID)
    							->select(
    								'SOP.special_options_id as special_options_id',
    								'SO.title as title',
    								'SO.description as description',
                                    'SO.image as image'
    							)
    							->get();

    	return $displayOptions;
    }

    public static function SPECproductOptions_ByOPT_ID($optIDs)
    {
        $SPECproductOptions_ByOPT_ID = DB::table('special_options_products as SOP')
                                            ->join('products as P','P.id','SOP.product_id')
                                            ->join('categories as CAT','P.category_id','CAT.id')
                                            ->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id')
                                            ->leftJoin('special_options_products as SOPM', function($j) {
                                                $j->on('SOPM.product_id','P.id');
                                            })
                                            ->join('special_options as SO','SO.id','SOPM.special_options_id')
                                            ->whereIn('SOP.special_options_id',$optIDs)
                                            ->select(
                                                'SOPM.special_options_id as sop_id',
                                                'SO.title as so_title',
                                                'P.id as p_id',
                                                'P.sku as p_sku',
                                                'P.title as p_title',
                                                'P.slug as p_slug',
                                                'P.category_id as p_category_id',
                                                'P.manufacturer_id as p_manufacturer_id',
                                                'P.excerpt as p_excerpt',
                                                'P.image as p_image',
                                                'P.status as p_status',
                                                'P.product_price as p_product_price',
                                                'P.product_price_with_discount as p_product_price_with_discount',
                                                'P.product_discount as p_product_discount',
                                                'P.product_retail_price as p_product_retail_price',
                                                'P.product_vat as p_product_vat',
                                                'CAT.id as cat_id',
                                                'CAT.name as cat_name',
                                                'CAT.slug as cat_slug',
                                                'CAT.cat_color as cat_color',
                                                'PCAT.id as pcat_id',
                                                'PCAT.name as pcat_name',
                                                'PCAT.slug as pcat_slug',
                                                'PCAT.cat_color as cat_color',
                                                DB::raw('count(SOP.product_id) as sop_count')
                                            )
                                            ->where('P.status',1)
                                            ->groupBy('SOPM.special_options_id','SO.title','P.id','P.sku','P.title','P.slug','P.category_id','P.manufacturer_id','P.excerpt','P.image','P.status',
                                            'P.product_price','P.product_price_with_discount','P.product_discount','P.product_retail_price','P.product_vat','CAT.id','CAT.name','CAT.slug',
                                            'CAT.cat_color','PCAT.id','PCAT.name','PCAT.slug','PCAT.cat_color')
                                            ->get();

        return $SPECproductOptions_ByOPT_ID;
    }


    //relacije
    public function Product()
    {
        return $this->hasOne('App\Product','id','product_id');
    }

}
