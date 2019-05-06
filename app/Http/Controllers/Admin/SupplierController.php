<?php

namespace App\Http\Controllers\Admin;

use App\ProductModel;
use App\SupplierModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public  function  index(){
        $supp=SupplierModel::orderBy('order')->get();
        $data=array(
            'supps'=>$supp,
        );
        return view('admin.supplier.index',$data);
    }
    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:supplier,name',
            'slug' => 'required|max:100|unique:supplier,slug',
            'image'=>'required|mimes:jpeg,png'
        ]);

        //If input is right
        if ($validator->passes()) {

            $path='';
            if ($request->file('image')!=null){
                $path=$request->file('image')->store('category');
            }

            $order=0;
            $count=SupplierModel::all()->count();
            if ($count!=0){
                $order=$last_cat=SupplierModel::orderBy('order','DESC')->first()->order;
            }

            //Add user to database
            $supp =new SupplierModel();
            $supp->name=$request->name;
            $supp->slug=$request->slug;
            $supp->image=$path;
            $supp->order=$order+1;
            $supp->save();


            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'supplier');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){
        $supp=SupplierModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'slug' => 'required|max:100',
            'image'=>'mimes:jpeg,png'
        ]);

        if ($supp->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100',
                'slug' => 'required|max:100',
                'image'=>'mimes:jpeg,png'
            ]);
        }

        if ($supp->slug!=$request->slug){
            $validator = Validator::make($request->all(), [
                'slug' => 'required|max:100',
                'name' => 'required|max:100',
                'image'=>'required|mimes:jpeg,png'
            ]);
        }

        //If input is right
        if ($validator->passes()) {
            $path=$supp->image;
            if ($request->file('image')!=null){
                Storage::delete($supp->image);
                $path=$request->file('image')->store('category');
            }

            SupplierModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
                'slug'=>$request->slug,
                'image'=>$path,
            ]);

            Session::flash('message', $supp->name.' have been updated !');
            Session::flash('title', 'Supplier');
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

        $supp= SupplierModel::find($id);

        Storage::delete($supp->image);

        SupplierModel::where('id',$id)->delete();
        Session::flash('message', $supp->name.' have been deleted !');
        Session::flash('title', 'supplier');
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
        SupplierModel ::where('order',$new_order)->update(['order'=>$order]);
        SupplierModel::where('id',$id)->update(['order'=>$new_order]);
        return redirect()->back();
    }

}
