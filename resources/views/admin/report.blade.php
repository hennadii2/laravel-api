@include('admin.z_header')
<title>Reports | Top Shelf Menu</title>
	<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
<?php
$pro_type='';
$brand_type='';

if(!empty($_GET['pro_type'])){
	$pro_type=$_GET['pro_type'];
}
if(!empty($_GET['pro_brand'])){
	$brand_type=$_GET['pro_brand'];
}
?>
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
			<div class="alert alert-success" role="alert"><button class="close" data-dismiss="alert"></button>Email has been sent successfully.</div>
			@endif
			<div class="row">

				<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
					<div class="row">

						<div class="col-sm-6 col-xs-12">
							<div class="box_sales box__shadow">
								<div class="p__30">
									<div class="box_top_text" style="color:#22242d !important;">Monthly Sales Avg.</div>
									<h3 class="box_mid_heading" style="min-height:36px; font-size:36px; line-height:38px;">${{number_format($month_sales,2)}}  </h3>
								</div>
							</div>


						</div>
						<div class="col-sm-6 col-xs-12">
							<div class="box_customer box__shadow">
								<div class="p__30">
									<div class="box_top_text">New Customers This Month </div>
									<h3 class="box_mid_heading profit__amt"> {{$month_customer}} </h3>
								</div>
							</div>
						</div>


					</div>

				</div>


				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<div style="background-color:#fff;" class="box__shadow">
						<div class="table__main__title">10 Most Popular Products</div>
						<div class="scrollbar" style="max-height: 230px;">
							<div style="padding:0px 20px; background-color:#fff !important;">
								<table class="table mb-0 v_a_top">
									<tbody>
										<tr>
											<th colspan="2" class="th__head">Product Name</th>
											<th class="th__head" style="width:40%;">Brand</th>
										</tr>
										@if (count($popular_product) > 0)
										@foreach($popular_product as $key => $value)
										<tr>
											<td class="thumb__img">
												<?php
												if($value->pro_image!=''){?>
												<img src="{{URL::to('/')}}/product_images/{{$value->prod_id}}/{{$value->pro_image}}" class="product__img" />
												<?php }else{?>
												<img src="{{URL::to('/')}}/default.png" class="product__img" />
												<?php }?>
											</td>
											<td class="pro____title"><a href="#">{{$value->pro_title}}</a></td>
											<td class="brand__name"> {{$value->name}}</td>
										</tr>
										@endforeach
										@else
										<tr>
											<td class="thumb__img"> No Records</td>
										</tr>
										@endif

									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="row page__main__heading">
				<div class="col-sm-12 col-sx-12">
					<h3>Sales Revenue</h3>
				</div>

			</div>
			<div  class="box__shadow"  style="background-color:#fff; padding:40px;">
				<div class="row">

					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<div>
							<form role="form" id="search" name="search" action="report" method="post"  >
								<input type="hidden" name="_token" value="{{ csrf_token() }}">

								<div class="row">
									<div class="col-xs-6 col-sm-3 p_lr_5">
										<h5>Select by brand</h5>
										<select name="pro_brand" id="pro_brand" class="cart_quantity full_input" style="height:35px; max-width:400px;">
											<option value="">Brand</option>
											@foreach($brand as $key => $value)
											<option value="{{$value->brand_id}}" <?php  if (isset($brand_type) && !empty($brand_type)){
	if ($value->brand_id ==$brand_type) {echo 'selected="selected"'; }} ?>>{{$value->name}}</option>
											@endforeach

										</select></div>
									<div class="col-xs-6 col-sm-3 p_lr_5">
										<h5>Product Type.</h5>
										<select name="pro_type" id="pro_type" class="cart_quantity full_input" style="height:35px; max-width:400px;">
											<option value="">Category</option>
											@foreach($type as $key => $value)
											<option value="{{$value->type_id}}" <?php  if (isset($pro_type) && !empty($pro_type)){
	if ($value->type_id ==$pro_type) {echo 'selected="selected"'; }} ?>>{{$value->type_name}}</option>
											@endforeach
										</select></div>


									<div class="col-xs-9 col-sm-6 p_lr_5"> <div class="btn-group m-b-10">
										<h5>Filter By <span class="semi-bold">Date Range</span></h5>
										<div class="input-daterange input-group" id="datepicker-range">
											<input type="text" class="form-control" name="start"    id="start_date" />
											<span class="input-group-addon">to</span>
											<input type="text" class="form-control" name="end" id="end_date"  />

										</div>

										</div>
									</div>
									<input type="hidden" name="page" id="page" value="" />
									<input type="hidden" name="download_csv" id="download_csv" value="0" />
									<div class="col-xs-3 col-sm-12 p_lr_5 text-right">
										<h5 class="visible-xs">&nbsp;</h5>
										<button type="button"  onClick="viewReport();" class="btn btn-success btn-cons">VIEW</button>
										<button type="button"  onClick="doenloadCSV();" class="btn btn-success btn-cons">DOWNLOAD </button>

									</div>

								</div>



							</form>

							<style>
								.p_lr_5{ padding-left:5px !important; padding-right:5px !important; margin-bottom:5px !important;}
							</style>
						</div>
						<div>
							<table class="table mb-0">
								<tbody>
									<tr>
										<th class="th__head">Date</th>
										<th class="th__head">Total Revenue</th>
										<th class="th__head">Average Order Size</th>
										<th class="th__head">Total Customers</th>
									</tr>

									<tr>
										<td>{{$sel_date}}</td>
										<td>${{number_format($date_sales,2)}}</td>
										<td>${{number_format($avg_sales,2)}}</td>

										<td>{{$total_cus}}</td>
									</tr>



									<tr>
										<td colspan="4">
											<div style="max-width:180px; background-color:#22242d; color:#fff; padding:15px 20px;">
												<div class="box_top_text">Total</div>
												<h3 class="box_mid_heading mb-0">${{number_format($date_sales,2)}}</h3>
											</div>
										</td>
									</tr>

								</tbody>
							</table>

						</div>
					</div>
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<div class="chart-wrapper">
							<div class="pt-sd pr-md pb-md pl-md">
								<div class="table-responsive">
									<div class="chart" id="revenue-chart" style="height: 800px;">


										<div id="container_div" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

										<script>

											Highcharts.chart('container_div', {

												title: {
													text: 'Sales Revenue'
												},
												yAxis: {
													title: {
														text: 'Sales Report'
													}
												},
												xAxis: {
													categories: <?php echo $add_date;?>
												},
													credits: {
														enabled: false
													},
													legend: {
														layout: 'vertical',
														align: 'right',
														verticalAlign: 'middle'
													},

													series: [{
														name: 'Sale',
														data: <?php echo $str4;?>
													}],

														responsive: {
														rules: [{
														condition: {
														maxWidth: 500
													},
															 chartOptions: {
															 legend: {
															 layout: 'horizontal',
															 align: 'center',
															 verticalAlign: 'bottom'
															 }
															 }
															 }]
												}

											});
										</script>

									</div>
								</div>
							</div>
						</div>
						<!-- <img src="{{URL::to('/')}}/admin/images/report/b4.png" style="margin-top:30px;" />-->
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- Site Wraper End -->

	@include('admin.z_footer')
	<style>
		.table>tbody>tr>td{ padding:15px 0px 13px 0px !important; color:#808080 !important; font-weight:400;}
		th.th__head {
			font-family: 'proximanova_regular';
			font-weight: bold;
			color: #222222 !important;
		}
	</style>

	<script src="{{URL::to('/')}}/admin/js/extra/manageReport.js?2"></script>

</body>
</html>