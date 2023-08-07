@include('front.z_header')
<title>Menu | Company Name Here</title>
</head>

<body>
	@include('front.z_right_menu')
	<?php
	$pro_type='';
	$brand_type='';
	$sort_by='';
	if(!empty($_GET['pro_type'])){
		$pro_type=$_GET['pro_type'];
	}
	if(!empty($_GET['brand_type'])){
		$brand_type=$_GET['brand_type'];
	}
	if(!empty($_GET['sort_by'])){
		$sort_by=$_GET['sort_by'];
	}

	?>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->

		@include('front.z_top')
		<!-- End Header -->
		<!-- CONTENT --------------------------------------------------------------------------------->

		<!-- Intro -->
		<section class="main_banner">
			<?php
			if(Session::get('member_cover')!=''){?>
			<img src="{{URL::to('/')}}/images/banner.jpg" class="text-center" />
			
			<?php } else{?>
			<img src="{{URL::to('/')}}/<?php echo  Session::get('member_cover');?>" class="text-center" />
			<?php } ?>
			<div class="clearfix"></div>
		</section>
		<!-- End Intro -->
		<div class="clearfix"></div>
		<section class="wow fadeIn animated filter__menu">
			<div style="border-bottom:3px solid #f4f4f4; min-height:57px; ">
				<div class="container">
					<nav class="navbar white navbar-default">
						<div class="navbar-header">
							<a onClick="filterByTypeAll();" href="javascript:void();" class="all_product">All Products</a>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-1" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span> <span class="icon-bar top-bar"></span>
								<span class="icon-bar middle-bar"></span> <span class="icon-bar bottom-bar"></span>
							</button>
						</div>
						<div id="navbar-1" class="navbar-collapse collapse mainnav ">
							<ul class="nav navbar-nav">
								@if (count($product_type) > 0)
								@foreach($product_type as $key => $value)
								<li><a class="<?php  if (isset($pro_type) && !empty($pro_type)){ if ($value->type_id==$pro_type) {echo 'active'; }} ?>" onClick="filterByType({{$value->type_id}});" href="javascript:void();">{{$value->type_name}} </a>
									<?php
									$query = DB::table('admin_type')->where('parentid','=', $value->type_id)->get();
									if(count($query)>0)
									{ ?>

									<div class="asr_menu" style="left: 7px;">
										<ul>
											<?php foreach($query as $key => $sub_cat){ ?>
											<li><a onClick="filterByType({{$sub_cat->type_id}});" href="javascript:void();"><?php echo $sub_cat->type_name;?></a></li>
											<?php } ?>
										</ul>
									</div>
									<?php } ?>
								</li>
								@endforeach
								@endif

							</ul>
						</div>
						<input type="hidden" name="page" id="page" value="" />
						<input type="hidden" name="pro_type" id="pro_type" value="<?php echo $pro_type;?>" />
						<input type="hidden" name="user_name" id="user_name" value="{{$user_name}}" />
						<input type="hidden" name="brand_type" id="brand_type" value="<?php echo $brand_type;?>" />
						<input type="hidden" name="sort_by" id="sort_by" value="<?php echo $sort_by;?>" />

						<!--/.nav-collapse -->

					</nav>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="clearfix"></div>
			<!-- Shop Item Section -->
		</section>
		<div class="clearfix"></div>
		<section class="pb-60 pt-60 pt-xs-30">
			<div class="container">
				<!-- Sort List -->
				<div class="row mb-15 ">
					<div class="col-lg-6 col-md-6 col-sm-6 hidden-xs">
						<div style="font-size:24px; font-weight:bold; color:#222222;">All Products</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6">
						<div class="row">
							<div class="col-xs-6" style="border-right:1px solid #ddd;"> <span><img src="{{URL::to('/')}}/images/icon/sort.png" height="16" width="24" style="float:left; padding-top:7px;" /></span> <span>
								<select class="qty" onChange="filterBySort(this.value);">
									<option value="">Sort By</option>
									<option value="1" <?php  if (isset($sort_by) && !empty($sort_by)){ if (1==$sort_by) {echo 'selected="selected"'; }} ?> >Popular</option>
									<option value="2" <?php  if (isset($sort_by) && !empty($sort_by)){ if (2==$sort_by) {echo 'selected="selected"'; }} ?>>Latest</option>
									<option value="3" <?php  if (isset($sort_by) && !empty($sort_by)){ if (3==$sort_by) {echo 'selected="selected"'; }} ?>>Price High To Low</option>
									<option value="4" <?php  if (isset($sort_by) && !empty($sort_by)){ if (4==$sort_by) {echo 'selected="selected"'; }} ?>>Price Low To High</option>
								</select>
								</span>
							</div>
							<div class="col-xs-6">
								<span><img src="{{URL::to('/')}}/images/icon/brand.png" height="20" width="20" style="float:left; padding-top:5px; " /></span> <span>
								<select class="qty" onChange="filterByBrand(this.value);" >
									<option value="">Select Brand</option>
									@if (count($product_brand) > 0)
									@foreach($product_brand as $key => $value)
									<option value="{{$value->brand_id}}" <?php  if (isset($brand_type) && !empty($brand_type)){ if ($value->brand_id ==$brand_type) {echo 'selected="selected"'; }} ?>>{{$value->name}}</option>
									@endforeach
									@endif
								</select>
								</span> </div>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
				<!-- End Sort List -->

				<!-- Shop Item -->
				<div class="row container-grid" style="">
					<div class="item_list">
						@if (count($product_data) > 0)
						<ul>
							@foreach($product_data as $key => $value)
							<?php
							$UrlNames = str_replace("/","",str_replace(",",",",str_replace("","_",str_replace("-","_",str_replace("&","",str_replace("*","",str_replace("+","",str_replace("=","",str_replace("%","",str_replace("@","",str_replace("$","",str_replace("#","",str_replace("{","",str_replace("}","",str_replace("(","",str_replace(")","",str_replace(">","",str_replace("<","",str_replace(";","",str_replace("'","",str_replace('"',"",str_replace('`',"",str_replace('!',"",str_replace(':',"",str_replace('~',"",trim($value->pro_title))))))))))))))))))))))))));
							$UrlNames = str_replace("?","",$UrlNames);
							$UrlNames = str_replace("^","",$UrlNames);
							$UrlNames = str_replace("%","",$UrlNames);
							$UrlNames = str_replace(" ","",$UrlNames);
							?>
							<form id="form-login"  role="form" method="POST" action="{{$user_name}}/addItemCart">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="pro_id" id="pro_id" value="{{$value->prod_id}}" />
								<input type="hidden" name="user_name" id="user_name" value="{{$user_name}}" />
								<input type="hidden" name="pro_price" id="pro_price" value="{{number_format($value->pro_price,2)}}" />

								<li>
									<div class="item-box">
										<!-- Shop item images -->
										<div class="shop-item">
											<div class="item-img">
												<?php
												if($value->pro_image!=''){?>
												<div class="border__btm"><img src="{{URL::to('/')}}/product_images/{{$value->prod_id}}/{{$value->pro_image}}" style="height:100%;" /></div>
												<?php }else{?>
												<div class="border__btm"><img src="{{URL::to('/')}}/default.png" style="height:100%;" /></div>  
												<?php } ?>
												<div class="shop-item-info">
													<div class="shop-item-name"><a href="{{URL::to('/')}}/{{$user_name}}/product-details/{{$value->prod_id}}/{{$UrlNames}}">{{$value->pro_title}} </a></div>
													<div class="shop-item-cate"><span>{{$value->name}}</span></div>
												</div>
												<div class="item-rate">Starting at <b>${{number_format($value->pro_price,2)}}</b></div>
											</div>
											<div class="item-mask">
												<div class="item-mask-detail">

													<div class="item-mask-detail-ele">
														<button class="details_btn add_bag_btn" type="submit"> Add to Bag </button>
														<a class="details_btn" href="{{URL::to('/')}}/{{$user_name}}/product-details/{{$value->prod_id}}/{{$UrlNames}}">View Details</a>
													</div>
												</div>
											</div>
										</div>
										<!-- End Shop item images -->
									</div>
								</li>
							</form>
							@endforeach
						</ul>
						@else
						<div style="text-align: left;">  I don't have any records!  </div>
						@endif
						<div class="clearfix"></div>
					</div>
				</div>
				<!-- End Shop Item -->

				<!-- End Pagination Nav -->
			</div>
		</section>
		@include('front.z_bottom')
	</div>
	<!-- Site Wraper End -->
	@include('front.z_footer')

	<style>
		.nav>li>a {
			margin: 0px 5px !important;
		}
		.border__btm {
			height: 218px !important;
			overflow: hidden;
		}
	</style>
</body>
</html>