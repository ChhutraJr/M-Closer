<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    protected $table ='sub_category';

    public function cats(){
        return $this->belongsTo('App\CategoryModel','cat_id','id');
    }
}
