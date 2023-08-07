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
<div class="form____title mb-0">Forgot password to Trees Pot Shop.</div>
<p class="color__80 mb-15">Please enter your email address. You will receive a link to create a new password..</p>
<form id="form-login"  role="form" method="POST" action="forgot" autocomplete="off">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="row">
<div class="col-md-11">
@if (Session::has('for_success'))
<div class="alert alert-success" id='errordiv'>{{ Session::get('for_success') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer; position: absolute; top: 5px; right: 23px;" >x</span></div>
@endif
@if (Session::has('for_error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('for_error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer; position: absolute; top: 5px; right: 23px;" >x</span></div>
@endif
<div class="mb-20">
<input type="email" class="input-group-lg full_input" required name="email" placeholder="Email Address" >
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


</body>
</html>