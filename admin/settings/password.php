<?php
include "config/config.php";
error_reporting(0);
$status_pay='';


if($_POST['update_password']=='update_password'){
	$select=$db->query("SELECT * from `".USERS_TBL."` where id='".$_POST['edit_id']."' and password='".md5($_POST['old_password'])."' ");
	$rows=$select->rowCount();
	if($rows>0){
		$sql = "UPDATE `".USERS_TBL."` SET
password='".md5($_POST['new_password'])."'
where `id`='".$_POST['edit_id']."'   ";
		$stmt = $db->prepare($sql);
		$stmt->execute();
		$_SESSION['msg_left'] = "Your password  has been updated successfully.";
	}else{
		$_SESSION['msg_left'] = "Current password does not match.";
	}
	echo "<script>window.location='password.php?memberShip=".base64_encode($_POST['edit_id'])."';</script>";  exit;
}
$cur_date=date("Y-m-d");
$getUserInfo=getTableIdValue(USERS_TBL,"where `id`='".base64_decode($_GET['memberShip'])."' and `exp_date`>'".$cur_date."' ",'*',$db);

if($getUserInfo['id']==''){
	echo '<script>window.location.href = "http://topshelfmenu.us/admin/settings/index.php?memberShip='.$_GET['memberShip'].'";</script>';   exit;
}

