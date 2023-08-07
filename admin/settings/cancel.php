<?php
include "config/config.php";
error_reporting(0);
$getUserInfo=getTableIdValue(USERS_TBL,"where id='".base64_decode($_GET['memberShip'])."' ",'*',$db);
require 'init.php';
require_once("lib/Stripe.php");
$params = array(
	"testmode"   => "on",
	"private_live_key" => "sk_live_z7LgvTzYDEi0NWK5b0NIab2n",
	"public_live_key"  => "pk_live_jNFBLqGtZhlf9SH0LZwhDR2U",
	"private_test_key" => "sk_test_1aRdhfzXvfpSRVcTtbfIDL6i",
	"public_test_key"  => "pk_test_HAgQgQEtYF2lmoVRskA4onDL"
);

if ($params['testmode'] == "on") {
	$pubkey = $params['public_test_key'];
	$key_define=$params['public_test_key'];
    \Stripe\Stripe::setApiKey($params['private_test_key']);
} else {
	$pubkey = $params['public_live_key'];
	$key_define=$params['public_live_key'];
    \Stripe\Stripe::setApiKey($params['private_live_key']);
}


$subscription = \Stripe\Subscription::retrieve($getUserInfo['subscription_id']);
$subscription->cancel();
$sql2=$db->exec("update ".USERS_TBL." set
subscription_id='',
where id='".$getUserInfo['id']."'  ");
echo "<script>window.location='http://topshelfmenu.us/admin/load/".$getUserInfo['id']."';</script>";  exit;


?>

