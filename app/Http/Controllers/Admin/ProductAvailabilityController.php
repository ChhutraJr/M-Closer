<?php

namespace App\Http\Controllers\Admin;
use App\ProductAvailabilityModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ProductAvailabilityController extends Controller
{
    public  function index(){
        $product_avty = ProductAvailabilityModel::all();
        $data=array(
            'product_avty'=>$product_avty,
        );
        return view('admin.product.product_availability.index',$data);
    }

    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:pro_availability,name',
        ]);
        //If input is right
        if ($validator->passes()) {

            //Add user to database
            $product_avty =new ProductAvailabilityModel();
            $product_avty->name=$request->name;
            $product_avty->save();

            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'ProductAvailability');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){
        $product_avty =ProductAvailabilityModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($product_avty ->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:pro_availability,name',
            ]);
        }
        //If input is right
        if ($validator->passes()) {

            ProductAvailabilityModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
            ]);

            Session::flash('message', $product_avty->name.' have been updated !');
            Session::flash('title', 'ProductAvailability');
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
        $product_avty= ProductAvailabilityModel::find($id);
        ProductAvailabilityModel::where('id',$id)->delete();
        Session::flash('message', $product_avty->name.' have been deleted !');
        Session::flash('title', 'ProductAvailability');
        Session::flash('alert-type', 'error');
        return back();
    }
}
