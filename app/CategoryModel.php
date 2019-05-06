<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    protected $table= 'category';

    public function cats(){
        return $this->belongsTo('App\SubCategoryModel','cat_id','id');
    }
}
