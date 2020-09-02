<?php

namespace App\Http\Controllers\Voyager;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCG\Voyager\Database\Schema\SchemaManager;
use TCG\Voyager\Events\BreadDataAdded;
use TCG\Voyager\Events\BreadDataDeleted;
use TCG\Voyager\Events\BreadDataRestored;
use TCG\Voyager\Events\BreadDataUpdated;
use TCG\Voyager\Events\BreadImagesDeleted;
use TCG\Voyager\Facades\Voyager;
use TCG\Voyager\Http\Controllers\Traits\BreadRelationshipParser;

use TCG\Voyager\Http\Controllers\VoyagerBaseController;

use App\URL;
use App\Attributes;
use App\Category;
use App\AttributesCategory;
use App\AttributesValues;
use App\AttributesProduct;

use Carbon\Carbon;

class V_AttributesController extends VoyagerBaseController
{
    use BreadRelationshipParser;

    //***************************************
    //               ____
    //              |  _ \
    //              | |_) |
    //              |  _ <
    //              | |_) |
    //              |____/
    //
    //      Browse our Data Type (B)READ
    //
    //****************************************

    public function index(Request $request)
    {
        // GET THE SLUG, ex. 'posts', 'pages', etc.
        $slug = $this->getSlug($request);

        // GET THE DataType based on the slug
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('browse', app($dataType->model_name));

        $getter = $dataType->server_side ? 'paginate' : 'get';

        $search = (object) ['value' => $request->get('s'), 'key' => $request->get('key'), 'filter' => $request->get('filter')];
        $searchable = $dataType->server_side ? array_keys(SchemaManager::describeTable(app($dataType->model_name)->getTable())->toArray()) : '';
        $orderBy = $request->get('order_by', $dataType->order_column);
        $sortOrder = $request->get('sort_order', null);
        $usesSoftDeletes = false;
        $showSoftDeleted = false;
        $orderColumn = [];
        if ($orderBy) {
            $index = $dataType->browseRows->where('field', $orderBy)->keys()->first() + 1;
            $orderColumn = [[$index, 'desc']];
            if (!$sortOrder && isset($dataType->order_direction)) {
                $sortOrder = $dataType->order_direction;
                $orderColumn = [[$index, $dataType->order_direction]];
            } else {
                $orderColumn = [[$index, 'desc']];
            }
        }

        // Next Get or Paginate the actual content from the MODEL that corresponds to the slug DataType
        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $query = $model->{$dataType->scope}();
            } else {
                $query = $model::select('*');
            }

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses($model)) && app('VoyagerAuth')->user()->can('delete', app($dataType->model_name))) {
                $usesSoftDeletes = true;

                if ($request->get('showSoftDeleted')) {
                    $showSoftDeleted = true;
                    $query = $query->withTrashed();
                }
            }

            // If a column has a relationship associated with it, we do not want to show that field
            $this->removeRelationshipField($dataType, 'browse');

            if ($search->value != '' && $search->key && $search->filter) {
                $search_filter = ($search->filter == 'equals') ? '=' : 'LIKE';
                $search_value = ($search->filter == 'equals') ? $search->value : '%'.$search->value.'%';
                $query->where($search->key, $search_filter, $search_value);
            }

            if ($orderBy && in_array($orderBy, $dataType->fields())) {
                $querySortOrder = (!empty($sortOrder)) ? $sortOrder : 'desc';
                $dataTypeContent = call_user_func([
                    $query->orderBy($orderBy, $querySortOrder),
                    $getter,
                ]);
            } elseif ($model->timestamps) {
                $dataTypeContent = call_user_func([$query->latest($model::CREATED_AT), $getter]);
            } else {
                $dataTypeContent = call_user_func([$query->orderBy($model->getKeyName(), 'DESC'), $getter]);
            }

            // Replace relationships' keys for labels and create READ links if a slug is provided.
            $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType);
        } else {
            // If Model doesn't exist, get data from table name
            $dataTypeContent = call_user_func([DB::table($dataType->name), $getter]);
            $model = false;
        }

        // Check if BREAD is Translatable
        if (($isModelTranslatable = is_bread_translatable($model))) {
            $dataTypeContent->load('translations');
        }

        // Check if server side pagination is enabled
        $isServerSide = isset($dataType->server_side) && $dataType->server_side;

        // Check if a default search key is set
        $defaultSearchKey = $dataType->default_search_key ?? null;

        $view = 'voyager::bread.browse';

        if (view()->exists("voyager::$slug.browse")) {
            $view = "voyager::$slug.browse";
        }


        // dostupni tipovi atributa
        $attributeTYPE = Attributes::attributeTYPE();


        return Voyager::view($view, compact(
            'dataType',
            'dataTypeContent',
            'isModelTranslatable',
            'search',
            'orderBy',
            'orderColumn',
            'sortOrder',
            'searchable',
            'isServerSide',
            'defaultSearchKey',
            'usesSoftDeletes',
            'showSoftDeleted',
            'attributeTYPE'
        ));
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |__) |
    //               |  _  /
    //               | | \ \
    //               |_|  \_\
    //
    //  Read an item of our Data Type B(R)EAD
    //
    //****************************************

    public function show(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $isSoftDeleted = false;

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
            if ($dataTypeContent->deleted_at) {
                $isSoftDeleted = true;
            }
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        // Replace relationships' keys for labels and create READ links if a slug is provided.
        $dataTypeContent = $this->resolveRelations($dataTypeContent, $dataType, true);

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'read');

        // Check permission
        $this->authorize('read', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.read';

        if (view()->exists("voyager::$slug.read")) {
            $view = "voyager::$slug.read";
        }

        // podaci o odabranom ATRIBUTu
        $attributeDATA = Attributes::attributeDATA($id);

        // kreirane VREDNOSTI za odabrani ATRIBUT
        $attributeValuesDATA = AttributesValues::attributeVALUES($id);

        // dostupni tipovi atributa
        $attributeTYPE = Attributes::attributeTYPE();


        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable', 'isSoftDeleted',
                                                'attributeDATA','attributeValuesDATA','attributeTYPE'));
    }

    //***************************************
    //                ______
    //               |  ____|
    //               | |__
    //               |  __|
    //               | |____
    //               |______|
    //
    //  Edit an item of our Data Type BR(E)AD
    //
    //****************************************

    public function edit(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        if (strlen($dataType->model_name) != 0) {
            $model = app($dataType->model_name);

            // Use withTrashed() if model uses SoftDeletes and if toggle is selected
            if ($model && in_array(SoftDeletes::class, class_uses($model))) {
                $model = $model->withTrashed();
            }
            if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
                $model = $model->{$dataType->scope}();
            }
            $dataTypeContent = call_user_func([$model, 'findOrFail'], $id);
        } else {
            // If Model doest exist, get data from table name
            $dataTypeContent = DB::table($dataType->name)->where('id', $id)->first();
        }

        foreach ($dataType->editRows as $key => $row) {
            $dataType->editRows[$key]['col_width'] = isset($row->details->width) ? $row->details->width : 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'edit');

        // Check permission
        $this->authorize('edit', $dataTypeContent);

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }

        // dostupni tipovi atributa
        $attributeTYPE = Attributes::attributeTYPE();

        // kategorij proizvoda
        $productCategories_SEL = Category::productCategories_SEL();

        //odabrani ATRIBUT
        $atributDATA = DB::table('attributes as ATTR')
                            ->where('ATTR.id',$id)
                            ->first();

        //za koje KATEGORIJE je definisan ATRIBUT
        $categoriesForAttribute = AttributesCategory::catForAttr($id);

        //kreirane vrednosti za atribut
        $attributeVALUES = AttributesValues::attributeVALUES($id);

        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable',
                                                'attributeTYPE','productCategories_SEL','atributDATA','categoriesForAttribute','attributeVALUES'));
    }

    // POST BR(E)AD
    public function update(Request $request, $id)
    {

        $sada = Carbon::now();

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Compatibility with Model binding.
        $id = $id instanceof Model ? $id->{$id->getKeyName()} : $id;

        $model = app($dataType->model_name);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        if ($model && in_array(SoftDeletes::class, class_uses($model))) {
            $data = $model->withTrashed()->findOrFail($id);
        } else {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);
        }

        // Check permission
        $this->authorize('edit', $data);

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->editRows, $dataType->name, $id)->validate();
        $this->insertUpdateData($request, $slug, $dataType->editRows, $data);

        event(new BreadDataUpdated($dataType, $data));

        // update STATUS
        $upadteSTATUS = Attributes::where('id',$id)->update(['status' => request('status')]);

        // kreira se veza izmedju atributa i kategorije proizvoda -------------------------------------------- //
        $chkForCategories = AttributesCategory::where('attribute_id',$id)->get();

        if ($chkForCategories):

            $delete = AttributesCategory::where('attribute_id',$id)->delete();

        endif;

        //potrebni parametri za insert
        $selectedCAT = request('category_id'); // spisak odabranih kategorija
        $sada = Carbon::now();
        $attrCATforInsert = array();
        $attrCAT_CNT = 0;

        //kreira se niz za unos
        if (count($selectedCAT) > 0):

            for ($c=0; $c < count($selectedCAT); $c++) { 
                    
                $attrCATforInsert[$attrCAT_CNT]['attribute_id'] = $id;
                $attrCATforInsert[$attrCAT_CNT]['category_id'] = $selectedCAT[$c];
                $attrCATforInsert[$attrCAT_CNT]['attribute_id'] = $id;
                $attrCATforInsert[$attrCAT_CNT]['created_at'] = $sada;
                $attrCATforInsert[$attrCAT_CNT]['updated_at'] = $sada;

                $attrCAT_CNT++;

            }

        endif;

        //upis podataka
        $insert = DB::table('attributes_category')->insert($attrCATforInsert);
        // kreira se veza izmedju atributa i kategorije proizvoda -------------------------------------------- //


        // unos vrednosti za atribut ------------------------------------------------------------------------- //

        $maxLOOP = 200;
        $attributesValues_arr = array();
        $cntNONE = 0;
        $attrVAL_CNT = 0;

        //sprema se niz za unos
        for ($av=0; $av<$maxLOOP; $av++) {

            if ($request->has('attr_order_'.$av)):

                //podaci za unos vrednsoti za ATRIBUTE
                $attributesValues_arr[$attrVAL_CNT]['val_id'] = request('attr_val_id_'.$av);
                $attributesValues_arr[$attrVAL_CNT]['attribute_id'] = $id;
                $attributesValues_arr[$attrVAL_CNT]['status'] = request('attr_status_'.$av);;
                $attributesValues_arr[$attrVAL_CNT]['value_order'] = request('attr_order_'.$av);
                $attributesValues_arr[$attrVAL_CNT]['label'] = request('attr_label_'.$av);
                $attributesValues_arr[$attrVAL_CNT]['value'] = request('attr_value_'.$av);
                $attributesValues_arr[$attrVAL_CNT]['created_at'] = $sada;
                $attributesValues_arr[$attrVAL_CNT]['updated_at'] = $sada;

                $attrVAL_CNT++;
                $cntNONE = 0;

            else:

                if ($cntNONE > 30):
                    //prekidam petlju
                    break;
                else:
                    $cntNONE++;
                endif;

            endif;

        }

        // da li postoje unete vrednosti za odabrani atribut
        $ifATTRval_exist = AttributesValues::where('attribute_id',$id)->get();
        // spisak vec unetih
        $attrVAL_IDs = $ifATTRval_exist->pluck('id')->toArray();

        // UPDATE ili INSERT za vrednosi ATRIBUTA
        for ($i=0; $i < count($attributesValues_arr); $i++) { 
            
            // probveravam da li vec postoji ATRIBUT poslatim IDjem
            if (in_array($attributesValues_arr[$i]['val_id'], $attrVAL_IDs)):

                //UPDATE ako postoje vrednosti za atribut i poslat ID je jedna od njih
                $update = AttributesValues::where('id',$attributesValues_arr[$i]['val_id'])
                                            ->where('attribute_id',$attributesValues_arr[$i]['attribute_id'])
                                            ->update([
                                                'status' => $attributesValues_arr[$i]['status'], 
                                                'label' => $attributesValues_arr[$i]['label'],
                                                'value' => $attributesValues_arr[$i]['value'],
                                                'value_order' => $attributesValues_arr[$i]['value_order'],
                                                'updated_at' => $attributesValues_arr[$i]['updated_at']
                                            ]);

                $key = array_search($attributesValues_arr[$i]['val_id'], $attrVAL_IDs);

                unset($attrVAL_IDs[$key]);

            else:
                // INSERT ako vrednost ATRIBUTA ne postoji
                $insert = AttributesValues::insert([
                                                'attribute_id' => $attributesValues_arr[$i]['attribute_id'],
                                                'status' => $attributesValues_arr[$i]['status'],
                                                'label' => $attributesValues_arr[$i]['label'],
                                                'value' => $attributesValues_arr[$i]['value'],
                                                'value_order' => $attributesValues_arr[$i]['value_order'],
                                                'created_at' => $attributesValues_arr[$i]['created_at'],
                                                'updated_at' => $attributesValues_arr[$i]['updated_at']
                                            ]);

            endif;

        }

        // DELETE ili promena STATUSA za vrednosti atributa
        if (count($attrVAL_IDs) > 0):

            foreach ($attrVAL_IDs as $key => $attrVAL_ID) {

                // da li je vrednost atributa dodeljna bar jednom proizvodu?
                $ifExistForProduct = AttributesProduct::where('attribute_value_id',$attrVAL_ID)->first();


                //ako postoje dodeljene vrednosti, ide promena STATUSA. Ako ne postoje dodeljene vrednosti, ide DELETE vrednosti za atribut
                if ($ifExistForProduct):

                    $statusUpdate = AttributesValues::where('id',$attrVAL_ID)->update(['status' => 0]);

                else:

                    $delete = AttributesValues::where('id',$attrVAL_ID)->delete();

                endif;

            }

        endif;      
        // unos vrednosti za atribut ------------------------------------------------------------------------- //


        return redirect()
        ->route("voyager.{$dataType->slug}.index")
        ->with([
            'message'    => __('voyager::generic.successfully_updated')." {$dataType->display_name_singular}",
            'alert-type' => 'success',
        ]);
    }

    //***************************************
    //
    //                   /\
    //                  /  \
    //                 / /\ \
    //                / ____ \
    //               /_/    \_\
    //
    //
    // Add a new item of our Data Type BRE(A)D
    //
    //****************************************

    public function create(Request $request)
    {

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        $dataTypeContent = (strlen($dataType->model_name) != 0)
                            ? new $dataType->model_name()
                            : false;

        foreach ($dataType->addRows as $key => $row) {
            $dataType->addRows[$key]['col_width'] = $row->details->width ?? 100;
        }

        // If a column has a relationship associated with it, we do not want to show that field
        $this->removeRelationshipField($dataType, 'add');

        // Check if BREAD is Translatable
        $isModelTranslatable = is_bread_translatable($dataTypeContent);

        $view = 'voyager::bread.edit-add';

        if (view()->exists("voyager::$slug.edit-add")) {
            $view = "voyager::$slug.edit-add";
        }


        // dostupni tipovi atributa
        $attributeTYPE = Attributes::attributeTYPE();

        // kategorij proizvoda
        $productCategories_SEL = Category::productCategories_SEL();

        //za koje KATEGORIJE je definisan ATRIBUT
        $categoriesForAttribute = array();


        return Voyager::view($view, compact('dataType', 'dataTypeContent', 'isModelTranslatable',
                                            'attributeTYPE','productCategories_SEL','categoriesForAttribute'));
    }

    /**
     * POST BRE(A)D - Store data.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $sada = Carbon::now();

        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('add', app($dataType->model_name));

        // Validate fields with ajax
        $val = $this->validateBread($request->all(), $dataType->addRows)->validate();
        $data = $this->insertUpdateData($request, $slug, $dataType->addRows, new $dataType->model_name());

        // ID za poslednji unos atributa
        $id = $data->id;

        // Dodajem STATUS i TIMESTAMP
        $upadteSTATUS = Attributes::where('id',$id)->update([
                                                        'status' => request('status'),
                                                        'created_at' => $sada,
                                                        'updated_at' => $sada,
                                                    ]);
        // kreira se veza izmedju atributa i kategorije proizvoda -------------------------------------------- //

        //potrebni parametri za insert
        $selectedCAT = request('category_id'); // spisak odabranih kategorija
        $sada = Carbon::now();
        $attrCATforInsert = array();
        $attrCAT_CNT = 0;

        //kreira se niz za unos
        if (count($selectedCAT) > 0):

            for ($c=0; $c < count($selectedCAT); $c++) { 
                    
                $attrCATforInsert[$attrCAT_CNT]['attribute_id'] = $id;
                $attrCATforInsert[$attrCAT_CNT]['category_id'] = $selectedCAT[$c];
                $attrCATforInsert[$attrCAT_CNT]['attribute_id'] = $id;
                $attrCATforInsert[$attrCAT_CNT]['created_at'] = $sada;
                $attrCATforInsert[$attrCAT_CNT]['updated_at'] = $sada;

                $attrCAT_CNT++;

            }


        endif;

        //upis podataka
        $insert = DB::table('attributes_category')->insert($attrCATforInsert);

        // kreira se veza izmedju atributa i kategorije proizvoda -------------------------------------------- //


        // unos vrednosti za atribut ------------------------------------------------------------------------- //

        $maxLOOP = 200;
        $attributesValues_arr = array();
        $cntNONE = 0;
        $attrVAL_CNT = 0;

        //sprema se niz za unos
        for ($av=0; $av<$maxLOOP; $av++) {

            if ($request->has('attr_order_'.$av)):

                //podaci za unos vrednsoti za ATRIBUTE
                $attributesValues_arr[$attrVAL_CNT]['attribute_id'] = $id;
                $attributesValues_arr[$attrVAL_CNT]['status'] = request('attr_status_'.$av);;
                $attributesValues_arr[$attrVAL_CNT]['value_order'] = request('attr_order_'.$av);
                $attributesValues_arr[$attrVAL_CNT]['label'] = request('attr_label_'.$av);
                $attributesValues_arr[$attrVAL_CNT]['value'] = request('attr_value_'.$av);
                $attributesValues_arr[$attrVAL_CNT]['created_at'] = $sada;
                $attributesValues_arr[$attrVAL_CNT]['updated_at'] = $sada;

                $attrVAL_CNT++;
                $cntNONE = 0;

            else:

                if ($cntNONE > 30):
                    //prekidam petlju
                    break;
                else:
                    $cntNONE++;
                endif;

            endif;

        }

        // INSERT za vrednosti atributa
        $insert = AttributesValues::insert($attributesValues_arr);

        // unos vrednosti za atribut ------------------------------------------------------------------------- //


        event(new BreadDataAdded($dataType, $data));

        return redirect()
        ->route("voyager.{$dataType->slug}.index")
        ->with([
                'message'    => __('voyager::generic.successfully_added_new')." {$dataType->display_name_singular}",
                'alert-type' => 'success',
            ]);
    }

    //***************************************
    //                _____
    //               |  __ \
    //               | |  | |
    //               | |  | |
    //               | |__| |
    //               |_____/
    //
    //         Delete an item BREA(D)
    //
    //****************************************

    public function destroy(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('delete', app($dataType->model_name));

        // Init array of IDs
        $ids = [];
        if (empty($id)) {
            // Bulk delete, get IDs from POST
            $ids = explode(',', $request->ids);
        } else {
            // Single item delete, get ID from URL
            $ids[] = $id;
        }
        foreach ($ids as $id) {
            $data = call_user_func([$dataType->model_name, 'findOrFail'], $id);

            $model = app($dataType->model_name);
            if (!($model && in_array(SoftDeletes::class, class_uses($model)))) {
                $this->cleanup($dataType, $data);
            }
        }

        $displayName = count($ids) > 1 ? $dataType->display_name_plural : $dataType->display_name_singular;

        $res = $data->destroy($ids);

        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_deleted')." {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_deleting')." {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataDeleted($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    public function restore(Request $request, $id)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('delete', app($dataType->model_name));

        // Get record
        $model = call_user_func([$dataType->model_name, 'withTrashed']);
        if ($dataType->scope && $dataType->scope != '' && method_exists($model, 'scope'.ucfirst($dataType->scope))) {
            $model = $model->{$dataType->scope}();
        }
        $data = $model->findOrFail($id);

        $displayName = $dataType->display_name_singular;

        $res = $data->restore($id);
        $data = $res
            ? [
                'message'    => __('voyager::generic.successfully_restored')." {$displayName}",
                'alert-type' => 'success',
            ]
            : [
                'message'    => __('voyager::generic.error_restoring')." {$displayName}",
                'alert-type' => 'error',
            ];

        if ($res) {
            event(new BreadDataRestored($dataType, $data));
        }

        return redirect()->route("voyager.{$dataType->slug}.index")->with($data);
    }

    /**
     * Remove translations, images and files related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $dataType
     * @param \Illuminate\Database\Eloquent\Model $data
     *
     * @return void
     */
    protected function cleanup($dataType, $data)
    {
        // Delete Translations, if present
        if (is_bread_translatable($data)) {
            $data->deleteAttributeTranslations($data->getTranslatableAttributes());
        }

        // Delete Images
        $this->deleteBreadImages($data, $dataType->deleteRows->where('type', 'image'));

        // Delete Files
        foreach ($dataType->deleteRows->where('type', 'file') as $row) {
            if (isset($data->{$row->field})) {
                foreach (json_decode($data->{$row->field}) as $file) {
                    $this->deleteFileIfExists($file->download_link);
                }
            }
        }

        // Delete media-picker files
        $dataType->rows->where('type', 'media_picker')->where('details.delete_files', true)->each(function ($row) use ($data) {
            $content = $data->{$row->field};
            if (isset($content)) {
                if (!is_array($content)) {
                    $content = json_decode($content);
                }
                if (is_array($content)) {
                    foreach ($content as $file) {
                        $this->deleteFileIfExists($file);
                    }
                } else {
                    $this->deleteFileIfExists($content);
                }
            }
        });
    }

    /**
     * Delete all images related to a BREAD item.
     *
     * @param \Illuminate\Database\Eloquent\Model $data
     * @param \Illuminate\Database\Eloquent\Model $rows
     *
     * @return void
     */
    public function deleteBreadImages($data, $rows)
    {
        foreach ($rows as $row) {
            if ($data->{$row->field} != config('voyager.user.default_avatar')) {
                $this->deleteFileIfExists($data->{$row->field});
            }

            if (isset($row->details->thumbnails)) {
                foreach ($row->details->thumbnails as $thumbnail) {
                    $ext = explode('.', $data->{$row->field});
                    $extension = '.'.$ext[count($ext) - 1];

                    $path = str_replace($extension, '', $data->{$row->field});

                    $thumb_name = $thumbnail->name;

                    $this->deleteFileIfExists($path.'-'.$thumb_name.$extension);
                }
            }
        }

        if ($rows->count() > 0) {
            event(new BreadImagesDeleted($data, $rows));
        }
    }

    /**
     * Order BREAD items.
     *
     * @param string $table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        if (!isset($dataType->order_column) || !isset($dataType->order_display_column)) {
            return redirect()
            ->route("voyager.{$dataType->slug}.index")
            ->with([
                'message'    => __('voyager::bread.ordering_not_set'),
                'alert-type' => 'error',
            ]);
        }

        $model = app($dataType->model_name);
        if ($model && in_array(SoftDeletes::class, class_uses($model))) {
            $model = $model->withTrashed();
        }
        $results = $model->orderBy($dataType->order_column, $dataType->order_direction)->get();

        $display_column = $dataType->order_display_column;

        $dataRow = Voyager::model('DataRow')->whereDataTypeId($dataType->id)->whereField($display_column)->first();

        $view = 'voyager::bread.order';

        if (view()->exists("voyager::$slug.order")) {
            $view = "voyager::$slug.order";
        }

        return Voyager::view($view, compact(
            'dataType',
            'display_column',
            'dataRow',
            'results'
        ));
    }

    public function update_order(Request $request)
    {
        $slug = $this->getSlug($request);

        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        // Check permission
        $this->authorize('edit', app($dataType->model_name));

        $model = app($dataType->model_name);

        $order = json_decode($request->input('order'));
        $column = $dataType->order_column;
        foreach ($order as $key => $item) {
            if ($model && in_array(SoftDeletes::class, class_uses($model))) {
                $i = $model->withTrashed()->findOrFail($item->id);
            } else {
                $i = $model->findOrFail($item->id);
            }
            $i->$column = ($key + 1);
            $i->save();
        }
    }

    public function action(Request $request)
    {
        $slug = $this->getSlug($request);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        $action = new $request->action($dataType, null);

        return $action->massAction(explode(',', $request->ids), $request->headers->get('referer'));
    }

    /**
     * Get BREAD relations data.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function relation(Request $request)
    {
        $slug = $this->getSlug($request);
        $page = $request->input('page');
        $on_page = 50;
        $search = $request->input('search', false);
        $dataType = Voyager::model('DataType')->where('slug', '=', $slug)->first();

        foreach ($dataType->editRows as $key => $row) {
            if ($row->field === $request->input('type')) {
                $options = $row->details;
                $skip = $on_page * ($page - 1);

                // If search query, use LIKE to filter results depending on field label
                if ($search) {
                    $total_count = app($options->model)->where($options->label, 'LIKE', '%'.$search.'%')->count();
                    $relationshipOptions = app($options->model)->take($on_page)->skip($skip)
                        ->where($options->label, 'LIKE', '%'.$search.'%')
                        ->get();
                } else {
                    $total_count = app($options->model)->count();
                    $relationshipOptions = app($options->model)->take($on_page)->skip($skip)->get();
                }

                $results = [];
                foreach ($relationshipOptions as $relationshipOption) {
                    $results[] = [
                        'id'   => $relationshipOption->{$options->key},
                        'text' => $relationshipOption->{$options->label},
                    ];
                }

                return response()->json([
                    'results'    => $results,
                    'pagination' => [
                        'more' => ($total_count > ($skip + $on_page)),
                    ],
                ]);
            }
        }

        // No result found, return empty array
        return response()->json([], 404);
    }
}