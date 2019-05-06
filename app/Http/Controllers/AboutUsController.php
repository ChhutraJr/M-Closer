<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductModel;
use App\SlideShowModel;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    public function index(){

        $products=ProductModel::orderBy('id','DESC')->limit(30)->get();
        $categories=CategoryModel::orderBy('order')->limit(10)->get();
        $cat_footer=CategoryModel::orderBy('order')->limit(5)->get();

        $data=array(
            'products'=>$products,
            'categories'=>$categories,
            'cat_footer'=>$cat_footer,

        );

        return view('about_us.index',$data);
    }
}
