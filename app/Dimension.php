<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dimension extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'dimensions';

    public static function allDimensions()
    {
    	$dimensions = Dimension::all();
        
        return $dimensions;
    }

    public static function dimensionEXCLUDE()
    {
        $dimEXCLUDE = array(6,7);

        return $dimEXCLUDE;
    }

    public static function dimensionSEL()
    {
        //sklanjam dimenzije za pakete
        $dimEXCLUDE = Dimension::dimensionEXCLUDE();

        $dimensions = Dimension::whereNotIn('id',$dimEXCLUDE)->get();

    	$dimensionSEL = array();
    	foreach ($dimensions as $key => $dimension) {
    		$dimensionSEL[$dimension->id.'|'.$dimension->width.'|'.$dimension->height] = $dimension->value;
    	}
        
        return $dimensionSEL;
    }

    public static function maliPaket()
    {
        $maliPaket = Dimension::where('id',6)->first();

        $maliPaketSEL[$maliPaket->id.'|'.$maliPaket->width.'|'.$maliPaket->height] = $maliPaket->value;

        return $maliPaketSEL;
    }
    public static function velikiPaket()
    {
        $velikiPaket = Dimension::where('id',7)->first();

        $velikiPaketSEL[$velikiPaket->id.'|'.$velikiPaket->width.'|'.$velikiPaket->height] = $velikiPaket->value;

        return $velikiPaketSEL;
    }


    // relacije
    public function orderItems()
    {
        return $this->hasMany('App\OrderItems','dimensions_id','id');
    }
}
