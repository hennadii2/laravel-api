@include('admin.z_header')
<title>Customers | Top Shelf Menu</title>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
</head>

<body>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->
		@include('admin.z_top')
		<!-- End Header -->

		<div class="clearfix"></div>
		<section class="main__container">
			@if (Session::has('success_send'))
			<div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"></button>Email has been sent successfully!</div>
			@endif

			<div  class="box__shadow"  style="background-color:#fff; padding:35px 30px 30px 30px;">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-9 col-sm-8 col-xs-12 mb-20">
								<div class="heading_style_left"> <span class="title">Your Customers</span> </div>
							</div>
							<form role="search" id="searchform" action="{{URL::to('/')}}/admin/customers" method="get">
								<div class="col-md-3 col-sm-4 col-xs-12  mb-20">
									<div class="input-group">
										<input type="text" class="form-control" placeholder="Search" name="search_key" id="search_key">
										<div class="input-group-btn">
											<button class="btn btn-default" type="submit"  type="button"><i class="fa fa-fw fa-search"></i></button>
										</div>
									</div>
								</div>
							</form>
						</div>

						<div class="tree-top-content">
							<div class="table-responsive">
								<table class="table table-striped table-bordered">
									<tbody>
										<tr>
											<th class="no_brdr th_brdr_3 ">Name</th>
											<th class="no_brdr th_brdr_3 ">Email</th>
											<th class="no_brdr th_brdr_3 ">Phone</th>
											<th class="no_brdr th_brdr_3 ">Total Purchases</th>
											<th class="no_brdr th_brdr_3 ">Action</th>
										</tr>
										@if (count($cus_list) > 0)
										@foreach($cus_list as $key => $value)


										<?php

										$date_sales=0;
										$invoice_paid2 = DB::table('orders')
											->where('user_id','=', $value->user_id)->get();
										if(count($invoice_paid2)>0)
										{
											foreach($invoice_paid2 as $key => $paid_data2){
												$date_sales=$date_sales+$paid_data2->order_amount;
											}
										}
										?>
										<tr>
											<td class="no_brdr" valign="top">{{ucfirst($value->fname)}} {{ucfirst($value->lname)}}</td>
											<td class="no_brdr" valign="top">{{$value->email}}</td>
											<td class="no_brdr" valign="top">{{$value->phone}}</td>
											<td class="no_brdr 3_brder"> ${{number_format($date_sales,2)}}</td>
											<td class="no_brdr 3_brder"> <a href="customer_details/{{$value->user_id}}/{{$value->orderid}}" class="btn___green" style="padding:8px 25px !important; position:relative;"><i class="far fa-search-plus"></i> View</a></td>
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
	</style>


</body>
</html>