<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'materials';


    public static function allMaterial()
    {
    	$materials = Material::all();
        
        return $materials;
    }

    public static function materialSEL()
    {
    	$materials = Material::all();

    	$materialSEL = array();

    	foreach ($materials as $key => $material) {
    		$materialSEL[$material->id.'|'.$material->price] = $material->name;
    	}
        
        return $materialSEL;
    }


    // relacije
    public function orderItems()
    {
        return $this->hasMany('App\OrderItems','material_id','id');
    }
}
