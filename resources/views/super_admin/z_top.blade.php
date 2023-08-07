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
<span>{{ Session::get('admin_fname') }} {{ Session::get('admin_lname') }}</span>

@if (!empty(Session::has('admin_logo')))
<img src="{{URL::to('/')}}/super_admin_img/{{ Session::get('admin_logo') }}"  class="img-circle" >
@else
<img src="{{URL::to('/')}}/admin/images/pro-avatar.png" class="img-circle" >
@endif


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
<a href="{{URL::to('/')}}/super_admin/index" style="border-color:#22aa00 !important; background-color:transparent !important; ">
<span class="tt__logo">
<img src="{{URL::to('/')}}/admin/images/logo.png"  />
</span>
</a>
<img src="{{URL::to('/')}}/admin/images/head_blur_bg.png" class="hidden-xs" style="position:fixed; top:0px; right:0px;" />
<img src="{{URL::to('/')}}/admin/images/head_blur_bg_mini.png" class="visible-xs" style="position:fixed; top:0px; right:0px;" />

</li>
<li><a href="{{URL::to('/')}}/super_admin/index" class="menu_top_margin
{{ Request::is('super_admin/index') ? 'active' : '' }} ">
<span class="nav-icon">
<img src="{{URL::to('/')}}/admin/images/icon/home.png" /></span> Home</a></li>


<li><a data-toggle="collapse" data-target="#demo" class="
{{ Request::is('super_admin/menu') ? 'active' : '' }}
{{ Request::is('super_admin/product_type') ? 'active' : '' }}
{{ Request::is('super_admin/brand') ? 'active' : '' }}
{{ Request::is('super_admin/related_products') ? 'active' : '' }}
"><span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/menu.png" /></span> Add Products <i class="fa fa-fw fa-plus pull-right" style="margin-top: 8px;"></i></a>

<div id="demo" class="collapse">
<div class="parent___menu">
<ul>

<li><a href="{{URL::to('/')}}/super_admin/menu"><i class="fa fa-fw fa-caret-right"></i> Add Products</a></li>

<li><a href="{{URL::to('/')}}/super_admin/product_type"><i class="fa fa-fw fa-caret-right"></i> Product Categories</a></li>
<li><a href="{{URL::to('/')}}/super_admin/brand"><i class="fa fa-fw fa-caret-right"></i> Brand</a></li>


</ul>
</div>
</div>
</li>

<li><a href="{{URL::to('/')}}/super_admin/edit-profile" class="{{ Request::is('super_admin/edit-profile') ? 'active' : '' }} "><span class="nav-icon"><img src="{{URL::to('/')}}/customer/images/icon/setting.png" /></span> Edit Profile</a></li>

<li><a href="{{URL::to('/')}}/super_admin/logout"><span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/logout.png" /></span> Logout</a></li>
</ul>
</div>
</nav>

<style>
.parent___menu{ margin:0px 0px 0px 70px !important; padding:0px; position:relative; top:-10px;}
.parent___menu ul { margin:0px; padding:0px;  display:list-item;}
.parent___menu ul li{ margin:0px !important; padding:0px !important; list-style:circle !important; line-height:30px !important;}
.parent___menu ul li a{ font-size:14px !important; line-height:0px; padding:5px 10px !important;}
</style>