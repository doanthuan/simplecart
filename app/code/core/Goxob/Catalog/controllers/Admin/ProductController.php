<?php
namespace Goxob\Catalog\Admin;

use Goxob\Core\Helper\Data;
use Goxob\Core\Html\Toolbar;

use View, Input, Session, Redirect, Route, Request, Form, Event, File, Validator, Str, Lang, Response;

class ProductController extends \Goxob\Core\Controller\AdminController {

    public function index()
    {
        Toolbar::title(trans('Manage Products'));
        Toolbar::buttons(array(Toolbar::BUTTON_CREATE, Toolbar::BUTTON_DELETE));
        Toolbar::redirectButton(trans('Import Producs'), url('admin/catalog/product/get-import'));

        return View::make($this->module.'.'.$this->viewKey.'.index');
    }

    public function edit()
    {
        Toolbar::title(trans('Edit Product'));
        Toolbar::buttons(array(Toolbar::BUTTON_SAVE, Toolbar::BUTTON_CANCEL)) ;

        $item = \Goxob::getModel('catalog/product')->find(Input::get('id'));
        if(is_null($item))
        {
            \Goxob::error(trans('Could not find record'));
        }
        $data['item'] = $item;

        //get related products
        $relatedProducts = $item->relatedProducts()->get();
        $data['relatedProducts'] = $relatedProducts;

        return View::make('catalog.product.edit', $data);
    }

    public function store()
    {
        //raise event before saving product
        Event::fire('catalog.product.saving');

        $input = Input::all();

        $product = $this->model;
        $product->setData($input);
        if(!$product->save())
        {
            return Redirect::back()->withErrors($product->getErrors())->withInput();
        }

        //save images
        $images = Input::file('product_images');
        $overwrite = Input::has('replace_images');
        $defaultImg = Input::get('default_image');
        if(!$product->saveImages($images, $overwrite, $defaultImg))
        {
            $product->delete();
            return Redirect::back()->withErrors($product->getErrors())->withInput();
        }

        //save attributes
        if(!$product->saveAttributes($input))
        {
            $product->delete();
            return Redirect::back()->withErrors($product->getErrors())->withInput();
        }

        //save related products
        $relatedProducts = Input::get('product-suggestion-list');
        if(!empty($relatedProducts)){
            $product->relatedProducts()->sync($relatedProducts);
        }

        //raise event after saving product
        Event::fire('catalog.product.saved', array($product));

        return Redirect::to('admin/catalog/product/index')->with('message', trans('Product Saved').'!');
    }


    public function delete()
    {
        Event::fire('catalog.product.deleting');

        return parent::delete();
    }

    public function getAttributes()
    {
        // Load product attributes
        $attributeSetId = Input::get('attr_set_id', 0);
        $productId = Input::get('product_id', 0);

        if($productId > 0)
        {
            $product = \Goxob::getModel('catalog/product')->find($productId);
            $attributesOfProduct = $product->attributes()->get();
        }
        if($attributeSetId > 0)
        {
            $attributeSet = \Goxob::getModel('catalog/attribute-set')->find($attributeSetId);
            $attributesOfSet = $attributeSet->attributes()->get();
        }
        foreach($attributesOfSet as $attribute)
        {
            $value = null;
            foreach($attributesOfProduct as $pAttribute){
                if($pAttribute->attr_id == $attribute->attr_id){
                    $value = $pAttribute->pivot->attr_value;
                    break;
                }
            }
            $attribute->attr_value = $value;
        }

        $html = '';
        foreach($attributesOfSet as $attr)
        {
            $html .= \Goxob\Catalog\Helper\Attribute::renderAttribute($attr);
        }
        echo $html;
        exit;
    }

    public function getImport()
    {
        Toolbar::title('Import Products');
        Toolbar::buttons(array(Toolbar::BUTTON_UPLOAD, Toolbar::BUTTON_CANCEL)) ;

        return View::make('catalog.product.import');
    }

    public function postImport()
    {
        $csvFile = $this->uploadCsvFile();

        $this->parseCsvFile($csvFile);

        return Redirect::to('admin/catalog/product/index')->with('message', trans('Importing Product Completed').'!');
    }

    private function uploadCsvFile()
    {
        //init upload directory
        $uploadDir = base_path().'/media/product/import/';
        if(!file_exists($uploadDir))
        {
            File::makeDirectory($uploadDir, 777);
        }

        //validate file
        if (!Input::hasFile('import_file') || !Input::file('import_file')->isValid()){
            return Redirect::back();
        }
        $uploadRules = array(
            'file' => 'max:20000'
        );
        $file = Input::file('import_file');
        $validator = Validator::make(array('file'=> $file), $uploadRules);
        if(!$validator->passes()){
            return Redirect::back()->withErrors($validator->messages());
        }

        //move upload file
        $filename  = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $filename  =  basename($filename,'.'.$extension);
        $file->move($uploadDir, $filename);

        return $uploadDir.'/'.$filename;
    }

