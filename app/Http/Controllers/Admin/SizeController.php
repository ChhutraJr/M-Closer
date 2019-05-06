<?php

namespace App\Http\Controllers\Admin;

use App\SizeModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public  function index(){
        $size = SizeModel::all();
        $data=array(
            'sizes'=>$size,
        );
        return view('admin.product.size.index',$data);
    }

    public function store(Request $request){
        //Check if input is right or wrong
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100|unique:size,name',
        ]);
        //If input is right
        if ($validator->passes()) {

            //Add user to database
            $size=new SizeModel();
            $size->name=$request->name;
            $size->save();

            Session::flash('message', $request->name.' have been added !');
            Session::flash('title', 'size');
            Session::flash('alert-type', 'success');

            return response()->json(['verify'=>'true',
            ]);
        }

        //Send errors if input is wrong
        return ['errors' => $validator->errors()];
    }

    public function update(Request $request){
        $size =SizeModel::where('id',$request->update_id)->first();

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
        ]);

        if ($size ->name!=$request->name){
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:100|unique:size,name',
            ]);
        }
        //If input is right
        if ($validator->passes()) {

            SizeModel::where('id',$request->update_id)->update([
                'name'=>$request->name,
            ]);

            Session::flash('message', $size->name.' have been updated !');
            Session::flash('title', 'size');
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
        $size= SizeModel::find($id);
        SizeModel::where('id',$id)->delete();
        Session::flash('message', $size->name.' have been deleted !');
        Session::flash('title', 'Size');
        Session::flash('alert-type', 'error');
        return back();
    }
}
