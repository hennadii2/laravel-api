@include('admin.z_header')
<title>Edit Products | Top Shelf Menu</title>
<link href="css/custom__dashboard.css" rel="stylesheet" type="text/css" />  
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
			<div  class="box__shadow"  style="background-color:#fff; padding:40px;">
				<div class="row">

					<div class="col-lg-12 col-sm-12 col-xs-12">
						<table class="table mb-0">
							<tbody>
								<tr>
									<th class="th__head">Product Name</th>
									<th class="th__head">Category</th>
									<th class="th__head">Brand</th>
									<th class="th__head">Action</th>
								</tr>
								@if (count($product_data) > 0)
								@foreach($product_data as $key => $value)
								<?php
								$category = DB::table('admin_type')->where('type_id','=', $value->pro_type)->first();
								$brand = DB::table('admin_brand')->where('brand_id','=', $value->brand)->first();
								?>
								<tr>
									<td>{{$value->pro_title}}</td>
									<td><?php if(isset($category->type_name)){ echo $category->type_name;}?></td>
									<td><?php if(isset($brand->name)){ echo $brand->name;}?></td>

									<td>
										<a href="{{URL::to('/')}}/admin/update-product/{{$value->prod_id}}" class="edit_green_text"><i class="fa fa-pencil"></i> Edit</a> &nbsp; | &nbsp;
										<a href="{{URL::to('/')}}/admin/delete_product/{{$value->prod_id}}/2" onclick="return confirm('Are you sure you want to delete this product?')" class="dlt_red_text"><i class="fa fa-trash"></i> Delete</a></td>
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
			color: #F00 !important;
			font-weight: 600;
			text-transform: uppercase;
			font-family: 'proxima_nova_rgbold';
		}

		a.dlt_red_text:hover{
			color: #222222 !important;
		}


	</style>
</body>
</html>