    private function parseCsvFile($csvFile)
    {
        $attrSetId = null;
        $attributeSet = null;
        $attributes = null;

        $attributeSetList = \Goxob::getModel('catalog/attribute-sets')->getAllAsArray();

        $handle = fopen($csvFile, "r");
        $header = fgetcsv($handle, 1000, ",");//read header
        while (($data = fgetcsv($handle)) !== FALSE) {
            if(empty($data)){
                continue;
            }

            #bind data
            $input = array();

            //read row
            foreach($header as $i => $field)
            {
                $field = strtolower($field);
                $field = str_replace(' ', '_', $field);
                $input[$field] = $data[$i];
            }

            //get attribute set
            $attrSetId = array_search($input['product_type'], $attributeSetList);
            if(is_null($attrSetId))
            {
                return Redirect::back()->withErrors('Attribute set does not exists');
            }
            $input['attr_set_id'] = $attrSetId;
            if(is_null($attributeSet))
            {
                $attributeSet = \Goxob::getModel('catalog/attribute-set')->find($attrSetId);
                $attributes = $attributeSet->attributes()->get();
            }

            //create new categories if not exist
            $categories = explode('|',$input['categories']);
            $catId = \Goxob::getModel('catalog/category')->findOrSaveCategories($categories);
            $input['category_id'] = $catId;


            //create new vendor if not exist
            if(!empty($input['vendor']))
            {
                $vendor = \Goxob::getModel('catalog/vendor')->firstOrCreate(array('vendor_name' => $input['vendor']));
                $input['vendor_id'] = $vendor->vendor_id;
            }

            //store product to db
            $product = \Goxob::getModel('catalog/product');
            $product->setData($input);
            if(!$product->save())
            {
                return Redirect::back()->withErrors($product->getErrors());
            }

            //copy product images
            $productImages = explode(';', $input['images']);
            $storedImages = array();
            foreach($productImages as $img)
            {
                //copy images to media folder
                $img = trim($img);
                if(empty($img))continue;

                $img = base_path().'/media/product/import/images/'.$img;

                copy($img, \Goxob\Catalog\Helper\Product::getProductImagePath().'/'.basename($img));

                $storedImages[] = basename($img);
            }

            //save product images
            if(!$product->saveImages($storedImages))
            {
                $product->delete();
                return Redirect::back()->withErrors($product->getErrors());
            }

            //save product attributes
            $attrValues = array();
            foreach($attributes as $attr){
                $value = isset($input[$attr->code])?$input[$attr->code]:'';
                $attrValues[$attr->attr_id] = $value;
            }

            if(!$product->saveAttributes($attrValues))
            {
                $product->delete();
                return Redirect::back()->withErrors($product->getErrors());
            }
        }
        fclose($handle);
    }

    public function export()
    {
        //get list product types
        $attrSetList = \Goxob::getModel('catalog/attribute-sets')->getAll();
        foreach($attrSetList as $attrSet)
        {
            $this->exportProductsByAttrSet($attrSet);
        }

        return Redirect::to('admin/catalog/product/index')->with('message', trans('Exporting Product Completed'));
    }

    private function exportProductsByAttrSet($attrSet)
    {
        //create csv file with attribute set
        $attrName = Str::slug( $attrSet->name , '-' );
        $exportDir = base_path().'/media/product/export';
        $handle = fopen($exportDir.'/'.$attrName.".csv", "w");

        $products = $attrSet->products()->get();

        //output header of csv file
        $product = \Goxob::getModel('catalog/product');
        $productAttributes = $product->getFillable();
//        $header = 'Categories,Name,Price,Description,SKU,Quantity,Cost,Vendor,Tax,Published,Published_Date,Sort Order,Images,Old_Price,New_From,New_To,Hot_From,Hot_To,Alias,Meta_Info,Related_Products';
//        $header = explode(',', $header);
        $header = $productAttributes;


        //append attributes of attr set to header
        //get list attributes by attribute set id
        $attributes = $attrSet->attributes()->get();
        foreach($attributes as $attr)
        {
            $header[] = $attr->code;
        }

        //write the header
        fputcsv($handle, $header);

        //output data of product list
        $modelCategories = \Goxob::getModel('catalog/categories');
        foreach ($products as $product) {
            $dataRow = array();
            $imageList = array();
            $imgData = array();

            $parentsCatName = $modelCategories->getParentNames($product->category_id);
            $dataRow[] = implode('|', $parentsCatName);
            foreach($productAttributes as $productAttr)
            {
                $value = $product->$productAttr;
                if($productAttr == 'published_date')
                {
                    $value = date('Y-m-d', strtotime($value));
                }
                $dataRow[] = $value;
            }

            //get product images
            $imageList = $product->images()->get();
            foreach($imageList as $img)
            {
                $imgName = trim($img->img_name);
                if(empty($imgName))continue;

                $imgData[] = $imgName;

                //copy image to export folder
                copy(base_path().'/media/product/'. $imgName, $exportDir.'/images/'.$imgName);
            }
            $imgData = implode(';', $imgData);
            $dataRow[] = $imgData;

            //get product attributes
            $productCustomAttributes = $product->attributes()->get();
            foreach($productCustomAttributes as $attr)
            {
                $dataRow[] = $attr->pivot->attr_value;
            }

            //write data row to csv file
            fputcsv($handle, $dataRow);
        }

        fclose($handle);
    }

    public function ajaxSearch()
    {
        if(Input::has('term'))
        {
            $term = Input::get('term');
            $query = \Goxob::getModel('catalog/products')->getSelect()->where('name','like','%'.$term.'%');
            $result = $query->get();
            return Response::json($result);
        }
    }
}