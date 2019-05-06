<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductModel;
use App\SlideShowModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index($name){


        $products=ProductModel::orderBy('id','DESC')->limit(30)->get();
        $categories=CategoryModel::orderBy('order')->limit(10)->get();
        $cat_footer=CategoryModel::orderBy('order')->limit(5)->get();


        $pro=ProductModel::where('name',$name)->first();
        ProductModel::where('name',$name)
            ->update(['view'=>$pro->view+1]);

        $related_pro=ProductModel::where('cat_id',$pro->cat_id)
            ->where('id','!=',$pro->id)
            ->orderBy('id','DESC')
            ->orderBy('view','DESC')
            ->limit(3)->get();
        $data=array(
            'products'=>$products,
            'categories'=>$categories,
            'cat_footer'=>$cat_footer,
            'pro'=>$pro,
            'related_pro'=>$related_pro,

        );

        return view('product.index',$data);
    }
}
