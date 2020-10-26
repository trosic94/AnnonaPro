<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
	protected $primaryKey = 'id';
    protected $table = 'tags';

    protected $fillable = ['name'];


    public static function tagsAll()
    {
    	$tagsAll = Tag::all();

    	return $tagsAll;
    }
}
