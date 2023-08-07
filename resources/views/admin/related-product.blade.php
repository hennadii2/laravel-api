@include('admin.z_header')
<title>Related Products | Top Shelf Menu</title>
<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/select-product.css" rel="stylesheet" type="text/css" />
</head>

<?php
$pro_type='';
$brand_type='';
$sort_by='';
$search_key='';
if(!empty($_GET['pro_type'])){
	$pro_type=$_GET['pro_type'];
}
if(!empty($_GET['brand_type'])){
	$brand_type=$_GET['brand_type'];
}
if(!empty($_GET['sort_by'])){
	$sort_by=$_GET['sort_by'];
}

if(!empty($_GET['search_key'])){
	$search_key=$_GET['search_key'];
}

?>
<style>
	.wrapper > ul#results li {
		margin-bottom: 1px;
		background: #f9f9f9;
		padding: 20px;
		list-style: none;
	}
	.ajax-loading{
		text-align: center;
	}
</style>
<body>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->
		@include('admin.z_top')
		<!-- End Header -->

		<div class="clearfix"></div>
		<section class="main__container">
			<div class="row">

				<form class="" role="search" name="form1" id="form1" action="publish-related-product" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="action" value="notadd">
					<input type="hidden" name="page" id="page" value="" />
					<input type="hidden" name="pro_type" id="pro_type" value="<?php echo $pro_type;?>" />
					<input type="hidden" name="brand_type" id="brand_type" value="<?php echo $brand_type;?>" />
					<input type="hidden" name="search_q" id="search_q" value="<?php echo $search_key;?>" />



					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div style="background-color:#fff;" class="box__shadow">
							<div class="table__main__title">
								<div class="row mb-0">
									<div class="col-lg-10 col-md-9 col-sm-12">
										<div class="row">
											<div class="col-xs-12 col-sm-3">

												<div class="input-group">
													<input type="text" class="form-control" placeholder="Search" name="q" id="search_text">
													<div class="input-group-btn">
														<button class="btn btn-default" onclick="filterByText();" type="button"><i class="fa fa-fw fa-search"></i></button>
													</div>
												</div>

											</div>

											<div class="col-xs-6 col-sm-1">
											</div>
											<div class="col-xs-6 col-sm-3 hidden-xs"> 
												<span><img src="images/icon/sort.png" height="16" width="24" style="float:left; padding-top:7px;" /></span> 
												<span>
													<select class="qty"  onChange="filterByType(this.value);">
														<option value="">By Category</option>
														@if (count($product_type) > 0)
														@foreach($product_type as $key => $value)
														<option value="{{$value->type_id}}" <?php  if (isset($pro_type) && !empty($pro_type)){
	if ($value->type_id ==$pro_type) {echo 'selected="selected"'; }} ?>>{{$value->type_name}}</option>
														<?php
														$query = DB::table('admin_type')->where('parentid','=', $value->type_id)->get();
														if(count($query)>0)
														{
															foreach($query as $key => $sub_cat){ ?>
														<option value="{{$sub_cat->type_id}}" <?php  if (isset($pro_type) && !empty($pro_type)){ if ($sub_cat->type_id ==$pro_type) {echo 'selected="selected"'; }} ?>> -- {{$sub_cat->type_name}}</option>
														<?php }}?>

														@endforeach
														@endif
													</select>
												</span> 
											</div>

											<div class="col-xs-6 col-sm-3 hidden-xs"> 
												<span><img src="images/icon/brand.png" height="20" width="20" style="float:left; padding-top:5px; " /></span> 
												<span>
													<select class="qty" id="sel_brand" onChange="filterByBrand(this.value);">
														<option value="">By Brand</option>
														@if (count($product_brand) > 0)
														@foreach($product_brand as $key => $value)
														<option value="{{$value->brand_id}}" <?php  if (isset($brand_type) && !empty($brand_type)){
	if ($value->brand_id ==$brand_type) {echo 'selected="selected"'; }} ?>>{{$value->name}}</option>
														@endforeach
														@endif
													</select>
												</span> 
											</div>

										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<div class="container-grid m-b-20" style="padding:20px;">
								<div class="row" style="margin:15px 0px 0px 0px;">
									<div class="col-sm-12">
										<div class="alert alert-success"> 
											Choose a Maximum of 4 products that you want to display on the cart for up-selling.<a href="#popup_preview" style="color:#fff;float:right;"><i class="fal fa-search-plus"></i> Click to See an Example</a>
										</div> 
									</div>
								</div>

								<!-- Modal -->
								<div id="popup_preview" class="overlay_how_it_work">
									<div class="popup_how_it_work">
										<h4>Related Products Example</h4> <a class="close" href="#">x</a>

										<div style="background-color:#fff;">
											<img src="/admin/images/related-preview.jpg" />
										</div>

									</div>
								</div>
								<!-- preview popup -->

								<div class="row container-grid">
									<h4 class="text-center">Active Related Products</h4>
									<hr style="width:18%;"/>
									<div class="item_list">
										<ul id="selectd_div">
											<?php
											if (count($related_product) > 0){
												foreach($related_product as $key => $pro){
													$img='';
													if($pro->pro_image==''){
														$img='/default.png';
													}else{
														$img='/product_images/'.$pro->prod_id.'/'.$pro->pro_image;
													}
											?>
											<li id="select_pro_{{$pro->prod_id}}"><input type="hidden" value="{{$pro->prod_id}}" name="preSel[]">
												<div class="item-box">
													<div class="shop-item">
														<div class="item-img">
															<div class="border__btm"> <img src="{{URL::to('/')}}/{{$img}}" style="height:100%;"/></div>
															<div class="shop-item-info title_pad">
																<div class="shop-item-name"><a href="#"><?php echo $pro->pro_title;?> </a></div>
															</div>
														</div>
														<div class="item-mask">
															<div class="item-mask-detail">
																<div class="item-mask-detail-ele">
																	<button class="details_btn add_bag_btn mini_btn" type="button" onclick="removSelectSingle(<?php echo $pro->prod_id;?>);"><i class="fa fa-fw fa-trash-o mr_0"></i> </button>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
											<?php }}?>
										</ul>
										<style>
											.mr_0{ margin-right:0px !important;}
											.title_pad{ padding:20px 0px 0px 0px !important;}
										</style>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
							<?php
							if($all_related>4 || $all_related==4){?>
							<div class="alert alert-danger" id="errordiv2">You already selectd 4 products. Please remove a product. </div>
							<?php }?>
							<div id="error_div"></div>
							<div style=" padding:20px;">

								<!-- Shop Item -->
								<div class="row container-grid" style="">
									<h4 class="text-center">Available Products</h4>
									<hr style="width:18%;"/>
									<div class="item_list">
										<ul id="results"><!-- results appear here --></ul>
										<div class="ajax-loading">
											<p><img src="{{URL::to('/')}}/images/loader.gif">Loading More Products</p>

										</div>
										<div class="clearfix"></div>
									</div>
								</div>
								<!-- End Shop Item -->
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
	<!-- Site Wraper End -->

	@include('admin.z_footer')

	<script src="{{URL::to('/')}}/admin/js/extra/relatedProduct.js"></script>
	<script src="{{URL::to('/')}}/admin/js/extra/jquery-1.11.1.min.js"></script>

	<script>
		var page = 1;
		load_more(page);
		$(window).scroll(function() {
			if($(window).scrollTop() + $(window).height() >= $(document).height()) {
				page++;
				load_more(page);
			}
		});
		function load_more(page){
			var brand= $("#brand_type").val();
			var pro_type= $("#pro_type").val();
			var search_q= $("#search_q").val();
			var ta=0;


			var checkPro = [];
			var delTeamList = document.getElementsByName("preSel[]");
			for(var h=0; h < delTeamList.length; h++){
				checkPro.push(delTeamList[h].value);
				ta++;
			}


			$.ajax(
				{
					url: '?page=' + page+'&brand_type='+brand+'&pro_type='+pro_type+'&search_key='+search_q+'&selPro='+checkPro,
					type: "get",
					datatype: "html",
					beforeSend: function()
					{
						$('.ajax-loading').show();
					}
				})
				.done(function(data)
					  {
				if(data.length == 0){
					//notify user if nothing to load
					$('.ajax-loading').html("No more records!");
					return;
				}
				$('.ajax-loading').hide(); //hide loading animation once data is received
				$("#results").append(data); //append data into #results element
			})
				.fail(function(jqXHR, ajaxOptions, thrownError)
					  {
				alert('No response from server');
			});
		}
	</script>

	<script type="text/javascript">
		function selectSingle(selId){
			if(document.getElementById("sel_id_"+selId).checked == true){
				var delTeamList = document.getElementsByName("preSel[]");
				var tr=delTeamList.length;
				if(tr<4){
					$.ajax({
						type: 'get',
						url: '{{ URL::to('/') }}/admin/addRelatedPro',
						data: {'proId': selId},
						success: function(data) {
							location.reload();
						}
					});
				}else{
					document.getElementById('sel_id_'+selId).checked = false;
					alert("You already selectd 4 products.");
				}
			}
		}
		function removSelectSingle(selId){
			$.ajax({
				type: 'get',
				url: '{{ URL::to('/') }}/admin/removeRelatedPro',
				data: {'proId': selId},
				success: function(data) {
					location.reload();
				}
			});
		}

	</script>
	<style>
		.border__btm {
			height: 218px !important;
			overflow: hidden;
		}
	</style>
</body>
</html>