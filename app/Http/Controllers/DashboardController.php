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

class DashboardController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
     public function LoadHomePge() {
        return view('index');
	 }

     public function loadAgain($id) {
        $user_data3 = DB::table('users')->where('id', $id)->first();
        if(count($user_data3)>0){
          Session::put('member_id', $user_data3->id);
          Session::put('member_fname', ucfirst($user_data3->fname));
          Session::put('member_lname', ucfirst($user_data3->lname));
          if($user_data3->image!=''){
          Session::put('member_logo', $user_data3->image);
          }
        Session::put('active_status', '1');
        return  redirect()->to('admin/index');
        }else{
        return  redirect()->to('admin/login');
        }
    }

      /*********************Load after billing**********************/

   public function loadMenuAgain($url,$id) {

        $user_data3 = DB::table('users')->where('id', $id)->first();
        if(count($user_data3)>0){
          $cur_date=date("Y-m-d");
          $user_data4 = DB::table('users')->where('id', $id)->where('exp_date','>', $cur_date)->first();
          if(count($user_data4)=='' || count($user_data4)=='0'){
          echo '<script>window.location.href = "http://topshelfmenu.us/admin/settings/index.php?memberShip='.base64_encode($id).'";</script>';
          }

        Session::put('member_id', $user_data3->id);
        Session::put('member_fname', ucfirst($user_data3->fname));
        Session::put('member_lname', ucfirst($user_data3->lname));
        Session::put('member_name', $user_data3->username);
        Session::put('member_company', $user_data3->company);
        if($user_data3->image!=''){
        Session::put('member_logo', $user_data3->image);
        }
        Session::put('member_active_status', '1');
        if($url==1){
        return  redirect()->to('admin/index');
        }

         if($url==2){
        return  redirect()->to('admin/select-product');
        }
         if($url==3){
        return  redirect()->to('admin/related-product');
        }

        if($url==4){
        return  redirect()->to('admin/menu');
        }
        if($url==5){
        return  redirect()->to('admin/products');
        }
        if($url==6){
        return  redirect()->to('admin/saved-products');
        }
        if($url==7){
        return  redirect()->to('admin/faq');
        }
        if($url==8){
        return  redirect()->to('admin/customers');
        }
        if($url==9){
        return  redirect()->to('admin/report');
        }
        if($url==10){
        return  redirect()->to('admin/page-contain');
        }
        if($url==11){
        return  redirect()->to('admin/orders');
        }
        if($url==12){
        return  redirect()->to('admin/reviews');
        }
        }else{
        return  redirect()->to('admin/login');
        }
    }

  public function loadIndex()
  {
        if(session('member_id')!=''){

        $user_id = session('member_id');
        /***************************Get Last seven day sale***************************/
        $current_date=date('Y-m-d');
          $pre_seven_days=date('Y-m-d', strtotime('-7 days'));
          $seven_days=0;
          $all_amount=0;
          $per_amount=0;
          $invoice_paid = DB::table('orders')
          ->where('admin_id','=', $user_id)->whereBetween('order_date', array($pre_seven_days, $current_date))->get();
          if(count($invoice_paid)>0)
          {
          foreach($invoice_paid as $key => $paid_data){
          $seven_days=$seven_days+$paid_data->order_amount;
          }
          }

        // most benifite client
          $all_pay=0;
          $max_pay=0;
          $max_user='';
          $top_user='';
         $invoice_paid1 = DB::table('orders')
          ->where('admin_id','=', $user_id)->groupBy('user_id')->get();
          if(count($invoice_paid1)>0)
          {
          foreach($invoice_paid1 as $key => $paid_val){
            $all_pay=0;

          $email_paid = DB::table('orders')
          ->where('admin_id','=', $user_id)
          ->where('user_id','=', $paid_val->user_id)
          ->get();
          if(count($email_paid)>0)
          {
          foreach($email_paid as $key => $most_data){
           $all_pay=$all_pay+$most_data->order_amount;
          }
          if($all_pay>$max_pay){
            $max_pay=$all_pay;
            $max_user=ucfirst($paid_val->fname).' '.ucfirst($paid_val->lname);
          }

          //Top Purchage user
            $top_user.=''.$all_pay.'=>'.$paid_val->user_id.''.',';
          }
          }
          }

          //Get most popular product
          $popular_product='';
          $query='';
          $query = DB::table('products')
          ->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0')
          ->join('products_brand', 'products.brand', '=', 'products_brand.brand_id');
          $query->orderBy('products.prod_view', 'desc');
          $query->limit(10);
          $popular_product=$query->get();

          if($top_user!=''){
          $top_user= rtrim($top_user,',');
          $myTopUser = explode(',', $top_user);
          sort($myTopUser);
          }else{
          $myTopUser='';
          }

        return view('admin.index',compact('seven_days','max_pay','max_user','popular_product','myTopUser'));
        }else{
        return  redirect()->to('admin/login');
        }
  }


    public function loadHome()
    {
        if(session('member_id')!=''){
        if(session('member_active_status')==''){
        redirect()->to('admin/account/billing');
        } else{
        $invoicedata='';
        $user_id = session('member_id');

        return view('admin/index');
        }
        }else{
        return  redirect()->to('admin/login');
        }
    }




  /***************************ACCOUNT  UPDATE******************/
 public function account()
  {
  if(session('member_id')!=''){
  $user_id = session('member_id');
  $state=DB::table('state')->get();

  $user_data=DB::table('users')->where('id','=', $user_id)->first();
  return view('admin/settings',compact('user_data','state'));
  }else{
  return  redirect()->to('admin/login');
  }
  }
  /*****************Load Menu**************/
  public function loadMenu()
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $type=DB::table('admin_type')->where('parentid', 'NULL')->get();
  $brand=DB::table('admin_brand')->orderBy('name', 'asc')->get();
  return view('admin/menu',compact('type','brand'));
  }else{
  return  redirect()->to('admin/login');
  }
  }
  public function subcategoryList(Request $request)
  {
  $states = DB::table("admin_type")->where("parentid",$request->category)->pluck("type_name","type_id");
  return response()->json($states);
  }
