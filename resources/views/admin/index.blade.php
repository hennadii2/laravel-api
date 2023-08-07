@include('admin.z_header')
<title>Dashboard | Top Shelf Menu</title>
</head>

<body>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->

		@include('admin.z_top')
		<!-- End Header -->

		<div class="clearfix"></div>
		<section class="main__container">
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
					<div class="box_setting box__shadow">
						<div class="p__30">
							<div class="box_top_text">Setting up your account</div>
							<h3 class="box_mid_heading">Click the button below to setup your account</h3>
							<p class="box___content">Start managing your sales in less than 10 minutes</p>
							<div class="mb-15"><a href="{{URL::to('/')}}/admin/settings/business_settings.php?memberShip={{base64_encode(Session::get('member_id'))}}" class="tt_submit_btn">Account Settings</a></div>
						</div>
					</div>
					<div class="box_sales box__shadow">
						<div class="p__30">
							<div class="box_top_text" style="color:#22242d !important;">Last 7 Days Sales</div>
							<h3 class="box_mid_heading" style="min-height:100px; font-size:36px; line-height:38px;">${{number_format($seven_days,2)}}</h3>
						</div>
					</div>
					<div class="box_customer box__shadow">
						<div class="p__30">
							<div class="box_top_text">Most profitable Customer</div>
							<h3 class="box_mid_heading profit__amt">${{number_format($max_pay,2)}}</h3>
							<div style="min-height:70px; font-size:16px; color:#808080;">{{$max_user}}</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div style="background-color:#fff;" class="box__shadow">
						<div class="table__main__title"><strong>10 Most Popular Products</strong></div>
						<div class="scrollbar">
							<div style="padding:0px 20px; background-color:#fff !important;">
								<table class="table mb-0 v_a_top">
									<tbody>
										<tr>
											<th colspan="2" class="th__head">Product</th>
											<th class="th__head" style="width:40%;">Brand</th>
											<th class="th__head" style="width:40%;">Sales</th>
										</tr>
										@if (count($popular_product) > 0)
										@foreach($popular_product as $key => $value)

										<?php
										$all_sale=0;
										$order_item=DB::table('order_item')->where('prod_id', '=', $value->prod_id)->get();
										foreach($order_item as $key2 => $value1){
											$all_sale=$all_sale+$value1->price;
										}
										?>

										<tr>
											<?php
											$images= '/product_images/'.$value->prod_id.'/'.$value->pro_image;
											if(file_exists($images)){
												$recimages=$images; }else{
												$recimages='/default.png';
											}?>
											<td class="thumb__img"><img src="{{$recimages}}" class="product__img" style="max-width: 50px !important;" /></td>
											<td class="pro____title" style="line-height:14px;"><a href="#">{{$value->pro_title}}</a></td>
											<td class="brand__name"> {{$value->name}}</td>
											<td class="brand__name"> $<?php echo number_format($all_sale,2);?></td>
										</tr>
										@endforeach
										@else
										<tr>
											<td class="thumb__img"> No sales in this time period. Stay tuned!</td>
										</tr>
										@endif

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div style="background-color:#fff;" class="box__shadow">
						<div class="table__main__title"><strong>Your Top 10 Customers</strong></div>
						<div class="scrollbar">
							<div style="padding:0px 20px; background-color:#fff !important;">
								<table class="table mb-0">
									<tbody>
										<tr>
											<th colspan="2" class="th__head">Customer</th>
											<th class="th__head" style="width:40%;">Total Purchase</th>
										</tr>
										<?php if ($myTopUser!=''){
											foreach($myTopUser as $value){
												$new = explode("=>", $value);
												$get_cus=DB::table('customer')->where('cus_id', '=', $new[1])->first();
																				?>
										<tr>
											<?php
											if($get_cus->image!=''){?>
											<td class="thumb__img"><img src="{{URL::to('/')}}/member_img/<?php echo $get_cus->image;?>" class="customer_thumb__img" /></td>
											<?php }else{?>
											<td class="thumb__img"><img src="{{URL::to('/')}}/admin/images/pro-avatar.png" class="customer_thumb__img" /></td>
											<?php }?>
											<td class="pro____title"><a href="#"><?php echo ucfirst($get_cus->fname);?> <?php echo ucfirst($get_cus->lname);?></a></td>
											<td class="brand__name"> $<?php echo number_format($new[0],2);?></td>
										</tr>
										<?php }}else{?>
										<tr>
											<td class="thumb__img"> No customers yet. Once you have sales you will see them here!</td>
										</tr>
										<?php }?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- Site Wraper End -->

	@include('admin.z_footer')
	<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
</body>
</html>