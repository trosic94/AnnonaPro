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
use Intervention\Image\ImageManagerStatic as Image;
use Input;

class Import_ComputerLand_PROD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:CompLand_PROD';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import - proizvodi';

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

            $products = array();
            $products_TMP = array();
            $productsSLUG_TMP = array();

            $pCNT = 0;

            // uzimem potrebne podatke o glavim kategorijama kako bi resili podkategorije
            $cat_DATA = Category::where('import_id','!=',null)
                                    ->select(
                                        'id as id',
                                        'parent_id as parent_id',
                                        'import_id as import_id'
                                    )
                                    ->pluck('id','import_id')->toArray();

            // uzimem potrebne podatke o glavim kategorijama kako bi resili podkategorije
            $mfc_DATA = DB::table('manufacturer')
                                        ->select(
                                            'id as id',
                                            'import_id as import_id'
                                        )
                                        ->pluck('id','import_id')->toArray();

            // echo '<pre>';
            // print_r($allItems->return->item);
            // echo '</pre>';

            foreach ($allItems->return->item as $key => $catDATA) {

                // koristim za testiranje
                // if ($key > $rangeSTART && $key <= $rangeEND):
                //     break;
                // endif;

                if (isset($catDATA->item_group->parent_group) && in_array($catDATA->item_group->parent_group->id, $selectedCAT)):
                //if (array_key_exists('parent_group', $catDATA->item_group) && in_array($catDATA->item_group->parent_group->id, $selectedCAT)):

                    if (!in_array($catDATA->id, $products_TMP)):

                        $prodSLUG = Category::slugify($catDATA->name);

                        if (!in_array($prodSLUG, $productsSLUG_TMP)):
                            array_push($productsSLUG_TMP, $prodSLUG);
                        else:
                            $prodSLUG = $prodSLUG.'-'.$catDATA->id;
                        endif;


                        $description = '';
                        if (isset($catDATA->description)):
                        //if (array_key_exists('description',$catDATA)):

                            $description = $catDATA->description;

                        endif;

                        $products_IMPORTorUPDATE = Product::updateOrCreate(

                            ['import_id' => $catDATA->id],
                            [
                                'sku' => $catDATA->id,
                                'title' => $catDATA->name,
                                'slug' => $prodSLUG,
                                'category_id' => $cat_DATA[$catDATA->item_group->id],
                                'author_id' => 11, // ADMIN, promeniti kasnije kada se sredi kreiranje korisnika iz admina
                                'manufacturer_id' => $mfc_DATA[$catDATA->manufacturer->id],
                                'excerpt' => $description,
                                'body' => $description,
                                // 'specification' => null,
                                // 'image' => null,
                                // 'image_import' => null,
                                // 'video' => null,
                                'meta_description' => $description,
                                'meta_keywords' => $description,
                                'status' => $catDATA->on_stock,
                                // 'featured' => 0,
                                'product_price' => $catDATA->retail_price,
                                'product_price_with_discount' => 0,
                                //'product_price_with_discount' => $catDATA->price_with_discounts,
                                'product_discount' => null,
                                'product_retail_price' => $catDATA->retail_price,
                                'product_vat' => $catDATA->tax_value,
                                'warranty' => $catDATA->warranty
                                // 'created_at' => $sada,
                                // 'updated_at' => $sada
                            ]

                        );

                        $pCNT++;

                    endif;

                endif;

            }

            echo 'Products: '.$pCNT.' // ';

            // Track Import EXECUTION TIime ------------------------------------------------
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start)/60; //dividing with 60 will give the execution time in minutes otherwise seconds
            echo 'Total Execution Time: '.number_format((float) $execution_time, 10).' Mins'; //execution time of the script


            // PRODUCT IMPORT ------------------------------------------------------------------- //


            //echo '<pre>';
            //print_r($selectedCAT);
            //print_r($products);
            //echo '</pre>';

        } catch(SoapFault $e) {

            //hvatam gresku
            echo $e->getMessage();

        }

    }
}
