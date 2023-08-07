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
use Cart;
class ListProductController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
public function indexView($id,Request $request)
  {

      $cur_date=date("Y-m-d");
      $user_data = DB::table('users')->where('username','=', $id)->where('exp_date','>=', $cur_date)->where('status','=', '1')->first();

      if(count($user_data)>0){
          $user_id = $user_data->id;
           //get Static contain
          $static_data = DB::table('static_contain')->where('user_id','=', $user_id)->first();
          if(count($static_data)>0){
            $cover_logo='cover_admin_img/'.$static_data->cover_image;
          Session::put('member_cover', $cover_logo);
          Session::put('member_what_next', $static_data->what_next);
          Session::put('member_how_it_work', $static_data->how_it_work);
          }else{

          Session::put('member_cover', '');
          Session::put('member_what_next', '');
          Session::put('member_how_it_work', '');
          }
          if($user_data->image!=''){
          $logo='profile/'.$user_data->image;
          Session::put('memberlogo', $logo);
          }else{
          $logo='images/logo.png';
          Session::put('memberlogo', $logo);
          }

          $product_type = DB::table('admin_type')->where('parentid', 'NULL')->get();
		  $product_brand=DB::table('admin_brand')->orderBy('name', 'asc')->get();
          $product_data='';
          $query='';
          $query = DB::table('products')
          ->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0')
          ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id');
          if(!empty($request->pro_type)){
          $query->where('products.pro_type','=', $request->pro_type);
          $query->orWhere('products.sub_cat','=', $request->pro_type);
          }
          if(!empty($request->brand_type)){
          $query->where('products.brand','=', $request->brand_type);
          }
           if(!empty($request->search_key)){
               $query->Where('products.pro_title', 'Like', "%$request->search_key%");
               $query->orWhere('products.short_desc', 'Like', "%$request->search_key%");
               $query->orWhere('products.pro_desc', 'Like', "%$request->search_key%");
           }
           if(!empty($request->sort_by)){
           if($request->sort_by==3){
          $query->orderBy('products.pro_price', 'desc');
          }
          if($request->sort_by==4){
          $query->orderBy('products.pro_price', 'asc');
          }
          if($request->sort_by==2){
          $query->orderBy('products.prod_id', 'desc');
          }
          if($request->sort_by==1){
          $query->orderBy('products.prod_view', 'desc');
          }
          }else{
           $query->orderBy('products.prod_id', 'desc');
          }

          $product_data=$query->get();

          $user_name=$user_data->username;
          //remove other cart value
          $brand='';
          $new='0';
          $total_item=Cart::count();
          if($total_item>0){
          foreach(Cart::content() as $row){
          $proid=explode('@@@@@',$row->id);
          $pre_cart = DB::table('products')
          ->where('prod_id', '=', $proid[0])->first();
          $brand.=$pre_cart->brand.',';
          if($pre_cart->user_id!=$user_id) {
          $new=1;
          }
          }
          }
          if($new=='1'){
          Cart::destroy();
          }
          $related_product='';


          /*$related_product = DB::table('products')->where('products.user_id','=', $user_id)
          ->where('products.save_status', '=', '0')
          ->whereIn('brand', [$unque_brand])
          ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
           ->limit(6)
          ->get();*/

          $related_product = DB::table('products')->where('products.user_id','=', $user_id)
          ->where('products.save_status', '=', '0')->where('products.related_products', '=', '1')
          ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
           ->limit(4)
          ->get();


      return view('front/index',compact('product_data','user_name','product_type','product_brand','related_product'));
      }else{
      //return  redirect()->to('errors.404');
      return view('errors.404');
      }
  }

 /**************************Product Details****************************/
 public function productDetails($id,$pro_id,$title)
  {


      $cur_date=date("Y-m-d");
      $user_data = DB::table('users')->where('username','=', $id)->where('exp_date','>=', $cur_date)->where('status','=', '1')->first();
      if(count($user_data)>0){
      $user_id = $user_data->id;
      $product_faq=DB::table('products_faq')->where('user_id','=', $user_id)->get();

      $product_data = DB::table('products')->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0')
      ->where('products.prod_id', '=', $pro_id)
      ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
      ->first();
      if(count($product_data)>0){
       //Update product view
      $pro_view=$product_data->prod_view+1;
      $update_id=DB::table('products')
    ->where('prod_id', $pro_id)
    ->update( ['prod_view' => $pro_view]   );

      $product_qty=DB::table('products_qty')->where('pro_id','=', $product_data->prod_id)->get();
      $product_image=DB::table('products_image')->where('pro_id','=', $product_data->prod_id)->get();
      $effects=DB::table('strain_attributes')->where('prod_id','=', $product_data->prod_id)->where('type','=', 1)->where('percentage','!=','')->get();
      $medical=DB::table('strain_attributes')->where('prod_id','=', $product_data->prod_id)->where('type','=', 2)->where('percentage','!=', '')->get();
      $negatives=DB::table('strain_attributes')->where('prod_id','=', $product_data->prod_id)->where('type','=', 3)->where('percentage','!=','')->get();
      $user_name=$user_data->username;
      $bussiness_name=$user_data->company;

          $brand='';
          $new='0';
          $total_item=Cart::count();
          if($total_item>0){
          foreach(Cart::content() as $row){
          $proid=explode('@@@@@',$row->id);
          $pre_cart = DB::table('products')
          ->where('prod_id', '=', $proid[0])->first();
          if($pre_cart->brand!=''){
          $brand.=$pre_cart->brand.',';
          }
          }
          }

        $related_product='';


        $related_product = DB::table('products')->where('products.user_id','=', $user_id)
          ->where('products.save_status', '=', '0')->where('products.related_products', '=', '1')
          ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
           ->limit(4)
          ->get();

        //Get Rating
         $rating_data = DB::table('order_item')->where('prod_id','=', $pro_id)->where('review_status','=', '2')->get();
         $static_data = DB::table('static_contain')->where('user_id','=', $user_id)->first();
          if(count($static_data)>0){
          $how_it_work=$static_data->how_it_work;
          }else{
            $how_it_work='';
          }
         // echo $how_it_work;die;
      return view('front/product-details',compact('product_data','how_it_work','user_name','bussiness_name','product_faq','product_qty','product_image','related_product','effects','negatives','medical','rating_data'));
      }else{
           return view('errors.404');
      }
      }else{
      //return  redirect()->to('errors.404');
      return view('errors.404');
      }

  }

  public function getPrice(Request $request){

    if ($request->ajax())
    {
    $output = "";
    if($request->search!='null'){
    $invoice_list = DB::table('products_qty')
    ->where('qty_id','=', $request->search)
    ->first();
    if(count($invoice_list)>0)
    {
    $output=number_format($invoice_list->price,2);
    }
    }else{
    $product_data = DB::table('products')
    ->where('products.prod_id', '=', $request->pro_id)
    ->first();
    $output=number_format($product_data->pro_price,2);

    }
    return Response($output);
    }
}
 /*********************Add Item from index******************************/

 public function addItemCart(Request $request){
//Cart::instance('ashok');
//Cart::destroy();

$pro_id=$request->pro_id;
$product_info = DB::table('products')
->where('prod_id', '=', $pro_id)
->first();
$total=Cart::count();
$user_name=$request->user_name;


$pro_title=$product_info->pro_title;
$product_qty = DB::table('products_qty')->where('pro_id', '=', $pro_id)->first();
$prod_price=$product_qty->price;
 $pro_size=$product_qty->qty_id;
$new='0';
$total_item=Cart::count();
if($total_item>0){
foreach(Cart::content() as $row){
  $proid=explode('@@@@@',$row->id);
 $pre_cart = DB::table('products')
->where('prod_id', '=', $proid[0])->first();
if($pre_cart->user_id!=$product_info->user_id) {
   $new=1;
   }
}
}
if($new=='1'){
Cart::destroy();
}
$pro_id_new=$pro_id.'@@@@@'.rand(0,100000);
Cart::add($pro_id_new, $pro_title, 1, $prod_price,['size' => $pro_size]);
Session::put('popup_show', '1');
return  redirect()->to('/'.$user_name);

}



