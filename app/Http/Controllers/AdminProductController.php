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
//use Illuminate\Mail\Mailer;
//use Mail;
//use App\User;

class AdminProductController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
    /***********************************Save simple product*****************************/
    public function productSave(Request $request)
    {
    if(session('admin_id')!=''){
    $totalInvoice = ($request->input('totalInvoice')!='0')?$request->input('totalInvoice'):'1';
    $user_id = session('admin_id');
    $save_status = ($request->input('save_status')!='')?$request->input('save_status'):'0';

    $pro_title = ($request->input('pro_title')!='')?$request->input('pro_title'):'';
    $short_desc =($request->input('short_desc')!='')?$request->input('short_desc'):'';
    $pro_desc =($request->input('pro_desc')!='')?$request->input('pro_desc'):'';
    $pro_price ='0';
    $pro_type = ($request->input('pro_type')!='')?$request->input('pro_type'):'';
    $sub_cat = ($request->input('sub_cat')!='Select')?$request->input('sub_cat'):'';
    $brand = ($request->input('brand')!='')?$request->input('brand'):'';
    $add_date=date("Y-m-d");
    $last_id=DB::table('admin_products')->insertGetId(
    ['pro_title'=>addslashes($pro_title),'product_type'=>addslashes($pro_type),'sub_cat'=>addslashes($sub_cat),'brand'=>addslashes($brand),'short_description' => addslashes($short_desc),'long_description' => addslashes($pro_desc),'status'=>'1','add_date'=>$add_date,'image'=>''] );
    if($last_id!=''){
    for($i=1;$i<=$totalInvoice;$i++){
    $question = ($request->input('question_'.$i)!='')?$request->input('question_'.$i):'';
    $ans = ($request->input('ans_'.$i)!='')?$request->input('ans_'.$i):'';
    if($question!=''){
    $last_id8=DB::table('admin_products')->where('id', $last_id)->update(['quantity_'.$i => $question,'price_'.$i => $ans,]);

    }
    }
    //medical benifiate
    for($k=1;$k<=5;$k++){
    $name = ($request->input('effects_title_'.$k)!='')?$request->input('effects_title_'.$k):'';
    $price = ($request->input('effects_per_'.$k)!='')?$request->input('effects_per_'.$k):'';
    $last_id2=DB::table('admin_products')->where('id', $last_id)->update(['effects_title_'.$k => $name,'effects_per_'.$k => $price]);
    }

    $images=array();
    if($files=$request->file('images')){
    if(!is_dir('admin_product_image/'.$last_id.'/')){
    mkdir('admin_product_image/'.$last_id.'/', 0777, true);
    }
    $destinationPath='admin_product_image/'.$last_id.'/';
    $k=1;
    foreach($files as $file){
    $random_name='';
    $filename='';
    $random_name=time().rand();
    $extension=$file->getClientOriginalExtension();
    $filename=$random_name.'.'.$extension;
    $file->move($destinationPath,$filename);
    if($k==1){
    $img='image';
    }else{
    $img='image_'.$k;
    }
    if($k<11){
    $sql=DB::table('admin_products')->where('id', $last_id)->update(array($img => $filename));
    }

    $k++;
    }
    }

    }
    if($save_status=='0'){
    Session::flash('success', 'Product has been added successfully.');

    }else{
    Session::flash('success', 'Product has been save successfully.');
    }
    return  redirect()->to('/super_admin/menu');

    }else{
    return  redirect()->to('super_admin/login');
    }
    }



  /***********************************Save related product*****************************/
    public function relatedProductSave(Request $request)
    {
    if(session('admin_id')!=''){
    $totalInvoice = ($request->input('totalInvoice')!='0')?$request->input('totalInvoice'):'1';
    $user_id = session('admin_id');
    $save_status = ($request->input('save_status')!='')?$request->input('save_status'):'0';

    $pro_title = ($request->input('pro_title')!='')?$request->input('pro_title'):'';
    $short_desc =($request->input('short_desc')!='')?$request->input('short_desc'):'';
    $pro_desc =($request->input('pro_desc')!='')?$request->input('pro_desc'):'';
    $pro_price ='0';
    $pro_type = ($request->input('pro_type')!='')?$request->input('pro_type'):'';
    $brand = ($request->input('brand')!='')?$request->input('brand'):'';
    $add_date=date("Y-m-d");
    $last_id=DB::table('admin_related_products')->insertGetId(
    ['pro_title'=>addslashes($pro_title),'product_type'=>addslashes($pro_type),'brand'=>addslashes($brand),'short_description' => addslashes($short_desc),'long_description' => addslashes($pro_desc),'status'=>'1','add_date'=>$add_date,'image'=>''] );
    if($last_id!=''){
    for($i=1;$i<=$totalInvoice;$i++){
    $question = ($request->input('question_'.$i)!='')?$request->input('question_'.$i):'';
    $ans = ($request->input('ans_'.$i)!='')?$request->input('ans_'.$i):'';
    if($question!=''){
    $last_id8=DB::table('admin_related_products')->where('id', $last_id)->update(['quantity_'.$i => $question,'price_'.$i => $ans,]);

    }
    }
    //medical benifiate
    for($k=1;$k<=5;$k++){
    $name = ($request->input('effects_title_'.$k)!='')?$request->input('effects_title_'.$k):'';
    $price = ($request->input('effects_per_'.$k)!='')?$request->input('effects_per_'.$k):'';
    $last_id2=DB::table('admin_related_products')->where('id', $last_id)->update(['effects_title_'.$k => $name,'effects_per_'.$k => $price]);
    }
    //medical benifiate
    for($i=1;$i<=5;$i++){
    $name = ($request->input('medical_title_'.$i)!='')?$request->input('medical_title_'.$i):'';
    $price = ($request->input('medical_per_'.$i)!='')?$request->input('medical_per_'.$i):'';
    $last_id2=DB::table('admin_related_products')->where('id', $last_id)->update(['medical_title_'.$i => $name,'medical_per_'.$i => $price]);
    }
    //medical benifiate
    for($i=1;$i<=5;$i++){
    $name = ($request->input('negatives_title_'.$i)!='')?$request->input('negatives_title_'.$i):'';
    $price = ($request->input('negatives_per_'.$i)!='')?$request->input('negatives_per_'.$i):'';
    $last_id2=DB::table('admin_related_products')->where('id', $last_id)->update(['negative_title_'.$i => $name,'negative_per_'.$i => $price]);
    }
    $images=array();
    if($files=$request->file('images')){
    if(!is_dir('admin_product_image/'.$last_id.'/')){
    mkdir('admin_product_image/'.$last_id.'/', 0777, true);
    }
    $destinationPath='admin_product_image/'.$last_id.'/';
    $k=1;
    foreach($files as $file){
    $random_name='';
    $filename='';
    $random_name=time().rand();
    $extension=$file->getClientOriginalExtension();
    $filename=$random_name.'.'.$extension;
    $file->move($destinationPath,$filename);
    if($k==1){
    $img='image';
    }else{
    $img='image_'.$k;
    }
    if($k<11){
    $sql=DB::table('admin_related_products')->where('id', $last_id)->update(array($img => $filename));
    }

    $k++;
    }
    } 
    }
    if($save_status=='0'){
    Session::flash('success', 'Product has been added successfully.');

    }else{
    Session::flash('success', 'Product has been save successfully.');
    }
    return  redirect()->to('/super_admin/related_products');

    }else{
    return  redirect()->to('super_admin/login');
    }
    }


  public function productCSVSave(Request $request)
    {
    if(session('admin_id')!=''){
    $user_id = session('admin_id');
    $file=Input::file('images');
    $random_name=time();
    if(!is_dir('admin_product_csv/')){
    mkdir('admin_product_csv/', 0777, true);
    }
    $destinationPath='admin_product_csv/';
    $extension=$file->getClientOriginalExtension();
    $filename=$random_name.'.'.$extension;
    $uploadSuccess=Input::file('images')->move($destinationPath,$filename);

    $fileD = fopen($destinationPath.$filename,"r");
    $column=fgetcsv($fileD);
    while(!feof($fileD)){
    $rowData[]=fgetcsv($fileD);
    }
    $add_date=date("Y-m-d");
    foreach ($rowData as $key => $value) {

     if($value[0]!='' && $value[2]!='' && $value[1]!=''){
    //brand check  exits
    $brand_check = DB::table('admin_brand')->where('user_id', $user_id)->where('name', trim($value[2]))->get();
    if(count($brand_check)==0){
    $last_brand=DB::table('admin_brand')->insertGetId(['user_id'=>$user_id,'name'=>trim($value[2])] );
    }else{
    $brand_get = DB::table('admin_brand')->where('user_id', $user_id)->where('name', trim($value[2]))->first();
    $last_brand=$brand_get->brand_id;
    }

    //category check  exits
    $cat_check = DB::table('admin_type')->where('user_id', $user_id)->where('type_name', trim($value[1]))->get();
    if(count($cat_check)==0){
    $last_cat=DB::table('admin_type')->insertGetId(['user_id'=>$user_id,'type_name'=>trim($value[1])] );
    }else{
    $cat_get = DB::table('admin_type')->where('user_id', $user_id)->where('type_name', trim($value[1]))->first();
    $last_cat=$cat_get->type_id;
    }

    $last_id=DB::table('admin_products')->insertGetId(
    ['pro_title'=>addslashes($value[0]),'product_type'=>addslashes($last_cat),'sub_cat'=>'',
    'brand'=>addslashes($last_brand),'short_description' => addslashes($value[3]),
    'long_description' => addslashes($value[4]),
    'quantity_1' => addslashes($value[6]),
    'price_1' => addslashes($value[7]),
    'quantity_2' => addslashes($value[8]),
    'price_2' => addslashes($value[9]),
    'quantity_3' => addslashes($value[10]),
    'price_3' => addslashes($value[11]),
    'quantity_4' => addslashes($value[12]),
    'price_4' => addslashes($value[13]),
    'quantity_5' => addslashes($value[14]),
    'price_5' => addslashes($value[15]),
    'effects_title_1' => addslashes($value[16]),
    'effects_per_1' => addslashes($value[17]),
    'effects_title_2' => addslashes($value[18]),
    'effects_per_2' => addslashes($value[19]),
    'effects_title_3' => addslashes($value[20]),
    'effects_per_3' => addslashes($value[21]),
    'effects_title_4' => addslashes($value[22]),
    'effects_per_4' => addslashes($value[23]),
    'effects_title_5' => addslashes($value[24]),
    'effects_per_5' => addslashes($value[25]),
    'status'=>'1',
    'add_date'=>$add_date,'image'=>''] );

   //Image upload
    if(trim($value[5])!=''){
    $image=$value[5];
     if(!is_dir('admin_product_image/'.$last_id.'/')){
    mkdir('admin_product_image/'.$last_id.'/', 0777, true);
    }
    $destinationPath='admin_product_image/'.$last_id.'/';
    $oldPath = trim($image); // publc/images/1.jpg
    $random_name=time().rand();
    $fileExtension = \File::extension($oldPath);
    $newName = $random_name.'.'.$fileExtension;
    $newPathWithName = $destinationPath.$newName;
    if (\File::copy($oldPath , $newPathWithName)) {
    $sql=DB::table('admin_products')->where('id', $last_id)->update(array('image' => $newName));
    }

    }else{
     // $image='https://topshelfmenu.us/default.png';
    }



   }
   }
    Session::flash('success', 'Product has been uploaded successfully.');
    return  redirect()->to('/super_admin/menu');
  }else{
  return  redirect()->to('super_admin/login');
  }
  }

}


?>