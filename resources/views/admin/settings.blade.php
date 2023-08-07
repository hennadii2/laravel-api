@include('admin.z_header')
<link href="{{URL::to('/')}}/admin/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/smooth-products.css?2" rel="stylesheet" />
</head>

<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('admin.z_top')
<!-- End Header -->

<div class="clearfix"></div>

<!-- Shop Item Detail Section -->
<section class="main__container">
<div class="">
<div class="page-breadcrumb"> <a href="{{URL::to('/')}}/admin/index">Account</a>/<span>Account Settings</span> </div>
<div class="row page__main__heading">
<div class="col-sm-12 col-sx-12">
<div>Settings</div>
</div>

</div>

<div style="background-color:#fff;">
<div class="row mt-30">
<div class="col-md-12">
<div class="tree-top-content">
<!-- Tab -->
<div class="tabs">
<ul>
<li><a href="#tabs-1">Business<br/> Settings</a></li>
<li><a href="#tabs-2" >Payment<br/> Information</a></li>
<li><a href="#tabs-3">Password</a></li>
</ul>
<div class="ui-tab-content">
@if (Session::has('error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif

@if (Session::has('success'))
<div class="alert alert-success" id='errordiv'>{{ Session::get('success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
@endif
<div id="tabs-1">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="left__content">
<div class="tt_green_text">UPDATING YOUR ACCOUNT</div>
<div class="tt_description_title">How it works?</div>
<p class="tt___content"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra sed ex a scelerisque. Curabitur sit amet purus fringilla, consectetur libero id, imperdiet turpis. Duis pellentesque enim sit amet arcu feugiat efficitur. Curabitur suscipit nulla tincidunt, efficitur erat quis, iaculis eros. Nam eu ex lacinia, rutrum elit et, dignissim justo. Nullam dapibus maximus nisi, quis congue quam venenatis et. </p>
</div>
</div>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="form__right__box">
<div class="form____title">Business Information</div>

<form class="" method="POST" role="form" id="form-profile" enctype="multipart/form-data" action="updateProfile">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
<div class="col-md-11">
<div class="mb-20">
<input type="text" class="input-group-lg full_input mb-5" name="company"   required value="{{$user_data->company}}" placeholder="Business Name" >
</div>
<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" required name="address"   value="{{$user_data->address}}" placeholder="Street Address 1"></div>
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5"  name="address2"   value="{{$user_data->address2}}" placeholder="Street Address 2"></div>
</div>
</div>

<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" required name="city"  value="{{$user_data->city}}" placeholder="City"></div>
<div class="col-sm-6 col-xs-12">
<div class="mb-25">
<select name="state" class="cart_quantity">
<option value="">State *</option>
@foreach($state as $key => $value)
<option value="{{$value->name}}" {{ $user_data->state == $value->name ? 'selected="selected"' : '' }}>{{$value->name}}</option>
@endforeach
</select>
</div>
</div>
</div>
</div>

<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" required name="zip_code"  value="{{$user_data->zip_code}}" placeholder="Zip Code"></div>
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" required name="website"  value="{{$user_data->website}}" placeholder="Website"></div>
</div>
</div>




  <div class="row mb-20">
  <div class="col-sm-7 col-xs-12">
  <div class="mb-10"><b>Upload Your Logo (recommended size 600x600)</b></div>
  <div class="input-group">
  <input type="file" name="image" id="files-input-upload" style="display:none">
  <input type="text" id="fake-file-input-name" disabled="disabled" placeholder="Choose File" class="input-group-lg browse___input">
  <span class="input-group-btn">
  <button id="fake-file-button-browse" type="button" class="btn browse___btn"> Browse </button>
  </span> </div>

  </div>
  </div>
<div class="mt-20 text-right">
  <button type="submit" class="btn___green">Save</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<script type="text/javascript">
document.getElementById('fake-file-button-browse').addEventListener('click', function() {
document.getElementById('files-input-upload').click();
});

document.getElementById('files-input-upload').addEventListener('change', function() {
document.getElementById('fake-file-input-name').value = this.value;

});
</script>
<style>
select.cart_quantity{height: 53px !important; max-width:600px; width: 100% !important;}
</style>
<div id="tabs-2">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="left__content">
<div class="tt_green_text">update payment Information</div>
<div class="tt_description_title">How it works?</div>
<p class="tt___content"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra sed ex a scelerisque. Curabitur sit amet purus fringilla, consectetur libero id, imperdiet turpis. Duis pellentesque enim sit amet arcu feugiat efficitur. Curabitur suscipit nulla tincidunt, efficitur erat quis, iaculis eros. Nam eu ex lacinia, rutrum elit et, dignissim justo. Nullam dapibus maximus nisi, quis congue quam venenatis et. </p>
</div>
</div>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="form__right__box" style="padding-top:90px; padding-bottom:60px;">
<div class="form____title">Update your credit card info below</div>
<form>
<div class="row">
<div class="col-md-11">

<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" placeholder="Name Holder"></div>
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" placeholder="CVV"></div>
</div>
</div>



<div style="background-color:#f4f4f4 !important; border:1px solid #ddd; padding:20px; margin-bottom:25px;">
<div class="mb-5"><b>Expiration</b></div>
<div class="row">
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" placeholder="Month"></div>
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" placeholder="Year"></div>
</div>
</div>

<div class="mb-20">
<div class="row">
<div class="col-sm-6 col-xs-12"><input type="text" class="input-group-lg full_input mb-5" placeholder="Billing Zip Code"></div>
</div>
</div>




<div class="mt-20 text-right">
  <button type="submit" class="btn___green">Save</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

<div id="tabs-3">
<div class="row">
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="left__content">
<div class="tt_green_text">Change password</div>
<div class="tt_description_title">How it works?</div>
<p class="tt___content"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. In viverra sed ex a scelerisque. Curabitur sit amet purus fringilla, consectetur libero id, imperdiet turpis. Duis pellentesque enim sit amet arcu feugiat efficitur. Curabitur suscipit nulla tincidunt, efficitur erat quis, iaculis eros. Nam eu ex lacinia, rutrum elit et, dignissim justo. Nullam dapibus maximus nisi, quis congue quam venenatis et. </p>
</div>
</div>
<div class="col-md-8 col-sm-6 col-xs-12">
<div class="form__right__box" style="padding-top:90px; padding-bottom:60px;">

<form class="" role="form" id="form-register"  action="upadtePassword" onSubmit="return validatePassFrm();" accept-charset="UTF-8" method="POST">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
<div class="col-md-8 col-md-offset-1">
<div class="form____title">Change your password below</div>
<div>
<div class="row">
<div class="col-xs-12">
<input  class="input-group-lg full_input mb-5" type="password" name="old_password" id="old_password" placeholder="Current Password">
<span id="old_password_error" style="color: red; display: none;"></span></div>
</div>
</div>
<div style="height:1px; margin:20px 0px 25px 0px; background-color:#ddd;"></div>
<div class="mb-20">
<div class="row">
<div class="col-xs-12"><input type="password" name="new_password" id="new_password" class="input-group-lg full_input mb-5" placeholder="New Password">
<span id="new_password_error" style="color: red; display: none;"></span>
</div>
</div>
</div>
<div class="mb-20">
<div class="row">
<div class="col-xs-12"><input type="password" name="con_password" id="con_password" class="input-group-lg full_input mb-5" placeholder="Confirm Password">
  <span id="con_password_error" style="color: red; display: none;"></span>
  </div>
</div>
</div>









<div class="mt-20 text-right">
  <button type="submit" class="btn___green" style="width:auto !important; padding:0px 30px;">Update Password</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
<!-- End Shop Item Section -->

<div class="clearfix"></div>
</div>
<!-- Site Wraper End -->

@include('admin.z_footer')
<script src="{{URL::to('/')}}/admin/js/owl.carousel.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/isotope.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/mediaelement-and-player.min.js"></script>
<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
<script src="{{URL::to('/')}}/admin/js/extra/password_val.js"></script>

</body>
</html>