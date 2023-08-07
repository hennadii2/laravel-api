<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Mail\Mailer;
use Mail;
//use App\User;

class AdminDashboardController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

     public function loginUser(Request $request)
     {
          $email = $request->input('email');
          $password = $request->input('password');
          $status = $request->input('status');
          $user_data3 = DB::table('admin')->where('email', $email)->where('password', md5($password))->where('status', $status)->first();
          if(count($user_data3)>0){
          $cur_date=date("Y-m-d");
          Session::put('admin_id', $user_data3->id);
          Session::put('admin_fname', ucfirst($user_data3->fname));
          Session::put('admin_lname', ucfirst($user_data3->lname));
          if($user_data3->image!=''){
          Session::put('admin_logo', $user_data3->image);
          }
          Session::put('admin_active_status', '1');
          return  redirect()->to('super_admin/index');
          }else{
          Session::flash('error', 'Invalid email or password.');
          return  redirect()->to('super_admin/login');
          }

    }






  public function loadIndex()
  {
        if(session('admin_id')!=''){

        $user_id = session('admin_id');
         $seven_days='0';
         $max_pay='0';
         $max_user='0';
         $popular_product='';
         $myTopUser='';
         $popular_product = '';

        return view('super_admin.index',compact('seven_days','max_pay','max_user','popular_product','myTopUser'));
        }else{
        return  redirect()->to('super_admin/login');
        }
  }





  /***************************ACCOUNT  UPDATE******************/
 public function account()
  {
  if(session('admin_id')!=''){
  $user_id = session('admin_id');
  $state=DB::table('state')->get();

  $user_data=DB::table('users')->where('id','=', $user_id)->first();
  return view('admin/settings',compact('user_data','state'));
  }else{
  return  redirect()->to('admin/login');
  }
  }


