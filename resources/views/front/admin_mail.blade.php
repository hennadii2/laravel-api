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
<img src="{{URL::to('/')}}/images/logo.png" alt="" style="max-width:100%;" /></div></div>
<h2 style="font-weight:800; color:#22aa00; text-align:center; padding-top:0px;">Order #{{$order_info->order_id}} Receipt</h2>
<div style="font-size:16px;font-weight:600; margin-bottom:5px;">Customer Information :</div>
<table class="table table-bordered table-condensed" style="border: 1px solid #ddd; text-align: left !important; color:#333; width: 100%; margin-bottom:30px;">
<tbody>

<tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: none; vertical-align: middle !important; width: 150px;" >Customer Name</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: none; vertical-align: middle !important;">{{$customer_info->fname}} {{$customer_info->lname}}</td>
</tr>
<tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">Email ID</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$customer_info->email}}</td>
</tr>
<tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">Phone Number</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$customer_info->phone}}</td>
</tr>

<tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">Address</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$customer_info->address}}</td>
</tr>

<tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">Suite/Apartment No</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$customer_info->apartment}}</td>
</tr>

 <tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">City</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$customer_info->city}}</td>
</tr>
<tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">State</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$customer_info->state}}</td>
</tr>

<tr>
<th style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">Zip Code</th>
<td style="padding: 10px 15px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$customer_info->zip_code}}</td>
</tr>



</tbody>
</table>

<div style="font-size:16px;font-weight:600; margin-bottom:5px;">Order Information :</div>
<table class="table mb-0" style="border: 1px solid #ddd; text-align: left !important; color:#333; width: 100%; margin-bottom:30px;">
<tbody>
<tr>
<th style="padding: 15px 18px; line-height: 1.42857143; border-top:none; vertical-align: middle !important;">PRODUCT INFO</th>
<th style="padding: 15px 18px; line-height: 1.42857143; border-top: none; vertical-align: middle !important;">SIZE</th>
<th style="padding: 15px 18px; line-height: 1.42857143; border-top: none; vertical-align: middle !important;">QTY</th>
<th style="padding: 15px 18px; line-height: 1.42857143; border-top: none; vertical-align: middle !important;">PRODUCT PRICE</th>

</tr>

@if (count($order_item) > 0)
    @foreach($order_item as $key => $value)
    <tr><td style="padding: 15px 18px; line-height: 1.42857143; border-top:1px solid #ddd; vertical-align: middle !important;">{{$value->prod_title}}</td>
    <td style="padding: 15px 18px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">{{$value->prod_size}}</td>
    <td style="padding: 15px 18px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">1</td>
    <td style="padding: 15px 18px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">${{number_format($value->price,2)}}</td>
    </tr>
    @endforeach
    @endif

<tr>

<td colspan="4"  style="padding: 15px 18px; line-height: 1.42857143; border-top: 1px solid #ddd; vertical-align: middle !important;">
<div style="max-width:180px; background-color:#22242d; color:#fff; padding:15px 20px; float:right;">
<div class="box_top_text">Total</div>
<h3 style="margin-top:2px !important; margin-bottom:0px;">${{number_format($order_info->order_amount,2)}}</h3>
</div>
</td>
</tr>

</tbody>
</table>

<div style="background-color:#F0FFFF; text-align:center; padding:20px; margin-bottom:20px; margin-top:20px;">
<div>Have A Question ?</div>
<div><a href="#" style="margin:3px 5px;">support@treepots.com</a></div>
</div>

</div>


</body>
</html>