<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
//use App\User;

class RegisterController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */


    public function registerUser(Request $request)
    {
    $website = $request->input('website');
    $email = $request->input('email');
    $fname = $request->input('fname');
    $lname = $request->input('lname');
    $username = $request->input('username');
    $company = $request->input('company');
    $password = $request->input('password');
    $phone = $request->input('phone');
    $status = $request->input('status');

      $UrlNames = str_replace("/","/",str_replace(",",",",str_replace("","_",str_replace("-","_",str_replace("&","",str_replace("*","",str_replace("+","",str_replace("=","",str_replace("%","",str_replace("@","",str_replace("$","",str_replace("#","",str_replace("{","",str_replace("}","",str_replace("(","",str_replace(")","",str_replace(">","",str_replace("<","",str_replace(";","",str_replace("'","",str_replace('"',"",str_replace('`',"",str_replace('!',"",str_replace(':',"",str_replace('~',"",trim($username))))))))))))))))))))))))));
      $UrlNames = str_replace("?","",$UrlNames);
      $UrlNames = str_replace("^","",$UrlNames);
      $UrlNames = str_replace("%","",$UrlNames);
      $UrlNames = str_replace(" ","",$UrlNames);

    $user_data3 = DB::table('users')->where('email', $email)->get();
    if(count($user_data3)==0){
      $user_name = DB::table('users')->where('username', $UrlNames)->get();
    if(count($user_name)==0){
    $cur_date=date("Y-m-d");
    $exp_date=date('Y-m-d', strtotime('+7 days'));
    $last_id=DB::table('users')->insertGetId(
    ['subscription_id'=>'','stripe_customer_id'=>'','selected_product'=>'','related_product'=>'','forgot'=>'','username'=>$UrlNames,'address2'=>'','email' => $email,'fname' => $fname,'lname'=>$lname,'website'=>$website,'company'=>$company,'password'=>md5($password),'add_date'=>$cur_date,'exp_date'=>$exp_date,'status'=>$status,'phone'=>$phone,'address'=>'','city'=>'','state'=>'','zip_code'=>'','image'=>'']
    );
    $user_data3 = DB::table('users')->where('id', $last_id)->first();
    Session::put('member_id', $user_data3->id);
    //Session::put('member_fname', ucfirst($user_data3->fname));
    //Session::put('member_lname', ucfirst($user_data3->lname));
    Session::put('member_company', $user_data3->company);
    Session::put('member_name', $user_data3->username);
    Session::put('member_active', '1');

    return  redirect()->to('admin/index');
     }
    else{
    Session::flash('error', 'Username already exists.');
    return  redirect()->to('admin/register');
    }
    }else{
    Session::flash('error', 'Email already exists.');
    return  redirect()->to('admin/register');
    }


    }

    public function loginUser(Request $request)
    {
      $email = $request->input('email');
      $password = $request->input('password');
      $status = $request->input('status');
      $user_data3 = DB::table('users')->where('email', $email)->where('password', md5($password))->where('status', $status)->first();
      if(count($user_data3)>0){
      $cur_date=date("Y-m-d");
      $user_data4 = DB::table('users')->where('id', $user_data3->id)->where('exp_date','>', $cur_date)->first();
      if(count($user_data4)>0){
      Session::put('member_id', $user_data3->id);
     // Session::put('member_fname', ucfirst($user_data3->fname));
     // Session::put('member_lname', ucfirst($user_data3->lname));
       Session::put('member_company', $user_data3->company);
      Session::put('member_name', $user_data3->username);
       if($user_data3->image!=''){
        Session::put('member_logo', $user_data3->image);
        }

      Session::put('member_active_status', '1');
      return  redirect()->to('admin/index');
      }else{
      //return  redirect()->to('admin/index');
      echo '<script>window.location.href = "http://topshelfmenu.us/admin/settings/index.php?memberShip='.base64_encode($user_data3->id).'";</script>';
      }


      }else{
      Session::flash('error', 'Invalid email or password.');
      return  redirect()->to('admin/login');
      }

      }
}


?>