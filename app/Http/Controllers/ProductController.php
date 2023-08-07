<?php
namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
//use Illuminate\Mail\Mailer;
//use Mail;
//use App\User;

class ProductController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
public function productSave(Request $request)
    {
    if(session('member_id')!=''){
    $totalInvoice = ($request->input('totalInvoice')!='0')?$request->input('totalInvoice'):'1';
    $user_id = session('member_id');
    $member_name = session('member_name');
    $save_status = ($request->input('save_status')!='')?$request->input('save_status'):'0';

    $pro_title = ($request->input('pro_title')!='')?$request->input('pro_title'):'';
    $short_desc =($request->input('short_desc')!='')?$request->input('short_desc'):'';
    $pro_desc =($request->input('pro_desc')!='')?$request->input('pro_desc'):'';
    $pro_price ='0';
    $pro_type = ($request->input('pro_type')!='')?$request->input('pro_type'):'';
    $sub_cat = ($request->input('sub_cat')!='Select')?$request->input('sub_cat'):'';
    $brand = ($request->input('brand')!='')?$request->input('brand'):'';
    $add_date=date("Y-m-d");
    $last_id=DB::table('products')->insertGetId(
    ['user_id' => $user_id,'save_status'=>$save_status,'pro_title'=>addslashes($pro_title),'pro_type'=>addslashes($pro_type),'sub_cat'=>addslashes($sub_cat),'brand'=>addslashes($brand),'short_desc' => addslashes($short_desc),'pro_desc' => addslashes($pro_desc),'pro_price' => $pro_price,
    'status'=>'1','add_date'=>$add_date,'pro_image'=>'','prod_view'=>'0']  );
    if($last_id!=''){
    $min_price='500000';
    for($i=1;$i<=$totalInvoice;$i++){
    $question = ($request->input('question_'.$i)!='')?$request->input('question_'.$i):'';
    $ans = ($request->input('ans_'.$i)!='')?$request->input('ans_'.$i):'';
    if($question!=''){
    $insert=DB::table('products_qty')->insertGetId(
    ['pro_id' => $last_id,'qty' => addslashes($question),'price' =>addslashes($ans)]
    );

    if($ans<$min_price){
    $min_price=$ans;
    }
    }
    }
    //medical benifiate
    for($k=1;$k<=5;$k++){
    $name = ($request->input('effects_title_'.$k)!='')?$request->input('effects_title_'.$k):'';
    $price = ($request->input('effects_per_'.$k)!='')?$request->input('effects_per_'.$k):'';
    $insert=DB::table('strain_attributes')->insertGetId(['prod_id' => $last_id,'type'=>'1','name' => addslashes($name),'percentage' =>addslashes($price)]);
    }


    $last_id2=DB::table('products')->where('prod_id', $last_id)->update(['pro_price' => $min_price]);

    $images=array();

    if($files=$request->file('images')){
    if(!is_dir('product_images/'.$last_id.'/')){
    mkdir('product_images/'.$last_id.'/', 0777, true);
    }
    $destinationPath='product_images/'.$last_id.'/';
    $k=1;
    foreach($files as $file){
    $random_name='';
    $filename='';
    $random_name=time().rand();
    $extension=$file->getClientOriginalExtension();
    $filename=$random_name.'.'.$extension;
    $file->move($destinationPath,$filename);
    if($k==1){
    $sql=DB::table('products')->where('prod_id', $last_id)->update(array('pro_image' => $filename));
    $insert=DB::table('products_image')->insertGetId(
    ['pro_id' => $last_id,'image' => addslashes($filename)]  );
    }else{
    $insert=DB::table('products_image')->insertGetId(
    ['pro_id' => $last_id,'image' => addslashes($filename)]  );
    }
    $k++;
    }
    }

    }

    if($save_status=='0'){
    Session::flash('success', 'Product has been added successfully.');
    Session::flash('Product_id', $last_id);
    }else{
    Session::flash('success', 'Product has been save successfully.');
    Session::flash('Product_id', '');
    }
    return  redirect()->to('/admin/menu');

    }else{
    return  redirect()->to('admin/login');
    }
    }


  public function save_product()
    {
    if(session('member_id')!=''){
      $sel_product='';
      $pro_id='';
      $user_id=session('member_id');
      $query = DB::table('products')
      ->where('products.user_id','=', $user_id)->where('products.save_status', '=', '1')
      ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
      ->join('admin_type', 'products.pro_type', '=', 'admin_type.type_id');
      $product_data=$query->get();

      return view('admin/save_product',compact('product_data'));
      } else{
      return  redirect()->to('admin/login'); 
      }
}



public function productsListing()
    {
    if(session('member_id')!=''){
      $sel_product='';
      $pro_id='';
      $user_id=session('member_id');
     /* $query = DB::table('products')
      ->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0')->where('products.related_products', '=', '0')
      ->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
      ->join('admin_type', 'products.pro_type', '=', 'admin_type.type_id');
      $product_data=$query->orderBy('products.prod_id', 'desc');
      $product_data=$query->get();*/

      $query = DB::table('products')
      ->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0');
      $product_data=$query->orderBy('products.prod_id', 'desc');
      $product_data=$query->get();
      return view('admin/product-listing',compact('product_data'));
      } else{
      return  redirect()->to('admin/login');
      }
}

