@include('customer.z_header')
</head>

<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('customer.z_top')
<!-- End Header -->

<div class="clearfix"></div>
<section class="main__container">
<div style="background-color:#fff;" class="box__shadow">
<div class="table__main__title" style="line-height:18px; padding-bottom:12px !important;">Edit Profile</div>
<div class="row">
<form class="" role="form" id="form-register"  action="upadtePassword" onSubmit="return validatePassFrm();" accept-charset="UTF-8" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="col-md-5 col-sm-12 col-xs-12">
<div style="padding:30px;">

<!--chnage-password-->
<div class="heading_style_left mb-15"> <span class="title" style="font-size:16px !important;"> Change your password below</span> </div>
<div class="row">
@if (Session::has('pass_error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('pass_error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif

@if (Session::has('pass_success'))
<div class="alert alert-success" id='errordiv'>{{ Session::get('pass_success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
@endif
<div class="col-xs-12">
<label>Current Password <span class="text-danger">*</span> </label>
<input type="password" name="old_password" id="old_password" class="input-group-lg full_input mb-5" placeholder="Current Password">
<span id="old_password_error" style="color: red; display: none;"></span>
</div>
</div>
<div style="height:1px; margin:20px 0px 25px 0px; background-color:#ddd;"></div>
<div class="mb-20">
<div class="row">
<div class="col-xs-12">
<label>New Password <span class="text-danger">*</span> </label>
<input type="password" name="new_password" id="new_password" class="input-group-lg full_input mb-5" placeholder="New Password">
<span id="new_password_error" style="color: red; display: none;"></span>
</div>
</div>
</div>
<div class="mb-20">
<div class="row">
<div class="col-xs-12">
<label>Confirm Password <span class="text-danger">*</span> </label>
<input type="password" name="con_password" id="con_password" class="input-group-lg full_input mb-5" placeholder="Confirm Password">
<span id="con_password_error" style="color: red; display: none;"></span>
</div>
</div>
</div>
<!--chnage-password-->
  <div class="mt-20 text-right">
<button type="submit" class="btn___green">Update Password</button>
</div>
</div>
</div>
 </form>


<form class="" method="POST" role="form" id="form-profile" enctype="multipart/form-data" action="updateProfile">
<input type="hidden" name="_token" value="{{ csrf_token() }}">

<div class="col-md-7 col-sm-12 col-xs-12" style="border-left:1px solid #ddd;">
<div style="padding:30px; ">

<!--chnage-Contact info-->
<div class="heading_style_left mb-15"> <span class="title" style="font-size:16px !important;">Contact Info</span> </div>
<div class="row">
@if (Session::has('acc_error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('acc_error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif

@if (Session::has('acc_success'))
<div class="alert alert-success" id='errordiv'>{{ Session::get('acc_success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
@endif
<div class="col-md-12">
<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12">
<label>First Name <span class="text-danger">*</span> </label>
<input type="text" name="fname"    value="{{$user_data->fname}}" class="input-group-lg full_input mb-5" placeholder="First Name *" required >
</div>
<div class="col-sm-6 col-xs-12">
<label>Last Name <span class="text-danger">*</span> </label>
<input type="text" name="lname" value="{{$user_data->lname}}" class="input-group-lg full_input mb-5" placeholder="Last Name *" required>
</div>
</div>
</div>
<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12">
<label>Email Address <span class="text-danger">*</span> </label>
<input type="text" name="email" value="{{$user_data->email}}" class="input-group-lg full_input mb-5" placeholder="Email Address *" required >
</div>
<div class="col-sm-6 col-xs-12">
<label>Phone Number <span class="text-danger">*</span> </label>
<input type="text" name="phone" value="{{$user_data->phone}}" class="input-group-lg full_input mb-5" placeholder="Phone Number *" required>
</div>
</div>
</div>
<div class="mb-20">
<div class="row">
<div class="col-xs-12">
<label>Address <span class="text-danger">*</span> </label>
<input type="text" name="address" value="{{$user_data->address}}" class="input-group-lg full_input mb-5" placeholder="Address *" required >
</div>
</div>
</div>
<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12">
<label>Suite/Apartment No.  </label>
<input type="text" name="apartment" value="{{$user_data->apartment}}" class="input-group-lg full_input mb-5" placeholder="Suite/Apartment No. " >
</div>
<div class="col-sm-6 col-xs-12">
<label>City <span class="text-danger">*</span> </label>
<input type="text" name="city" class="input-group-lg full_input mb-5" value="{{$user_data->city}}" placeholder="City *" required>
</div>
</div>
</div>
<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12">
<div class="mb-25">
<label>State <span class="text-danger">*</span> </label>
<select name="state" class="cart_quantity" required>
<option value="">State *</option>
      @foreach($state as $key => $value)
<option value="{{$value->name}}" <?php  if (isset($user_data->state) && !empty($user_data->state)){
  if ($value->name ==$user_data->state) {echo 'selected="selected"'; }} ?>>{{$value->name}}</option>
@endforeach
</select>
</div>
</div>
<div class="col-sm-6 col-xs-12">
<label>Zip Code <span class="text-danger">*</span> </label>
<input type="text" name="zip_code"  class="input-group-lg full_input mb-5" value="{{$user_data->zip_code}}" placeholder="Zip Code *" required>
</div>
  <div class="col-xs-12 mt-20">
  <div class="row mb-20">
  <div class="col-sm-7 col-xs-12">

  <div class="input-group">
  <input type="file" name="image" id="files-input-upload" style="display:none">
  <input type="text" id="fake-file-input-name" disabled="disabled" placeholder="Choose File" class="input-group-lg browse___input">
  <span class="input-group-btn">
  <button id="fake-file-button-browse" type="button" class="btn browse___btn"> Browse </button>
  </span> </div>

  </div>
  </div>
  </div>

</div>
</div>
<div class="mt-20 text-right">
<button type="submit" class="btn___green">Update Profile</button>
</div>
</div>
</div>
<!--chnage-Contact info-->

</div>
<style>
select.cart_quantity{height: 53px !important; max-width:600px; width: 100% !important;}
</style>
</div>
</form>
</div>
</div>
</section>
</div>
<!-- Site Wraper End -->
 <script type="text/javascript">
document.getElementById('fake-file-button-browse').addEventListener('click', function() {
document.getElementById('files-input-upload').click();
});

document.getElementById('files-input-upload').addEventListener('change', function() {
document.getElementById('fake-file-input-name').value = this.value;

});
</script>
@include('customer.z_footer')
<link href="{{URL::to('/')}}/customer/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
<script src="{{URL::to('/')}}/customer/js/extra/password_val.js?22"></script>
<script src="{{URL::to('/')}}/customer/js/extra/common.js?22"></script>
</body>
</html>