@include('customer.z_header')
</head>

<body>
<!-- Site Wraper -->
<div class="wrapper">
<!-- Header -->
@include('customer.z_top')

<!-- End Header -->

<div class="clearfix"></div>
<section class="main__container">
 @if (Session::has('success'))
  <div class="alert alert-success" id='errordiv'>{{ Session::get('success') }}
  <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
  @endif
<div class="row">

<div class="col-md-12 col-sm-12 col-xs-12">
<div style="background-color:#fff;" class="box__shadow">
<div class="table__main__title">My Dashboard</div>

<div class="table-responsive" style="padding:0px 20px; background-color:#fff !important;">
<table class="table mb-0 v_a_top">
<tbody>
<tr>
<th class="th__head">Order ID</th>
<th class="th__head">Date</th>
<th class="th__head">Items</th>
<th class="th__head">Total Amount</th>
<th class="th__head">Status</th>
<th class="th__head">Action</th>
</tr>
@if (count($order_info) > 0)
   @foreach($order_info as $key => $value)
   <?php
  if($value->status=='0'){
    $status='Pending';
  }
  if($value->status=='1'){
    $status='Cancelled';
  }
  if($value->status=='2'){
    $status='Fulfilled';
  }  ?>
<tr>
<td>{{$value->order_id}}</td>
<td><?php echo  date('M d,Y', strtotime($value->order_date));?></td>
<td>
<div class="order__list">
<ul>

<?php
$order_item=DB::table('order_item')->where('order_id', '=', $value->orderid)->get();
$user_info=DB::table('users')->where('id', '=', $value->admin_id)->first();?>
@foreach($order_item as $key2 => $value1)
<?php

$pro_img=DB::table('products')->where('prod_id', '=', $value1->prod_id)->first();


  $UrlNames = str_replace("/","",str_replace(",",",",str_replace("","_",str_replace("-","_",str_replace("&","",str_replace("*","",str_replace("+","",str_replace("=","",str_replace("%","",str_replace("@","",str_replace("$","",str_replace("#","",str_replace("{","",str_replace("}","",str_replace("(","",str_replace(")","",str_replace(">","",str_replace("<","",str_replace(";","",str_replace("'","",str_replace('"',"",str_replace('`',"",str_replace('!',"",str_replace(':',"",str_replace('~',"",trim($pro_img->pro_title))))))))))))))))))))))))));
  $UrlNames = str_replace("?","",$UrlNames);
  $UrlNames = str_replace("^","",$UrlNames);
  $UrlNames = str_replace("%","",$UrlNames);
  $UrlNames = str_replace(" ","",$UrlNames);

?>
<li>
<a href="{{URL::to('/')}}/<?php echo $user_info->username;?>/product-details/{{$value1->prod_id}}/{{$UrlNames}}" target="_blank">
<?php
if($pro_img->pro_image!=''){?>
<span class="thumb__img"><img src="{{URL::to('/')}}/product_images/{{$value1->prod_id}}/{{$pro_img->pro_image}}" class="product__img" /></span>

<?php }else{?>
<div class="thumb__img" ><img src="{{URL::to('/')}}/default.png" class="product__img" /> </div>
<?php }?>
<span class="pro____title">{{$value1->prod_title}}
<div class="f_12">Qty : 1 SIZE : {{$value1->prod_size}}</div></span>
</a>
<div class="clearfix"></div>
</li>
@endforeach

</ul>
</div>

</td>

<td class="brand__name"> ${{number_format($value->order_amount,2)}}</td>
<td class="brand__name"> {{$status}}</td>
<?php
if($value->status=='0'){ ?>
<td class="brand__name"> <a href="{{URL::to('/')}}/customer/cancel_order/{{$value->orderid}}" onclick="return confirm('Are you sure you want to canel this order?')" class="canecl_red_text"><i class="fa fa-times"></i> Cancel</a></td>
<?php }else{?>
<td class="brand__name"> </td>

<?php }?>
</tr>

@endforeach
@else
  <tr style="text-align: left;"><td>  No any orders! </td> </tr>
@endif


</tbody>
</table>
</div>

</div>
</div>

</div>
</section>
</div>
<!-- Site Wraper End -->
@include('customer.z_footer')
<link href="{{URL::to('/')}}/customer/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
</body>
</html>