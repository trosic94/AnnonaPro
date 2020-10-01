<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class Product extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'products';

    protected $fillable = ['sku','import_id','title','slug','category_id','author_id','manufacturer_id','excerpt','body','image','meta_description','meta_keywords','status','featured','product_price','product_price_with_discount','product_discount','product_retail_price','product_vat','warranty','created_at','updated_at'];

    public static function productDATA($productID)
    {
        //PRODUCT data
        $productDATA = DB::table('products as PROD')
                            ->join('categories as CAT','PROD.category_id','CAT.id')
                            ->join('manufacturer as M','PROD.manufacturer_id','M.id')
                            ->leftJoin('badges_products as BP','BP.product_id','PROD.id')
                            ->leftJoin('badges as B','B.id','BP.badge_id')
                            ->where('PROD.id',$productID)
                            ->select(
                                'PROD.id as prod_id',
                                'PROD.sku as prod_sku',
                                'PROD.title as prod_title',
                                'PROD.slug as prod_slug',
                                'PROD.category_id as prod_cat_id',
                                'PROD.manufacturer_id as prod_mnf_id',
                                'PROD.excerpt as prod_excerpt',
                                'PROD.body as prod_body',
                                'PROD.specification as prod_specification',
                                'PROD.image as prod_image',
                                'PROD.video as prod_video',
                                'PROD.status as prod_status',
                                'PROD.featured as prod_featured',
                                'PROD.product_price as prod_price',
                                'PROD.product_price_with_discount as prod_price_with_discount',
                                'PROD.product_discount as prod_discount',
                                'PROD.product_vat as prod_vat',
                                'PROD.meta_description as prod_meta_description',
                                'PROD.meta_keywords as prod_meta_keywords',
                                'PROD.created_at as prod_created_at',
                                'PROD.updated_at as prod_updated_at',
                                'CAT.parent_id as cat_parent_id',
                                'CAT.name as cat_name',
                                'CAT.slug as cat_slug',
                                'CAT.cat_image as cat_image',
                                'CAT.published as cat_published',
                                'CAT.cat_color as cat_color',
                                'CAT.use_product_price as cat_use_product_price',
                                'M.id as mnf_id',
                                'M.name as mnf_name',
                                'M.import_id as mnf_import_id',
                                'B.title as b_title',
                                'B.color as b_color',
                                'B.text_color as b_text_color'
                            )
                            ->first();

        return $productDATA;
    }

    public static function productDATA_bySLUG($productSLUG)
    {
        //PRODUCT data
        $productDATA = DB::table('products as PROD')
                            ->join('categories as CAT','PROD.category_id','CAT.id')
                            ->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id')
                            ->join('manufacturer as M','PROD.manufacturer_id','M.id')
                            ->leftJoin('special_options_products as SOP','SOP.product_id','PROD.id')
                            ->leftJoin('badges_products as BP','BP.product_id','PROD.id')
                            ->leftJoin('badges as B','B.id','BP.badge_id')
                            ->where('PROD.slug',$productSLUG)
                            ->select(
                                'PROD.id as prod_id',
                                'PROD.sku as prod_sku',
                                'PROD.title as prod_title',
                                'PROD.slug as prod_slug',
                                'PROD.category_id as prod_cat_id',
                                'PROD.manufacturer_id as prod_mnf_id',
                                'PROD.excerpt as prod_excerpt',
                                'PROD.body as prod_body',
                                'PROD.specification as prod_specification',
                                'PROD.image as prod_image',
                                'PROD.video as prod_video',
                                'PROD.status as prod_status',
                                'PROD.featured as prod_featured',
                                'PROD.product_price as prod_price',
                                'PROD.product_price_with_discount as prod_price_with_discount',
                                'PROD.product_discount as prod_discount',
                                'PROD.product_vat as prod_vat',
                                'PROD.meta_description as prod_meta_description',
                                'PROD.meta_keywords as prod_meta_keywords',
                                'PROD.created_at as prod_created_at',
                                'PROD.updated_at as prod_updated_at',
                                'CAT.parent_id as cat_parent_id',
                                'CAT.name as cat_name',
                                'CAT.slug as cat_slug',
                                'CAT.cat_image as cat_image',
                                'CAT.published as cat_published',
                                'PCAT.cat_color as cat_color',
                                'CAT.use_product_price as cat_use_product_price',
                                'PCAT.id as pcat_id',
                                'PCAT.name as pcat_name',
                                'PCAT.slug as pcat_slug',
                                'M.id as mnf_id',
                                'M.name as mnf_name',
                                'M.import_id as mnf_import_id',
                                'B.title as b_title',
                                'B.color as b_color',
                                'B.text_color as b_text_color',
                                DB::raw('count(SOP.product_id) as sop_count')
                            )
                            ->groupBy('PROD.id')
                            ->first();

        return $productDATA;
    }

    public static function allProducts()
    {
        $allProducts = DB::table('products as PROD')
                            ->join('categories as CAT','PROD.category_id','CAT.id')
                            ->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id')
                            ->join('manufacturer as M','PROD.manufacturer_id','M.id')
                            ->leftJoin('special_options_products as SOP','SOP.product_id','PROD.id')
                            ->leftJoin('badges_products as BP','BP.product_id','PROD.id')
                            ->leftJoin('badges as B','B.id','BP.badge_id')
                            ->where('PROD.status',1)
                            ->where('PROD.product_price','!=',0)
                            ->select(
                                'PROD.id as prod_id',
                                'PROD.sku as prod_sku',
                                'PROD.title as prod_title',
                                'PROD.slug as prod_slug',
                                'PROD.category_id as prod_cat_id',
                                'PROD.manufacturer_id as prod_mnf_id',
                                'PROD.excerpt as prod_excerpt',
                                'PROD.body as prod_body',
                                'PROD.specification as prod_specification',
                                'PROD.image as prod_image',
                                'PROD.video as prod_video',
                                'PROD.status as prod_status',
                                'PROD.featured as prod_featured',
                                'PROD.product_price as prod_price',
                                'PROD.product_price_with_discount as prod_price_with_discount',
                                'PROD.product_discount as prod_discount',
                                'PROD.product_vat as prod_vat',
                                'PROD.meta_description as prod_meta_description',
                                'PROD.meta_keywords as prod_meta_keywords',
                                'PROD.created_at as prod_created_at',
                                'PROD.updated_at as prod_updated_at',
                                'CAT.parent_id as cat_parent_id',
                                'CAT.name as cat_name',
                                'CAT.slug as cat_slug',
                                'CAT.cat_image as cat_image',
                                'CAT.published as cat_published',
                                'PCAT.cat_color as cat_color',
                                'CAT.use_product_price as cat_use_product_price',
                                'PCAT.id as pcat_id',
                                'PCAT.name as pcat_name',
                                'PCAT.slug as pcat_slug',
                                'M.id as mnf_id',
                                'M.name as mnf_name',
                                'M.import_id as mnf_import_id',
                                'B.title as b_title',
                                'B.color as b_color',
                                'B.text_color as b_text_color',
                                DB::raw('count(SOP.product_id) as sop_count')
                            )
                            ->groupBy('PROD.id')
                            ->paginate(12);

        return $allProducts;
    }

    public static function productsFor_MainCAT($catID)
    {
        $allProducts = DB::table('products as PROD')
                            ->join('categories as CAT','PROD.category_id','CAT.id')
                            ->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id')
                            ->join('manufacturer as M','PROD.manufacturer_id','M.id')
                            ->leftJoin('special_options_products as SOP','SOP.product_id','PROD.id')
                            ->leftJoin('badges_products as BP','BP.product_id','PROD.id')
                            ->leftJoin('badges as B','B.id','BP.badge_id')
                            ->where('PROD.status',1)
                            ->where('PROD.product_price','!=',0)
                            ->where('CAT.parent_id',$catID)
                            //->where('PROD.category_id',$catID)
                            ->select(
                                'PROD.id as prod_id',
                                'PROD.sku as prod_sku',
                                'PROD.title as prod_title',
                                'PROD.slug as prod_slug',
                                'PROD.category_id as prod_cat_id',
                                'PROD.manufacturer_id as prod_mnf_id',
                                'PROD.excerpt as prod_excerpt',
                                'PROD.body as prod_body',
                                'PROD.specification as prod_specification',
                                'PROD.image as prod_image',
                                'PROD.video as prod_video',
                                'PROD.status as prod_status',
                                'PROD.featured as prod_featured',
                                'PROD.product_price as prod_price',
                                'PROD.product_price_with_discount as prod_price_with_discount',
                                'PROD.product_discount as prod_discount',
                                'PROD.product_vat as prod_vat',
                                'PROD.meta_description as prod_meta_description',
                                'PROD.meta_keywords as prod_meta_keywords',
                                'PROD.created_at as prod_created_at',
                                'PROD.updated_at as prod_updated_at',
                                'CAT.parent_id as cat_parent_id',
                                'CAT.name as cat_name',
                                'CAT.slug as cat_slug',
                                'CAT.cat_image as cat_image',
                                'CAT.published as cat_published',
                                'PCAT.cat_color as cat_color',
                                'CAT.use_product_price as cat_use_product_price',
                                'PCAT.id as pcat_id',
                                'PCAT.name as pcat_name',
                                'PCAT.slug as pcat_slug',
                                'M.id as mnf_id',
                                'M.name as mnf_name',
                                'M.import_id as mnf_import_id',
                                'B.title as b_title',
                                'B.color as b_color',
                                'B.text_color as b_text_color',
                                DB::raw('count(SOP.product_id) as sop_count')
                            )
                            ->groupBy('PROD.id')
                            ->paginate(12);

        return $allProducts;
    }

    public static function productsFor_CAT($catID)
    {
        $allProducts = DB::table('products as PROD')
                            ->join('categories as CAT','PROD.category_id','CAT.id')
                            ->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id')
                            ->join('manufacturer as M','PROD.manufacturer_id','M.id')
                            ->leftJoin('special_options_products as SOP','SOP.product_id','PROD.id')
                            ->leftJoin('badges_products as BP','BP.product_id','PROD.id')
                            ->leftJoin('badges as B','B.id','BP.badge_id')
                            ->where('PROD.status',1)
                            ->where('PROD.product_price','!=',0)
                            ->where('PROD.category_id',$catID)
                            ->select(
                                'PROD.id as prod_id',
                                'PROD.sku as prod_sku',
                                'PROD.title as prod_title',
                                'PROD.slug as prod_slug',
                                'PROD.category_id as prod_cat_id',
                                'PROD.manufacturer_id as prod_mnf_id',
                                'PROD.excerpt as prod_excerpt',
                                'PROD.body as prod_body',
                                'PROD.specification as prod_specification',
                                'PROD.image as prod_image',
                                'PROD.video as prod_video',
                                'PROD.status as prod_status',
                                'PROD.featured as prod_featured',
                                'PROD.product_price as prod_price',
                                'PROD.product_price_with_discount as prod_price_with_discount',
                                'PROD.product_discount as prod_discount',
                                'PROD.product_vat as prod_vat',
                                'PROD.meta_description as prod_meta_description',
                                'PROD.meta_keywords as prod_meta_keywords',
                                'PROD.created_at as prod_created_at',
                                'PROD.updated_at as prod_updated_at',
                                'CAT.parent_id as cat_parent_id',
                                'CAT.name as cat_name',
                                'CAT.slug as cat_slug',
                                'CAT.cat_image as cat_image',
                                'CAT.published as cat_published',
                                'PCAT.cat_color as cat_color',
                                'CAT.use_product_price as cat_use_product_price',
                                'PCAT.id as pcat_id',
                                'PCAT.name as pcat_name',
                                'PCAT.slug as pcat_slug',
                                'M.id as mnf_id',
                                'M.name as mnf_name',
                                'M.import_id as mnf_import_id',
                                'B.title as b_title',
                                'B.color as b_color',
                                'B.text_color as b_text_color',
                                DB::raw('count(SOP.product_id) as sop_count')
                            )
                            ->groupBy('PROD.id')
                            ->paginate(12);

        return $allProducts;
    }



    //relacije
    public function category()
    {
        return $this->hasOne('App\Category','id','category_id');
    }
    public function orderItems()
    {
        return $this->hasOne('App\OrderItems','product_id','id');
    }
    public function SpecialOptionForProducts()
    {
        return $this->hasMany('App\SpecialOptionForProducts','product_id','id');
    }
}