/***********************BRAND SECTION************************/

  public function brand()
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $brand=DB::table('products_brand')->where('user_id', $user_id)->get();
  $edit_id='';
  return view('admin/brand',compact('brand','edit_id'));
  }else{
  return  redirect()->to('admin/login');
  }
  }

 /*****************Load edit brand*****************************/
  public function editbrand($id)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $edit_id=DB::table('products_brand')->where('brand_id','=', $id)->where('user_id', $user_id)->first();
  $brand=DB::table('products_brand')->where('user_id', $user_id)->get();
  return view('admin/brand',compact('brand','edit_id'));
  }else{
  return  redirect()->to('admin/login');
  }
  }
 /**********************Update Brand***************************/

 public function updateBrand(Request $request)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $brand_name=$request->input('brand_name');
  $edit_id=$request->input('edit_id');
  $user_data3 = DB::table('products_brand')->where('user_id', $user_id)->where('name', $brand_name)->where('brand_id','!=', $edit_id)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('products_brand')->where('brand_id', $edit_id)
  ->update(['name' => $brand_name]);
  Session::flash('brand_success', 'Brand has been updated successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('admin/brand');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Brand name already exists.');
  return  redirect()->to('admin/brand/'.$edit_id.'');
  }

  //return view('admin/brand',compact('brand'));
  }else{
  return  redirect()->to('admin/login');
  }
  }



  public function addBrand(Request $request)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $brand_name=$request->input('brand_name');
  $user_data3 = DB::table('products_brand')->where('user_id', $user_id)->where('name', $brand_name)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('products_brand')->insertGetId(
  ['user_id'=>$user_id,'name'=>$brand_name] );
  Session::flash('brand_success', 'Brand has been added successfully.');
  Session::flash('success_btn', 'success');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Brand name already exists.');
  }
  return  redirect()->to('admin/brand');
  }else{
  return  redirect()->to('admin/login');
  }
  }

  public function brandDelete($id)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $user_data3 = DB::table('products_brand')->where('user_id', $user_id)->where('brand_id', $id)->delete();
   Session::flash('brand_success', 'Brand has been deleted successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('admin/brand');
  }else{
  return  redirect()->to('admin/login');
  }
  }


  /***********************PRODUCT TYPE SECTION************************/

  public function product_type()
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $brand=DB::table('products_type')->where('user_id', $user_id)->get();
  $edit_id='';
  return view('admin/product_type',compact('brand','edit_id'));
  }else{
  return  redirect()->to('admin/login');
  }
  }

  /*****************Load edit brand*****************************/
  public function editType($id)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $edit_id=DB::table('products_type')->where('type_id','=', $id)->where('user_id', $user_id)->first();
  $brand=DB::table('products_type')->where('user_id', $user_id)->get();
  if(count($edit_id)>0){
  return view('admin/product_type',compact('brand','edit_id'));
  }else{
   return  redirect()->to('admin/product_type');
  }
  }else{
  return  redirect()->to('admin/login');
  }
  }
 /**********************Update Brand***************************/

 public function updateType(Request $request)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $brand_name=$request->input('brand_name');
  $edit_id=$request->input('edit_id');
  $user_data3 = DB::table('products_type')->where('user_id', $user_id)->where('type_name', $brand_name)->where('type_id','!=', $edit_id)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('products_type')->where('type_id', $edit_id)
  ->update(['type_name' => $brand_name]);
  Session::flash('brand_success', 'Product type has been updated successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('admin/product_type');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Product type name already exists.');
  return  redirect()->to('admin/product_type/'.$edit_id.'');
  }

  //return view('admin/brand',compact('brand'));
  }else{
  return  redirect()->to('admin/login');
  }
  }



  public function addProductType(Request $request)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $brand_name=$request->input('brand_name');
  $user_data3 = DB::table('products_type')->where('user_id', $user_id)->where('type_name', $brand_name)->get();
  if(count($user_data3)==0){
  $last_id=DB::table('products_type')->insertGetId(
  ['user_id'=>$user_id,'type_name'=>$brand_name] );
  Session::flash('brand_success', 'Product type has been added successfully.');
  Session::flash('success_btn', 'success');
  }else{
  Session::flash('success_btn', 'danger');
  Session::flash('brand_success', 'Product type name already exists.');
  }
  return  redirect()->to('admin/product_type');
  }else{
  return  redirect()->to('admin/login');
  }
  }

  public function typeDelete($id)
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $user_data3 = DB::table('products_type')->where('user_id', $user_id)->where('type_id', $id)->delete();
   Session::flash('brand_success', 'Product type has been deleted successfully.');
  Session::flash('success_btn', 'success');
  return  redirect()->to('admin/product_type');
  }else{
  return  redirect()->to('admin/login');
  }
  }


  /***********************PRODUCT TYPE SECTION************************/

  public function faq()
  {
  if(session('member_id')!=''){
  $user_id=session('member_id');
  $faq=DB::table('products_faq')->where('user_id', $user_id)->get();
  if(count($faq)==0){
  $question='';
  $ans='';
  $insert=DB::table('products_faq')->insertGetId(
  ['user_id' => $user_id,'question' => $question,'answer' =>$ans] );
  $faq=DB::table('products_faq')->where('user_id', $user_id)->get();
  }

  return view('admin/faq',compact('faq','static_data'));
  }else{
  return  redirect()->to('admin/login');
  }
  }



  public function pageContain()
  {
      if(session('member_id')!=''){
      $user_id=session('member_id');

      $static_data1 = DB::table('static_contain')->where('user_id', $user_id)->first();
      if($static_data1==''){
      $insert=DB::table('static_contain')->insertGetId(
      ['user_id' => $user_id,'how_it_work' => '','what_next' =>'','cover_image' =>'','facebook_pixel' =>'','google_analytics' =>''] );
      }
      $static_data = DB::table('static_contain')->where('user_id', $user_id)->first();
      return view('admin/page-contain',compact('static_data'));
      }else{
      return  redirect()->to('admin/login');
      }
  }


 public function pageconatinsave(Request $request)
  {
  if(session('member_id')!=''){
      $user_id=session('member_id');
      $user_data = DB::table('static_contain')->where('user_id', $user_id)->first();
      $how_it_work = ($request->input('how_it_work')!='')?$request->input('how_it_work'):'';
      $what_next = ($request->input('what_next')!='')?$request->input('what_next'):'';
      $google_analytics = ($request->input('google_analytics')!='')?$request->input('google_analytics'):'';
      $facebook_pixel = ($request->input('facebook_pixel')!='')?$request->input('facebook_pixel'):'';
      if(count($user_data)>0){
     $last_id=DB::table('static_contain')->where('user_id', $user_id)
  ->update(['how_it_work' => addslashes($how_it_work),'what_next' =>addslashes($what_next),'facebook_pixel' =>addslashes($facebook_pixel),'google_analytics' =>addslashes($google_analytics)]);

      }else{
        $insert=DB::table('static_contain')->insertGetId(
      ['user_id' => $user_id,'how_it_work' => addslashes($how_it_work),'what_next' =>addslashes($what_next),'facebook_pixel' =>addslashes($facebook_pixel),'google_analytics' =>addslashes($google_analytics),'cover_image' =>''] );
      }


     if(Input::hasFile('image'))
      {
      $file=Input::file('image');
      $random_name=time();
      $destinationPath='cover_admin_img/';
      $extension=$file->getClientOriginalExtension();
      $filename=$random_name.'.'.$extension;
      $byte=File::size($file); //get size of file
      $uploadSuccess=Input::file('image')->move($destinationPath,$filename);
      $last_id=DB::table('static_contain')->where('user_id', $user_id)
      ->update(['cover_image' => $filename]);

      }
      Session::flash('faq_success', 'Information  has been updated successfully.');
      Session::flash('success_btn', 'success');
      return  redirect()->to('admin/page-contain');
 }else{
  return  redirect()->to('admin/login');
  }
  }
  public function faqSave(Request $request)
  {
  if(session('member_id')!=''){
      $user_id=session('member_id');
      $user_data3 = DB::table('products_faq')->where('user_id', $user_id)->delete();
     $totalInvoice=$request->input('totalInvoice');
      for($i=1;$i<=$totalInvoice;$i++){
      $question = ($request->input('question_'.$i)!='')?$request->input('question_'.$i):'';

      $ans = ($request->input('ans_'.$i)!='')?$request->input('ans_'.$i):'';
      if($question!=''){
      $insert=DB::table('products_faq')->insertGetId(
      ['user_id' => $user_id,'question' => addslashes($question),'answer' =>addslashes($ans)] );
      }
      }


      Session::flash('faq_success', 'FAQ  has been added successfully.');
      Session::flash('success_btn', 'success');
      return  redirect()->to('admin/faq');
 }else{
  return  redirect()->to('admin/login');
  }
  }

 public function forgot(Request $request)
      {
          $email=$request->input('email');
          $user_inf=DB::table('users')->where('email', $email)->first();
          if(count($user_inf)>0){
          $type='1';
          $user_type='admin';
          $email= $user_inf->email;
          $random_number = mt_rand(100000, 999999);
          $rand_no=base64_encode($random_number.'@@@@@'.$type);
          $sql=DB::table('users')->where('id', $user_inf->id)->update(array('forgot' => $rand_no));
           $user_info=DB::table('users')->where('id', $user_inf->id)->first();
          Mail::send('admin.forgot_password_mail', ['user_info'=>$user_info,'user_type'=>$user_type], function ($message) use ($email)
          {
          $message->from('noreply@topshelfmenu.us', 'Forgot Password');
          $message->to($email)
          ->subject('Forgot Password');
          });

          Session::flash('for_success', 'Reset password link has been send to your email address.');
          return  redirect()->to('admin/forgot-password');
          }else{
          Session::flash('for_error', 'Invalid email address.');
          return  redirect()->to('admin/forgot-password');
          }
      }

    /***********************Reset Password Done*******************/
     public function resetpassword(Request $request)
      {
        $forget=$request->input('forget_cupon');
        $user_inf=DB::table('users')->where('forgot', $forget)->first();
        if(count($user_inf)>0){
        $forgot= $user_inf->forgot;
        $new_password=$request->input('new_password');
        $sql=DB::table('users')->where('id', $user_inf->id)->update(array('forgot' => '','password' => md5($new_password)));
        Session::flash('error', 'Password has been resert successfully.');
        return  redirect()->to('admin/login');
        }else{
        return view('errors.404');
        }

      }
    /*********************Forgot pass word link verify************/
      public function resetpass($id)
      {
        if($id!=''){
           $for_id=base64_decode($id);
          $forget_id= explode('@@@@@',$for_id);

          $user_inf=DB::table('users')->where('forgot', $id)->first();
          if(count($user_inf)>0){
          $forgot= $user_inf->forgot;
          return view('admin/resetpassword',compact('forgot'));
          }else{
          return view('errors.404');
          }
          }else{
          return view('errors.404');
          }
      }



 /**********************Report Section**************************/
 public function report(Request $request)
  {
  if(session('member_id')!=''){
      $user_id=session('member_id');


        $mail_status='0';
        $invoice_paid2 = DB::table('orders')
        ->where('admin_id','=', $user_id)->where('rating_status','=', $mail_status)->get();
        $review_pendind=count($invoice_paid2);

        //Get current month sale
        $current_date=date('Y-m-d');
        $pre_seven_days=date('Y-m-d', strtotime('-30 days'));
        $month_sales=0;
        $invoice_paid = DB::table('orders')
        ->where('admin_id','=', $user_id)->whereBetween('order_date', array($pre_seven_days, $current_date))->get();
        if(count($invoice_paid)>0)
        {
        foreach($invoice_paid as $key => $paid_data){
        $month_sales=$month_sales+$paid_data->order_amount;
        }
        }
        $month_customer=0;
        $cus = DB::table('orders')
        ->where('admin_id','=', $user_id)->whereBetween('order_date', array($pre_seven_days, $current_date))->groupBy('email')->get();
        if(count($cus)>0)
        {
        $month_customer=count($cus);
        }
        //Get most popular product
        $popular_product='';
        $query='';
        $query = DB::table('products')
        ->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0')
        ->join('products_brand', 'products.brand', '=', 'products_brand.brand_id');
        $query->orderBy('products.prod_view', 'desc');
        $query->limit(10);
        $popular_product=$query->get();
        //Get record list
        $k=0;
        $str4='[]';
        $strq='';
        $add_date='[]';
        if($request->input('start_date')!='' && $request->input('end_date')!=''){
        list($m,$d,$y) = preg_split('/\//', $request->input('start_date'));
        $start=$y.'-'.$m.'-'.$d;
        list($m,$d,$y) = preg_split('/\//', $request->input('end_date'));
        $end=$y.'-'.$m.'-'.$d;
        }else{
        $start=date('Y-m-d', strtotime('-3 days'));
        $end=$current_date;
        }
        //for graph
        $dates = array($start);
        $aviableDate='';
        $total_price='0';
        $add_date='[';
        $strq='[';
        while(end($dates) <= $end){
        $add_date.='"'.date('m-d-Y', strtotime($dates[$k])).'"'.',';
        $dates[] = date('Y-m-d', strtotime(end($dates).' +1 day'));


        $total=0;
        $query1 = DB::table('order_item')
        ->where('admin_id','=', $user_id)->where('orderdate', "=", $dates[$k]) ;
        if(!empty($request->input('pro_brand'))){
        $query1->where('pro_brand','=', $request->input('pro_brand'));
        }
        if(!empty($request->input('pro_type'))){
        $query1->where('pro_category','=', $request->input('pro_type'));
        }
        $invoice_paid5=$query1->get();

        if(count($invoice_paid5)>0)
        {
        foreach($invoice_paid5 as $key => $paid_data5){
        $total=$total+number_format((float)$paid_data5->price, 2, '.', '');
        }
        }else{
        $total.='0';
        }
        $strq.=$total.',';
        $k++;
        }
        $str4=rtrim($strq,',');

        $str4.=']';

        $add_date=rtrim($add_date,',');
        $add_date.=']';

        $date_sales=0;
        $avg_sales=0;
        $total_cus=0;

        $sel_date=date('M d,Y', strtotime($start)).' To '.date('M d,Y', strtotime($end));
        $query2 = DB::table('order_item')
        ->where('admin_id','=', $user_id)->whereBetween('orderdate', array($start,$end));

        if(!empty($request->input('pro_brand'))){
        $query2->where('pro_brand','=', $request->input('pro_brand'));
        }
        if(!empty($request->input('pro_type'))){
        $query2->where('pro_category','=', $request->input('pro_type'));
        }
        $invoice_paid3=$query2->get();

        if(count($invoice_paid3)>0)
        {
        foreach($invoice_paid3 as $key => $paid_data3){
        $date_sales=$date_sales+$paid_data3->price;
        }
        $avg_sales=$date_sales/count($invoice_paid3);

        }

        $query5 = DB::table('order_item')
        ->where('admin_id','=', $user_id)->whereBetween('orderdate', array($start,$end));
        if(!empty($request->input('pro_brand'))){
        $query5->where('pro_brand','=', $request->input('pro_brand'));
        }
        if(!empty($request->input('pro_type'))){
        $query5->where('pro_category','=', $request->input('pro_type'));
        }
        $cus2=$query5->groupBy('user_id')->get();
        if(count($cus2)>0)
        {
        $total_cus=count($cus2);
        }




        $type=DB::table('admin_type')->get();
        $brand=DB::table('admin_brand')->orderBy('name', 'asc')->get();
      //Download CSV
      $download_type=$request->input('download_csv');
      if($download_type==1){
      $query3 = DB::table('order_item')
      ->where('admin_id','=', $user_id)->whereBetween('orderdate', array($start,$end));
      if(!empty($request->input('pro_brand'))){
      $query3->where('pro_brand','=', $request->input('pro_brand'));
      }
      if(!empty($request->input('pro_type'))){
      $query3->where('pro_category','=', $request->input('pro_type'));
      }
      $query3->orderBy('orderdate', 'desc');
      $report_get=$query3->get();

      $tot_record_found=0;

      $tot_record_found=1;
      //First Methos
      $export_data="Order Date,Order Id,Pro Name,Size,Qty,Price,First Name,Last Name,Email Address,Phone Number,Address,Suite/Apartment No,City,State,Zip Code\n";
      if(count($report_get)>0){
      foreach($report_get as $value){
      $order_date=date('m-d-Y', strtotime($value->orderdate)) ;
      $qty=1;
      $ord_info=DB::table('orders')->where('orderid', $value->order_id)->first();
      $apartment=($ord_info->apartment!='')?$ord_info->apartment:'NA';
      $export_data.=$order_date.','.$ord_info->order_id.','.addslashes($value->prod_title).','.$value->prod_size.','.$qty.','.$value->price.','.$ord_info->fname.','.$ord_info->lname.','.$ord_info->email.','.$ord_info->phone.','.addslashes($ord_info->address).','.addslashes($apartment).','.$ord_info->city.','.$ord_info->state.','.$ord_info->zip_code."\n";
      }
      }else{
      $export_data.='No record found';
      }
      return response($export_data)
      ->header('Content-Type','application/csv')
      ->header('Content-Disposition', 'attachment; filename="report.csv"')
      ->header('Pragma','no-cache')
      ->header('Expires','0');
      }
       return view('admin.report',compact('type','brand','month_sales','month_customer','popular_product','date_sales','avg_sales','total_cus','sel_date','add_date','str4','review_pendind'));
     // return  redirect()->to('admin/report');
 }else{
  return  redirect()->to('admin/login');
  }
  }


  /**********************Customer Section**************************/
 public function customers(Request $request)
  {
  if(session('member_id')!=''){
        $user_id=session('member_id');
        $query = DB::table('orders')
        ->where('admin_id','=', $user_id);
        if(!empty($request->search_key)){
        $query->Where('fname', 'Like', "%$request->search_key%");
        $query->orWhere('lname', 'Like', "%$request->search_key%");
        $query->orWhere('email', 'Like', "%$request->search_key%");
        $query->orWhere('phone', 'Like', "%$request->search_key%");
        }
        $product_data=$query->groupBy('user_id');
        $cus_list=$query->get();
        return view('admin.customers',compact('cus_list'));
        }else{
        return  redirect()->to('admin/login');
        }
  }


   /**********************Customer Section**************************/
 public function customerDetails($id,$oid,Request $request)
  {
  if(session('member_id')!=''){
    $user_id=session('member_id');
    $client_id=$id;
    $order_id=$oid;
    $invoice_paid2 = DB::table('orders')
    ->where('admin_id','=', $user_id)->where('orderid','=', $order_id)->first();
    if(count($invoice_paid2)>0)
    {
    return view('admin.customer_details',compact('client_id','order_id'));
    }else{
    return  redirect()->to('admin/login');
    }
     // return  redirect()->to('admin/report');
 }else{
  return  redirect()->to('admin/login');
  }
  }





 /*********************Cancel Order************/
 public function cancel_order($id)
      {
            if($id!=''){
            $order_id=base64_decode($id);
            $order_inf=DB::table('orders')->where('order_id', $order_id)->first();
            $admin_inf=DB::table('users')->where('id', $order_inf->admin_id)->first();
            $user_id=$admin_inf->username;
            $user_inf=DB::table('orders')->where('order_id', $order_id)->where('status', '0')->first();
            if(count($user_inf)>0){
            $sql=DB::table('orders')->where('order_id', $order_id)->update(['status' => '1']);
            $user_name=$user_id;
            $order_product='';
            $related_product='';
            $order_info='';
            return view('front/order_cancel',compact('order_product','user_name','related_product','order_info'));
            }else{
            $user_name=$user_id;
            $order_product='';
            $related_product='';
            $order_info='';
            return view('front/order_cancel',compact('order_product','user_name','related_product','order_info'));
            }
            }else{
            return view('errors.404');
            }
      }

  /**********************Logout********************************/
      public function logout()
      {
      Session::put('member_id', '');
      Session::put('member_fname', '');
      Session::put('member_lname', '');
      Session::put('member_logo', '');
      Session::put('member_active_status', '');
      return  redirect()->to('admin/login');
      }
}


?>