?>
<?php function curPageName() {
	return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
$page  = curPageName();?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>Payment Settings | Top Shelf Menu</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- CSS -->
		<link href="/public/admin/css/style.css" rel="stylesheet" type="text/css" />
		<link href="/public/admin/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="/public/admin/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<link href="/public/admin/css/sidebar-menu.css" rel="stylesheet" type="text/css" />

		<link href="/public/admin/css/jquery-ui.css" rel="stylesheet" type="text/css" />
		<link href="/public/admin/css/smooth-products.css" rel="stylesheet" />

		<link rel="apple-touch-icon" sizes="180x180" href="https://topshelf.us/wp-content/uploads/fbrfg/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="https://topshelf.us/wp-content/uploads/fbrfg/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="https://topshelf.us/wp-content/uploads/fbrfg/favicon-16x16.png">
		<link rel="manifest" href="https://topshelf.us/wp-content/uploads/fbrfg/manifest.json">
		<link rel="mask-icon" href="https://topshelf.us/wp-content/uploads/fbrfg/safari-pinned-tab.svg" color="#000000">
		<link rel="shortcut icon" href="https://topshelf.us/wp-content/uploads/fbrfg/favicon.ico">
		<meta name="msapplication-config" content="https://topshelf.us/wp-content/uploads/fbrfg/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">

		<!-- Font Awesome 5 -->
		<script src="/admin/js/fontawesome-all.js"></script>
		<script src="/admin/js/fa-v4-shims.min.js"></script>

		<script>
			function siteUrl(path,url) {
				location.href = 'https://topshelfmenu.us/members/'+path+'/'+url;
			}
		</script>
	</head>

	<body>
		<!-- Site Wraper -->
		<div class="wrapper">
			<!-- Header -->
			<!-- Preloader -->
			<section id="preloader">
				<div class="loader" id="loader">
					<div class="loader-img"></div>
				</div>
			</section>
			<!-- End Preloader -->
			<!-- End Preloader -->
			<header id="header" class="header">
				<div class="header-inner" style="padding:0px !important;">
					<div class="row" style="margin:0px; padding:0px;">

						<div class="col-xs-12 plr-0">
							<div class="right__author" style="margin-top: 13px;">
								<a href="#">
									<span><?php echo $getUserInfo['company'];?> </span>
									<p><small>Click to View Menu</small></p>
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
							<a href="javascript:void();" onclick="siteUrl('1','<?php echo  $getUserInfo['id'];?>');" style="border-color:#22aa00 !important; background-color:transparent !important; ">
								<span class="tt__logo">
									<img src="/admin/images/top-logo.png" srcset="/admin/images/logo@2x.png 2x" alt="">
								</span>
							</a>
						</li>
						<li><a href="javascript:void();" onclick="siteUrl('1','<?php echo  $getUserInfo['id'];?>');" class="menu_top_margin">
							<span class="nav-icon"><img src="/public/admin/images/icon/home.png" /></span> Home</a></li>

						<li><a data-toggle="collapse" data-target="#demo3" class="">
							<span class="nav-icon"><img src="https://topshelfmenu.us/admin/images/icon/menu.png" /></span> Manage Menu
							<i class="fal fa-chevron-down pull-right" style="margin-top: 8px;"></i></a>

							<div id="demo3" class="collapse">
								<div class="parent___menu">
									<ul>
										<li><a href="javascript:void();" onclick="siteUrl('2','<?php echo  $getUserInfo['id'];?>');"> Add Pre-Loaded Products</a></li>
										<li><a href="javascript:void();" onclick="siteUrl('3','<?php echo  $getUserInfo['id'];?>');"> Set Related Products</a></li>
										<li><a href="javascript:void();" onclick="siteUrl('4','<?php echo  $getUserInfo['id'];?>');"> Add Products Manually</a></li>
										<li><a href="javascript:void();" onclick="siteUrl('5','<?php echo  $getUserInfo['id'];?>');"> Edit Products</a></li>
										<li><a href="javascript:void();" onclick="siteUrl('6','<?php echo  $getUserInfo['id'];?>');"> Saved Products</a></li>
										<li><a href="javascript:void();" onclick="siteUrl('7','<?php echo  $getUserInfo['id'];?>');"> Product Page FAQs</a></li>
										<li><a href="javascript:void();" onclick="siteUrl('10','<?php echo  $getUserInfo['id'];?>');"> Page Content</a></li>

									</ul>
								</div>
							</div>
						</li>


						<style>
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

							}
						</style>
						<li><a href="javascript:void()" onclick="siteUrl('8','<?php echo  $getUserInfo['id'];?>');"><span class="nav-icon"><i class="far fa-users fa-lg"></i></span>  Customers</a></li>
						<li><a href="javascript:void()" onclick="siteUrl('11','<?php echo  $getUserInfo['id'];?>');"><span class="nav-icon"><img src="https://topshelfmenu.us/public/admin/images/icon/customers.png" /></span>  Orders</a></li>
						<li><a href="javascript:void()" onclick="siteUrl('12','<?php echo  $getUserInfo['id'];?>');"><span class="nav-icon"><i class="far fa-comments fa-lg"></i></span>  Reviews </a></li>
						<li><a href="javascript:void()" onclick="siteUrl('9','<?php echo  $getUserInfo['id'];?>');"><span class="nav-icon"><img src="https://topshelfmenu.us/public/admin/images/icon/report.png" /></span> Reports</a></li>


						<li><a data-toggle="collapse" data-target="#demo" class="<?php if ($page == 'business_settings.php' || $page == 'payment_information.php' || $page == 'password.php') { ?>active<?php } ?>"><span class="nav-icon"><img src="https://topshelfmenu.us/admin/images/icon/setting.png" /></span> Settings
							<i class="fal fa-chevron-down pull-right" style="margin-top: 8px;"></i>
							</a>

							<div id="demo" class="collapse">
								<div class="parent___menu">
									<ul>
										<li><a href="https://topshelfmenu.us/admin/settings/business_settings.php?memberShip=<?php echo base64_encode($getUserInfo['id']);?>"> Business Settings</a></li>
										<li><a href="https://topshelfmenu.us/admin/settings/payment_information.php?memberShip=<?php echo base64_encode($getUserInfo['id']);?>"> Payment  Information</a></li>
										<li><a href="https://topshelfmenu.us/admin/settings/password.php?memberShip=<?php echo base64_encode($getUserInfo['id']);?>"> Password</a></li>
									</ul>
								</div>
							</div>
						</li>
						<li><a href="https://topshelfmenu.us/<?php echo $getUserInfo['username'];?>" target="_blank" class="">
							<span class="nav-icon"><i class="fal fa-list-alt fa-lg"></i></span> View Menu</a></li>
						<li><hr></li>
						<li><a href="javascript:void(0);" onclick="olark('api.box.expand')" ><span class="nav-icon"><img src="https://topshelfmenu.us/public/admin/images/icon/help.png" /></span> Help</a></li>

						<li><a href="https://topshelfmenu.us/admin/logout"><span class="nav-icon"><img src="https://topshelfmenu.us/public/admin/images/icon/logout.png" /></span> Logout</a></li>
					</ul>
				</div>
			</nav>

			<?php

			$cur_date=date("Y-m-d");
			$date1=date_create($cur_date);
			$date2=date_create($getUserInfo['exp_date']);
			$diff=date_diff($date1,$date2);
			$date= $diff->format("%R%a");
			$date2=str_replace("+","",$date);
			if($getUserInfo['subscription_id']==''){?>
			<div class="alert alert-danger alert__position">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="position: absolute;right: 11px;top: 6px; font-weight: bold; font-size: 16px;">X</button>
				<?php if($date2>0){ ?>
				<b><?php echo $date2; ?> Days Remaining</b> on your unlimited FREE trial. You can subscribe at any time before your trial ends -
				<a class="" href="http://topshelfmenu.us/admin/settings/index.php?memberShip=<?php echo $_GET['memberShip'];?>" style="font-weight:700; text-transform:uppercase; color:#111 !important;">SUBSCRIBE TODAY! </a>

				<?php } else {?>
				Please subscribe to continue using topshelfmenu -
				<a class="" href="http://topshelfmenu.us/admin/settings/index.php?memberShip=<?php echo $_GET['memberShip'];?>" style="font-weight:700; text-transform:uppercase; color:#111 !important;">SUBSCRIBE TODAY! </a>
				<?php }?>
			</div>
			<?php } ?>
			<style>
				.alert__position{margin-left:80px; position: relative; border-radius:0px !important; padding:8px 28px !important;  top:80px;}
				@media (max-width: 767px) {
					.alert__position{margin-left:60px;  padding:8px 28px !important;  top:65px;}
				}
			</style>

			<!-- End Header -->

			<div class="clearfix"></div>

			<!-- Shop Item Detail Section -->
			<section class="main__container">
				<div class="page-breadcrumb"> <a >Account</a>/<span>Change password</span> </div>
				<?php if($_SESSION['msg_left']!=''){?>
				<div class="alert alert-success" id='errordiv'><?php echo $_SESSION['msg_left'];unset($_SESSION['msg_left']);?>
					<span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
				<?php }?>


				<div style="background-color:#fff;">
					<div class="row mt-30">
						<div class="col-md-12">
							<div class="tree-top-content">

								<!-- Tab -->

								<div class="box__shadow" style="background-color:#fff; padding:30px;">


									<style>
										select.cart_quantity{height: 53px !important; max-width:600px; width: 100% !important;}
									</style>

									<div >
										<div class="row">
											<div class="col-md-4 col-sm-6 col-xs-12">
												<div class="left__content">
													<div class="tt_green_text">Change password</div>
													<h1>HOW IT WORKS?</h1>
													<p>To change your password enter your old  password first, and then your new one. We advise that you change your password at least once a quarter. Even thought our security system is very high, retail shops generally have employees coming in and out regularly and it’s better to be safe and make sure no old employees has it.</p>
												</div>
											</div>
											<div class="col-md-8 col-sm-6 col-xs-12">
												<div class="form__right__box" style="padding-top:90px; padding-bottom:60px;">

													<form class="" role="form" id="form-register"  action="" onSubmit="return validatePassFrm();" accept-charset="UTF-8" method="post">
														<input type="hidden" name="edit_id" value="<?php echo $getUserInfo['id'];?>">
														<div class="row">
															<div class="col-md-8 col-md-offset-1">
																<h4 class="text-center">Change Your Password</h4>
																<hr style="width:18%;" />
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
																	<button type="submit" name="update_password" value="update_password" class="btn___green" style="width:auto !important; padding:0px 30px;">Update Password</button>
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
			</section>
			<!-- End Shop Item Section -->

			<div class="clearfix"></div>
		</div>
		<!-- Site Wraper End -->

		<style>
			.tab____li{line-height: 55px !important;   margin-top: 3px !important;}
		</style>
		<!-- JS -->

		<script src="https://topshelfmenu.us/public/admin/js/jquery-1.11.2.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/bootstrap.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/jquery.fitvids.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/jquery.viewportchecker.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/sidebar-menu.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/theme.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/jquery.colorbox-min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/smooth-products.js"></script>
		<script type="text/javascript">
			$(window).load(function () {
				$('.sp-wrap').smoothproducts();
			});    </script>
		<script src="https://topshelfmenu.us/public/admin/js/jquery.stellar.min.js" type="text/javascript"></script>



		<script src="https://topshelfmenu.us/public/admin/js/owl.carousel.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/isotope.pkgd.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/public/admin/js/mediaelement-and-player.min.js"></script>
		<script src="https://topshelfmenu.us/public/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
		<script src="https://topshelfmenu.us/admin/settings/js/extra/password_val.js" type="text/javascript"></script>

		<script src="https://topshelfmenu.us/admin/settings/js/extra/common.js" type="text/javascript"></script>

		<link href="https://topshelfmenu.us/admin/settings/js/extra/common.css" rel="stylesheet">

				<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-114997354-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());

			gtag('config', 'UA-114997354-1');
		</script>


		<!-- begin olark code -->
		<script type="text/javascript" async> ;(function(o,l,a,r,k,y){if(o.olark)return; r="script";y=l.createElement(r);r=l.getElementsByTagName(r)[0]; y.async=1;y.src="//"+a;r.parentNode.insertBefore(y,r); y=o.olark=function(){k.s.push(arguments);k.t.push(+new Date)}; y.extend=function(i,j){y("extend",i,j)}; y.identify=function(i){y("identify",k.i=i)}; y.configure=function(i,j){y("configure",i,j);k.c[i]=j}; k=y._={s:[],t:[+new Date],c:{},l:a}; })(window,document,"static.olark.com/jsclient/loader.js");
			/* custom configuration goes here (www.olark.com/documentation) */
			olark.identify('1978-848-10-4767');</script>
		<!-- end olark code -->
	</body>
</html>