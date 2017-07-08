<?php
namespace Goxob\Coupon\Admin;

use View, Input, Redirect;

class CouponController extends \Goxob\Core\Controller\AdminController {

    public function store()
    {
        $input = Input::all();

        $model = $this->model;
        $model->setData($input);
        if(!$model->save())
        {
            return Redirect::back()->withErrors($model->getErrors())->withInput();
        }

        //save related products
        $relatedProducts = Input::get('product-suggestion-list');
        if(!empty($relatedProducts)){
            $model->products()->sync($relatedProducts);
        }

        return Redirect::to('admin/coupon/coupon/index')->with('message', trans('Coupon Saved').'!');
    }

}