/***********************BRAND SECTION************************/

  public function brand()
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $brand=DB::table('admin_brand')->where('user_id', $user_id)->get();
  $edit_id='';
  return view('super_admin/brand',compact('brand','edit_id'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

 /*****************Load edit brand*****************************/
  public function editbrand($id)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $edit_id=DB::table('admin_brand')->where('brand_id','=', $id)->where('user_id', $user_id)->first();
  $brand=DB::table('admin_brand')->where('user_id', $user_id)->get();
  return view('super_admin/brand',compact('brand','edit_id'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }
 /**********************Update Brand***************************/

 public function updateBrand(Request $request)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $brand_name=$request->input('brand_name');
  $edit_id=$request->input('edit_id');
  $user_data3 = DB::table('admin_brand')->where('user_id', $user_id)->where('name', $brand_name)->where('brand_id','!=', $edit_id)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('admin_brand')->where('brand_id', $edit_id)
  ->update(['name' => $brand_name]);
  Session::flash('brand_success', 'Brand has been updated successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('super_admin/brand');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Brand name already exists.');
  return  redirect()->to('super_admin/brand/'.$edit_id.'');
  }

  //return view('admin/brand',compact('brand'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }



  public function addBrand(Request $request)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $brand_name=$request->input('brand_name');
  $user_data3 = DB::table('admin_brand')->where('user_id', $user_id)->where('name', $brand_name)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('admin_brand')->insertGetId(
  ['user_id'=>$user_id,'name'=>$brand_name] );
  Session::flash('brand_success', 'Brand has been added successfully.');
  Session::flash('success_btn', 'success');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Brand name already exists.');
  }
  return  redirect()->to('super_admin/brand');
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

  public function brandDelete($id)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $user_data3 = DB::table('admin_brand')->where('user_id', $user_id)->where('brand_id', $id)->delete();
   Session::flash('brand_success', 'Brand has been deleted successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('super_admin/brand');
  }else{
  return  redirect()->to('super_admin/login');
  }
  }


  /***********************PRODUCT TYPE SECTION************************/

  public function product_type()
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $category_list=DB::table('admin_type')->where('parentid','=', 'NULL')->get();
  $main_cat=DB::table('admin_type')->where('parentid', 'NULL')->get();
  $edit_id='';
  return view('super_admin/product_type',compact('category_list','main_cat','edit_id'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

  /*****************Load edit brand*****************************/
  public function editType($id)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $edit_id=DB::table('admin_type')->where('type_id','=', $id)->first();
  $category_list=DB::table('admin_type')->where('parentid','=', 'NULL')->get();
  $main_cat=DB::table('admin_type')->where('parentid', 'NULL')->get();
  if(count($edit_id)>0){
  return view('super_admin/product_type',compact('category_list','main_cat','edit_id'));
  }else{
   return  redirect()->to('super_admin/product_type');
  }
  }else{
  return  redirect()->to('super_admin/login');
  }
  }
 /**********************Update Brand***************************/

 public function updateType(Request $request)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $brand_name=$request->input('brand_name');
  $category_name=$request->input('category_name');
  $edit_id=$request->input('edit_id');
  $user_data3 = DB::table('admin_type')->where('user_id', $user_id)->where('type_name', $brand_name)->where('type_id','!=', $edit_id)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('admin_type')->where('type_id', $edit_id)
  ->update(['type_name' => $brand_name,'parentid' => $category_name]);
  Session::flash('brand_success', 'Product type has been updated successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('super_admin/product_type');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Category name already exists.');
  return  redirect()->to('super_admin/product_type/'.$edit_id.'');
  }

  //return view('admin/brand',compact('brand'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }



  public function addProductType(Request $request)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $brand_name=$request->input('brand_name');
  $category_name=$request->input('category_name');
  $user_data3 = DB::table('admin_type')->where('user_id', $user_id)->where('type_name', $brand_name)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('admin_type')->insertGetId(['user_id'=>$user_id,'type_name'=>$brand_name,'parentid'=>$category_name] );
  Session::flash('brand_success', 'Product type has been added successfully.');
  Session::flash('success_btn', 'success');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Category name already exists.');
  }
  return  redirect()->to('super_admin/product_type');
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

  public function typeDelete($id)
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $user_data3 = DB::table('admin_type')->where('user_id', $user_id)->where('type_id', $id)->delete();
 // $user_data3 = DB::table('admin_type')->where('user_id', $user_id)->where('parentid', $id)->delete();
   Session::flash('brand_success', 'Product type has been deleted successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('super_admin/product_type');
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

    /*****************Load Menu**************/
  public function loadMenu()
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $type=DB::table('admin_type')->where('parentid', 'NULL')->get();
  $brand=DB::table('admin_brand')->where('user_id', $user_id)->get();
  return view('super_admin/menu',compact('type','brand'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

  public function subcategoryList(Request $request)
  {
   $states = DB::table("admin_type")->where("parentid",$request->category)->pluck("type_name","type_id");
  return response()->json($states);
  }
   /***************************ACCOUNT  UPDATE******************/
 public function edit_profile()
  {
  if(session('admin_id')!=''){
  $user_id = session('admin_id');

  $user_data=DB::table('admin')->where('id','=', $user_id)->first();
  return view('super_admin/edit-profile',compact('user_data'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

   public function upadtePassword(Request $request)
  {
  if(session('admin_id')!=''){
  $user_id = session('admin_id');
  $old_password = $request->input('old_password');
  $new_password = $request->input('new_password');
  $user_data3 = DB::table('admin')->where('password', md5($old_password))->where('id', '=' , $user_id)->get();
  if(count($user_data3)>0){
  $last_id=DB::table('admin')->where('id', $user_id)
  ->update(
  ['password' => md5($new_password)]
  );
  Session::flash('pass_success', 'Your password information has been updated.');
  return  redirect()->to('super_admin/edit-profile');
  }else{
  Session::flash('pass_error', 'Current password does not match.');
  return  redirect()->to('super_admin/edit-profile');
  }
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

  /***********************Update Profile**************************/
  public function updateProfile(Request $request)
  {

  if(session('admin_id')!=''){
      $user_id = session('admin_id');
      $fname = ($request->input('fname')!='')?$request->input('fname'):'';
      $lname = ($request->input('lname')!='')?$request->input('lname'):'';
      $email = ($request->input('email')!='')?$request->input('email'):'';
      $phone = ($request->input('phone')!='')?$request->input('phone'):'';
      Session::put('admin_fname', ucfirst($fname));
      Session::put('admin_lname', ucfirst($lname));
      $user_data3 = DB::table('admin')->where('email', $email)->where('id', '!=' , $user_id)->get();
      if(count($user_data3)==0){
      $last_id=DB::table('admin')->where('id', $user_id)
      ->update(['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$phone] );

      if(Input::hasFile('image'))
      {
      $file=Input::file('image');
      $random_name=time();
      $destinationPath='super_admin_img/';
      $extension=$file->getClientOriginalExtension();
      $filename=$random_name.'.'.$extension;
      $byte=File::size($file); //get size of file
      $uploadSuccess=Input::file('image')->move($destinationPath,$filename);


      $user_data = DB::table('admin')->where('id', $user_id)->first();
      if($user_data->image!=''){
      File::delete(public_path().'/super_admin_img/'.$user_data->image); // Delete old
      }

      $last_id=DB::table('admin')->where('id', $user_id)
      ->update(['image' => $filename]);
      Session::put('admin_logo', $filename);
      }

      Session::flash('acc_success', 'Your account information has been updated.');
      return  redirect()->to('super_admin/edit-profile');
      }else{
      Session::flash('acc_error', 'Email already exists.');
      return  redirect()->to('super_admin/edit-profile');

      }

      }else{
      return  redirect()->to('super_admin/login');
      }
  }

    /*****************Load Menu**************/
  public function related_products()
  {
  if(session('admin_id')!=''){
  $user_id=session('admin_id');
  $type=DB::table('admin_type')->where('user_id', $user_id)->get();
  $brand=DB::table('admin_brand')->where('user_id', $user_id)->get();
  return view('super_admin/related_products',compact('type','brand'));
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

  /**********************Logout********************************/
      public function logout()
      {
      Session::put('admin_id', '');
      Session::put('admin_fname', '');
      Session::put('admin_lname', '');
      Session::put('admin_logo', '');
      Session::put('admin_active_status', '');
      return  redirect()->to('super_admin/login');
      }
}


?>