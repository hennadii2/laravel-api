<!-- Preloader -->
<section id="preloader">
<div class="loader" id="loader">
<div class="loader-img"></div>
</div>
</section>
<!-- End Preloader -->

<header id="header" class="header">
<div class="header-inner" style="padding:0px !important;">
<div class="row" style="margin:0px; padding:0px;">

<div class="col-xs-12 plr-0">
<div class="right__author">
<a href="#">
<span>{{ Session::get('customer_fname') }} {{ Session::get('customer_lname') }}</span>
<span>

@if (!empty(Session::has('customer_logo')))
<img src="{{URL::to('/')}}/member_img/{{ Session::get('customer_logo') }}"  class="img-circle" >
@else
<img src="{{URL::to('/')}}/customer/images/pro-avatar.png" class="img-circle" >
@endif
</span>
</a>
</div>
</div>
</div>
</div>
</header>
<style>
</style>
<nav class="main-menu">
<div class="tt__left__menu">
<ul>
<li class="logo__head">
<a href="{{URL::to('/')}}/customer/index" style="border-color:#22aa00 !important; background-color:transparent !important; ">
<span class="tt__logo">
<img src="{{URL::to('/')}}/customer/images/logo.png?3"  />
</span>
</a>
<img src="{{URL::to('/')}}/customer/images/head_blur_bg.png" class="hidden-xs" style="position:fixed; top:0px; right:0px;" />
<img src="{{URL::to('/')}}/customer/images/head_blur_bg_mini.png" class="visible-xs" style="position:fixed; top:0px; right:0px;" />

</li>
<li><a href="{{URL::to('/')}}/customer/index" class="menu_top_margin
{{ Request::is('customer/index') ? 'active' : '' }}
{{ Request::is('customer') ? 'active' : '' }}
"><span class="nav-icon"><img src="{{URL::to('/')}}/customer/images/icon/home.png" /></span> Dashboard</a></li>
<li><a href="{{URL::to('/')}}/customer/edit-profile" class="{{ Request::is('customer/edit-profile') ? 'active' : '' }} "><span class="nav-icon"><img src="{{URL::to('/')}}/customer/images/icon/setting.png" /></span> Edit Profile</a></li>
<li><a href="{{URL::to('/')}}/customer/logout"><span class="nav-icon"><img src="{{URL::to('/')}}/customer/images/icon/logout.png" /></span> Logout</a></li>
</ul>
</div>
</nav>

