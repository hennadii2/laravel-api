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
			<div class="col-xs-6 col-sm-3 plr-0"> </div>
			<div class="col-xs-6 col-sm-6 plr-0 hidden-xs">
				<div class="logo">
					@if (!empty(Session::has('member_logo')))
					<img src="{{URL::to('/')}}/profile/{{ Session::get('member_logo') }}"  class="" style="max-height:50px; margin-top:13px;" >
					@else
					<img src="{{URL::to('/')}}/admin/images/pro-avatar.png" class="" style="max-height:50px; margin-top:13px;" >
					@endif </div>
			</div>
			<div class="col-xs-6 col-sm-3 plr-0">
				<div class="right__author" style="margin-top: 13px;">
					<a href="{{URL::to('/')}}/{{ Session::get('member_name') }}" target="_blank" class="">
						<span>{{ Session::get('member_company') }} </span>
					</a>
					<p><small>Click to View Menu</small></p>
				</div>
			</div>
		</div>
	</div>
</header>
<nav class="main-menu">
	<div class="tt__left__menu">
		<ul>
			<li class="logo__head">
				<a href="{{URL::to('/')}}/admin/index" style="border-color:#22aa00 !important; background-color:transparent !important; ">
					<span class="tt__logo">
						<img src="{{URL::to('/')}}/admin/images/top-logo.png" srcset="{{URL::to('/')}}/admin/images/logo@2x.png 2x" alt="">
					</span>
				</a>
				<img src="{{URL::to('/')}}/admin/images/head_blur_bg.png" class="hidden-xs" style="position:fixed; top:0px; right:0px;" />
				<img src="{{URL::to('/')}}/admin/images/head_blur_bg_mini.png" class="visible-xs" style="position:fixed; top:0px; right:0px;" />

			</li>
			<li>
				<a href="{{URL::to('/')}}/admin/index" class="menu_top_margin {{ Request::is('admin/index') ? 'active' : '' }}">
					<span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/home.png" /></span> Home</a>
			</li>

			<li>
				<a data-toggle="collapse" data-target="#demo" class="
																	 {{ Request::is('admin/menu') ? 'active' : '' }}
																	 {{ Request::is('admin/saved-products') ? 'active' : '' }}
																	 {{ Request::is('admin/select-product') ? 'active' : '' }}
																	 {{ Request::is('admin/product_type') ? 'active' : '' }}
																	 {{ Request::is('admin/brand') ? 'active' : '' }}
																	 {{ Request::is('admin/publish-product') ? 'active' : '' }}
																	 {{ Request::is('admin/products') ? 'active' : '' }}
																	 {{ Request::is('admin/related-product') ? 'active' : '' }}
																	 {{ Request::is('admin/publish-related-product') ? 'active' : '' }}
																	 {{ Request::is('admin/page-contain') ? 'active' : '' }}

																	 {{ Request::is('admin/faq') ? 'active' : '' }}"><span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/menu.png" /></span> Manage Menu <i class="fal fa-chevron-down pull-right" style="margin-top: 8px;"></i></a>

				<div id="demo" class="collapse">
					<div class="parent___menu">
						<ul>
							<li><a href="{{URL::to('/')}}/admin/select-product"> Add Pre-Loaded Products</a></li>
							<li><a href="{{URL::to('/')}}/admin/related-product"> Set Related Products</a></li>
							<li><a href="{{URL::to('/')}}/admin/menu"> Add Products Manually</a></li>
							<li><a href="{{URL::to('/')}}/admin/products"> Edit Your Products</a></li>
							<li><a href="{{URL::to('/')}}/admin/saved-products"> Saved Products</a></li>
							<li><a href="{{URL::to('/')}}/admin/faq"> Product Page FAQs</a></li>
							<li><a href="{{URL::to('/')}}/admin/page-contain"> Page Content</a></li>

						</ul>
					</div>
				</div>
			</li>


			<li>
				<a href="{{URL::to('/')}}/admin/customers" class="{{ Request::is('admin/customers') ? 'active' : '' }} ">
					<span class="nav-icon"><i class="far fa-users fa-lg"></i></span> Customers</a>
			</li>


			<li>
				<a href="{{URL::to('/')}}/admin/orders" class="{{ Request::is('admin/orders') ? 'active' : '' }} ">
					<span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/customers.png" /></span> Orders</a>
			</li>

			<li>
				<a href="{{URL::to('/')}}/admin/reviews" class="{{ Request::is('admin/reviews') ? 'active' : '' }} ">
					<span class="nav-icon"><i class="far fa-comments fa-lg"></i></span> Reviews </a>
			</li>

			<li>
				<a href="{{URL::to('/')}}/admin/report" class="{{ Request::is('admin/report') ? 'active' : '' }} ">
					<span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/report.png" /></span> Reports</a>
			</li>


			<li>
				<a data-toggle="collapse" data-target="#demo1" class=""><span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/setting.png" /></span> Settings  <i class="fal fa-chevron-down pull-right" style="margin-top: 8px;"></i></a>
				<div id="demo1" class="collapse">
					<div class="parent___menu">
						<ul>
							<li><a href="{{URL::to('/')}}/admin/settings/business_settings.php?memberShip={{base64_encode(Session::get('member_id'))}}"> Business Settings</a></li>
							<li><a href="{{URL::to('/')}}/admin/settings/payment_information.php?memberShip={{base64_encode(Session::get('member_id'))}}"> Payment  Information</a></li>
							<li><a href="{{URL::to('/')}}/admin/settings/password.php?memberShip={{base64_encode(Session::get('member_id'))}}"> Password</a></li>

						</ul>
					</div>
				</div>
			</li>
			<li>
				<a href="{{URL::to('/')}}/{{ Session::get('member_name') }}" target="_blank" class="">
					<span class="nav-icon"><i class="fal fa-list-alt fa-lg"></i></span> View Menu</a>
			</li>
			<li><hr></li>
			<li>
				<a href="javascript:void(0);" onclick="olark('api.box.expand')" class="{{ Request::is('admin/help') ? 'active' : '' }}">
					<span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/help.png" /></span> Help</a>
			</li>
			<li>
				<a href="{{URL::to('/')}}/admin/logout"><span class="nav-icon"><img src="{{URL::to('/')}}/admin/images/icon/logout.png" /></span> Logout</a>
			</li>
		</ul>
	</div>
