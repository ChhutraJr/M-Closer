<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Frontend
Route::get('/','IndexController@index');

//Login
Route::get('/system','Admin\LoginController@index')->name('login.system');
Route::post('/system/login','Admin\LoginController@auth')->name('login.login');

//Category
Route::get('/category/{slug}','CategoryController@index');

//Product
Route::get('/product/{name}','ProductController@index');
//Contact
Route::get('/contact','ContactController@index');
Route::post('/contact/create','ContactController@store')->name('contacts.create');

//About Us
Route::get('/about_us','AboutUsController@index');

//Backend
Route::group(['prefix'=>'system','middleware' => 'check.admin'],function (){

    //Logout
    Route::get('/logout','Admin\LoginController@logout');
//User
    Route::get('/users', 'Admin\UserController@index');
    Route::post('/users/create', 'Admin\UserController@store')->name('users.create');
    Route::post('/users/update', 'Admin\UserController@update')->name('users.update');
    Route::post('/users/delete', 'Admin\UserController@delete');


//Category
    Route::get('/categories', 'Admin\CategoryController@index');
    Route::post('/categories/create', 'Admin\CategoryController@store')->name('categories.create');
    Route::post('/categories/update', 'Admin\CategoryController@update')->name('categories.update');
    Route::post('/categories/delete', 'Admin\CategoryController@delete');
    Route::get('/categories/order/{id}/{order}/{mode}','Admin\CategoryController@order');



//Sub_Categorys
    Route::get('/sub_categories','Admin\SubCategoryController@index');
    Route::post('/sub_categories/create', 'Admin\SubCategoryController@store')->name('sub_categories.create');
    Route::post('/sub_categories/update', 'Admin\SubCategoryController@update')->name('sub_categories.update');
    Route::post('/sub_categories/delete', 'Admin\SubCategoryController@delete');
    Route::get('/sub_categories/order/{id}/{order}/{mode}','Admin\SubCategoryController@order');

//Supplier
    Route::get('/suppliers', 'Admin\SupplierController@index');
    Route::post('/suppliers/create', 'Admin\SupplierController@store')->name('suppliers.create');
    Route::post('/suppliers/update', 'Admin\SupplierController@update')->name('suppliers.update');
    Route::post('/suppliers/delete', 'Admin\SupplierController@delete');
    Route::get('/suppliers/order/{id}/{order}/{mode}','Admin\SupplierController@order');

//Brand
    Route::get('/brands', 'Admin\BrandController@index');
    Route::post('/brands/create', 'Admin\BrandController@store')->name('brands.create');
    Route::post('/brands/update', 'Admin\BrandController@update')->name('brands.update');
    Route::post('/brands/delete', 'Admin\BrandController@delete');
    Route::get('/brands/order/{id}/{order}/{mode}','Admin\BrandController@order');

    //Product_availability
    Route::get('/product_availability', 'Admin\ProductAvailabilityController@index');
    Route::post('/product_availability/create', 'Admin\ProductAvailabilityController@store')->name('product_availability.create');
    Route::post('/product_availability/update', 'Admin\ProductAvailabilityController@update')->name('product_availability.update');
    Route::post('/product_availability/delete', 'Admin\ProductAvailabilityController@delete');

//Colors
    Route::get('/colors', 'Admin\ColorController@index');
    Route::post('/colors/create', 'Admin\ColorController@store')->name('color.create');
    Route::post('/colors/update', 'Admin\ColorController@update')->name('color.update');
    Route::post('colors/delete', 'Admin\ColorController@delete');

//Szie
    Route::get('/sizes', 'Admin\SizeController@index');
    Route::post('/sizes/create', 'Admin\SizeController@store')->name('size.create');
    Route::post('/sizes/update', 'Admin\SizeController@update')->name('size.update');
    Route::post('sizes/delete', 'Admin\SizeController@delete');

    //Shipping
    Route::get('/shipping', 'Admin\ShippingController@index');
    Route::post('/shipping/create', 'Admin\ShippingController@store')->name('shipping.create');
    Route::post('/shipping/update', 'Admin\ShippingController@update')->name('shipping.update');
    Route::post('/shipping/delete', 'Admin\ShippingController@delete');
    Route::get('/shipping/order/{id}/{order}/{mode}','Admin\ShippingController@order');


    //CheckOut
    Route::get('/checkout', 'Admin\CheckOutController@index');
  //  Route::post('/shipping/create', 'Admin\CheckOutController@store')->name('shipping.create');
  //  Route::post('/shipping/update', 'Admin\CheckOutController@update')->name('shipping.update');
    Route::post('/checkout/delete', 'Admin\CheckOutController@delete');
//CheckOutdetail
    Route::get('/checkout_detail/{id}','Admin\CheckOutController@indexCheckOutDetail');

//Slide show
    Route::get('/slide_show', 'Admin\SlideShowController@index');
    Route::post('/slide_show/create', 'Admin\SlideShowController@store')->name('slide_show.create');
    Route::post('/slide_show/update', 'Admin\SlideShowController@update')->name('slide_show.update');
    Route::post('/slide_show/delete', 'Admin\SlideShowController@delete');
    Route::get('/slide_show/order/{id}/{order}/{mode}','Admin\SlideShowController@order');


//Product
    Route::get('/products', 'Admin\ProductController@index');
    Route::post('/products/create', 'Admin\ProductController@store')->name('products.create');
    Route::get('/products/update/{id}','Admin\ProductController@show_update');
    Route::post('/products/update', 'Admin\ProductController@update')->name('products.update');
    Route::post('/products/delete', 'Admin\ProductController@delete');

    Route::post('/products/picture/color','Admin\ProductController@product_color_image');

    Route::post('/products/picture','Admin\ProductController@product_picture')->name('products.picture');
    Route::post('/products/picture/delete','Admin\ProductController@delete_picture')->name('products.picture.delete');

    Route::get('/products/list_cat/{id}','Admin\ProductController@list_by_cat');

});
