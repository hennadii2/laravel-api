@include('front.z_header')
<link href="{{URL::to('/')}}/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/css/smooth-products.css?2" rel="stylesheet" />

</head>

<body>
@include('front.z_right_menu')
<?php
$dob='';
$month=1;
$year='';
$day=1;
if (isset($user_data->dob) && !empty($user_data->dob)){
if($user_data->dob!='1970-01-01' && $user_data->dob!='0000-00-00'){
$dob=explode("-",$user_data->dob);
$month=$dob[1];
$year=$dob[0];
$day=$dob[2];
}}
?>
<!-- Site Wraper -->
<div class="wrapper">

<!-- Header -->
@include('front.z_top')
<!-- End Header -->

<!-- CONTENT --------------------------------------------------------------------------------->
<!-- Intro Section -->
<section class="main_banner text-left border__bottom">
<div class="container">
<div class="row">
<div class="page-breadcrumb"> <a href="{{URL::to('/')}}/{{$user_name}}">Home</a>/<span>Checkout</span> </div>
</div>
</div>
<div class="clearfix"></div>
</section>

<!-- End Intro Section -->

<!-- Shop Item Detail Section -->
<section class="ptb ptb-sm-80" style="padding-bottom:20px !important;">
<div class="container">
<div class="row mt-30">
<div class="col-md-8">
@if (empty(Session::has('customer_id')))
<div class="heading_style_left"> <span class="title">Been Here Before?</span> </div>
<div class="tree-top-content">
<!-- Tab -->
@if (Session::has('login_error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('login_error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif

@if (Session::has('for_success'))
<div class="alert alert-success" id='errordiv'>{{ Session::get('for_success') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif
@if (Session::has('for_error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('for_error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif

<div class="tabs">
<ul>
<!--<li><a href="#tabs-2">New Customer</a></li> -->
<li><a href="#tabs-1">Returning Customer</a></li>
</ul>
<div class="ui-tab-content">

<div id="tabs-1">
<form method="POST" action="cus_login">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
<div class="col-md-6">
<div class="mb-15">
<label>Email Address <span class="text-danger">*</span></label>
<input type="email" name="email"  class="input-group-lg comm_input" placeholder="Email Address" required>

</div>

</div>

<div class="col-md-6">
<div class="mb-15">
<label>Password <span class="text-danger">*</span></label>
<input type="password" name="password"  class="input-group-lg comm_input" placeholder="Password" required>
</div>

</div>

</div>

<div class="mb-10"><a href="#popup_forgot_password" class="theme__color"><b>Forgot Password?</b></a></div><br/>

<input type="hidden" name="user_name" value="{{$user_name}}" >
<button type="submit" class="tt_submit_btn">Login</button>
</form>
</div>
</div>
</div>


</div>
@endif

<div class="heading_style_left"> <span class="title"> Checkout as guest</span> </div>
<div class="tree-top-content">
<form id="form-login"  role="form" method="POST" action="order_confirm" >
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="user_name" value="{{$user_name}}">
<div class="row">
<div class="col-md-6">
<div class="mb-25">
<label>First Name <span class="text-danger">*</span></label>
<input type="text" name="fname" class="input-group-lg comm_input" value="<?php if (isset($user_data->fname) && !empty($user_data->fname)){echo  $user_data->fname;}?>" placeholder="First Name *" required>
</div>
</div>
<div class="col-md-6">
<div class="mb-25">
<label>Last Name <span class="text-danger">*</span></label>
<input type="text" name="lname" class="input-group-lg comm_input" value="<?php if (isset($user_data->lname) && !empty($user_data->lname)){echo  $user_data->lname;}?>" placeholder="Last Name *" required>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="mb-25">
<label>Email Address <span class="text-danger">*</span></label>
<input type="email" name="email" class="input-group-lg comm_input" value="<?php if (isset($user_data->email) && !empty($user_data->email)){echo  $user_data->email;}?>" placeholder="Email Address *" required>
</div>
</div>
<div class="col-md-6">
<div class="mb-25">
<label>Phone Number <span class="text-danger">*</span></label>
<input type="text" name="phone" id="phone" class="input-group-lg comm_input" value="<?php if (isset($user_data->phone) && !empty($user_data->phone)){echo  $user_data->phone;}?>" placeholder="Phone Number *" required>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="mb-25">
<label>Address <span class="text-danger">*</span></label>
<input type="text" name="address" class="input-group-lg comm_input" value="<?php if (isset($user_data->address) && !empty($user_data->address)){echo  $user_data->address;}?>" placeholder="Address *" required>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="mb-25">
<label>Suite/Apartment No. </label>
<input type="text" name="apartment" class="input-group-lg comm_input" value="<?php if (isset($user_data->apartment) && !empty($user_data->apartment)){echo  $user_data->apartment;}?>" placeholder="Suite/Apartment No. *" >
</div>
</div>
<div class="col-md-6">
<div class="mb-25">
<label>City <span class="text-danger">*</span></label>
<input type="text" name="city" class="input-group-lg comm_input" value="<?php if (isset($user_data->city) && !empty($user_data->city)){echo  $user_data->city;}?>" placeholder="City *" required>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6">
<div class="mb-25">
<label>State <span class="text-danger">*</span></label>
<select name="state" class="cart_quantity" required>
<option value="">State *</option>
@foreach($state as $key => $value)
<option value="{{$value->name}}" <?php  if (isset($user_data->state) && !empty($user_data->state)){
if ($value->name ==$user_data->state) {echo 'selected="selected"'; }} ?>>{{$value->name}}</option>
@endforeach
</select>
</div>
</div>
<div class="col-md-6">
<div class="mb-25">
<label>Zip Code <span class="text-danger">*</span></label>
<input type="text" class="input-group-lg comm_input" name="zip_code" value="<?php if (isset($user_data->zip_code) && !empty($user_data->zip_code)){echo  $user_data->zip_code;}?>" placeholder="Zip Code *" required>
</div>
</div>
</div>

<div class="row">
<div class="col-md-6">
<div class="mb-25">
<label>Gender <span class="text-danger">*</span></label>
<select name="gender" class="cart_quantity" required>
<option value="Male" <?php  if (isset($user_data->gender) && !empty($user_data->gender)){
if ('Male'==$user_data->gender) {echo 'selected="selected"'; }} ?>>Male</option>

<option value="Female" <?php  if (isset($user_data->gender) && !empty($user_data->gender)){
if ('Female' ==$user_data->gender) {echo 'selected="selected"'; }} ?>>Female</option>

</select>
</div>
</div>
<div class="col-md-6">
<div class="mb-25">
<div class="row">
<div class="col-xs-4 p-r-5">

<label>Month<span class="text-danger">*</span></label>
<select name="month" class="cart_quantity" required>
<?php

for($k=1;$k<13;$k++){?>
<option value="<?php echo $k;?>" <?php  if (isset($month) && !empty($month)){
if ($k==$month) {echo 'selected="selected"'; }} ?>><?php echo $k;?></option>
<?php }?>


</select>
</div>
<div class="col-xs-4 p-l-5 p-r-5">
<label>Day<span class="text-danger">*</span></label>
<select name="day" class="cart_quantity" required>
<?php
for($ki=1;$ki<32;$ki++){?>
<option value="<?php echo $ki;?>" <?php  if (isset($day) && !empty($day)){
if ($ki==$day) {echo 'selected="selected"'; }} ?>><?php echo $ki;?></option>
<?php }?>
</select>
</div>
<div class="col-xs-4 p-l-5">
<label>Year<span class="text-danger">*</span></label>
<select name="year" class="cart_quantity" style="padding-right: 31px;" required>
<?php
for($ky=1930;$ky<2018;$ky++){?>
<option value="<?php echo $ky;?>" <?php  if (isset($year) && !empty($year)){
if ($ky==$year) {echo 'selected="selected"'; }} ?>><?php echo $ky;?></option>
<?php }?>
</select>
</div>
</div>



</div>
</div>
</div>
@if (empty(Session::has('customer_id')))
<div>Create Account <input type="checkbox" onclick="selectcheckBox();" value="1" name="set_password" id="set_password" style="appearance: checkbox; -webkit-appearance: checkbox;"/></div>
<hr />
<div class="row">
<div class="col-md-6" id="show_password" style="display: none;">
<div class="mb-25">
<label>Password <span class="text-danger">*</span></label>
<input type="password" name="password" class="input-group-lg comm_input" value="" placeholder="Password *" >
</div>
</div>

</div>
@endif
<div>
<button type="submit" class="tt_submit_btn">Submit Your Order</button>
</div>
</form>
</div>
</div>

<script>



function selectcheckBox(){
if(document.getElementById("set_password").checked == true){
$("#show_password").show();

}else{
$("#show_password").hide();
}
}
</script>
<div class="col-md-4">
<div class="heading_style_left"> <span class="title">Submit Your Order</span> </div>
<div class="tree-top-content">
<div class="table-responsive">
<table class="table">
<tbody>
<tr>
<th>Sub Total</th>
<td class="text-right">$<?php echo Cart::total(); ?></td>
</tr>
<tr>
<th>Total</th>
<td class="text-right">$<?php echo Cart::total(); ?></td>
</tr>
</tbody>
</table>
</div>
</div>
<div class="heading_style_left"> <span class="title">Item</span> <span class="edit____btn"></span> </div>
<!--<a id="menu-sidebar-list-icon" > <img src="{{URL::to('/')}}/images/icon-edit.png" height="14" width="51" alt="Edit" title="Edit" /> </a> </span> </div>
--> <div class="tree-top-content">
<?php foreach(Cart::content() as $row):
$size_id=($row->options->has('size') ? $row->options->size : '');
$proid=explode('@@@@@',$row->id);
if($size_id!=''){
$get_qty=DB::table('products_qty')->where('qty_id', '=', $size_id)->first();
$size=$get_qty->qty;
}else{
$size='';
}

$product_data = DB::table('products')->where('prod_id', '=', $proid[0])
->join('admin_brand', 'products.brand', '=', 'admin_brand.brand_id')
->first();
?>
<div class="row">
<div class="col-sm-5 col-xs-12">
<?php
if($product_data->pro_image!=''){?>
<img src="{{URL::to('/')}}/product_images/{{$product_data->prod_id}}/{{$product_data->pro_image}}">
 <?php }else {?>
<img src="{{URL::to('/')}}/default.png">
 <?php }?>
</div>
<div class="col-sm-7 col-xs-12">
<div class="item-box">
<!-- Shop item images -->

<div class="">
<div class="item-img">
<div class="shop-item-info" style="padding:0px !important;">
<div class="shop-item-name"><a href="{{URL::to('/')}}/{{$user_name}}/product-details/{{$product_data->prod_id}}"> <?php echo $row->name; ?> </a></div>
<div class="shop-item-cate"><span><?php echo $product_data->name;?></span></div>
<div class="td__price"> $<?php echo number_format($row->total,2); ?></div>
</div>
<hr/>
<div>Size:<span><?php echo $size;?></span></div>
<div>Qty: <span>1</span></div>
</div>
</div>


<!-- End Shop item images -->
</div>
</div>
</div>
<hr />
<?php endforeach;?>

</div>
</div>
</div>
</div>
</section>
<!-- End Shop Item Section -->

<div class="clearfix"></div>
@include('front.z_bottom')
</div>
<!-- Site Wraper End -->

@include('front.z_footer')
<script src="{{URL::to('/')}}/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/js/mediaelement-and-player.min.js"></script>
<script src="{{URL::to('/')}}/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<style>
select.cart_quantity {height: 46px; width: 100% !important;  max-width: 600px !important; font-size: 16px; margin-top: 0px; padding-right: 55px; padding-top: 0px !important;
padding-bottom: 0px !important; padding-left: 24px; color: #222222; outline: none; font-weight: 600;}
.table>tbody>tr>td, .table>tbody>tr>th{ border-top:none !important; border-bottom:1px solid #dddddd !important; padding-left:0px !important; padding-right:0px !important;}
.table-responsive { border:none !important;}
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script>
$(window).load(function()
{
var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-####"}];
$('#phone').inputmask({
mask: phones,
greedy: false,
definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
});
</script>

<!-- how it work popup -->
<div id="popup_forgot_password" class="overlay_forgot_password">
<div class="popup_forgot_password">
<h4>Forgot password</h4> <a class="close" href="#">×</a>
<p>Please enter your email address. You will receive a link to create a new password.</p>
<form id="form-login"  role="form" method="POST" action="cus_forgot_password" autocomplete="off">
<input type="hidden" name="user_name" value="{{$user_name}}" >
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="row">
<div class="col-md-10">
<div class="mb-20">
<input type="email" class="input-group-lg" style="width:100%;" required="" name="email" placeholder="Email Address">
</div>

<div class="mt-25 text-left">
<button type="submit" class="tt_submit_btn">Reset Password</button>
</div>
</div>
</div>
</form>


</div>
</div>
<style>

.overlay_forgot_password {
position: fixed;
top: 0;
bottom: 0;
left: 0;
right: 0;
background: rgba(0, 0, 0, 0.7);
transition: opacity 500ms;
visibility: hidden;
opacity: 0;
z-index:1100;
}
.overlay_forgot_password:target {
visibility: visible;
opacity: 1;
}

.popup_forgot_password {
margin: 50px auto;
padding: 20px;
background: #fff;
border-radius: 5px;
width: 35%;
position: relative;
transition: all 5s ease-in-out;
}

.popup_forgot_password h4 {
margin-top: 7px;
color: #333;
font-weight:600;
border-bottom:1px solid #eeeeee;
padding-bottom:12px;

}
.popup_forgot_password .close {
position: absolute;
top: 18px;
right: 30px;
transition: all 200ms;
font-size: 30px;
font-weight: bold;
text-decoration: none;
color: #333;
}
.popup_forgot_password .close:hover {
color: #22aa00;
}
.popup_forgot_password .content {
max-height: 30%;
overflow: auto;
}

@media screen and (max-width: 700px){
.popup_forgot_password{
width: 70%;
}
}

.p-l-5{  padding-left:5px !important;}
.p-r-5{  padding-right:5px !important;}
</style>
<!-- how it work popup -->
</body>
</html>