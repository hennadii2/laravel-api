<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Trees Pot Shop</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<meta name="author" content="nileforest">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />



<!-- CSS -->
<link href="{{URL::to('/')}}/css/style.css?4" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/css/bootstrap.css?2" rel="stylesheet" type="text/css" />
</head>

<body>
<div style="max-width:600px; margin:0px auto; background-color:#fff;">
<div style="width:140px;  margin:0px auto !important;">
<div style="width:130px; height:120px; background-color:#22242d; display:table-cell; vertical-align:middle; text-align:center; overflow:hidden; border-radius:50%; padding:10px;">
<img src="{{URL::to('/')}}/images/logo.png" style="max-width:100%;" alt="" /></div></div>
<h2 style="font-weight:800; color:#22aa00; text-align:center; padding-top:0px;">Order #{{$order_info->order_id}} Receipt</h2>

<div style="font-size:16px;font-weight:600; margin-bottom:5px;">Order Information :</div>
<table class="table mb-0"  style="border: 1px solid #ddd; text-align: left !important; color:#333; width: 100%; margin-bottom:30px;">
<tbody>
<tr>
<th style="padding: 15px 18px; line-height: 1.42857143;">PRODUCT INFO</th>
<th style="padding: 15px 18px; line-height: 1.42857143;">SIZE</th>
<th style="padding: 15px 18px; line-height: 1.42857143;">QTY</th>
<th style="padding: 15px 18px; line-height: 1.42857143;">PRODUCT PRICE</th>

</tr>

@if (count($order_item) > 0)
    @foreach($order_item as $key => $value)
    <tr><td style="padding: 15px 18px; line-height: 1.42857143; border-top:1px solid #ddd; vertical-align: middle !important;">{{$value->prod_title}}</td>
    <td style="padding: 15px 18px; line-height: 1.42857143; border-top:1px solid #ddd; vertical-align: middle !important;">{{$value->prod_size}}</td>
    <td style="padding: 15px 18px; line-height: 1.42857143; border-top:1px solid #ddd; vertical-align: middle !important;">1</td>
    <td style="padding: 15px 18px; line-height: 1.42857143; border-top:1px solid #ddd; vertical-align: middle !important;">${{number_format($value->price,2)}}</td>
    </tr>
    @endforeach
    @endif

<tr>

<td colspan="5" style="padding: 15px 18px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;" >
<div style="max-width:180px; background-color:#22242d; color:#fff; padding:15px 20px; float:right;">
<div class="box_top_text">Total</div>
<h3 style="margin-top:2px !important; margin-bottom:0px;">${{number_format($order_info->order_amount,2)}}</h3>
</div>
</td>
</tr>

</tbody>
</table>
   <?php
  $admin_info = DB::table('users')->where('id', '=', $order_info->admin_id)->first();

  $address=str_replace(" ","+",$admin_info->address);
  $city=str_replace(" ","+",$admin_info->city);
  $state=str_replace(" ","+",$admin_info->state);
  $zip_code=str_replace(" ","+",$admin_info->zip_code);
  $direction=$address.'+'.$city.'+'.$state.'+'.$zip_code;

  ?>

<div style="text-align:center; margin:60px 0px 30px 0px;">
<div style="width: 50%; float: left;">
    <a style="background-color: #22aa00; border:2px solid #22aa00; text-transform:uppercase; font-size: 16px; font-weight: 600; display: block;  color: #fff; padding: 10px 30px; margin-right:5px; text-decoration:none;" href="{{URL::to('/')}}/cancel_order/<?php echo base64_encode($order_info->order_id);?>"> Cancel Order</a>
</div>
<div style="width: 50%; float: left;">
    <a style="background-color: #22aa00; border:2px solid #22aa00; text-transform:uppercase; font-size: 16px; font-weight: 600; display: block;  color: #fff; padding: 10px 30px; margin-left:5px; text-decoration:none;"  href="https://maps.google.com?q=<?php echo $direction;?>"> Directions</a>
</div>
<div style="clear: left;"></div>
 </div>

<div style="background-color:#F0FFFF; text-align:center; padding:20px; margin-bottom:20px; margin-top:20px;">
<div>Have A Question ?</div>
<div><a href="#" style="margin:3px 5px;">support@treepots.com</a></div>
</div>

</div>


</body>
</html>