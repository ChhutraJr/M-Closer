<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ProductModel;
use App\SlideShowModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug){
        $products=ProductModel::orderBy('id','DESC')->limit(30)->get();
        $categories=CategoryModel::orderBy('order')->limit(10)->get();
        $cat_footer=CategoryModel::orderBy('order')->limit(5)->get();

        $cat=CategoryModel::where('slug',$slug)->first();
        $pro_count=ProductModel::where('cat_id',$cat->id)->count();
        $cat_products=ProductModel::where('cat_id',$cat->id)
            ->orderBy('id','DESC')
            ->paginate(6);

        $per_page=6;

        $paginate='false';
        if ($pro_count>6){
            $paginate='true';
        }

        $data=array(
            'products'=>$products,
            'categories'=>$categories,
            'cat_footer'=>$cat_footer,

            'cat_products'=>$cat_products,
            'cat'=>$cat,
            'per_page'=>$per_page,
            'paginate'=>$paginate,

        );

        return view('category.index',$data);
    }
}
