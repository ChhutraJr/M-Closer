<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CheckOutDetailModel extends Model
{
    protected $table = 'check_out_detail';

    public function pro(){
        return $this->belongsTo('App\ProductModel','pro_id','id');
    }
}
