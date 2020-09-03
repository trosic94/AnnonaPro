<?php

namespace App\Console\Commands;

use App\Product;

use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use Intervention\Image\ImageManagerStatic as Image;
use Input;

class Import_ComputerLand_IMG extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:CompLand_IMG';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import - slike';

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

        //proizvodi koji nemaju odgovarajuci format za sliku
        $skipIMGs = array(71175,70955,8166853,70957,70956,8166855,72424,11110793);

        // Track Import EXECUTION TIime ------------------------------------------------
        $time_start = microtime(true);


        $importedPROD = Product::where('import_id','!=',0)
                                    ->whereNotIn('import_id',$skipIMGs)
                                    ->select(
                                        'id',
                                        'import_id'
                                    )
                                    //->where('id','>',0) // id proizvoda ako je negde zapelo
                                    ->get();

        $imgForImport = array();
        $impCNT = 0;

        foreach ($importedPROD as $key => $prod) {

            echo $prod->id.' => '.$prod->import_id.' || ';
            Log::info('ComputerLand_IMGImp|'.$prod->id.'|'.$prod->import_id);

            try {

                $soapUrl = 'http://b2b.computerland.rs/b2b/services/stock-webservice?wsdl';

                $ver =array(
                    'arg0' => $prod->import_id,
                    //'arg0' => '71175',
                    'arg1' => '4',
                );

                $client = new \SoapClient($soapUrl);
                $getItemImage = $client->getItemImage($ver);

                if (isset($getItemImage->return->item_image->item_image)):
                //if (array_key_exists('item_image',$getItemImage->return->item_image)):

                    // DOWNLOAD img to server
                    $base64 = base64_encode($getItemImage->return->item_image->item_image);

                    //echo $base64.' ------------- ';

                    $img = Image::make($getItemImage->return->item_image->item_image);

                    print_r($img);

                    echo $img->mime.' -- ';

                    switch ($img->mime) {
                        case 'image/png':
                            $imgType = 'png';
                            break;
                        case 'image/gif':
                            $imgType = 'gif';
                            break;
                        case 'image/jpeg':
                            $imgType = 'jpeg';
                            break;
                        case 'image/jpg':
                            $imgType = 'jpg';
                            break;
                        case 'image/bmp':
                            $imgType = 'bmp';
                            break;
                        case 'image/svg':
                            $imgType = 'svg';
                            break;
                    }

                    $IMGname = $prod->id.'_'.$prod->import_id.'.'.$imgType;
                    //$IMGname = '7110_71175.'.$imgType;

                    $path = public_path('storage/products/'.$IMGname);

                    $img->save($path);

                    
                    // array for import
                    $imgForImport[$impCNT]['id'] = $prod->id;
                    $imgForImport[$impCNT]['image'] = $IMGname;

                    // INSERT encoded IMG
                    $imgUpdate = Product::where('id',$prod->id)->update(['image' => $IMGname]);

                    $impCNT++;

                endif;

               //break;

            } catch(SoapFault $e) {

                //hvatam gresku
                echo $e->getMessage();

            }

        }

        echo 'Images: '.$impCNT.' // ';

        // Track Import EXECUTION TIime ------------------------------------------------
        $time_end = microtime(true);
        $execution_time = ($time_end - $time_start)/60; //dividing with 60 will give the execution time in minutes otherwise seconds
        echo 'Total Execution Time: '.number_format((float) $execution_time, 10).' Mins'; //execution time of the script

    }
}