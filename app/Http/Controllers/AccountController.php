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
//use App\User;

class AccountController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */

  /***********************Update Profile**************************/
  public function updateProfile(Request $request)
  {
  if(session('member_id')!=''){

  $user_id = session('member_id');
  $company = ($request->input('company')!='')?$request->input('company'):'';
  $address = ($request->input('address')!='')?$request->input('address'):'';
  $address2 = ($request->input('address2')!='')?$request->input('address2'):'';
  $website = ($request->input('website')!='')?$request->input('website'):'';
  $state = ($request->input('state')!='')?$request->input('state'):'';
  $city = $request->input('city');
  $zip_code = $request->input('zip_code');


/*
  $user_data3 = DB::table('users')->where('email', $email)->where('id', '!=' , $user_id)->get();
  if(count($user_data3)==0){*/
  $last_id=DB::table('users')->where('id', $user_id)
  ->update(
  ['website'=>$website,'company'=>$company,'address2'=>$address2,'address'=>$address,'city'=>$city,'state'=>$state,'zip_code'=>$zip_code]
  );

  if(Input::hasFile('image'))
  {

  $file=Input::file('image');
  $random_name=time();
  $destinationPath='profile/';
  $extension=$file->getClientOriginalExtension();
  $filename=$random_name.'.'.$extension;
  $byte=File::size($file); //get size of file
  $uploadSuccess=Input::file('image')->move($destinationPath,$filename);


  $user_data = DB::table('users')->where('id', $user_id)->first();
  if($user_data->image!=''){
  File::delete(public_path().'/profile/'.$user_data->image); // Delete old
  }
  /* $file = Input::file('image');
  $name = time() . '-' . $file->getClientOriginalName();
  $file = $file->move(public_path() . '/profile/', $name);*/
  $last_id=DB::table('users')->where('id', $user_id)
  ->update(['image' => $filename]);
   Session::put('member_logo', $filename);
  }

  Session::flash('success', 'Your account information has been updated.');
  return  redirect()->to('admin/settings');
  /*}else{
  Session::flash('error', 'Email already exists.');
  return  redirect()->to('dashboard/account/account');

  }*/

  }else{
  return  redirect()->to('admin/login');
  }
  }


  public function upadtePassword(Request $request)
  {
  if(session('member_id')!=''){
  $user_id = session('member_id');
  $old_password = $request->input('old_password');
  $new_password = $request->input('new_password');
  $user_data3 = DB::table('users')->where('password', md5($old_password))->where('id', '=' , $user_id)->get();
  if(count($user_data3)>0){
  $last_id=DB::table('users')->where('id', $user_id)
  ->update(
  ['password' => md5($new_password)]
  );
  Session::flash('success', 'Your password information has been updated.');
  return  redirect()->to('admin/settings');
  }else{
  Session::flash('error', 'Current password does not match.');
  return  redirect()->to('admin/settings');
  }
  }else{
  return  redirect()->to('admin/login');
  }
  }




}


?>