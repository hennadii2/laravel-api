@include('admin.z_header')
<title>Orders | Top Shelf Menu</title>
<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$( function() {
		$( "#start_date" ).datepicker();
		$( "#end_date" ).datepicker();
	} );
</script>

</head>

<body>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->
		@include('admin.z_top')
		<!-- End Header -->

		<div class="clearfix"></div>
		<section class="main__container">


			@if (Session::has('success'))
			<div class="alert alert-success" id='errordiv'>{{ Session::get('success') }}
				<span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
			@endif

			<div  class="box__shadow"  style="background-color:#fff; padding:35px 30px 30px 30px;">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-9 col-sm-8 col-xs-12 mb-20">
								<div class="heading_style_left"> <span class="title">Your Orders</span> </div>
							</div>
							<form role="search" id="searchform" action="{{URL::to('/')}}/admin/orders" method="get">
								<div class="col-md-3 col-sm-4 col-xs-12  mb-20">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search" name="search_key" id="search_key">
										<div class="input-group-btn">
											<button class="btn btn-default" type="submit"  ><i class="fa fa-fw fa-search"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="row mb-20">


							<div class="col-xs-12 col-md-6 p_lr_5">

								<form role="search" id="searchform" action="{{URL::to('/')}}/admin/orders" method="post" >
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="row">
										<div class="col-sm-8 col-md-8 mb-10">
											<div class="input-daterange input-group" id="datepicker-range">
												<input type="text" class="form-control" required name="start_date"    id="start_date" />
												<span class="input-group-addon">to</span>
												<input type="text" class="form-control" required name="end_date" id="end_date"  />

											</div>
										</div>
										<div class="col-sm-4 col-md-4">
											<button type="submit"  class="btn btn-success btn-block btn-cons">SEARCH</button>
										</div>
									</div>
								</form>
							</div>
						</div>

						<div class="tree-top-content">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tbody>
										<tr>
											<th class="no_brdr th_brdr_3 ">Order Id</th>
											<th class="no_brdr th_brdr_3 ">Customer Name</th>
											<th class="no_brdr th_brdr_3 ">Email</th>
											<th class="no_brdr th_brdr_3 ">Total Amount</th>
											<th class="no_brdr th_brdr_3 ">Status</th>
											<th class="no_brdr th_brdr_3 ">Action</th>
										</tr>
										@if (count($order_list) > 0)
										@foreach($order_list as $key => $value)
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
											<td class="no_brdr" valign="top"><a href="order_details/{{$value->orderid}}">{{$value->order_id}}</a> </td>
											<td class="no_brdr" valign="top"><a href="customer_details/{{$value->user_id}}/{{$value->orderid}}">{{ucfirst($value->fname)}} {{ucfirst($value->lname)}}</a></td>
											<td class="no_brdr" valign="top">{{$value->email}}</td>

											<td class="no_brdr 3_brder"> ${{number_format($value->order_amount,2)}}</td>
											<td class="no_brdr" valign="top">{{$status}}</td>
											<td class="no_brdr 3_brder">
												<?php
												if($value->status!='0'){ ?>
												<a href="{{URL::to('/')}}/admin/pending_order/{{$value->orderid}}" class="edit_green_text"><i class="fa fa-adjust"></i> Pending</a> &nbsp; | &nbsp;
												<?php } ?>
												<?php
												if($value->status!='1'){ ?>
												<a href="{{URL::to('/')}}/admin/cancel_order/{{$value->orderid}}"  class="canecl_red_text"><i class="fa fa-times"></i> Cancel</a> &nbsp; | &nbsp;
												<?php } ?>
												<?php
												if($value->status!='2'){ ?>
												<a href="{{URL::to('/')}}/admin/approve_order/{{$value->orderid}}"  class="dlt_red_text"><i class="fa fa-check-square"></i> Fulfilled</a>
												<?php } ?>
											</td>

										</tr>

										@endforeach
										@else
										<tr>
											<td colspan="6">No record found.</td>

										</tr>
										@endif


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
	<style>
		.table>tbody>tr>td, .table>tbody>tr>th{ padding:12px 10px 10px 15px !important; color:#808080 !important;}
		th.th__head {

			font-weight: bold;
			color: #222222 !important;
		}

		a.edit_green_text {
			font-size: 14px;
			color: #22aa00 !important;
			font-weight: 600;
			text-transform: uppercase;
			font-family: 'proxima_nova_rgbold';
		}
		a.edit_green_text:hover{
			color: #222222 !important;
		}

		a.dlt_red_text {
			font-size: 14px;
			color: #22aa00 !important;
			font-weight: 600;
			text-transform: uppercase;
			font-family: 'proxima_nova_rgbold';
		}

		a.dlt_red_text:hover{
			color: #222222 !important;
		}

		a.canecl_red_text {
			font-size: 14px;
			color: #F00 !important;
			font-weight: 600;
			text-transform: uppercase;
			font-family: 'proxima_nova_rgbold';
		}

		a.canecl_red_text:hover{
			color: #222222 !important;
		}

	</style>


</body>
</html>