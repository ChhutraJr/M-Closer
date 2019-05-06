<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductModel;
use App\SlideShowModel;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){

        $products=ProductModel::orderBy('id','DESC')->limit(30)->get();
        $categories=CategoryModel::orderBy('order')->limit(10)->get();
        $cat_footer=CategoryModel::orderBy('order')->limit(5)->get();
        $slides=SlideShowModel::orderBy('id','DESC')->get();
        $features=ProductModel::orderBy('view','DESC')->limit(4)->get();
        $latest_pro=ProductModel::orderBy('id','DESC')->limit(4)->get();

        $data=array(
            'products'=>$products,
            'categories'=>$categories,
            'cat_footer'=>$cat_footer,
            'slides'=>$slides,
            'features'=>$features,
            'latest_pro'=>$latest_pro,
        );

        return view('index',$data);
    }
}