/*********************Add Item Related Product******************************/

 public function addCard(Request $request){
$pro_id=$request->pro_id;
$product_info = DB::table('products')
->where('prod_id', '=', $pro_id)
->first();
$total=Cart::count();



$pro_title=$product_info->pro_title;
$product_qty = DB::table('products_qty')->where('pro_id', '=', $pro_id)->first();
$prod_price=$product_qty->price;
 $pro_size=$product_qty->qty_id;
$new='0';
$total_item=Cart::count();
if($total_item>0){
foreach(Cart::content() as $row){
  $proid=explode('@@@@@',$row->id);
 $pre_cart = DB::table('products')
->where('prod_id', '=', $proid[0])->first();
if($pre_cart->user_id!=$product_info->user_id) {
   $new=1;
   }
}
}
if($new=='1'){
Cart::destroy();
}
$pro_id_new=$pro_id.'@@@@@'.rand(0,100000);
Cart::add($pro_id_new, $pro_title, 1, $prod_price,['size' => $pro_size]);
Session::put('popup_show', '1');
  return;

}


/************************Add item from details***********************/
public function addCardItem(Request $request){
//Cart::instance('ashok');
//Cart::destroy();

$pro_id=$request->pro_id;
$product_info = DB::table('products')
->where('prod_id', '=', $pro_id)
->first();
$total=Cart::count();
$user_name=$request->user_name;
$pro_qty=$request->pro_qty; //get price
$pro_size=($request->input('pro_qty')!='')?$request->input('pro_qty'):'';
$pro_title=$product_info->pro_title;
if($request->pro_qty==''){
$prod_price=$product_info->pro_price;
}else{
$product_qty = DB::table('products_qty')
->where('qty_id', '=', $request->pro_qty)
->first();
$prod_price=$product_qty->price;

}
$new='0';
$total_item=Cart::count();
if($total_item>0){
foreach(Cart::content() as $row){
  $proid=explode('@@@@@',$row->id);
 $pre_cart = DB::table('products')
->where('prod_id', '=', $proid[0])->first();
if($pre_cart->user_id!=$product_info->user_id) {
   $new=1;
   }
}
}
if($new=='1'){
Cart::destroy();
}

$UrlNames = str_replace("/","",str_replace(",",",",str_replace("","_",str_replace("-","_",str_replace("&","",str_replace("*","",str_replace("+","",str_replace("=","",str_replace("%","",str_replace("@","",str_replace("$","",str_replace("#","",str_replace("{","",str_replace("}","",str_replace("(","",str_replace(")","",str_replace(">","",str_replace("<","",str_replace(";","",str_replace("'","",str_replace('"',"",str_replace('`',"",str_replace('!',"",str_replace(':',"",str_replace('~',"",trim($product_info->pro_title))))))))))))))))))))))))));
  $UrlNames = str_replace("?","",$UrlNames);
  $UrlNames = str_replace("^","",$UrlNames);
  $UrlNames = str_replace("%","",$UrlNames);
  $UrlNames = str_replace(" ","",$UrlNames);

$pro_id_new=$pro_id.'@@@@@'.rand(0,100000);
Cart::add($pro_id_new, $pro_title, 1, $prod_price,['size' => $pro_size]);
Session::put('popup_show', '1');
return  redirect()->to('/'.$user_name.'/product-details/'.$pro_id.'/'.$UrlNames.'');

}


