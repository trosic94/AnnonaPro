<?php

namespace App;

use App\Category;
use App\Post;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'categories';

    protected $fillable = ['parent_id','import_id','order','name','slug','cat_image','published','created_at','use_product_price','updated_at','meta_description','meta_keywords'];

    // SHOP category --------------------------------------------------------- !!
    public static function shopCAT()
    {
        $shopCAT = 3;
        
        return $shopCAT;
    }


    public static function shopCAT_Slug()
    {
        $shopCAT = Category::shopCAT();

        $chopCATdata = Category::where('id',$shopCAT)->first();

        $shopCAT_Slug = $chopCATdata->slug;
        
        return $shopCAT_Slug;
    }

    public static function allCAT()
    {
    	$kategorije = Category::all();
        
        return $kategorije;
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public static function productCategories_SEL()
    {
    	$productCategories = DB::table('categories as CAT')
                                        ->where('CAT.parent_id',3)
                                        //->where('published',1) // u selectu oznaciti kategorije koje nisu aktive
                                        ->select(
                                            'CAT.id as cat_id',
                                            'CAT.name as cat_name',
                                            'CAT.published as cat_published',
                                            'CAT.parent_id as cat_parent_id'
                                        )
                                        ->get();

        $allCAT_SEL = array();
        $cat_CNT = 0;

        foreach ($productCategories as $key => $cat) {

            $subcat_CNT = 0;

            $findeSUBcat = DB::table('categories as CAT')
                                ->where('parent_id',$cat->cat_id)
                                ->select(
                                    'CAT.id as subcat_id',
                                    'CAT.name as subcat_name',
                                    'CAT.published as subcat_published',
                                    'CAT.parent_id as subcat_parent_id'
                                )
                                ->get();

            $allCAT_SEL[$cat_CNT]['cat_id'] = $cat->cat_id;
            $allCAT_SEL[$cat_CNT]['cat_name'] = $cat->cat_name;
            $allCAT_SEL[$cat_CNT]['cat_published'] = $cat->cat_published;
            $allCAT_SEL[$cat_CNT]['cat_parent_id'] = $cat->cat_parent_id;
            $allCAT_SEL[$cat_CNT]['cat_sub'] = array();

            if (!$findeSUBcat->isEmpty()):

                foreach ($findeSUBcat as $key => $subCAT) {

                    $subsubcat_CNT = 0;

                    $findeSUBSUBcat = DB::table('categories as CAT')
                                        ->where('parent_id',$subCAT->subcat_id)
                                        ->select(
                                            'CAT.id as subsubcat_id',
                                            'CAT.name as subsubcat_name',
                                            'CAT.published as subsubcat_published',
                                            'CAT.parent_id as subsubcat_parent_id'
                                        )
                                        ->get();



                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_id'] = $subCAT->subcat_id;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_name'] = $subCAT->subcat_name;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_published'] = $subCAT->subcat_published;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_parent_id'] = $subCAT->subcat_parent_id;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'] = array();

                    if (!$findeSUBSUBcat->isEmpty()):

                        foreach ($findeSUBSUBcat as $key => $subsubCAT) {

                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_id'] = $subsubCAT->subsubcat_id;
                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_name'] = $subsubCAT->subsubcat_name;
                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_published'] = $subsubCAT->subsubcat_published;
                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_parent_id'] = $subsubCAT->subsubcat_parent_id;


                            $subsubcat_CNT++;

                        }


                    endif;
                    
                    $subcat_CNT++;

                }

            endif;

            $cat_CNT++;
        }


        
        return $allCAT_SEL;
    }


    public static function postsCategories_SEL()
    {
        $MAINproductCAT_arr = DB::table('categories as CAT')
                                ->where('CAT.parent_id',3)
                                ->pluck('id')->toArray();

        $OTHERproductCAT_arr = DB::table('categories as CAT')
                                ->whereIn('CAT.parent_id',$MAINproductCAT_arr)
                                ->pluck('id')->toArray();

        $ALLproductCAT_arr = array_merge($MAINproductCAT_arr,$OTHERproductCAT_arr);

        array_push($ALLproductCAT_arr,'3');

        $postsCategories = DB::table('categories as CAT')
                                        ->whereNotIn('CAT.id',$ALLproductCAT_arr)
                                        //->where('published',1) // u selectu oznaciti kategorije koje nisu aktive
                                        ->select(
                                            'CAT.id as cat_id',
                                            'CAT.name as cat_name',
                                            'CAT.published as cat_published',
                                            'CAT.parent_id as cat_parent_id'
                                        )
                                        ->get();

        $allCAT_SEL = array();
        $cat_CNT = 0;

        foreach ($postsCategories as $key => $cat) {

            $subcat_CNT = 0;

            $findeSUBcat = DB::table('categories as CAT')
                                ->where('parent_id',$cat->cat_id)
                                ->select(
                                    'CAT.id as subcat_id',
                                    'CAT.name as subcat_name',
                                    'CAT.published as subcat_published',
                                    'CAT.parent_id as subcat_parent_id'
                                )
                                ->get();

            $allCAT_SEL[$cat_CNT]['cat_id'] = $cat->cat_id;
            $allCAT_SEL[$cat_CNT]['cat_name'] = $cat->cat_name;
            $allCAT_SEL[$cat_CNT]['cat_published'] = $cat->cat_published;
            $allCAT_SEL[$cat_CNT]['cat_parent_id'] = $cat->cat_parent_id;

            $cat_CNT++;
        }


        
        return $allCAT_SEL;
    }


    public static function categoryNAV()
    {
        $productCategories = DB::table('categories as CAT')
                                        ->where('CAT.parent_id',3)
                                        ->where('published',1) // uzimam samo aktivne kategorije
                                        ->select(
                                            'CAT.id as cat_id',
                                            'CAT.name as cat_name',
                                            'CAT.slug as cat_slug',
                                            'CAT.published as cat_published',
                                            'CAT.parent_id as cat_parent_id'
                                        )
                                        ->orderBy('order','ASC')
                                        ->get();

        $allCAT_SEL = array();
        $cat_CNT = 0;

        foreach ($productCategories as $key => $cat) {

            $subcat_CNT = 0;

            $findeSUBcat = DB::table('categories as CAT')
                                ->where('parent_id',$cat->cat_id)
                                ->select(
                                    'CAT.id as subcat_id',
                                    'CAT.name as subcat_name',
                                    'CAT.slug as subcat_slug',
                                    'CAT.published as subcat_published',
                                    'CAT.parent_id as subcat_parent_id'
                                )
                                ->orderBy('order','ASC')
                                ->get();

            $allCAT_SEL[$cat_CNT]['cat_id'] = $cat->cat_id;
            $allCAT_SEL[$cat_CNT]['cat_name'] = $cat->cat_name;
            $allCAT_SEL[$cat_CNT]['cat_slug'] = $cat->cat_slug;
            $allCAT_SEL[$cat_CNT]['cat_published'] = $cat->cat_published;
            $allCAT_SEL[$cat_CNT]['cat_parent_id'] = $cat->cat_parent_id;
            $allCAT_SEL[$cat_CNT]['cat_sub'] = array();

            if (!$findeSUBcat->isEmpty()):

                foreach ($findeSUBcat as $key => $subCAT) {

                    $subsubcat_CNT = 0;

                    $findeSUBSUBcat = DB::table('categories as CAT')
                                        ->where('parent_id',$subCAT->subcat_id)
                                        ->select(
                                            'CAT.id as subsubcat_id',
                                            'CAT.name as subsubcat_name',
                                            'CAT.slug as subsubcat_slug',
                                            'CAT.published as subsubcat_published',
                                            'CAT.parent_id as subsubcat_parent_id'
                                        )
                                        ->orderBy('order','ASC')
                                        ->get();



                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_id'] = $subCAT->subcat_id;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_name'] = $subCAT->subcat_name;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_slug'] = $subCAT->subcat_slug;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_published'] = $subCAT->subcat_published;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_parent_id'] = $subCAT->subcat_parent_id;
                    $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'] = array();

                    if (!$findeSUBSUBcat->isEmpty()):

                        foreach ($findeSUBSUBcat as $key => $subsubCAT) {

                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_id'] = $subsubCAT->subsubcat_id;
                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_name'] = $subsubCAT->subsubcat_name;
                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_slug'] = $subsubCAT->subsubcat_slug;
                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_published'] = $subsubCAT->subsubcat_published;
                            $allCAT_SEL[$cat_CNT]['cat_sub'][$subcat_CNT]['cat_subsub'][$subsubcat_CNT]['cat_parent_id'] = $subsubCAT->subsubcat_parent_id;


                            $subsubcat_CNT++;

                        }


                    endif;
                    
                    $subcat_CNT++;

                }

            endif;

            $cat_CNT++;
        }


        
        return $allCAT_SEL;
    }

    public static function nav_catForParent($parentCAT)
    {

        $builder = DB::table('categories as CAT');

        if ($parentCAT == 3):

            $childCATs = Category::where('parent_id',$parentCAT)
                                    ->pluck('id');

            $builder->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id');

            $builder->leftJoin('products as P', function($p) use ($childCATs) {
                                    $p->on('P.category_id','CAT.id')
                                    ->whereIn('P.category_id',$childCATs)
                                    ->where('P.status',1);
                                });

            $builder->where('CAT.parent_id',$parentCAT);

        else:

            $builder->leftJoin('categories as PCAT','CAT.parent_id','PCAT.id');

            $builder->leftJoin('products as P', function($p) {
                                    $p->on('P.category_id','CAT.id')
                                    ->where('P.status',1);
                                });

            $builder->where('CAT.parent_id',$parentCAT);

        endif;


        $productCategories = $builder
                                        ->where('CAT.published',1) // uzimam samo aktivne kategorije
                                        ->select(
                                            'CAT.id as cat_id',
                                            'CAT.name as cat_name',
                                            'CAT.slug as cat_slug',
                                            'CAT.published as cat_published',
                                            'CAT.parent_id as cat_parent_id',
                                            'PCAT.id as pcat_id',
                                            'PCAT.name as pcat_name',
                                            'PCAT.slug as pcat_slug',
                                            DB::raw('COUNT(P.category_id) AS prod_count')

                                        )
                                        ->orderBy('CAT.order','ASC')
                                        ->groupBy('CAT.id')
                                        ->get();

        $allCAT = array();
        $cat_CNT = 0;

        foreach ($productCategories as $key => $cat) {

            $allCAT[$cat_CNT]['cat_id'] = $cat->cat_id;
            $allCAT[$cat_CNT]['cat_name'] = $cat->cat_name;
            $allCAT[$cat_CNT]['cat_slug'] = $cat->cat_slug;
            $allCAT[$cat_CNT]['cat_published'] = $cat->cat_published;
            $allCAT[$cat_CNT]['cat_parent_id'] = $cat->cat_parent_id;
            $allCAT[$cat_CNT]['pcat_id'] = $cat->pcat_id;
            $allCAT[$cat_CNT]['pcat_name'] = $cat->pcat_name;
            $allCAT[$cat_CNT]['pcat_slug'] = $cat->pcat_slug;
            $allCAT[$cat_CNT]['prod_count'] = $cat->prod_count;

            $cat_CNT++;
        }


        
        return $allCAT;
    }

    public static function categoriesByParentCAT($parentCatID)
    {
        $shopCAT = Category::shopCAT();

        $productCategories = DB::table('categories as CAT')
                                        ->where('CAT.parent_id',$parentCatID)
                                        ->where('published',1) // uzimam samo aktivne kategorije
                                        ->select(
                                            'CAT.id as cat_id',
                                            'CAT.name as cat_name',
                                            'CAT.slug as cat_slug',
                                            'CAT.published as cat_published',
                                            'CAT.parent_id as cat_parent_id'
                                        )
                                        ->orderBy('order','ASC')
                                        ->get();

        return $productCategories;
    }

    // nadji ALL CHILD CATEGORIES ---------------------------------------------------------- //
    // kreiram listu kategorija i podkategorija -------------------------------------------- //
    public function categories()
    {
        return $this->hasMany(Category::class,'parent_id');
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class,'parent_id')->with('categories');
    }
    // kreiram listu kategorija i podkategorija -------------------------------------------- //

    public static function getAllChildCAT_IDs($categoryID)
    {

        $startCATegory = Category::where('id',$categoryID)
                                ->with('childrenCategories')
                                ->get();

        $allCAT_w_Child = array();

        foreach ($startCATegory as $cat) {

            foreach ($cat->childrenCategories as $childCAT) {
                array_push($allCAT_w_Child, $childCAT->id);


                if ($childCAT->categories):

                    $allCAT_w_Child = Category::fetchChildCAT_IDs($childCAT->categories,$allCAT_w_Child);

                endif;

            }

        }

        return $allCAT_w_Child;

    }

    public static function fetchChildCAT_IDs($categories,$allCAT_w_Child)
    {

        foreach ($categories as $childCAT) {

            array_push($allCAT_w_Child, $childCAT->id);

            if ($childCAT->categories):

                $allCAT_w_Child = Category::fetchChildCAT_IDs($childCAT->categories,$allCAT_w_Child);

            endif;

        }

        return $allCAT_w_Child;
    }
    // nadji ALL CHILD CATEGORIES ---------------------------------------------------------- //

    // Reverse CAT ----------------------------------------------------------------//
    public function parentReverse()
    {
        return $this->belongsTo('App\Category', 'parent_id');
    }

    public function childrenReverse()
    {
        return $this->hasMany('App\Category', 'parent_id');
    }


    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parentReverse;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parentReverse;
        }

        return $parents;
    }
    // Reverse CAT ----------------------------------------------------------------//

    // Pronadji sve Parent Kategorije (IDs)
    public static function findAllCAT_IDs_list($catID)
    {

        $categoryW_Parents = Category::where('id',$catID)->first();

        $allCATdata = array();

        array_push($allCATdata, $categoryW_Parents->id);

        // dodajem sve parent kategorije u niz
        foreach ($categoryW_Parents->getParentsAttribute() as $pCAT):
            if (!in_array($pCAT['id'], $allCATdata) && $pCAT['parent_id'] != ''):
                array_push($allCATdata, $pCAT['id']);
            endif;
        endforeach;

        return $allCATdata;

    }




    public static function edu_MainCategories($parent_id){
        $catsWithPosts = Category::where('parent_id',$parent_id)->with('posts')->get()->toArray();
        return $catsWithPosts;
    }

    public static function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      //$text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }



    //relacije
    public function product()
    {
        return $this->hasMany('App\Product','category_id','id');
    }



}
