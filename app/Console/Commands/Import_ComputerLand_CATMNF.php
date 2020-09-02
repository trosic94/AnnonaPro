<?php

namespace App\Console\Commands;

use App\Category;
use App\Product;
use App\Manufacturer;
use App\Import_ComputerLand;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDO;
use Carbon\Carbon;

class Import_ComputerLand_CATMNF extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:CompLand_CATMNF';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import - kategorije, proizvodjaci';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // Track Import EXECUTION TIime ------------------------------------------------
        $time_start = microtime(true);

        $sada = Carbon::now();

        try {

            $soapUrl = 'http://b2b.computerland.rs/b2b/services/stock-webservice?wsdl';

            $ver =array(
                //'arg0' => '11051020',
                'arg0' => '910b8d54-7408-4682-a196-ab333f68e003',
                'arg1' => '4',
                'arg2' => 'false',
            );

            $client = new \SoapClient($soapUrl);

            $allItems = $client->getAllItems($ver);

            $allITEMS = array();

            //CATEGORY
            $parentCAT = 3; // CAT ID za proizvode

            // 70223 - Miševi i tastature
            // 8150724 - Dronovi i Skuteri
            // 11031143 - Stolice i stolovi
            // 70217 - Zvučnici i zvučne kartice
            // 70213 - Slušalice i mikrofoni
            // 70312 - Gaming figure i garderoba
            // 70278 - Igračka oprema
            // 70289 - Video igrice
            // 70284 - Igračke konzole

            $selectedCAT = array(70223,8150724,11031143,70217,70213,70312,70278,70289,70284);
            $categories = array();
            $categories_TMP = array();
            $categoriesSLUG_TMP = array();

            $SUBcategories = array();
            $SUBcategories_TMP = array();
            $SUBcategoriesSLUG_TMP = array();

            $manufacturers = array();
            $manufacturers_TMP = array();

            $cCNT = 0;
            $scCNT = 0;
            $mCNT = 0;

            foreach ($allItems->return->item as $key => $catDATA) {

                if (isset($catDATA->item_group->parent_group) && in_array($catDATA->item_group->parent_group->id, $selectedCAT)) {
                //if (array_key_exists('parent_group', $catDATA->item_group) && in_array($catDATA->item_group->parent_group->id, $selectedCAT)) {
                    
                    $allITEMS[] = $catDATA;

                    // CATEGORY za IMPORT ------------------------------------------------------- //
                    if (!in_array($catDATA->item_group->parent_group->id, $categories_TMP)):

                        $catSLUG = Category::slugify($catDATA->item_group->parent_group->name);

                        if (!in_array($catSLUG, $categoriesSLUG_TMP)):
                            array_push($categoriesSLUG_TMP, $catSLUG);
                        else:
                            $catSLUG = $catSLUG.'-'.$catDATA->item_group->parent_group->id;
                        endif;

                        $categories[$cCNT]['parent_id'] = $parentCAT;
                        $categories[$cCNT]['import_id'] = $catDATA->item_group->parent_group->id;
                        $categories[$cCNT]['order'] = $catDATA->item_group->parent_group->order_num;
                        $categories[$cCNT]['name'] = $catDATA->item_group->parent_group->name;
                        $categories[$cCNT]['slug'] = $catSLUG;
                        $categories[$cCNT]['cat_image'] = '';
                        $categories[$cCNT]['published'] = 1;
                        $categories[$cCNT]['created_at'] = $sada;
                        $categories[$cCNT]['use_product_price'] = 1;
                        $categories[$cCNT]['updated_at'] = $sada;
                        $categories[$cCNT]['meta_description'] = $catDATA->item_group->parent_group->name;
                        $categories[$cCNT]['meta_keywords'] = $catDATA->item_group->parent_group->name;

                        array_push($categories_TMP, $catDATA->item_group->parent_group->id);

                        $cCNT++;

                    endif;
                    // CATEGORY za IMPORT ------------------------------------------------------- //

                    // SUB CATEGORY za IMPORT --------------------------------------------------- //
                    if (!in_array($catDATA->item_group->id, $SUBcategories_TMP)):

                        $SUBcatSLUG = Category::slugify($catDATA->item_group->name);

                        if (!in_array($SUBcatSLUG, $SUBcategoriesSLUG_TMP)):
                            array_push($SUBcategoriesSLUG_TMP, $SUBcatSLUG);
                        else:
                            $SUBcatSLUG = $SUBcatSLUG.'-'.$catDATA->item_group->id;
                        endif;

                        $SUBcategories[$scCNT]['parent_id'] = '';
                        $SUBcategories[$scCNT]['parent_from_import_id'] = $catDATA->item_group->parent_group->id;
                        $SUBcategories[$scCNT]['import_id'] = $catDATA->item_group->id;
                        $SUBcategories[$scCNT]['order'] = $catDATA->item_group->order_num;
                        $SUBcategories[$scCNT]['name'] = $catDATA->item_group->name;
                        $SUBcategories[$scCNT]['slug'] = $SUBcatSLUG;
                        $SUBcategories[$scCNT]['cat_image'] = '';
                        $SUBcategories[$scCNT]['published'] = 1;
                        $SUBcategories[$scCNT]['created_at'] = $sada;
                        $SUBcategories[$scCNT]['use_product_price'] = 1;
                        $SUBcategories[$scCNT]['updated_at'] = $sada;
                        $SUBcategories[$scCNT]['meta_description'] = $catDATA->item_group->name;
                        $SUBcategories[$scCNT]['meta_keywords'] = $catDATA->item_group->name;

                        array_push($SUBcategories_TMP, $catDATA->item_group->id);

                        $scCNT++;

                    endif;
                    // SUB CATEGORY za IMPORT --------------------------------------------------- //

                    // MANUFACTURERS za IMPORT -------------------------------------------------- //
                    if (!in_array($catDATA->manufacturer->id, $manufacturers_TMP)):

                        $manufacturers[$mCNT]['name'] = $catDATA->manufacturer->name;
                        $manufacturers[$mCNT]['image'] = '';
                        $manufacturers[$mCNT]['description'] = '';
                        $manufacturers[$mCNT]['import_id'] = $catDATA->manufacturer->id;
                        $manufacturers[$mCNT]['created_at'] = $sada;
                        $manufacturers[$mCNT]['updated_at'] = $sada;

                        array_push($manufacturers_TMP, $catDATA->manufacturer->id);

                        $mCNT++;

                    endif;
                    // MANUFACTURERS za IMPORT -------------------------------------------------- //

                }

            }

            // MANUFACTURERS IMPORT ------------------------------------------------------------ //
            foreach ($manufacturers as $key => $manufacturer) {

                $manufacturer_IMPORTorUPDATE = Manufacturer::updateOrCreate(

                    ['import_id' => $manufacturer['import_id']],
                    [
                        'name' => $manufacturer['name'],
                        'image' => $manufacturer['image'],
                        'description' => $manufacturer['description'],
                        'created_at' => $manufacturer['created_at'],
                        'updated_at' => $manufacturer['updated_at']
                    ]

                );
            }
            echo 'MNFC: '.count($manufacturers).' // ';
            // MANUFACTURERS IMPORT ------------------------------------------------------------ //

            // PARENT CAT IMPORT --------------------------------------------------------------- //
            foreach ($categories as $key => $cat) {

                $category_IMPORTorUPDATE = Category::updateOrCreate(

                    ['import_id' => $cat['import_id']],
                    [
                        'parent_id' => $cat['parent_id'],
                        'order' => $cat['order'],
                        'name' => $cat['name'],
                        'slug' => $cat['slug'],
                        'cat_image' => $cat['cat_image'],
                        'published' => $cat['published'],
                        'created_at' => $cat['created_at'],
                        'use_product_price' => $cat['use_product_price'],
                        'updated_at' => $cat['updated_at'],
                        'meta_description' => $cat['meta_description'],
                        'meta_keywords' => $cat['meta_keywords']
                    ]

                );
            }
            echo 'PARENT_CAT: '.count($categories).' // ';
            // PARENT CAT IMPORT ---------------------------------------------------------------- //

            // SUB CAT IMPORT ------------------------------------------------------------------- //
            // uzimem potrebne podatke o glavim kategorijama kako bi resili podkategorije
            $mainCAT_DATA = Category::where('parent_id',3)
                                        ->where('import_id','!=',null)
                                        ->select(
                                            'id as id',
                                            'parent_id as parent_id',
                                            'import_id as import_id'
                                        )
                                        ->pluck('id','import_id')->toArray();

            // unos SUBkategorija
            for ($sc=0; $sc < count($SUBcategories); $sc++) {

                    //$SUBcatSLUG = Category::slugify($SUBcategories[$sc]['name']);

                    $SUBcategory_IMPORTorUPDATE = Category::updateOrCreate(

                        ['import_id' => $SUBcategories[$sc]['import_id']],
                        [
                            'parent_id' => $mainCAT_DATA[$SUBcategories[$sc]['parent_from_import_id']],
                            'order' => $SUBcategories[$sc]['order'],
                            'name' => $SUBcategories[$sc]['name'],
                            'slug' => $SUBcategories[$sc]['slug'],
                            'cat_image' => '',
                            'published' => 1,
                            'created_at' => $SUBcategories[$sc]['created_at'],
                            'use_product_price' => 1,
                            'updated_at' => $SUBcategories[$sc]['updated_at'],
                            'meta_description' => $SUBcategories[$sc]['name'],
                            'meta_keywords' => $SUBcategories[$sc]['name']
                        ]

                    );

            }

            echo 'SUB_CAT: '.count($SUBcategories).' // ';
            // SUB CAT IMPORT ------------------------------------------------------------------- //


            // Track Import EXECUTION TIime ------------------------------------------------
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start)/60; //dividing with 60 will give the execution time in minutes otherwise seconds
            echo 'Total Execution Time: '.number_format((float) $execution_time, 10).' Mins'; //execution time of the script


            // echo '<pre>';
            // print_r($categories);
            // print_r($SUBcategories);
            // echo '</pre>';

        } catch(SoapFault $e) {

            //hvatam gresku
            echo $e->getMessage();

        }

    }
}