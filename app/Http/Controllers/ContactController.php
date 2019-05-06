<?php

namespace App\Http\Controllers;

use App\CategoryModel;
use App\ContactModel;
use App\ProductModel;
use App\SlideShowModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function index()
    {

        $products = ProductModel::orderBy('id', 'DESC')->limit(30)->get();
        $categories=CategoryModel::orderBy('order')->limit(10)->get();
        $cat_footer=CategoryModel::orderBy('order')->limit(5)->get();

        $data = array(
            'products' => $products,
            'categories' => $categories,
            'cat_footer' => $cat_footer,

        );

        return view('contact.index', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'required|max:100',
            'message' => 'required|max:500',
        ]);


        //If input is right
        if ($validator->passes()) {

            $con=new ContactModel();
            $con->name=$request->name;
            $con->email=$request->email;
            $con->subject=$request->subject;
            $con->message=$request->message;
            $con->save();

            return response()->json(['verify'=>'true',
                ]);
        }

        return ['errors' => $validator->errors()];
    }
}