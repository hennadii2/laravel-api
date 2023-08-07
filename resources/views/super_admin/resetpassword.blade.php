@include('admin.z_header')
<link href="{{URL::to('/')}}/admin/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/smooth-products.css?2" rel="stylesheet" />
</head>

<body>
<!-- Site Wraper -->
<div class="wrapper"  style="overflow:hidden !important;">

<div class="row">
@include('admin.z_login_cover')

<div class="col-md-8 col-sm-6 col-xs-12">
<div class="right__form__outer">
<div class="text-right">
<span class="top_____right">Already have an account?</span><a href="{{URL::to('/')}}/admin/login" class="btn__white__border">Sign In</a>
</div>

<div class="form_____outer">
<div class="form____title mb-0">Reset password to Trees Pot Shop.</div>

<form id="form-login"  role="form" method="POST" action="{{URL::to('/')}}/admin/resetpassword" onSubmit="return validateRePassFrm();" autocomplete="off">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
<div class="col-md-11">
@if (Session::has('for_error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('for_error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif
<div class="mb-20">
<input type="hidden" name="forget_cupon" value="{{$forgot}}"   >
<input type="password" name="new_password" id="new_password" class="input-group-lg full_input"  placeholder="New Password" >
<span id="new_password_error" style="color: red; display: none;"></span>
</div>

<div class="mb-20">
<input type="password" name="con_password" id="con_password" class="input-group-lg full_input"  placeholder="Confirm Password" >
<span id="con_password_error" style="color: red; display: none;"></span>
</div>


<div class="mt-20 text-center">
<button type="submit" class="btn___green">Reset Password</button>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>

<div class="clearfix"></div>
</div>
<!-- Site Wraper End -->
@include('admin.z_footer')
<script src="{{URL::to('/')}}/admin/js/extra/password_val.js?88"></script>

</body>
</html>