</nav>
<?php
$user_ids=Session::get('member_id');
$user_cus=DB::table('users')->where('id', '=', $user_ids)->first();
$cur_date=date("Y-m-d");
$date1=date_create($cur_date);
$date2=date_create($user_cus->exp_date);
$diff=date_diff($date1,$date2);
$date= $diff->format("%R%a");
$date2=str_replace("+","",$date);
if($user_cus->subscription_id==''){?>
<div class="alert alert-danger alert__position">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position: absolute;right: 11px;top: 6px; font-weight: bold; font-size: 16px;">X</button>
	<?php if($date2>0){ ?>
	<b><?php echo $date2; ?> Days Remaining</b> on your unlimited FREE trial. You can subscribe at any time before your trial ends -
	<a class="" href="/admin/settings/index.php?memberShip=<?php echo base64_encode ($user_ids); ?>" style="font-weight:700; text-transform:uppercase; color:#111 !important;">SUBSCRIBE TODAY! </a>

	<?php } else {?>
	Please subscribe to continue using topshelfmenu -
	<a class="" href="/admin/settings/index.php?memberShip=<?php echo base64_encode ($user_ids); ?>" style="font-weight:700; text-transform:uppercase; color:#111 !important;">SUBSCRIBE TODAY! </a>
	<?php }?>
</div>
<?php } ?>
<style>
	.alert__position {
	margin-left: 80px;
	position: relative;
	border-radius: 0px !important;
	padding: 8px 28px !important;
	top: 80px;
}
@media (max-width: 767px) {
	.alert__position {
		margin-left: 60px;
		padding: 8px 28px !important;
		top: 65px;
	}
}
.parent___menu {
	padding: 15px 0px 20px 74px !important;
	position: relative;
	top: 0px;
	background: #f4f4f4;
	border-top: 1px solid #ddd;
}
.parent___menu ul {
	margin: 0px;
	padding: 0px;
	display: list-item;
}
.parent___menu ul li {
	margin: 0px !important;
	padding: 0px !important;
	list-style: circle !important;
	line-height: 30px !important;
}
.parent___menu ul li a {
	font-size: 14px !important;
	line-height: 30px;
	height: 30px;
	padding: 0px 10px !important;
	border-left: none !important;
	background-color: transparent !important;
}
.parent___menu ul li a:hover {
	border-left: none !important;
	background-color: transparent !important;
}
</style>