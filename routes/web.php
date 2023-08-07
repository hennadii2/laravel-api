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

/************Landing Page
Route::get('/', function () {
	return view('index');
});
**********************/

/************LOAD Index**********************/
//Route::any('/admin', 'DashboardController@loadIndex');
Route::get('/', 'DashboardController@LoadHomePge');


Route::get('/admin', function () {     return view('admin.login');});
Route::get('/admin/login', function () {     return view('admin.login');});
Route::get('/admin/register', function () {     return view('admin.register');});
Route::get('/terms', function () {
	return view('terms');
});

Route::get('/privacy', function () {
	return view('privacy');
});
Route::get('/admin/load/{id}', 'DashboardController@loadAgain');
Route::get('/admin/index', 'DashboardController@loadIndex');

/*****************Register Login********************************/
Route::any('/members/{url}/{id}', 'DashboardController@loadMenuAgain');
Route::post('/admin/registerForm', 'RegisterController@registerUser');
Route::post('/admin/login', 'RegisterController@loginUser');
Route::get('/admin/logout', 'DashboardController@logout');
/*******************Account Setting*********/
Route::get('/admin/settings', 'DashboardController@account');
Route::post('/admin/updateProfile', 'AccountController@updateProfile');
Route::post('/admin/upadtePassword', 'AccountController@upadtePassword');

/*****************Product Setting********************************/
Route::get('/admin/menu', 'DashboardController@loadMenu');
Route::any('/admin/get-subcategory-list', 'DashboardController@subcategoryList');
Route::post('/admin/productSave', 'ProductController@productSave');

/*****************BRAND Setting********************************/
Route::get('/admin/brand', 'DashboardController@brand');
Route::get('/admin/brand/{id}', 'DashboardController@editbrand');
Route::post('/admin/addBrand', 'DashboardController@addBrand');
Route::get('/admin/brand_delete/{id}', 'DashboardController@brandDelete');
Route::post('/admin/brand/updateBrand', 'DashboardController@updateBrand');

/*****************PRODUCT TYPE Setting********************************/
Route::get('/admin/product_type', 'DashboardController@product_type');
Route::get('/admin/product_type/{id}', 'DashboardController@editType');
Route::post('/admin/addProductType', 'DashboardController@addProductType');
Route::get('/admin/type_delete/{id}', 'DashboardController@typeDelete');
Route::post('/admin/product_type/updateType', 'DashboardController@updateType');

/*****************FAQ Setting********************************/
Route::get('/admin/faq', 'DashboardController@faq');
Route::post('/admin/faqSave', 'DashboardController@faqSave');


Route::get('/admin/page-contain', 'DashboardController@pageContain');
Route::post('/admin/pageconatinsave', 'DashboardController@pageconatinsave');

Route::post('/admin/forgot', 'DashboardController@forgot');
Route::any('/admin/reset_pass/{id}', 'DashboardController@resetpass');
Route::any('/admin/resetpassword', 'DashboardController@resetpassword');
Route::get('/admin/forgot-password', function () {     return view('admin.forgot-password');});

Route::any('/admin/report', 'DashboardController@report');
Route::any('/admin/customers', 'DashboardController@customers');

Route::any('/admin/customer_details/{id}/{oid}', 'DashboardController@customerDetails');

Route::any('/admin/select-product1', 'SelectProductController@select_product');

Route::get('/admin/select-product',['as'=>'select-product','uses'=>'SelectProductController@loadMore']);
//Route::post('/admin/select-product/loaddata', 'SelectProductController@loadDataAjax');
Route::any('/admin/publish-product', 'SelectProductController@publish_product');
Route::any('/admin/saved-products', 'ProductController@save_product');
Route::any('/admin/products', 'ProductController@productsListing');
Route::any('/admin/update-product/{id}', 'ProductController@updateProduct');
Route::post('/admin/update_product', 'ProductController@productUpdateSave');
Route::get('/admin/delete_product/{id}/{type}', 'ProductController@productDelete');
/****************Order Manage********************************/
Route::any('/admin/orders', 'ProductController@orders');
Route::any('/admin/pending_order/{id}', 'ProductController@pending_order');
Route::any('/admin/cancel_order/{id}', 'ProductController@cancel_order');
Route::any('/admin/approve_order/{id}', 'ProductController@approve_order');
Route::any('/admin/order_details/{id}/', 'ProductController@orderDetails');
/****************Related product Add********************************/
Route::get('/admin/related-product',['as'=>'related-product','uses'=>'SelectProductController@relatedProduct']);
Route::any('/admin/publish-related-product', 'SelectProductController@publishRelatedProduct');

Route::any('/admin/addRelatedPro', 'SelectProductController@addRelatedPro');
Route::any('/admin/removeRelatedPro', 'SelectProductController@removeRelatedPro');
/**********************Manage Review****************************/
Route::any('/admin/reviews', 'ReviewController@reviews');
Route::any('/admin/ratingRequest', 'ReviewController@ratingRequest');
Route::any('/admin/review_details/{id}', 'ReviewController@review_details');
Route::any('/admin/rating_approve', 'ReviewController@rating_approve');
Route::any('/admin/review_mail_update', 'ReviewController@review_mail_update');

