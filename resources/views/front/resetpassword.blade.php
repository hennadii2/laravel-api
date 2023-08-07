  @include('front.z_header')
  <link href="{{URL::to('/')}}/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
  <link href="{{URL::to('/')}}/css/smooth-products.css?2" rel="stylesheet" />
  </head>

  <body>
  @include('front.z_right_menu')

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
  <div class="page-breadcrumb"> <a href="{{URL::to('/')}}/{{$user_name}}">Home</a>/<span>Reset Password</span> </div>
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

  <div class="heading_style_left"> <span class="title">Reset Password?</span> </div>
  <div class="tree-top-content">
  <!-- Tab -->


@if (Session::has('for_success'))
<div class="alert alert-success" id='errordiv'>{{ Session::get('for_success') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif
@if (Session::has('for_error'))
<div class="alert alert-danger" id='errordiv'>{{ Session::get('for_error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
@endif

  <div class="tabs">
  <ul>
  <!--<li><a href="#tabs-2">New Customer</a></li> -->
  <li><a href="#tabs-1">Reset your password </a></li>
  </ul>
  <div class="ui-tab-content">

  <div id="tabs-1">
  <form method="POST" action="{{URL::to('/')}}/{{$user_name}}/resetpassword" onSubmit="return validateRePassFrm();" autocomplete="off">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <input type="hidden" name="forget_cupon" value="{{$forgot}}"   >
    <div class="row">
      <div class="col-md-6">
        <div class="mb-15">
         <label>New Password <span class="text-danger">*</span></label>
          <input type="password" name="new_password" id="new_password"  class="input-group-lg comm_input"  placeholder="New Password">
           <span id="new_password_error" style="color: red; display: none;"></span>
        </div>

      </div>

        <div class="col-md-6">
        <div class="mb-15">
                <label>Confirm Password <span class="text-danger">*</span></label>
               <input type="password" name="con_password" id="con_password" class="input-group-lg comm_input" placeholder="Confirm Password">
               <span id="con_password_error" style="color: red; display: none;"></span>
        </div>

      </div>

    </div>
    


      <input type="hidden" name="user_name" value="{{$user_name}}" >
        <button type="submit" class="tt_submit_btn">Reset Password</button>
  </form>
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
  <script src="{{URL::to('/')}}/js/extra/password_val.js?88"></script>
  <style>
  select.cart_quantity {height: 46px; width: 100% !important;  max-width: 600px !important; font-size: 16px; margin-top: 0px; padding-right: 55px; padding-top: 0px !important;
  padding-bottom: 0px !important; padding-left: 24px; color: #222222; outline: none; font-weight: 600;}
  .table>tbody>tr>td, .table>tbody>tr>th{ border-top:none !important; border-bottom:1px solid #dddddd !important; padding-left:0px !important; padding-right:0px !important;}
  .table-responsive { border:none !important;}
  </style>




<!-- how it work popup -->
  </body>
  </html>