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
use App\Http\Requests;
use App\Post;
use URL;




class SelectProductController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
public function select_product(Request $request)
  {

  if(session('member_id')!=''){
        $user_id=session('member_id');
        $pre_sel = DB::table('users')->where('id', $user_id)->first();
        $product_type=DB::table('admin_type')->get();
		$product_brand=DB::table('admin_brand')->orderBy('name', 'asc')->get();
        $product_data='';
        $query='';

        $query = DB::table('admin_products')
        ->join('admin_brand', 'admin_products.brand', '=', 'admin_brand.brand_id');
        if(!empty($request->pro_type)){
        $query->where('admin_products.product_type','=', $request->pro_type);
        }
        if(!empty($request->brand_type)){
        $query->where('admin_products.brand','=', $request->brand_type);
        }
        if(!empty($request->search_key)){
        $query->Where('admin_products.pro_title', 'Like', "%$request->search_key%");
        $query->orWhere('admin_products.short_description', 'Like', "%$request->search_key%");
        $query->orWhere('admin_products.long_description', 'Like', "%$request->search_key%");
        }
        //Remove pre selected product
        if($pre_sel->selected_product!=''){
            $proId=$pre_sel->selected_product;
            $myArray = explode(',', $proId);
            for($t=0;$t<count($myArray);$t++){
            $query->where('admin_products.id','!=', $myArray[$t]);
            }
        }
        $product_data=$query->get();


        return view('admin/select-product',compact('product_data','product_type','product_brand'));

      }else{
    return  redirect()->to('admin/login');
    }
  }

      public function loadMore(Request $request){
           $user_id=session('member_id');
        $pre_sel = DB::table('users')->where('id', $user_id)->first();

        $product_type = DB::table('admin_type')->where('parentid', 'NULL')->get();
		$product_brand=DB::table('admin_brand')->orderBy('name', 'asc')->get();
        $product_data='';
        $query='';
        $sel_class='';
        $checked='';
        $query = DB::table('admin_products')
        ->join('admin_brand', 'admin_products.brand', '=', 'admin_brand.brand_id');
        if(!empty($request->pro_type)){
        $query->where('admin_products.product_type','=', $request->pro_type);
        $query->orWhere('admin_products.sub_cat','=', $request->pro_type);
        }
        if(!empty($request->brand_type)){
        $query->where('admin_products.brand','=', $request->brand_type);
        }
        if(!empty($request->search_key)){
        $query->Where('admin_products.pro_title', 'Like', "%$request->search_key%");
        $query->orWhere('admin_products.short_description', 'Like', "%$request->search_key%");
        $query->orWhere('admin_products.long_description', 'Like', "%$request->search_key%");
        }
        //Remove pre selected product
        if($pre_sel->selected_product!=''){
            $proId=$pre_sel->selected_product;
            $myArray = explode(',', $proId);
            for($t=0;$t<count($myArray);$t++){
            $query->where('admin_products.id','!=', $myArray[$t]);
            }
        }
        $product_data=$query->paginate(12);
           $url = URL::to("/");
        $html='';
        $k=1;
        foreach ($product_data as $value) {
          $img='';
          if($value->image==''){
            $img=$url.'/default.png';
          }else{
           $img=$url.'/admin_product_image/'.$value->id.'/'.$value->image;
          }
            if(!empty($request->selPro)){
            $myArray = explode(',', $request->selPro);
            if (in_array($value->id, $myArray)){
              $sel_class='select_product_active';
              $checked='checked';
            }else{
              $sel_class='';
               $checked='';
            }
            }
            $html.=' <li>
            <div class="item-box">

            <div class="shop-item '.$sel_class.'" id="shop_item_'.$value->id.'">
            <div class="item-img">
            <div class="border__btm"><img src="'.$img.'" style="height:100%;" /></div>
            <div class="shop-item-info">
            <div class="shop-item-name"><a href="#">'.$value->pro_title.' </a></div>
            <div class="shop-item-cate"><span>'.$value->name.'</span></div>
            </div>

            </div>
            <div class="item-mask">
            <div class="item-mask-detail">
            <div class="item-mask-detail-ele">
            <a class="select____btn">  <div class="checkbox m-0">
            <label class="p-0">
            <input type="checkbox" class="checkboxes" name="sel_pro[]" '.$checked.' id="sel_id_'.$value->id.'" value="'.$value->id.'" onclick="selectSingle('.$value->id.');" >
            <span class="cr"><i class="cr-icon fa fa-check"></i></span>Select</label>
            </div></a>

            </div>
            </div>
            </div>
            </div>

            </div>
            </li>  ';
            $k++;
        }
        if ($request->ajax()) {
            return $html;
        }
        return view('admin/select-product',compact('product_data','product_type','product_brand'));
    }


 public function publish_product(Request $request)
  {
        $pro_id='';
        $unque_brand='';
        if(session('member_id')!=''){
            $user_id=session('member_id');
            if($request->action=='add') {
            $save_status ='0';
            $pro_title=($request->input('pro_title')!='')?$request->input('pro_title'):'';
            $short_desc=($request->input('short_desc')!='')?$request->input('short_desc'):'';
            $pro_desc=($request->input('pro_desc')!='')?$request->input('pro_desc'):'';
            $pro_price='0';
            $pro_type=($request->input('pro_type')!='')?$request->input('pro_type'):'';
            $sub_cat=($request->input('sub_cat')!='')?$request->input('sub_cat'):'';
            $brand=($request->input('brand')!='')?$request->input('brand'):'';
            $add_date=date("Y-m-d");
            //brand check  exits
            $brand_check = DB::table('admin_brand')->where('user_id', '1')->where('name', $brand)->get();
            if(count($brand_check)==0){
            $last_brand=DB::table('admin_brand')->insertGetId(['user_id'=>'1','name'=>$brand] );
            }else{
            $brand_get = DB::table('admin_brand')->where('user_id', '1')->where('name', $brand)->first();
            $last_brand=$brand_get->brand_id;
            }

            //category check  exits
            if($pro_type!=''){
            $cat_check = DB::table('admin_type')->where('type_name', $pro_type)->get();
            if(count($cat_check)==0){
            $last_cat=DB::table('admin_type')->insertGetId(['user_id'=>$user_id,'type_name'=>$pro_type] );
            }else{
            $cat_get = DB::table('admin_type')->where('user_id', '1')->where('type_name', $pro_type)->first();
            $last_cat=$cat_get->type_id;
            }
            }else{
              $last_cat='';
            }
             $cub_category='';
             //subcategory check  exits
             if($sub_cat!=''){
            $cat_check2 = DB::table('admin_type')->where('type_name', $sub_cat)->get();
            if(count($cat_check2)==0){
            $last_cat=DB::table('admin_type')->insertGetId(['user_id'=>'1','type_name'=>$sub_cat] );
            }else{
            $cat_get = DB::table('admin_type')->where('type_name', $sub_cat)->first();
            $cub_category=$cat_get->type_id;
            }
            }else{
              $cub_category='';
            }

            $last_id=DB::table('products')->insertGetId(
            ['user_id' => $user_id,'save_status'=>$save_status,'pro_title'=>addslashes($pro_title),'pro_type'=>addslashes($last_cat),'sub_cat'=>$cub_category,'brand'=>addslashes($last_brand),'short_desc' => addslashes($short_desc),'pro_desc' => addslashes($pro_desc),'pro_price' => $pro_price,
            'status'=>'1','add_date'=>$add_date,'pro_image'=>'','prod_view'=>'0']  );

             //Add QTY and Price
            if($last_id!=''){
            $min_price='500000';
            for($i=1;$i<=5;$i++){
            $question = ($request->input('question_'.$i)!='')?$request->input('question_'.$i):'';
            $ans = ($request->input('ans_'.$i)!='')?$request->input('ans_'.$i):'';
            if($question!=''){
            $insert=DB::table('products_qty')->insertGetId(
            ['pro_id' => $last_id,'qty' => addslashes($question),'price' =>addslashes($ans)]);

            if($ans<$min_price){
            $min_price=$ans;
            }
            }
            }

            $last_id2=DB::table('products')->where('prod_id', $last_id)->update(['pro_price' => $min_price]);
            $proId='';
            //Add selected product
            $pre_sel = DB::table('users')->where('id', $user_id)->first();
            if($pre_sel->selected_product==''){
             $proId=$request->input('pro_id');
            }else{
               $proId=$pre_sel->selected_product.','.$request->input('pro_id');
            }

            $last_id4=DB::table('users')->where('id', $user_id)->update(['selected_product' => $proId]);

            //Effects
            for($k=1;$k<=5;$k++){
            $name = ($request->input('effects_title_'.$k)!='')?$request->input('effects_title_'.$k):'';
            $price = ($request->input('effects_per_'.$k)!='')?$request->input('effects_per_'.$k):'';
            $insert=DB::table('strain_attributes')->insertGetId(['prod_id' => $last_id,'type'=>'1','name' => addslashes($name),'percentage' =>addslashes($price)] );
            }


            //Image upload
            if($request->input('image_path')!=''){
             if(!is_dir('product_images/'.$last_id.'/')){
            mkdir('product_images/'.$last_id.'/', 0777, true);
            }
            $destinationPath='product_images/'.$last_id.'/';
            $oldPath = $request->input('image_path'); // publc/images/1.jpg
             $random_name=time().rand();
            $fileExtension = \File::extension($oldPath);
            $newName = $random_name.'.'.$fileExtension;
            $newPathWithName = $destinationPath.$newName;
            if (\File::copy($oldPath , $newPathWithName)) {
            $sql=DB::table('products')->where('prod_id', $last_id)->update(array('pro_image' => $newName));
            $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
            }
            }

                 //image 2
               if($request->input('image_path_2')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_2'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }
                //image 3
               if($request->input('image_path_3')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_3'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }
                //image 4
               if($request->input('image_path_4')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_4'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }
                //image 5
               if($request->input('image_path_5')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_5'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }
                //image 6
               if($request->input('image_path_6')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_6'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }

              //image 7
               if($request->input('image_path_7')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_7'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }

              //image 8
               if($request->input('image_path_8')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_8'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }

              //image 9
               if($request->input('image_path_9')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_9'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }

              //image 10
               if($request->input('image_path_10')!=''){
              $destinationPath='product_images/'.$last_id.'/';
              $oldPath = $request->input('image_path_10'); // publc/images/1.jpg
              $random_name=time().rand();
              $fileExtension = \File::extension($oldPath);
              $newName = $random_name.'.'.$fileExtension;
              $newPathWithName = $destinationPath.$newName;
              if (\File::copy($oldPath , $newPathWithName)) {
              $insert=DB::table('products_image')->insertGetId(['pro_id' => $last_id,'image' => addslashes($newName)]  );
              }
              }

         }


            $input = $request->input('pro_id');
            $list = $request->input('selected_id');
            $array1 = Array($input);
            $array2 = explode(',', $list);
            $array3 = array_diff($array2, $array1);

            $output = implode(',', $array3);
            if($output!=''){
            $again_loadId = explode(',', $output);
            //Reload again
            $pro_id='';
            $sel_pro=$again_loadId;
            $sel_product='';
            $query = DB::table('admin_products')
            ->join('admin_brand', 'admin_products.brand', '=', 'admin_brand.brand_id')
            ->join('admin_type', 'admin_products.product_type', '=', 'admin_type.type_id');
            for($k=0;$k<count($sel_pro);$k++){
            $pro_id.=$sel_pro[$k].',';
            $query->orWhere('admin_products.id','=', $sel_pro[$k]);
            }
            $sel_product=$query->get();
            $pro_id=rtrim($pro_id,',');
            }else{
              $sel_product='';
              $pro_id='';
            }
             Session::flash('success', 'Item successfully added to your menu.');
            return view('admin/publish-product',compact('sel_product','pro_id'));


          }else{
        if(count($request->preSel)>0) {
          $pro_id='';
        $sel_pro=$request->preSel;
        $sel_product='';
        $query = DB::table('admin_products')
        ->join('admin_brand', 'admin_products.brand', '=', 'admin_brand.brand_id')
        ->join('admin_type', 'admin_products.product_type', '=', 'admin_type.type_id');
        for($k=0;$k<count($sel_pro);$k++){
          $pro_id.=$sel_pro[$k].',';
        $query->orWhere('admin_products.id','=', $sel_pro[$k]);
        }
        $sel_product=$query->get();
        $pro_id=rtrim($pro_id,',');

        return view('admin/publish-product',compact('sel_product','pro_id'));
        } else{
        return  redirect()->to('admin/select-product');
        }
        }


        }else{
        return  redirect()->to('admin/login');
        }
  }

 /************************************Load Related Product***************************/

   public function relatedProduct(Request $request){
        $user_id=session('member_id');
        $pre_sel = DB::table('users')->where('id', $user_id)->first();

         $product_type = DB::table('admin_type')->where('parentid', 'NULL')->get();
        $product_brand=DB::table('admin_brand')->orderBy('name', 'asc')->get();

   $related_product = DB::table('products')->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0')->where('products.related_products', '=', '1')->get();


        $product_data='';
        $query='';

         $query = DB::table('products')
      ->where('products.user_id','=', $user_id)->where('products.save_status', '=', '0')->where('products.related_products', '!=', '1')
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
        //Remove pre selected product
        $all_related=0;
        $product_data=$query->paginate(12);
        $url = URL::to("/");
        $html='';
        $k=1;
        foreach ($product_data as $value) {
           $img='';
          if($value->pro_image==''){
            $img=$url.'/default.png';
          }else{
           $img=$url.'/product_images/'.$value->prod_id.'/'.$value->pro_image;
          }

        $html.=' <li>
        <div class="item-box">

        <div class="shop-item" id="shop_item_'.$value->prod_id.'">
        <div class="item-img">
        <div class="border__btm"><img id="pro_image_'.$value->prod_id.'" src="'.$img.'" style="height:100%;" /></div>
        <div class="shop-item-info">
        <div class="shop-item-name"><a href="#" id="pro_title_'.$value->prod_id.'"> '.$value->pro_title.'  </a></div>
        <div class="shop-item-cate"><span>'.$value->name.'</span></div>
        </div>
        </div>
        <div class="item-mask">
        <div class="item-mask-detail">
        <div class="item-mask-detail-ele">
        <a class="select____btn">  <div class="checkbox m-0">
        <label class="p-0">
        <input type="checkbox" class="checkboxes" name="sel_pro[]" id="sel_id_'.$value->prod_id.'" value="'.$value->prod_id.'" onclick="selectSingle('.$value->prod_id.');" >
        <span class="cr"><i class="cr-icon fa fa-check"></i></span>Select</label>
        </div></a>
        </div>
        </div>
        </div>
        </div>
        </div>
        </li>  ';
        $k++;
        }
        if ($request->ajax()) {
        return $html;
        }
        return view('admin/related-product',compact('product_data','product_type','product_brand','all_related','related_product'));
        }



      /**************************ADD Related product**************************/

      public function addRelatedPro(Request $request){
      $proId=($request->input('proId')!='')?$request->input('proId'):'';
      $sql=DB::table('products')->where('prod_id', $proId)->update(array('related_products' => '1'));
      return;
      }

      /**************************Remove Related product**************************/

      public function removeRelatedPro(Request $request){
      $proId=($request->input('proId')!='')?$request->input('proId'):'';
      $sql=DB::table('products')->where('prod_id', $proId)->update(array('related_products' => '0'));
      return;
      }


}


?>