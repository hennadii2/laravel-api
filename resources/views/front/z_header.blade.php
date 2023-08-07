<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />

		<meta name="description" content="" />

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		
		<link rel="apple-touch-icon" sizes="180x180" href="https://topshelf.us/wp-content/uploads/fbrfg/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="https://topshelf.us/wp-content/uploads/fbrfg/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="https://topshelf.us/wp-content/uploads/fbrfg/favicon-16x16.png">
		<link rel="manifest" href="https://topshelf.us/wp-content/uploads/fbrfg/manifest.json">
		<link rel="mask-icon" href="https://topshelf.us/wp-content/uploads/fbrfg/safari-pinned-tab.svg" color="#000000">
		<link rel="shortcut icon" href="https://topshelf.us/wp-content/uploads/fbrfg/favicon.ico">
		<meta name="msapplication-config" content="https://topshelf.us/wp-content/uploads/fbrfg/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">

		<!-- CSS -->
		<link href="{{URL::to('/')}}/css/style.css" rel="stylesheet" type="text/css" />
		<link href="{{URL::to('/')}}/css/bootstrap.css" rel="stylesheet" type="text/css" />
		<link href="{{URL::to('/')}}/css/font-awesome.css" rel="stylesheet" type="text/css" />
		<link href="{{URL::to('/')}}/css/sidebar-menu.css" rel="stylesheet" type="text/css" />
		<?php $kt=Session::get('popup_show');

		if($kt=='1'){
			echo "<script> window.onload = function() {
     loadItem();
 }; </script>";
		}
		Session::put('popup_show', '0');
		?>

		<script>
			function loadItem(){
				$menuSidebar = $('.pushmenu-right');
				$menusidebarNav = $('#menu-sidebar-list-icon');
				$menuSidebarclose = $('#menu-sidebar-close-icon');
				//sidebar menu navigation icon toggle
				$('#menu-sidebar-list-icon').toggleClass('active');
				$('.pushmenu-push').toggleClass('pushmenu-push-toleft pushmenu-active');
				$menuSidebar.toggleClass('pushmenu-open');

				//$("#menu-sidebar-list-icon").show();
			}
		</script>