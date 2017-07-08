<?php
namespace Goxob\Locale\Model;

use Goxob\Core\Model\Model;
use DB, Input, Str, Validator, File;

class Currency extends Model{

    protected $table = 'locale_currency';
    protected $primaryKey = 'currency_id';
    public $timestamps = true;

    protected $fillable = array( 'title', 'code', 'symbol_left', 'symbol_right', 'decimal_place', 'value', 'status', 'default');

    protected $rules = array(
        'title'       =>'required',
        'code'        =>'required',
        'decimal_place'     =>'required|numeric',
        'value'     =>  'required|numeric',
    );

    protected static function boot()
    {
        static::saving(function($model)
        {
            $model->where('status', 1)->update(array('default' => 0));
            return $model->validate();
        });
    }

    public function validate()
    {
        if(parent::validate())
        {
            if($this->exists(array('code')))
            {
                $this->setErrors(trans('Currency code is already existed'));
                return false;
            }

            if($this->exists(array('title')))
            {
                $this->setErrors(trans('Currency title is already existed'));
                return false;
            }

            return true;
        }
        return false;
    }



}