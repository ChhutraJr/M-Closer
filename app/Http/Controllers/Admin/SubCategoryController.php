<?php

namespace App\Http\Controllers\Admin;

use App\CategoryModel;
use App\ProductModel;
use App\SubCategoryModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    public  function index(){

        $sub_cats=SubCategoryModel::orderBy('order')->get();
        $cats=CategoryModel::orderBy('order')->get();
        $data=array(
            'sub_cats'=>$sub_cats,
            'cats'=>$cats,
        );
        return view('admin.category.sub_category.index',$data);
    }

    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required|max:100|unique:sub_category,name',
            'slug' => 'required|max:100|unique:sub_category,slug',
            'image'=>'required|mimes:jpeg,png'
        ]);
        //If input is right
        if ($validator->passes()) {

            $path='';
            if ($request->file('image')!=null){
                $path=$request->file('image')->store('sub_category');
            }

            $order=0;
            $count=SubCategoryModel::all()->count();
            if ($count!=0){
                $order=$last_cat=SubCategoryModel::orderBy('order','DESC')->first()->order;
            }
            //Add user to database
            $sub_cat =new SubCategoryModel();
            $sub_cat->cat_id=$request->category;
            $sub_cat->name=$request->name;
            $sub_cat->slug=$request->slug;
            $sub_cat->image=$path;
            $sub_cat->order=$order+1;
            $sub_cat->save();

            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'Sub_Category');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){

        $sub_cat=SubCategoryModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
            'image'=>'mimes:jpeg,png'
        ]);

        if ($sub_cat->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'slug' => 'required|max:100',
                'image'=>'mimes:jpeg,png'
            ]);
        }
        if ($sub_cat->slug!=$request->slug){
            $validator = Validator::make($request->all(), [
                'slug' => 'required|max:100',
                'name' => 'required|max:100',
                'image'=>'required|mimes:jpeg,png'
            ]);
        }
        //If input is right
        if ($validator->passes()) {
            $path=$sub_cat->image;
            if ($request->file('image')!=null){
                Storage::delete($sub_cat->image);
                $path=$request->file('image')->store('category');
            }

            SubCategoryModel::where('id',$request->update_id)->update([
                'cat_id'=>$request->category,
                'name'=>$request->name,
                'slug'=>$request->slug,
                'image'=>$path,
            ]);

            Session::flash('message', $sub_cat->name.' have been updated !');
            Session::flash('title', 'Sub Category');
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

        $pro=ProductModel::where('cat_id',$id)->get();
        foreach ($pro as $item){
            Storage::delete($item->image);
        }

        ProductModel::where('cat_id',$id)->delete();

        $sub_cat= SubCategoryModel::find($id);

        Storage::delete($sub_cat->image);

        SubCategoryModel::where('id',$id)->delete();
        Session::flash('message', $sub_cat->name.' have been deleted !');
        Session::flash('title', 'Sub Category');
        Session::flash('alert-type', 'error');
        return back();
    }
    public function order($id,$order,$mode){

        if ($mode=='down'){
            $new_order=$order+1;
        }else{
            $new_order=$order-1;
        }

        //$parent_id= CategoriesModel::find($id)->parent_id;
        SubCategoryModel::where('order',$new_order)->update(['order'=>$order]);
        SubCategoryModel::where('id',$id)->update(['order'=>$new_order]);
        return redirect()->back();
    }


}
