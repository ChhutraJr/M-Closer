<?php

namespace App\Http\Controllers\Admin;

use App\BrandModel;
use App\ProductModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(){

        $brand=BrandModel::orderBy('order')->get();
        $data=array(
            'brands'=>$brand,
        );
        return view('admin.product.brand.index',$data);

    }
    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:brand,name',
            'slug' => 'required|max:100|unique:brand,slug',
            'image'=>'required|mimes:jpeg,png'
        ]);

        //If input is right
        if ($validator->passes()) {

            $path='';
            if ($request->file('image')!=null){
                $path=$request->file('image')->store('category');
            }

            $order=0;
            $count=BrandModel::all()->count();
            if ($count!=0){
                $order=$last_brand=BrandModel::orderBy('order','DESC')->first()->order;
            }

            //Add user to database
            $brand =new BrandModel();
            $brand->name=$request->name;
            $brand->slug=$request->slug;
            $brand->image=$path;
            $brand->order=$order+1;
            $brand->save();

            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'Brand');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }
        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){
        $brand=BrandModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'max:100',
            'slug' => 'max:100',
            'image'=>'mimes:jpeg,png'
        ]);

        if ($brand->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:brand,name',
                'slug' => 'required|max:100',
                'image'=>'mimes:jpeg,png'
            ]);
        }

        if ($brand->slug!=$request->slug){
            $validator = Validator::make($request->all(), [
                'slug' => 'required|max:100|unique:brand,slug',
                'name' => 'required|max:100',
                'image'=>'required|mimes:jpeg,png'
            ]);
        }

        //If input is right
        if ($validator->passes()) {
            $path=$brand->image;
            if ($request->file('image')!=null){
                Storage::delete($brand->image);
                $path=$request->file('image')->store('brand');
            }

            BrandModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'image'=>$path,
            ]);

            Session::flash('message', $brand->name.' have been updated !');
            Session::flash('title', 'Brand');
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

        $brand= BrandModel::find($id);

        Storage::delete($brand->image);

        BrandModel::where('id',$id)->delete();
        Session::flash('message', $brand->name.' have been deleted !');
        Session::flash('title', 'Brand');
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
        BrandModel::where('order',$new_order)->update(['order'=>$order]);
        BrandModel::where('id',$id)->update(['order'=>$new_order]);
        return redirect()->back();
    }
}
