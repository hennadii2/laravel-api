<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Illuminate\Mail\Mailer;
use Mail;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
//use App\User;

class CustomerController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */




  public function loadIndex()
  {

      if(session('customer_id')!=''){
      $customer_id = session('customer_id');
      $order_info = DB::table('orders')->where('user_id',  $customer_id)->get();
      return view('customer.index',compact('order_info'));
      }else{
      return  redirect()->to('customer/login');
      }
  }

    /***************************Cancel Orders*********************************/
 public function cancel_order($order_id)
    {
      $user_id = session('customer_id');
      $user_inf=DB::table('orders')->where('orderid', $order_id)->where('user_id', $user_id)->first();
      if(session('customer_id')!='' && count($user_inf)>0){
      $sql=DB::table('orders')->where('orderid', $order_id)->update(array('status' => '1'));
    Session::flash('success', 'Order has been cancel successfully.');
      return  redirect()->to('/customer/index');

      } else{
      return  redirect()->to('customer/login');
      }
      }

  /***************************ACCOUNT  UPDATE******************/
 public function edit_profile()
  {
  if(session('customer_id')!=''){
  $user_id = session('customer_id');
  $state=DB::table('state')->get();
  $user_data=DB::table('customer')->where('cus_id','=', $user_id)->first();
  return view('customer/edit-profile',compact('user_data','state'));
  }else{
  return  redirect()->to('customer/login');
  }
  }

   public function upadtePassword(Request $request)
  {
  if(session('customer_id')!=''){
  $user_id = session('customer_id');
  $old_password = $request->input('old_password');
  $new_password = $request->input('new_password');
  $user_data3 = DB::table('customer')->where('password', md5($old_password))->where('cus_id', '=' , $user_id)->get();
  if(count($user_data3)>0){
  $last_id=DB::table('customer')->where('cus_id', $user_id)
  ->update(
  ['password' => md5($new_password)]
  );
  Session::flash('pass_success', 'Your password information has been updated.');
  return  redirect()->to('customer/edit-profile');
  }else{
  Session::flash('pass_error', 'Current password does not match.');
  return  redirect()->to('customer/edit-profile');
  }
  }else{
  return  redirect()->to('customer/login');
  }
  }

  /***********************Update Profile**************************/
  public function updateProfile(Request $request)
  {
  if(session('customer_id')!=''){

  $user_id = session('customer_id');
  $fname = ($request->input('fname')!='')?$request->input('fname'):'';
  $lname = ($request->input('lname')!='')?$request->input('lname'):'';
  $email = ($request->input('email')!='')?$request->input('email'):'';
  $address = ($request->input('address')!='')?$request->input('address'):'';
  $phone = ($request->input('phone')!='')?$request->input('phone'):'';
  $apartment = ($request->input('apartment')!='')?$request->input('apartment'):'';
  $state = ($request->input('state')!='')?$request->input('state'):'';
  $city = ($request->input('city')!='')?$request->input('city'):'';
  $zip_code = ($request->input('zip_code')!='')?$request->input('zip_code'):'';

  $user_data3 = DB::table('customer')->where('email', $email)->where('cus_id', '!=' , $user_id)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('customer')->where('cus_id', $user_id)
  ->update(
  ['fname'=>$fname,'lname'=>$lname,'email'=>$email,'phone'=>$phone,'apartment'=>$apartment,'address'=>$address,'city'=>$city,'state'=>$state,'zip_code'=>$zip_code]
  );

  if(Input::hasFile('image'))
  {

  $file=Input::file('image');
  $random_name=time();
  $destinationPath='member_img/';
  $extension=$file->getClientOriginalExtension();
  $filename=$random_name.'.'.$extension;
  $byte=File::size($file); //get size of file
  $uploadSuccess=Input::file('image')->move($destinationPath,$filename);


  $user_data = DB::table('customer')->where('cus_id', $user_id)->first();
  if($user_data->image!=''){
  File::delete(public_path().'/member_img/'.$user_data->image); // Delete old
  }
  /* $file = Input::file('image');
  $name = time() . '-' . $file->getClientOriginalName();
  $file = $file->move(public_path() . '/profile/', $name);*/
  $last_id=DB::table('customer')->where('cus_id', $user_id)
  ->update(['image' => $filename]);
   Session::put('customer_logo', $filename);
  }

  Session::flash('acc_success', 'Your account information has been updated.');
  return  redirect()->to('customer/edit-profile');
 }else{
  Session::flash('acc_error', 'Email already exists.');
  return  redirect()->to('customer/edit-profile');

  }

  }else{
  return  redirect()->to('customer/login');
  }
  }


public function loginUser(Request $request)
    {
      $email = $request->input('email');
      $password = $request->input('password');
      $status = 1;
      $user_data3 = DB::table('customer')->where('email', $email)->where('password', md5($password))->first();
      if(count($user_data3)>0){
      Session::put('customer_id', $user_data3->cus_id);
      Session::put('customer_fname', ucfirst($user_data3->fname));
      Session::put('customer_lname', ucfirst($user_data3->lname));
      if($user_data3->image!=''){
      Session::put('customer_logo', $user_data3->image);
      }
      return  redirect()->to('customer/index');
      }else{
      Session::flash('error', 'Invalid email or password.');
      return  redirect()->to('customer/login');
      }

      }
  /**********************Logout********************************/
      public function logout()
      {
      Session::put('customer_id', '');
      Session::put('customer_fname', '');
      Session::put('customer_lname', '');
      Session::put('customer_logo', '');
      Session::put('customer_active_status', '');
      return  redirect()->to('customer/login');
      }
}


?>