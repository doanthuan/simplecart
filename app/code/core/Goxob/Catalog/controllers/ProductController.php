<?php
namespace Goxob\Catalog;

use View, Input, Redirect, Response, Session, Validator, Request;

class ProductController extends \Goxob\Core\Controller\BaseController {

    //category view
	public function index($slug = null)
	{
        $categoryId = Helper\Category::getCategoryId($slug);
        if(!is_null($categoryId)){
            Input::merge(array('cid' => $categoryId));
        }

        return View::make('catalog.product.index');
	}

    public function postSearch()
    {
        $term = Input::get('product_search');
        if(!empty($term))
        {
            return Redirect::to('products/search/'.$term);
        }
    }

    //search view
    public function search($search)
    {
        Input::merge(array('search' => $search));
        return View::make('catalog.product.index');
    }

    public function ajaxSearch($search)
    {
        if(!empty($search))
        {
            $query = \Goxob::getModel('catalog/products')->getSelect()->where('name','like','%'.$search.'%');
            $result = $query->get();
            return Response::json($result);
        }
    }

    public function info($pid = null)
    {
        Input::merge(array('pid' => $pid));

        //get product
        $productId = \Goxob\Catalog\Helper\Product::getProductId($pid);

        $product = \Goxob::getModel('catalog/product')->find($productId);
        if(is_null($product))
        {
            return Redirect::to('error')->withErrors(trans('Could not find product'));
        }

        //get product images
        $images = $product->images()->get();
        $defaultImage = $product->images()->where('default', 1)->first();

        //get product custom attributes
        $attributes = $product->attributes;

        //get product reviews
        $reviews = $product->reviews()->where('status', 1)->paginate();

        //get related products
        $relatedProducts = $product->relatedProducts()->with(array('images' => function($query){
            $query->where('default', 1);
        }))->where('status', 1)->get();

        $data['product'] = $product;
        $data['images'] = $images;
        $data['defaultImage'] = $defaultImage;
        $data['attributes'] = $attributes;
        $data['reviews'] = $reviews;
        $data['relatedProducts'] = $relatedProducts;

        return View::make('catalog.product.info', $data);
    }

    public function postReview()
    {
        $input = Input::all();

        //validate captcha
        $rules =  array('captcha' => array('required', 'captcha'));
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return \Goxob::back(trans('Captcha does not match'));
        }

        //store item to db
        $review = \Goxob::getModel('catalog/review');
        $review->setData($input);
        if(!$review->save())
        {
            return Redirect::back()->withErrors($review->getErrors())->withInput();
        }

        $referer = Request::header('referer');
        $referer .= '#tab-review';

        return Redirect::to($referer)->with('message', trans('Thank you for your review. It has been submitted to the webmaster for approval').'!');
    }
}