<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $table ='products';

    public function pictures(){
        return $this->hasMany('App\ProductImageModel','pro_id','id');
    }
    public function colors(){
        return $this->hasMany('App\PorductColorModel','pro_id','id');
    }
    public function sizes(){
        return $this->hasMany('App\PorductSizeModel','pro_id','id');
    }
    public function users(){
        return $this->belongsTo('App\UsersModel','user_id','id');
    }

    public function cat(){
        return $this->belongsTo('App\CategoryModel','cat_id','id');
    }
    public function brand(){
        return $this->belongsTo('App\BrandModel','brand_id','id');
    }
    public function supplier(){
        return $this->belongsTo('App\SupplierModel','sup_id','id');
    }

    public function sub_cat(){
        return $this->belongsTo('App\SubCategoryModel','sub_cat_id','id');
    }

}
