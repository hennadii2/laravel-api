@include('admin.z_header')
<title>Customer Details | Top Shelf Menu</title>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

</head>

<?php
$get_order=DB::table('orders')->where('orderid', '=', $order_id)->first();
$customer=DB::table('customer')->where('cus_id', '=', $client_id)->first();
?>


<body>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->
		@include('admin.z_top')
		<!-- End Header -->

		<div class="clearfix"></div>
		<section class="main__container">

			<div class="box__shadow" style="background-color:#fff; margin-bottom:30px; padding-top: 20px;">
				<div class="heading_style" style="text-align: left; padding-left: 11px;"> <span class="title" style="font-size:26px !important;">Customer Details</span> </div>
				<div style=" padding:10px 30px 30px 30px;">
					<div class="row">
						<div class="col-md-12">



							<div class="tree-top-content mt-10">

								<div class="row">
									<div class="col-sm-3 col-xs-12 pull-right">
										<!--<div><img src="{{URL::to('/')}}/admin/images/customer_default.png"/ style="max-width:200px; border:1px solid #ddd; margin-bottom:15px;"  /></div>  -->
									</div>
									<div class="col-sm-9 col-xs-12">
										<div class="table-responsive">
											<table class="table table-bordered">
												<tbody>

													<tr>
														<td class="no_brdr bg__td" valign="top" style="width: 20%;">Name: </td>
														<td class="no_brdr" valign="top" style="width: 80%;">{{ucfirst($get_order->fname)}} {{ucfirst($get_order->lname)}}</td>
													</tr>

													<tr>
														<td class="no_brdr bg__td" valign="top">Email: </td>
														<td class="no_brdr" valign="top">{{$get_order->email}}</td>
													</tr>

													<tr>
														<td class="no_brdr bg__td" valign="top">DOB: </td>
														<td class="no_brdr" valign="top">

															<?php if($customer->dob!='1970-01-01' && $customer->dob!='0000-00-00' && $customer->dob!='N/A' && $customer->dob!=''){
	$date_format=date('m-d-Y', strtotime($customer->dob));
	echo $date_format;
}?>
														</td>
													</tr>

													<tr>
														<td class="no_brdr bg__td" valign="top">Gender: </td>
														<td class="no_brdr" valign="top">{{$customer->gender}}</td>
													</tr>

													<tr>
														<td class="no_brdr bg__td" valign="top">Phone: </td>
														<td class="no_brdr" valign="top">{{$get_order->phone}}</td>
													</tr>
													<tr>
														<td class="no_brdr bg__td" valign="top">Address:</td>
														<td class="no_brdr 3_brder"> {{$get_order->address}}</td>
													</tr>


													<tr>
														<td class="no_brdr bg__td" valign="top">City:</td>
														<td class="no_brdr 3_brder"> {{$get_order->city}}</td>
													</tr>

													<tr>
														<td class="no_brdr bg__td" valign="top">State: </td>
														<td class="no_brdr" valign="top">{{$get_order->state}} </td>
													</tr>
													<tr>
														<td class="no_brdr bg__td" valign="top">Zipcode:</td>
														<td class="no_brdr 3_brder"> {{$get_order->zip_code}}</td>
													</tr>

												</tbody>
											</table>
										</div>
									</div>

								</div>

							</div>




						</div>
					</div>
				</div>
			</div>


			<div  class="box__shadow"  style="background-color:#fff; padding:35px 30px 30px 30px;">
				<div class="row">
					<div class="col-md-12">
						<!-- order listing Start -->
						<?php

						$date_sales=0;
						$order = DB::table('orders')
							->where('user_id','=', $client_id)->orderBy('orderid', 'desc')->get();
						if(count($order)>0)
						{
							foreach($order as $key => $order_list){

						?>
						<div class="row">
							<div class="col-sm-10 col-xs-12">
								<div class="heading_style_left"> <span class="title">Previous Orders</span> </div>
							</div>
							<div class="col-sm-2 col-xs-12">
								<div class="order___date">Date: <span><?php echo date('m-d-Y', strtotime($order_list->order_date));?></span></div>
							</div>
						</div>

						<div class="tree-top-content mt-20">
							<div class="table-responsive">
								<table class="table table-bordered">
									<tbody>
										<tr style="background-color: #f9f9f9;">
											<th class="no_brdr th_brdr_3 ">Title</th>
											<th class="no_brdr th_brdr_3 ">Size</th>
											<th class="no_brdr th_brdr_3 ">Qty</th>
											<th class="no_brdr th_brdr_3 ">Price</th>

										</tr>
										<?php
								$order_item = DB::table('order_item')
									->where('order_id','=', $order_list->orderid)->get();
								if(count($order_item)>0)
								{
									foreach($order_item as $key2 => $order_item){?>
										<tr>
											<td class="no_brdr" valign="top"><?php echo $order_item->prod_title;?> </td>
											<td class="no_brdr" valign="top"><?php echo $order_item->prod_size;?></td>
											<td class="no_brdr" valign="top">1</td>
											<td class="no_brdr 3_brder"> $<?php echo number_format($order_item->price,2);?> </td>
										</tr>
										<?php }}else{?>

										<?php } ?>


									</tbody>
								</table>
							</div>
						</div>
						<!-- order listing End -->
						<?php }}?>
						<!-- order listing End -->
					</div>
				</div>
			</div>


		</section>
	</div>
	<!-- Site Wraper End -->

	@include('admin.z_footer')
	<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
	<style>
		.table>tbody>tr>td, .table>tbody>tr>th{ padding:8px 10px 7px 15px !important; color:#808080 !important;}
		th.th__head {

			font-weight: bold;
			color: #222222 !important;
		}
		.heading_style_left .title {
			font-size: 18px !important;
			color: #22aa00 !important;
		}

		.order___date{
			text-align:right; font-family:Arial; font-weight: 600; font-size: 14px !important;
			color: #22aa00 !important; margin-top: 4px;
		}
		.order___date span{
			color: #666;'
		}

		.bg__td{
			background-color: #f9f9f9 !important;
		}


	</style>


</body>
</html>