public function updateCard(Request $request){

$mainId=($request->input('mainId')!='')?$request->input('mainId'):'';
$proid=($request->input('proid')!='')?$request->input('proid'):'';
$rowId=($request->input('rowId')!='')?$request->input('rowId'):'';
$pro_size=($request->input('selId')!='')?$request->input('selId'):'';
  $product_qty = DB::table('products_qty')
->where('qty_id', '=', $request->selId)
->first();

$product_info = DB::table('products')
->where('prod_id', '=', $proid)
->first();

 $prod_price=$product_qty->price;
 $pro_title=$product_info->pro_title;
 //Cart::update($rowId,$pro_title);



//Cart::update($data);
Cart::remove($rowId);

$pro_id_new=$proid.'@@@@@'.rand(0,100000);
Cart::add($pro_id_new, $pro_title, 1, $prod_price,['size' => $pro_size]);
 //Cart::update($rowId,$pro_title,1,$prod_price,['size' => $pro_size]);
 Session::put('popup_show', '1');  
  return;
}

/************************Remove product from Cart****************/

public function removeProCard(Request $request){
$rowId=($request->input('rowId')!='')?$request->input('rowId'):'';
Cart::remove($rowId);
  return;
}

 /**************************Check Out****************************/

 public function checkout($id){
      $cur_date=date("Y-m-d");
      $user_data = DB::table('users')->where('username','=', $id)->where('exp_date','>=', $cur_date)->where('status','=', '1')->first();
      if(count($user_data)>0){
      $user_id = $user_data->id;
      $user_name=$user_data->username;

         $brand='';
          $new='0';
          $total_item=Cart::count();
          if($total_item>0){
          foreach(Cart::content() as $row){
          $proid=explode('@@@@@',$row->id);
          $pre_cart = DB::table('products')
          ->where('prod_id', '=', $proid[0])->first();
         // $brand.=$pre_cart->brand.',';
          if($pre_cart->user_id!=$user_id) {
          $new=1;
          }
          }
          }else{

            return  redirect()->to(''.$user_name.'/');
          }

          $related_product='';


          $related_product = DB::table('products')->where('products.user_id','=', $user_id)
          ->where('products.save_status', '=', '0')->where('products.related_products', '=', '1')
          ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
           ->limit(4)
          ->get();

          $state=DB::table('state')->get();
          $user_data='';

          if(session('customer_id')!=''){
          $cus_id=session('customer_id');
          $user_data=DB::table('customer')->where('cus_id', $cus_id)->first();
          }
      return view('front/checkout',compact('user_name','related_product','state','user_data'));
      }else{
      //return  redirect()->to('errors.404');
      return view('errors.404');
      }
 }
