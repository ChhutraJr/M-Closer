<?php

namespace App\Http\Controllers\Admin;

use App\ColorModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public  function index(){
        $color = ColorModel::all();
        $data=array(
            'colors'=>$color,
        );
        return view('admin.product.color.index',$data);
    }

    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:color,name',
        ]);
        //If input is right
        if ($validator->passes()) {

            //Add user to database
            $color=new ColorModel();
            $color->name=$request->name;
            $color->save();

            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'color');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){
        $color =ColorModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($color ->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:color,name',
            ]);
        }
        //If input is right
        if ($validator->passes()) {

            ColorModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
            ]);

            Session::flash('message', $color->name.' have been updated !');
            Session::flash('title', 'color');
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
        $color= ColorModel::find($id);
        ColorModel::where('id',$id)->delete();
        Session::flash('message', $color->name.' have been deleted !');
        Session::flash('title', 'color');
        Session::flash('alert-type', 'error');
        return back();
    }
}
