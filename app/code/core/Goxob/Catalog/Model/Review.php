<?php

namespace Goxob\Catalog\Model;

use Goxob\Core\Model\Model;

class Review extends Model{

    protected $table = 'product_review';
    protected $primaryKey = 'review_id';
    public $timestamps = true;

    protected $fillable = array( 'product_id', 'customer_id', 'author', 'title', 'description', 'rating', 'status');

    protected $rules = array(
        'description' => 'required|min:10',
        'product_id' => 'required'
    );

    //relationships
    public function product()
    {
        return $this->belongsTo('\Goxob\Catalog\Model\Product');
    }
}