<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckOutModel extends Model
{
    protected $table ='check_out';

    public function ship(){
        return $this->belongsTo('App\ShippingModel','shipp_id','id');
    }

    public function  check_out_detail(){
        return $this ->hasMany('App\CheckOutDetailModel','check_out_id','id');
    }
}
