<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'posts';

    //id, author_id, category_id, title, seo_title, excerpt, body, image, slug, meta_description, meta_keywords, status, featured, created_at, updated_at
     protected $fillable = ['author_id','category_id','title','seo_title','excerpt','body','slug','meta_description','meta_keywords','status','featured','created_at','updated_at'];

     public static function allPosts()
    {
    	$postovi = Post::all();
        
        return $postovi;
    }

    public function post()
    {
        return $this->belongsTo(Category::class);
    }

    public static function getPostBySlug($postSlug){
        $post = Post::where('slug',$postSlug)->first()->toArray();
        return $post;
    }

}