public function cus_login(Request $request){

      $email = $request->input('email');
      $password = $request->input('password');
      $user_name = $request->input('user_name');
      $status = '1';
      $user_data3 = DB::table('customer')->where('email', $email)->where('password', md5($password))->where('status', $status)->first();
      if(count($user_data3)>0){
      Session::put('customer_id', $user_data3->cus_id);
      Session::put('customer_fname', ucfirst($user_data3->fname));
      Session::put('customer_lname', ucfirst($user_data3->lname));
      Session::put('customer_logo', $user_data3->image);
      Session::flash('login_success', '1');
      return  redirect()->to(''.$user_name.'/checkout');

      }else{
      Session::flash('login_error', 'Invalid email or password.');
        return  redirect()->to(''.$user_name.'/checkout');
      }
}

public function order_confirm(Request $request){

$fname = ($request->input('fname')!='')?$request->input('fname'):'';
$lname = ($request->input('lname')!='')?$request->input('lname'):'';
$email = ($request->input('email')!='')?$request->input('email'):'';
$password = ($request->input('password')!='')?$request->input('password'):'123456';
$phone = ($request->input('phone')!='')?$request->input('phone'):'';
$address = ($request->input('address')!='')?$request->input('address'):'';
$apartment = ($request->input('apartment')!='')?$request->input('apartment'):'';
$city = ($request->input('city')!='')?$request->input('city'):'';
$state = ($request->input('state')!='')?$request->input('state'):'';
$zip_code = ($request->input('zip_code')!='')?$request->input('zip_code'):'';
$user_name = ($request->input('user_name')!='')?$request->input('user_name'):'';
$gender = ($request->input('gender')!='')?$request->input('gender'):'';


      $y=$request->input('year');
      $m=$request->input('month');
      $d=$request->input('day');
      $dob_date=$y.'-'.$m.'-'.$d;
 
  $cur_date=date("Y-m-d");
  if(session('customer_id')!=''){
    $cus_id=session('customer_id');
    $last_id=DB::table('customer')
    ->where('cus_id', $cus_id)
    ->update(
    ['fname' => $fname,'lname'=>$lname,'apartment'=>$apartment,
    'phone'=>$phone,'address'=>$address,'city'=>$city,'state'=>$state,'zip_code'=>$zip_code,'gender'=>$gender,'dob'=>$dob_date]   );
  }else{
        $user_data5 = DB::table('customer')->where('email', $email)->first();
        if(count($user_data5)==0){
        $last_id=DB::table('customer')->insertGetId(
        ['email' => $email,'fname' => $fname,'lname'=>$lname,'apartment'=>$apartment,
        'password'=>md5($password),'add_date'=>$cur_date,
        'status'=>'1','phone'=>$phone,'address'=>$address,'city'=>$city,'state'=>$state,'zip_code'=>$zip_code,'image'=>'','forgot'=>'','gender'=>$gender,'dob'=>$dob_date]  );
        $cus_id=$last_id;
        }else{
        $cus_id=$user_data5->cus_id;
        $last_id2=DB::table('customer')
        ->where('cus_id', $cus_id)
        ->update(
        ['fname' => $fname,'password'=>md5($password),'lname'=>$lname,'apartment'=>$apartment,
        'phone'=>$phone,'address'=>$address,'city'=>$city,'state'=>$state,'zip_code'=>$zip_code,'gender'=>$gender,'dob'=>$dob_date]   );
        }
    }

   $admin_info=DB::table('users')->where('username', '=', $user_name)->first();
    $total_amount= Cart::total();
    $order_id=DB::table('orders')->insertGetId(
    ['order_amount' => '0','admin_id'=>$admin_info->id,'user_id' => $cus_id,'email' => $email,'fname' => $fname,'lname'=>$lname,'apartment'=>$apartment,
    'order_date'=>$cur_date,'order_id'=>'',
    'phone'=>$phone,'address'=>$address,'city'=>$city,'state'=>$state,'zip_code'=>$zip_code,'rating_status'=>'0']  );

    $orderid='TP000'.$order_id;
    $sql=DB::table('orders')->where('orderid', $order_id)->update(['order_id' => $orderid]);

        $total_item=Cart::count();
        $total_amount=0;
          if($total_item>0){
          foreach(Cart::content() as $row){
         $proid=explode('@@@@@',$row->id);
          $size_id=($row->options->has('size') ? $row->options->size : '');
          if($size_id!=''){
          $get_qty=DB::table('products_qty')->where('qty_id', '=', $size_id)->first();
          $size=$get_qty->qty;
          $price=$get_qty->price;
          }else{
          $size='';
          $product_info = DB::table('products')->where('products.prod_id','=', $proid[0])->first();
          $price=$product_info->pro_price;
          }
          $total_amount=$total_amount+$price;
          $pro_info = DB::table('products')->where('products.prod_id','=', $proid[0])->first();
          $order_item=DB::table('order_item')->insertGetId(
          ['prod_id' => $proid[0],'admin_id' => $admin_info->id,'pro_brand'=>$pro_info->brand,'user_id' => $cus_id,'orderdate'=>$cur_date,'pro_category'=>$pro_info->pro_type,'prod_title' => $row->name,'prod_size' => $size,'order_id'=>$order_id,'price'=>$price,'rating_star'=>'0','rating_comment'=>'','rating_date'=>'0000-00-00' ]  );
          }
          $upadte=DB::table('orders')->where('orderid', $order_id)->update(['order_amount' => $total_amount]);

          }

        $user_data3 = DB::table('customer')->where('cus_id', $cus_id)->first();
        if(count($user_data3)>0){
        Session::put('customer_id', $user_data3->cus_id);
        Session::put('customer_fname', ucfirst($user_data3->fname));
        Session::put('customer_lname', ucfirst($user_data3->lname));
        if($user_data3->image!=''){
        Session::put('customer_logo', $user_data3->image);
        }
        }
        Cart::destroy();
        //Customer mail
        $email=$user_data3->email;
        $order_item = DB::table('order_item')->where('order_id','=', $order_id)->get();
        $order_info = DB::table('orders')->where('orderid',  $order_id)->first();
        Mail::send('front.order_mail', ['customer_info' => $user_data3, 'order_item' => $order_item, 'order_info'=> $order_info,'admin_info'=>$admin_info], function ($message) use ($email)
        {
        $message->from('noreply@topshelfmenu.us', 'Order Confirmation');
        $message->to($email)
        ->subject('Order Confirmation');
        });


        $admin_email=$admin_info->email;
         Mail::send('front.admin_mail', ['customer_info' => $user_data3, 'order_item' => $order_item, 'order_info'=> $order_info,'admin_info'=>$admin_info], function ($message) use ($admin_email)
        {
        $message->from('noreply@topshelfmenu.us', 'New Order');
        $message->to($admin_email)
        ->subject('New Order');
        });
       return  redirect()->to(''.$user_name.'/order_review/'.base64_encode($order_id).'');

}

