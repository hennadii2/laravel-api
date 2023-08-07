<?php
include "config/config.php";
error_reporting(0);

$getUserInfo=getTableIdValue(USERS_TBL,"where id='".base64_decode($_GET['memberShip'])."' ",'*',$db);
//$getUserInfo=getTableIdValue(USERS_TBL,"where id='".$_GET['memberShip']."' ",'*',$db);
 if($getUserInfo['id']!=''){
 echo "<script>window.location='https://topshelfmenu.us/admin/settings/payment_information.php?memberShip=".$_GET['memberShip']."';</script>";  exit;
 }
