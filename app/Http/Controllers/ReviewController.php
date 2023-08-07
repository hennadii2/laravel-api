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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Response;
//use App\User;

class ReviewController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */


 /**********************Review Section**************************/
 public function reviews(Request $request)
  {
    if(session('member_id')!=''){
    $user_id=session('member_id');
    $mail_status='0';
    $pending_review = DB::table('orders')
    ->where('admin_id','=', $user_id)->where('rating_status','=', $mail_status)->get();
    $review_pendind=count($pending_review);

    $query = DB::table('orders')
    ->where('admin_id','=', $user_id);
    if(!empty($request->status)){
    $query->Where('review_status', '=', $request->status); 
    }
     if(!empty($request->start_date) && !empty($request->end_date)){
    list($m,$d,$y) = preg_split('/\//', $request->input('start_date'));
    $start=$y.'-'.$m.'-'.$d;
    list($m,$d,$y) = preg_split('/\//', $request->input('end_date'));
    $end=$y.'-'.$m.'-'.$d;
    $query->whereBetween('order_date', array($start, $end));
    }
    $query->orderBy('orderid', 'desc');
    $review_list=$query->get();

    $mail_contain=DB::table('admin')->where('id','=', '1')->first();
    return view('admin.reviews',compact('review_pendind','review_list','mail_contain'));

    }else{
    return  redirect()->to('admin/login');
    }
  }

  public function review_details($order_id){

   if(session('member_id')!=''){
         $user_id=session('member_id');
         $orderid=base64_decode($order_id);
        $order_info = DB::table('orders')->where('orderid',  $orderid)->where('admin_id','=', $user_id)->first();
        if(count($order_info)>0){
        $order_product = DB::table('order_item')->where('order_id','=', $orderid)->get();
        if(count($order_product)>0){
        return view('admin/review_details',compact('order_product','orderid'));
        }else{
        return view('errors.404');
        }
        }else{
        return view('errors.404');
        }
        }
        else{
        return view('errors.404');
        }
}

public function rating_approve(Request $request){
        if(session('member_id')!=''){
        $order_id = ($request->input('order_id')!='')?$request->input('order_id'):'';
        $rating_status='2';
        $cur_date=date("Y-m-d");
        if(count($request->input('item_id'))>0){
        foreach ($request->input('item_id') as $key => $value) {
        $rating='p_'.$value;
        $comment='comment_'.$value;
        $rating_user=($request->input($rating)!='')?$request->input($rating):'';
        $comment_user=($request->input($comment)!='')?$request->input($comment):'';
        $sql=DB::table('order_item')->where('itemid', $value)->update(['rating_star' => $rating_user,'rating_comment' => addslashes($comment_user)]);
        }

        $sql2=DB::table('orders')->where('orderid', $order_id)->update(['review_status' => '2']);
        $sql2=DB::table('order_item')->where('order_id', $order_id)->update(['review_status' => '2']);
        }
         Session::flash('success', 'Rating has been approve successfully.');
        return  redirect()->to('admin/reviews');

        }
        else{
        return view('errors.404');
        }
}

 public function review_mail_update(Request $request){
      if(session('member_id')!=''){
      $re_message = ($request->input('re_message')!='')?$request->input('re_message'):'';
      $sql=DB::table('admin')->where('id', '1')->update(['re_message' => addslashes($re_message)]);
      return  redirect()->to('admin/reviews');

      }
      else{
      return view('errors.404');
      }
}
/*******************Send Rating Request********************/
  public function ratingRequest(Request $request)
    {
      if(session('member_id')!=''){
      $user_id=session('member_id');
      $mail_status='0';
      $sel_pro=$request->check;
      if(count($request->check)>0) {
      for($k=0;$k<count($sel_pro);$k++){
      $value = DB::table('orders')->where('orderid', $sel_pro[$k])->first();
      $user_inf=DB::table('users')->where('id', $value->admin_id)->first();
      $cus_inf=DB::table('customer')->where('cus_id', $value->user_id)->first();
      $username= $user_inf->username;
      $email=$cus_inf->email;
      $orderid=base64_encode($value->orderid);
      $mail_contain=DB::table('admin')->where('id','=', '1')->first();
      Mail::send('admin.review_mail', ['user_name' => $username, 'cus_info'=> $cus_inf,'order_id'=>$orderid,'mail_contain'=>$mail_contain], function ($message) use ($email)
      {
      $message->from('noreply@topshelfmenu.us', 'Review Product');
      $message->to($email)
      ->subject('Review Product');
      });
      $sql=DB::table('orders')->where('orderid', $value->orderid)->update(array('rating_status' => '1'));
      }
      Session::flash('success', 'Mail has been send successfully.');
      return  redirect()->to('admin/reviews');

      }else{
      Session::flash('success', 'Please select atlest one record for action.');
      return  redirect()->to('admin/reviews');
      }

      }else{
      return  redirect()->to('admin/login');
      }
  }





}


?>