/**********************Customer Cancel Order from mail****************************/
Route::any('/cancel_order/{id}', 'DashboardController@cancel_order');


/*******************************Customer SECTION*******************/
Route::get('/customer/login', function () {     return view('customer.login');});
Route::any('/customer', 'CustomerController@loadIndex');
Route::any('/customer/index', 'CustomerController@loadIndex');
Route::any('/customer/edit-profile', 'CustomerController@edit_profile');
Route::any('/customer/upadtePassword', 'CustomerController@upadtePassword');
Route::post('/customer/updateProfile', 'CustomerController@updateProfile');
Route::any('/customer/logout', 'CustomerController@logout');
Route::post('/customer/login', 'CustomerController@loginUser');
Route::any('/customer/cancel_order/{id}', 'CustomerController@cancel_order');

/************LOAD Super Admin Index**********************/
//Route::any('/admin', 'DashboardController@loadIndex');
Route::get('/super_admin', function () {     return view('super_admin.login');});
Route::get('/super_admin/login', function () {     return view('super_admin.login');});
Route::post('/super_admin/admin_login', 'AdminDashboardController@loginUser');
Route::any('/super_admin/index', 'AdminDashboardController@loadIndex');
Route::any('/super_admin/edit-profile', 'AdminDashboardController@edit_profile');
Route::any('/super_admin/upadtePassword', 'AdminDashboardController@upadtePassword');
Route::any('/super_admin/updateProfile', 'AdminDashboardController@updateProfile');
/*****************BRAND Setting********************************/
Route::get('/super_admin/brand', 'AdminDashboardController@brand');
Route::get('/super_admin/brand/{id}', 'AdminDashboardController@editbrand');
Route::post('/super_admin/addBrand', 'AdminDashboardController@addBrand');
Route::get('/super_admin/brand_delete/{id}', 'AdminDashboardController@brandDelete');
Route::post('/super_admin/brand/updateBrand', 'AdminDashboardController@updateBrand');

/*****************PRODUCT TYPE Setting********************************/
Route::get('/super_admin/product_type', 'AdminDashboardController@product_type');
Route::get('/super_admin/product_type/{id}', 'AdminDashboardController@editType');
Route::post('/super_admin/addProductType', 'AdminDashboardController@addProductType');
Route::get('/super_admin/type_delete/{id}', 'AdminDashboardController@typeDelete');
Route::post('/super_admin/product_type/updateType', 'AdminDashboardController@updateType');
Route::get('/super_admin/logout', 'AdminDashboardController@logout');

/*****************Product Setting********************************/
Route::get('/super_admin/menu', 'AdminDashboardController@loadMenu');
Route::any('/super_admin/get-subcategory-list', 'AdminDashboardController@subcategoryList');
Route::post('/super_admin/productSave', 'AdminProductController@productSave');
Route::post('/super_admin/productCSVSave', 'AdminProductController@productCSVSave');

/***************** Related Product Setting********************************/
Route::get('/super_admin/related_products', 'AdminDashboardController@related_products');
Route::post('/super_admin/relatedProductSave', 'AdminProductController@relatedProductSave');

/*******************************FRONT SECTION*******************/
 Route::any('/{id}', 'ListProductController@indexView');
 Route::get('/{id}/product-details/{pro_id}/{title}', 'ListProductController@productDetails');
 Route::any('/{id}/checkout', 'ListProductController@checkout');


// Route::get('/{id}', 'ListProductController@indexView');
Route::get('/{id}/search', [
    'uses' => 'ListProductController@getPrice',
    'as' => 'search'
 ]);
  Route::any('/{id}/addItemCart', 'ListProductController@addItemCart'); //add cart to index
   Route::any('/{id}/addCard', 'ListProductController@addCard'); //add to cart related product
  Route::any('/{id}/product-details/{type}/addCardItem', 'ListProductController@addCardItem');
  Route::any('/{id}/updateCard', 'ListProductController@updateCard');
  Route::any('/{id}/cus_login', 'ListProductController@cus_login');
  Route::any('/{id}/order_confirm', 'ListProductController@order_confirm');
  Route::any('/{id}/order_review/{orderid}', 'ListProductController@order_review');
  Route::any('/{id}/removeProCard', 'ListProductController@removeProCard');
  Route::get('/{id}/review_product/{order_id}', 'ListProductController@order_rating');
  Route::any('/{id}/rating_give', 'ListProductController@rating_give');
  Route::any('/{id}/thank_you', 'ListProductController@thank_you');
  Route::any('/{id}/cus_forgot_password', 'ListProductController@forgot');
  Route::any('/{id}/reset_pass/{forgot}', 'ListProductController@resetpass');
  Route::any('/{id}/resetpassword', 'ListProductController@resetpassword');


  Route::get('/404', function () {
    return abort(404);
});