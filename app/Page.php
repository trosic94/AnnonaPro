<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pages';


    public static function getPageBySlug($pageSLUG) {

        $post = Page::where('slug',$pageSLUG)->first();

        return $post;
    }
}