public function order_review($id,$orderId){
        $order_product = DB::table('order_item')->where('order_id','=', base64_decode($orderId))->get();
        $related_product='';
        $user_name=$id;
        if(count($order_product)>0){
        $user_info = DB::table('orders')->where('orderid',  base64_decode($orderId))->first();
        $admin_info=DB::table('users')->where('username', '=', $user_name)->first();
        $static_data = DB::table('static_contain')->where('user_id','=', $admin_info->id)->first();
           if(count($static_data)>0){
          $what_next=$static_data->what_next;
          }else{
            $what_next='';
          }

        return view('front/order-review',compact('order_product','user_name','related_product','user_info','what_next'));
        }else{
        return view('errors.404');
        }
}

public function order_rating($id,$order_id){

        $user_data = DB::table('users')->where('username','=', $id)->first();
        if(count($user_data)>0){

        if($user_data->image!=''){
        $logo='profile/'.$user_data->image;
        Session::put('memberlogo', $logo);
        }else{
        $logo='images/logo.png';
        Session::put('memberlogo', $logo);
        }
        $order_info = DB::table('orders')->where('orderid',  base64_decode($order_id))->where('rating_status','=', '1')->first();
        if(count($order_info)>0){
        $order_product = DB::table('order_item')->where('order_id','=', base64_decode($order_id))->get();
        $related_product='';
        $user_name=$id;
        if(count($order_product)>0){
        return view('front/rating',compact('order_product','user_name','related_product','order_info'));
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

/************************Rating  Give*****************************/
public function rating_give(Request $request){

    $order_id = ($request->input('order_id')!='')?$request->input('order_id'):'';
    $user_name = ($request->input('user_name')!='')?$request->input('user_name'):'';
    $rating_status='2';
    $cur_date=date("Y-m-d");
    if(count($request->input('item_id'))>0){
    foreach ($request->input('item_id') as $key => $value) {
    $rating='p_'.$value;
    $comment='comment_'.$value;
    $rating_user=($request->input($rating)!='')?$request->input($rating):'';
    $comment_user=($request->input($comment)!='')?$request->input($comment):'';
    $sql=DB::table('order_item')->where('itemid', $value)
    ->update(['rating_star' => $rating_user,'rating_comment' => addslashes($comment_user),'rating_date' => $cur_date]);
    }

    $sql2=DB::table('orders')->where('orderid', $order_id)->update(['rating_status' => $rating_status,'review_status' => '1']);
    $sql2=DB::table('order_item')->where('order_id', $order_id)->update(['review_status' => '1']);
    }
    return  redirect()->to(''.$user_name.'/thank_you');
}
public function thank_you($id){
  $user_name=$id;
  $order_product='';
  $related_product='';
  $order_info='';
  return view('front/thank_you',compact('order_product','user_name','related_product','order_info'));

}

  /************************************ Forgot Passwor****************************/
public function forgot(Request $request)
      {
          $email=$request->input('email');
          $user_name = $request->input('user_name');
          $user_inf=DB::table('customer')->where('email', $email)->first();
          if(count($user_inf)>0){
          $type='1';
          $user_type='admin';
          $email= $user_inf->email;
          $random_number = mt_rand(100000, 999999);
          $rand_no=base64_encode($random_number.'@@@@@'.$type);
          $sql=DB::table('customer')->where('cus_id', $user_inf->cus_id)->update(array('forgot' => $rand_no));
           $user_info=DB::table('customer')->where('cus_id', $user_inf->cus_id)->first();
          Mail::send('front.forgot_password_mail', ['user_info'=>$user_info,'user_type'=>$user_name], function ($message) use ($email)
          {
          $message->from('noreply@topshelfmenu.us', 'Forgot Password');
          $message->to($email)
          ->subject('Forgot Password');
          });

          Session::flash('for_success', 'Reset password link has been send to your email address.');
          return  redirect()->to(''.$user_name.'/checkout');
          }else{
          Session::flash('for_error', 'Invalid email address.');
          return  redirect()->to(''.$user_name.'/checkout');
          }
      }
    /*********************Forgot pass word link verify************/
public function resetpass($id,$forgot)
      {
        if($forgot!=''){
           $for_id=base64_decode($forgot);
          $forget_id= explode('@@@@@',$for_id);
           $user_name=$id;
           $related_product='0';
           $order_product='';
  $related_product='';
  $order_info='';
          $user_inf=DB::table('customer')->where('forgot', $forgot)->first();
          if(count($user_inf)>0){
          $forgot= $user_inf->forgot;
          return view('front.resetpassword',compact('forgot','user_name','related_product','order_product','order_info'));
          }else{
          return view('errors.404');
          }
          }else{
          return view('errors.404');
          }
      }

       /***********************Reset Password Done*******************/
     public function resetpassword($id,Request $request)
      {
        $forget=$request->input('forget_cupon');
        $user_inf=DB::table('customer')->where('forgot', $forget)->first();
        if(count($user_inf)>0){
        $forgot= $user_inf->forgot;
        $new_password=$request->input('new_password');
        $sql=DB::table('customer')->where('cus_id', $user_inf->cus_id)->update(array('forgot' => '','password' => md5($new_password)));
        Session::flash('for_success', 'Password has been resert successfully.');
        return  redirect()->to(''.$id.'/checkout');
        }else{
        return view('errors.404');
        }

      }

}


?>