@include('customer.z_header')
  <link href="{{URL::to('/')}}/customer/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
  <link href="{{URL::to('/')}}/customer/css/smooth-products.css?2" rel="stylesheet" />
  </head>

  <body>
  <!-- Site Wraper -->
  <div class="wrapper"  style="overflow:hidden !important;">

  <div class="row">
  @include('customer.z_login_cover')

  <div class="col-md-8 col-sm-6 col-xs-12">
  <div class="right__form__outer">
  <div class="text-right">
  <span class="top_____right">Customer Panel</span>
  </div>

  <div class="form_____outer">
  <div class="form____title mb-0">Sign in to Trees Pot Shop.</div>
  <p class="color__80 mb-15">Enter your details below.</p>
  <form id="form-login"  role="form" method="POST" action="login">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="row">
  <div class="col-md-11">
  @if (Session::has('error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif


  <div class="mb-20">
  <input type="email" class="input-group-lg full_input" name="email" placeholder="Email Address" required >
  </div>
  <div class="mb-20">
  <input type="password" class="input-group-lg full_input" placeholder="Password"  name="password"  required >
  </div>
<!--  <a href="#" class="theme__color"><b>Forgot Password?</b></a> -->



  <div class="mt-20 text-center">
  <button type="submit" class="btn___green">Sign In</button>
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
    @include('customer.z_footer')
   <script src="{{URL::to('/')}}/customer/js/extra/common.js?22"></script> 

  </body>
  </html>