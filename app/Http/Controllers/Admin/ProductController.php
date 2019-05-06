<?php

namespace App\Http\Controllers\Admin;

use App\BrandModel;
use App\CategoryModel;
use App\ProductAvailabilityModel;
use App\ProductColorModel;
use App\ProductImageModel;
use App\ProductModel;
use App\ProductSizeModel;
use App\SizeModel;
use App\SubCategoryModel;
use App\SupplierModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products=ProductModel::orderBy('id','DESC')->get();
        $brands=BrandModel::orderBy('id','DESC')->get();
        $sub_cats=SubCategoryModel::orderBy('id','DESC')->get();
        $supplier=SupplierModel::orderBy('id','DESC')->get();
        $pro_ava=ProductAvailabilityModel::orderBy('id','DESC')->get();
        $pro_img=ProductImageModel::where('pro_id',0)->get();
        $cats=CategoryModel::orderBy('order')->get();
        $size = SizeModel::orderBy('id','DESC')->get();
        foreach ($pro_img as $item){
            Storage::delete($item->name);
        }

        ProductImageModel::where('pro_id',0)->delete();
        $data=array(
            'products'=>$products,
            'cats'=>$cats,
            'brands'=>$brands,
            'suppliers'=>$supplier,
            'sub_cats'=>$sub_cats,
            'pro_avaty'=>$pro_ava,
            'sizes'=> $size
        );

        return view('admin.product.index',$data);
    }

    public function store(Request $request){
        //Check if input is right

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'category' => 'required',
            'sub_category'=> 'required',
            'brand'=>'required',
            'model'=>'required',
            'pro_ava'=>'required',
            'supplier'=>'required',
            'pro_code'=>'required',
            'size'=>'required',
            'price' => 'required|numeric|min:1|max:100000000',
            'description' => 'required|max:5000'
        ]);

        //If input is right
        if ($validator->passes()) {

         //  $pro_images->user_id = Auth::user()->id;
            $pro_images=ProductImageModel::where('pro_id',0)->count();
            if ($pro_images==0){
                    return response()->json(['images'=>'false',
                ]);
            }
            while (true){
                $generate_id = rand(00000, 999999);

                $data=ProductModel::where('gen_key',$generate_id)->count();

                if ($data==0) {
                    $price=str_replace(',','',$request->price);

            //Add product to database
            $pro =new ProductModel();
            $pro->name=$request->title;
            $pro->price=$price;
            $pro->description=$request->description;
            $pro->cat_id=$request->category;
            $pro->mod=$request->model;
            $pro->pro_code=$request->pro_code;
            $pro->brand_id=$request->brand;
            $pro->sup_id=$request->supplier;
            $pro->sub_cat_id=$request->sub_category;
            $pro->pro_ava_id=$request->pro_ava;
            $pro->gen_key=$generate_id;
            $pro->save();


            ProductImageModel::where('pro_id',0)
                        ->update(['pro_id'=>$pro->id]);

                    $n =0;

                    foreach ($request -> size as $item){
                        $pro_size = new ProductSizeModel();
                        $pro_size->size_id=$item[$n];
                        $pro_size->user_id=Auth::user()->id;
                        $pro_size->pro_id=$pro->id;
                        $pro_size->save();
                    }
          //  productImageModel::where('user_id',Auth::user()->id)
          //      ->where('pro_id',0);

            Session::flash('message', $request->title.' have been added !');
            Session::flash('title', 'Product');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
                    }
            }
        }
        //Send errors if input is wrong
        return ['errors' => $validator->errors()];

    }

    public function show_update($id){

        $product=ProductModel::where('id',$id)->first();
        $pro_images=ProductImageModel::where('pro_id',$id)->get();
        $brands=BrandModel::orderBy('id','DESC')->get();
        $sub_cats=SubCategoryModel::orderBy('id','DESC')->get();
        $supplier=SupplierModel::orderBy('id','DESC')->get();
        $pro_ava=ProductAvailabilityModel::orderBy('id','DESC')->get();
        $pro_img=ProductImageModel::where('pro_id',0)->get();
        $cats=CategoryModel::orderBy('order')->get();
        $size = SizeModel::orderBy('id','DESC')->get();

        $pro_sizes=ProductSizeModel::where('pro_id',$id)->get();
        foreach ($pro_img as $item){
            Storage::delete($item->name);
        }
        $data=array(
            'product'=>$product,
            'pro_images'=>$pro_images,
            'cats'=>$cats,
            'brands'=>$brands,
            'suppliers'=>$supplier,
            'sub_cats'=>$sub_cats,
            'pro_avaty'=>$pro_ava,
            'sizes'=>$size,
            'pro_sizes'=>$pro_sizes,
        );

        return view('admin.product.update',$data);
    }

    public function update(Request $request){

        $pro=ProductModel::where('id',$request->update_id)->first();
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:100',
            'category' => 'required',
            'brand'=>'required',
            'model'=>'required',
            'pro_ava'=>'required',
            'supplier'=>'required',
            'pro_code'=>'required',
            'price' => 'required|numeric|min:1|max:100000000',
            'description' => 'required|max:5000'
        ]);

        if ($pro->name!=$request->title){
            $validator = Validator::make($request->all(), [
                'title' => 'required|max:100|unique:products,name',
                'category' => 'required',
                'brand'=>'required',
                'model'=>'required',
                'pro_ava'=>'required',
                'supplier'=>'required',
                'pro_code'=>'required',
                'price' => 'required|numeric|min:1|max:100000000',
                'description' => 'required|max:5000'
            ]);
        }

        //If input is right
        if ($validator->passes()) {


            ProductModel::where('id',$request->update_id)
                ->update([
                    'name'=>$request->title,
                    'price'=>$request->price,
                    'description'=>$request->description,
                    'cat_id'=>$request->category,
                    'mod'=>$request->model,
                    'pro_code'=>$request->pro_code,
                    'brand_id'=>$request->brand,
                    'sup_id'=>$request->supplier,
                    'sup_id'=>$request->supplier,
                    'pro_ava_id'=>$request->pro_ava,
                    'sub_cat_id'=>$request->sub_category

                ]);

            $pro_images=ProductImageModel::where('pro_id',0)->count();
            if ($pro_images!=0){
                $pro_img=ProductImageModel::where('pro_id',$pro->id)->get();
                foreach ($pro_img as $p_m){
                    Storage::delete($p_m->name);
                }

                ProductImageModel::where('pro_id',$pro->id)->delete();

               ProductImageModel::where('pro_id',0)
                ->update(['pro_id'=>$pro->id]);
            }

            Session::flash('message', $pro->name.' have been updated !');
            Session::flash('title', 'Product');
            Session::flash('alert-type', 'success');

            //Send value back to view
            return response()->json(['verify'=>'true',
            ]);
        }
        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function delete(Request $request){
        $id=$request->delete_id;
        $pro_images=ProductImageModel::where('pro_id',$id)->get();
        foreach ($pro_images as $item){
            Storage::delete($item->name);
        }

        ProductImageModel::where('pro_id',$id)->delete();
        $pro= ProductModel::find($id);

        ProductModel::where('id',$id)->delete();
        Session::flash('message', $pro->name.' have been deleted !');
        Session::flash('title', 'Product');
        Session::flash('alert-type', 'error');
        return back();
    }

    public function product_picture(Request $request){
        // return $request->all();
        //dd($request->all());
        if ($request->file('file')!=null){
            $path=$request->file('file')->store('product');
            $pro_images=new ProductImageModel();
            $pro_images->image=$path;
            $pro_images->user_id=Auth::user()->id;
            $pro_images->pro_id=0;
            $pro_images->save();
            return $path;
        }else{
            return "false";
        }
    }

public  function product_color_image(Request $request){

    if ($request->file('file')!=null){
        $path=$request->file('file')->store('product');
        $pro_color_images=new ProductColorModel();
        $pro_color_images->image=$path;
        $pro_color_images->user_id=Auth::user()->id;
        $pro_color_images->pro_id=0;
        $pro_color_images->save();
        return $path;
    }else{
        return "false";
    }
}
    public function list_by_cat($id){

        $sub_cat =SubCategoryModel::where('cat_id',$id)->
        orderBy('id','DESC')->get();
        return $sub_cat;
    }

    public function delete_picture(Request $request){

        $pro_image=ProductImageModel::where('pro_id',0)->get();
        foreach ($pro_image as $item){
            Storage::delete($item->name);
        }
        ProductImageModel::where('pro_id',0)->delete();

    }
}