public function updateProduct($id)
  {
  if(session('member_id')!=''){
        $user_id = session('member_id');
        $cur_date=date("Y-m-d");
        $product_data = DB::table('products')->where('user_id','=', $user_id)->where('prod_id', '=', $id)->first();
        if(count($product_data)>0){
        $brand=DB::table('admin_brand')->orderBy('name', 'asc')->get();
        $sub_cat = DB::table('admin_type')->where('parentid', $product_data->pro_type)->get();
        $type = DB::table('admin_type')->where('parentid', 'NULL')->get();
        $effact = DB::table('strain_attributes')->where('prod_id','=', $id)->where('type','=', '1')->get();
        $item = DB::table('products_qty')->where('pro_id','=', $id)->get();
        $status='none';
        if($product_data->save_status==0){
        $pro_id=$id;
        }else{
        $pro_id='0';
        }

      return view('admin/update-product',compact('product_data','brand','type','effact','item','pro_id','sub_cat'));
      }else{
      return  redirect()->to('admin/products');
      }
      }else{
      return  redirect()->to('admin/login');
      }
  }

  public function productUpdateSave(Request $request)
    {
    if(session('member_id')!=''){
      $totalInvoice = ($request->input('totalInvoice')!='0')?$request->input('totalInvoice'):'1';
      $user_id = session('member_id');
      $member_name = session('member_name');
      $save_status = ($request->input('save_status')!='')?$request->input('save_status'):'0';

      $pro_title = ($request->input('pro_title')!='')?$request->input('pro_title'):'';
      $short_desc =($request->input('short_desc')!='')?$request->input('short_desc'):'';
      $pro_desc =($request->input('pro_desc')!='')?$request->input('pro_desc'):'';
      $pro_price ='0';
      $pro_type = ($request->input('pro_type')!='')?$request->input('pro_type'):'';
      $sub_cat = ($request->input('sub_cat')!='Select')?$request->input('sub_cat'):'';
      $brand = ($request->input('brand')!='')?$request->input('brand'):'';
    $add_date=date("Y-m-d");
     $edit_id = $request->input('edit_id');
     $last_id =$edit_id;
     $pro_title=strip_tags($pro_title);
     $pro_desc=strip_tags($pro_desc);
     $short_desc=strip_tags($short_desc);
    $update_id=DB::table('products')->where('prod_id', $edit_id)
    ->update(
    ['user_id' => $user_id,'save_status'=>$save_status,'pro_title'=>addslashes($pro_title),'pro_type'=>addslashes($pro_type),'sub_cat'=>addslashes($sub_cat),'brand'=>addslashes($brand),'short_desc' => addslashes($short_desc),'pro_desc' => addslashes($pro_desc),'pro_price' => $pro_price,
   'status'=>'1','prod_view'=>'0']  );
    if($last_id!=''){
      $min_price='500000';
       DB::table('products_qty')->where('pro_id', '=', $edit_id)->delete();
    for($i=1;$i<=$totalInvoice;$i++){
      $question = ($request->input('question_'.$i)!='')?$request->input('question_'.$i):'';
      $ans = ($request->input('ans_'.$i)!='')?$request->input('ans_'.$i):'';
      if($question!=''){
      $insert=DB::table('products_qty')->insertGetId(
      ['pro_id' => $last_id,'qty' => addslashes($question),'price' =>addslashes($ans)]
      );

      if($ans<$min_price){
         $min_price=$ans;
      }
      }
      }


      //medical benifiate
      DB::table('strain_attributes')->where('prod_id', '=', $edit_id)->delete();
       for($k=1;$k<=5;$k++){
      $name = ($request->input('effects_title_'.$k)!='')?$request->input('effects_title_'.$k):'';
      $price = ($request->input('effects_per_'.$k)!='')?$request->input('effects_per_'.$k):'';
      $insert=DB::table('strain_attributes')->insertGetId(
      ['prod_id' => $last_id,'type'=>'1','name' => addslashes($name),'percentage' =>addslashes($price)]);
      }
     $last_id2=DB::table('products')->where('prod_id', $last_id)->update(['pro_price' => $min_price]);
        $images=array();

      if($files=$request->file('images')){
            if(!is_dir('product_images/'.$last_id.'/')){
            mkdir('product_images/'.$last_id.'/', 0777, true);
            }
            $destinationPath='product_images/'.$last_id.'/';
              $k=1;
            foreach($files as $file){
            $random_name='';
            $filename='';
            $random_name=time().rand();
            $extension=$file->getClientOriginalExtension();
            $filename=$random_name.'.'.$extension;
            $file->move($destinationPath,$filename);
             if($k==1){
               $sql=DB::table('products')->where('prod_id', $last_id)->update(array('pro_image' => $filename));
               $insert=DB::table('products_image')->insertGetId(
            ['pro_id' => $last_id,'image' => addslashes($filename)]  );
            }else{
               $insert=DB::table('products_image')->insertGetId(
            ['pro_id' => $last_id,'image' => addslashes($filename)]  );
            }
            $k++;
            }
        }

      }

    if($save_status=='0'){
    Session::flash('success', 'Product has been updated successfully.');
    Session::flash('Product_id', $last_id);

    }else{
    Session::flash('success', 'Product has been save successfully.');
	Session::flash('Product_id', '');
    }
    return  redirect()->to('/admin/update-product/'.$last_id.'');

    }else{
    return  redirect()->to('admin/login');
    }
    }
 /****************************Delete Product***********************************/

 public function productDelete($edit_id,$type)
    {
        if(session('member_id')!=''){
        $user_id = session('member_id');
        DB::table('strain_attributes')->where('prod_id', '=', $edit_id)->delete();
        DB::table('products')->where('prod_id', '=', $edit_id)->delete();
        DB::table('products_qty')->where('pro_id', '=', $edit_id)->delete();
        Session::flash('success', 'Product has been deleted successfully.');
        if($type==1){
        return  redirect()->to('/admin/saved-products');
        }else{
        return  redirect()->to('/admin/products');
        }

        } else{
        return  redirect()->to('admin/login');
        }
        }


    /**********************Order Section**************************/
 public function orders(Request $request)
  {
  if(session('member_id')!=''){
        $user_id=session('member_id');
        $query = DB::table('orders')
        ->where('admin_id','=', $user_id);
        if(!empty($request->search_key)){
        $query->Where('fname', 'Like', "%$request->search_key%");
        $query->orWhere('lname', 'Like', "%$request->search_key%");
        $query->orWhere('order_id', 'Like', "%$request->search_key%");
        $query->orWhere('email', 'Like', "%$request->search_key%");
        $query->orWhere('phone', 'Like', "%$request->search_key%");
        }

        if($request->input('start_date')!='' && $request->input('end_date')!=''){
        list($m,$d,$y) = preg_split('/\//', $request->input('start_date'));
        $start=$y.'-'.$m.'-'.$d;
        list($m,$d,$y) = preg_split('/\//', $request->input('end_date'));
        $end=$y.'-'.$m.'-'.$d;
         $query->whereBetween('order_date', array($start,$end));
        }

        $query->orderBy('orderid', 'desc');
        $order_list=$query->get();
        return view('admin.orders',compact('order_list'));
        }else{
        return  redirect()->to('admin/login');
        }
  }

  /***************************Admin Pending Orders*********************************/
 public function pending_order($order_id)
    {
      $user_id = session('member_id');
      $user_inf=DB::table('orders')->where('orderid', $order_id)->where('admin_id', $user_id)->first();
      if(session('member_id')!='' && count($user_inf)>0){
      $sql=DB::table('orders')->where('orderid', $order_id)->update(array('status' => '0'));
      Session::flash('success', 'Status has been change successfully.');
      return  redirect()->to('/admin/orders');

      } else{
      return  redirect()->to('admin/login');
      }
      }


       /***************************Admin Cancel Orders*********************************/
 public function cancel_order($order_id)
    {
      $user_id = session('member_id');
      $user_inf=DB::table('orders')->where('orderid', $order_id)->where('admin_id', $user_id)->first();
      if(session('member_id')!='' && count($user_inf)>0){
      $sql=DB::table('orders')->where('orderid', $order_id)->update(array('status' => '1'));
      Session::flash('success', 'Status has been change successfully.');
      return  redirect()->to('/admin/orders');

      } else{
      return  redirect()->to('admin/login');
      }
      }



    /***************************Admin Approve Orders*********************************/
 public function approve_order($order_id)
    {
      $user_id = session('member_id');
      $user_inf=DB::table('orders')->where('orderid', $order_id)->where('admin_id', $user_id)->first();
      if(session('member_id')!='' && count($user_inf)>0){
      $sql=DB::table('orders')->where('orderid', $order_id)->update(array('status' => '2'));
      Session::flash('success', 'Status has been change successfully.');
      return  redirect()->to('/admin/orders');

      } else{
      return  redirect()->to('admin/login');
      }
      }

       /**********************Customer Section**************************/
 public function orderDetails($id,Request $request)
  {
    $user_id = session('member_id');
    $user_inf=DB::table('orders')->where('orderid', $id)->where('admin_id', $user_id)->first();
    if(session('member_id')!='' && count($user_inf)>0){
    $order_deatils = DB::table('orders')->where('admin_id','=', $user_id)->where('orderid','=', $id)->first();
    if(count($order_deatils)>0)
    {
    return view('admin.order_details',compact('order_deatils'));
    }else{
    return  redirect()->to('admin/login');
    }
     // return  redirect()->to('admin/report');
 }else{
  return  redirect()->to('admin/login');
  }
  }

}


?>