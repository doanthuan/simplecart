<?php
namespace Goxob\Slideshow\Model;

use Goxob\Core\Model\Model;
use DB, Input, Str, Validator, File;

class Item extends Model{

    protected $table = 'slideshow_item';
    protected $primaryKey = 'item_id';

    protected $fillable = array( 'name', 'link_to', 'sort_order', 'group_id');

    protected $rules = array(
        'group_id' =>'required|integer',
        'name'       =>'required',
    );

    protected  $uploadRules = array(
        'image' => 'mimes:png,gif,jpeg|max:20000'
    );

    public function group()
    {
        return $this->belongsTo('\Goxob\Slideshow\Model\Group','group_id', 'group_id');
    }

    public function setData($input)
    {
        if(empty($input)){
            return;
        }

        if (Input::hasFile('image'))
        {

            $file = Input::file('image');

            $validator = Validator::make(array('image'=> $file), $this->uploadRules);
            if(!$validator->passes()){
                return \Goxob::back($validator->messages());
            }

            $basePath = base_path().DS.'media'.DS.'slideshow';

            //remove old image
            if(isset($this->image)){
                File::delete($basePath.'/'.$this->image);
            }

            //get new image
            $filename = \Goxob\Core\Helper\File::formatFileName($file);
            $file->move($basePath, $filename);
            $this->image = $filename;
        }

        parent::setData($input);
    }

}