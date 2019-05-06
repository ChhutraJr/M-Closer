<?php

namespace App\Http\Controllers\Admin;

use App\CheckOutDetailModel;
use App\CheckOutModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CheckOutController extends Controller
{
    public  function index(){

        $check_out=CheckOutModel::all();
        $data=array(
            'check_outs'=>$check_out,
        );
        return view('admin.check_out.index',$data);

    }
    public  function indexCheckOutDetail($id){

        $check_out_detail=CheckOutDetailModel::where('check_out_id',$id)->get();
        $data=array(
            'check_out_details'=>$check_out_detail,
        );
        return view('admin.check_out_detail.index',$data);

    }


    public function delete(Request $request){
        $id=$request->delete_id;
        $check_out= CheckOutModel::find($id);

        Storage::delete($check_out->image);

        CheckOutModel::where('id',$id)->delete();
        Session::flash('message', $check_out->name.' have been deleted !');
        Session::flash('title', 'Slideshow');
        Session::flash('alert-type', 'error');
        return back();
    }

}
