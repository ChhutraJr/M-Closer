<?php

namespace App\Http\Controllers\Admin;

use App\ShippingModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ShippingController extends Controller
{
    public function index(){

        $shipp=ShippingModel  ::orderBy('order')->get();
        $data=array(
            'shipps'=>$shipp,
        );
        return view('admin.shipping.index',$data);

    }
    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:shipping,name',
            'price' => 'required|numeric|min:1|max:100000000',

        ]);

        //If input is right
        if ($validator->passes()) {

            $order=0;
            $count=ShippingModel::all()->count();
            if ($count!=0){
                $order=$last_brand=ShippingModel::orderBy('order','DESC')->first()->order;
            }
            //Add user to database
            $shipp =new ShippingModel();
            $shipp->name=$request->name;
            $shipp->price=$request->price;
            $shipp->order=$order+1;
            $shipp->save();

            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'Shipping');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }
        //Send errors if input is wrong
        return ['errors' => $validator->errors()];

    }

    public function update(Request $request){
        $shipp=ShippingModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'price' => 'required|numeric|min:1|max:100000000',
        ]);

        if ($shipp->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:shipping,name',
                'price' => 'required|numeric|min:1|max:100000000',
            ]);
        }

        if ($shipp->price!=$request->price){
            $validator = Validator::make($request->all(), [
                'price' => 'required|numeric|min:1|max:100000000',
                'name' => 'required|max:100',
            ]);
        }

        //If input is right
        if ($validator->passes()) {

            ShippingModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
                'price'=>$request->price,

            ]);

            Session::flash('message', $shipp->name.' have been updated !');
            Session::flash('title', 'Shipping');
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
        $shipp= ShippingModel::find($id);
        ShippingModel::where('id',$id)->delete();
        Session::flash('message', $shipp->name.' have been deleted !');
        Session::flash('title', 'Shipping');
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
       ShippingModel ::where('order',$new_order)->update(['order'=>$order]);
       ShippingModel ::where('id',$id)->update(['order'=>$new_order]);
        return redirect()->back();
    }
}
