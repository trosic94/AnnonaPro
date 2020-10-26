<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'product_tags';

    protected $fillable = ['product_id','tag_id'];


    public static function tagsForProduct($productID)
    {
    	$tagsForProduct = ProductTag::where('product_id',$productID)->get();

    	return $tagsForProduct;
    }

    public static function tagsForProductDATA($productID)
    {
    	$tagsForProductDATA = DB::table('product_tags as PT')
    							->join('tags as T','T.id','PT.tag_id')
    							->where('PT.product_id',$productID)
    							->select(
    								'PT.tag_id as tag_id',
    								'T.name as tag_name'
    							)
    							->get();

    	return $tagsForProductDATA;
    }
}
