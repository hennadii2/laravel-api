<?php
  //session_start();
include "config/config.php";
require 'init.php';
require_once("lib/Stripe.php");
\Stripe\Stripe::setApiKey("sk_test_1aRdhfzXvfpSRVcTtbfIDL6i");
$body = @file_get_contents('php://input');
$event_json = json_decode($body);
$event_id = $event_json->id;
$event = \Stripe\Event::retrieve($event_id);

$sub_id= $event->data->object->id;

if($event->type=='customer.subscription.updated') {

$exp_date=date('Y-m-d', strtotime('+1 days'));
$sql2=$db->exec("update `users` set
exp_date='".$exp_date."'
where subscription_id='".$sub_id."'  ");
$date=date('Y-m-d');
$sql2=$db->exec("insert into `demo` set
name='".$event->type."',date='".$date."' ");
} else{
$date=date('Y-m-d');
$sql2=$db->exec("insert into `demo` set
name='".$event->type."',date='".$date."' ");
} ?>
