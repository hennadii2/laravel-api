  @include('front.z_header')
</head>

<body>
@include('front.z_right_menu')

<!-- Site Wraper -->
<div class="wrapper">

<!-- Header -->
 @include('front.z_top')
<!-- End Header -->

<!-- CONTENT --------------------------------------------------------------------------------->
<!-- Intro Section -->
<section class="main_banner text-left border__bottom">
<div class="container">
<div class="row">
<div class="page-breadcrumb"> <a href="{{URL::to('/')}}/{{$user_name}}">Home</a>/<span>Order Review</span> </div>
</div>
</div>
<div class="clearfix"></div>
</section>

<!-- End Intro Section -->

<!-- Shop Item Detail Section -->
<section class="ptb ptb-sm-80" style="padding-bottom:20px !important;">
<div class="container">
<div class="row mt-30">
<div class="col-md-12">
<div class="heading_style_left"> <span class="title">What’s Next?</span> </div>
<div class="tree-top-content">
<p><?php echo $what_next;?></p>
</div>
</div>
</div>
<div class="row mt-30">
<div class="col-md-12">
<div class="heading_style_left"> <span class="title">Order Details</span> </div>
<div class="tree-top-content">
<div class="table-responsive">
<table class="table table-striped table-bordered">
<tbody>
<tr>
<th class="no_brdr th_brdr_3">Product</th>
<th class="no_brdr th_brdr_3">Size</th>
<th class="no_brdr th_brdr_3">Qty</th>
<th class="no_brdr th_brdr_3">Total</th>
</tr>
@if (count($order_product) > 0)
   @foreach($order_product as $key => $value)
   <?php
    $product_data = DB::table('products')->where('prod_id', '=', $value->prod_id)->first();?>
<tr>
<td class="no_brdr" style="" valign="top">

<div><span>
<?php
if($product_data->pro_image!=''){?>
<img src="{{URL::to('/')}}/product_images/{{$value->prod_id}}/{{$product_data->pro_image}}" alt="" style="width: 50px; height:50px; margin-right:8px; border:1px solid #ddd;">
<?php }else{?>
  <img src="{{URL::to('/')}}/default.png" style="width: 50px; height:50px; margin-right:8px; border:1px solid #ddd;" />
<?php } ?>

</span> <b>{{$value->prod_title}}</b></div>
</td>
<td class="no_brdr" style="" valign="top">{{$value->prod_size}}</td>
<td class="no_brdr" style="" valign="top">1</td>
<td class="no_brdr 3_brder td__price"> ${{number_format($value->price,2)}}</td>
</tr>
@endforeach
@endif
<tr>
<th class="no_brdr" colspan="3">Grand Total</th>
<td class="no_brdr td__price">${{number_format($user_info->order_amount,2)}}</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="row mt-30">
<div class="col-md-12">
<div class="heading_style_left"> <span class="title">Customer Details</span> </div>
<div class="tree-top-content">
<div class="table-responsive ">
<table class="table table-striped table-bordered">
<tbody>
<tr>
<th class="no_brdr" style="width:50%;">Email Address</th>
<td class="no_brdr" style="width:50%;">{{$user_info->email}}</td>
</tr>
<tr>
<th class="no_brdr">Phone Number</th>
<td class="no_brdr">{{$user_info->phone}}</td>
</tr>
</tbody>
</table>
</div>
</div>
</div>
</div>

</div>
</section>
<!-- End Shop Item Section -->

<div class="clearfix"></div>
@include('front.z_bottom')
<style>td.3_brder{border-top: 3px solid #f4f4f4 !important;}  </style>
</div>
<!-- Site Wraper End -->

 @include('front.z_footer')
</body>
</html>