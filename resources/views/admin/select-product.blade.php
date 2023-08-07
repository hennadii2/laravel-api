@include('admin.z_header')
<title>Pre-Loaded Products | Top Shelf Menu</title>
	<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
	<link href="{{URL::to('/')}}/admin/css/select-product.css?" rel="stylesheet" type="text/css" />
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
$allChecked='';
if(!empty($_GET['checkType'])){
	if($_GET['checkType']=='all'){
		$allChecked='checked';
	}
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

				<form class="" role="search" name="form1" id="form1" action="publish-product" method="POST">
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
												<div class="checkbox m-0" style="margin-top:1px !important;">
													<label class="p-0" style="color:#333 !important; margin-top:0px !important;">
														<input type="checkbox" class='chk_all' name="chk_all" value="all" <?php echo $allChecked;?> id='checkall'>
														<span class="cr" style=" border-color:#22aa00 !important;">
															<i class="cr-icon fa fa-check" style="color:#333 !important;"></i>
														</span>
														All
													</label>
												</div>
											</div>
											<div class="col-xs-6 col-sm-3 hidden-xs">
												<span><img src="images/icon/sort.png" height="16" width="24" style="float:left; padding-top:7px;" /></span> <span>
												<select class="qty"  onChange="filterByType(this.value);">
													<option value="">By Category</option>
													@if (count($product_type) > 0)
													@foreach($product_type as $key => $value)
													<option value="{{$value->type_id}}" <?php  if (isset($pro_type) && !empty($pro_type)){ if ($value->type_id ==$pro_type) {echo 'selected="selected"'; }} ?>>{{$value->type_name}}</option>
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
												</span> </div>

											<div class="col-xs-6 col-sm-3 hidden-xs"> <span><img src="images/icon/brand.png" height="20" width="20" style="float:left; padding-top:5px; " /></span> <span>
												<select class="qty" id="sel_brand" onChange="filterByBrand(this.value);">
													<option value="">By Brand</option>
													@if (count($product_brand) > 0)
													@foreach($product_brand as $key => $value)
													<option value="{{$value->brand_id}}" <?php  if (isset($brand_type) && !empty($brand_type)){ if ($value->brand_id ==$brand_type) {echo 'selected="selected"'; }} ?>>{{$value->name}}</option>
													@endforeach
													@endif
												</select>
												</span> </div>

											<div class="col-xs-6 col-sm-2 text-right">
												<a href="javascript:void();" onclick="nextAction();" class="btn___green" style="padding:8px 25px !important; position:relative; top:-8px;">Next</a>
											</div>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>

							<div id="selectd_div">
								<?php
								if(!empty($_GET['selPro'])){
									$myArray = explode(',', $_GET['selPro']);
									for($t=0;$t<count($myArray);$t++){?>
								<span id="select_pro_<?php echo $myArray[$t];?>"><input type="hidden" value="<?php echo $myArray[$t];?>" name="preSel[]"> </span>
								<?php }}?>
							</div>
							<div id="error_div"></div>





							<div style=" padding:20px;">

								<!-- Shop Item -->
								<div class="row container-grid" style="">
									<h4 class="text-center">Choose From These Pre-Loaded Products</h4>
									<p class="text-center"><small>You will be able to edit each product you select on the next step.</small></p>
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
								<!-- End Pagination Nav -->
							</div>

						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
	<!-- Site Wraper End -->

	@include('admin.z_footer')

	<script src="{{URL::to('/')}}/admin/js/extra/selectProduct.js"></script>
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
			var checkboxes = document.getElementsByName("preSel[]");
			var selPro = [];
			for (var i= 0; i<checkboxes.length;i++)
			{
				selPro.push(checkboxes[i].value);
			}
			if(document.getElementById("checkall").checked == true){
				var checkType='all';
			}else{
				var checkType='none';
			}

			$.ajax(
				{
					url: '?page=' + page+'&brand_type='+brand+'&pro_type='+pro_type+'&search_key='+search_q+'&selPro='+selPro+'&checkType='+checkType,
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
		$(document).ready(function () {

			// binding the check all box to click event
			$(".chk_all").click(function () {

				var checkAll = $(".chk_all").prop('checked');
				if (checkAll) {
					$(".checkboxes").prop("checked", true);


					var checkboxes = document.getElementsByName("sel_pro[]");
					var arrayVal = [];
					for (var i= 0; i<checkboxes.length;i++)
					{
						if (checkboxes[i].checked === true)
						{
							document.getElementById('shop_item_'+checkboxes[i].value).classList.add('select_product_active');
							arrayVal.push(checkboxes[i].value);
							$("#selectd_div").append('<span id="select_pro_'+checkboxes[i].value+'"><input type="hidden" value="'+checkboxes[i].value+'" name="preSel[]"> </span>');
						}
					}


				} else {

					$(".checkboxes").prop("checked", false);
					var checkboxes = document.getElementsByName("sel_pro[]");
					var arrayVal = [];
					for (var i= 0; i<checkboxes.length;i++)
					{
						if (checkboxes[i].checked === true)
						{
							document.getElementById('shop_item_'+checkboxes[i].value).classList.add('select_product_active');
							$("#selectd_div").append('<span id="select_pro_'+checkboxes[i].value+'"><input type="hidden" value="'+checkboxes[i].value+'" name="preSel[]"> </span>');

						}else{
							document.getElementById('shop_item_'+checkboxes[i].value).classList.remove('select_product_active');
							document.getElementById("select_pro_"+checkboxes[i].value).remove();
							/*var elem = document.getElementById("select_pro_"+checkboxes[i].value);
     elem.parentNode.removeChild(elem);*/

						}
					}

				}

			});

			// if all checkbox are selected, check the selectall checkbox and vise versa
			$(".checkboxes").click(function(){

				if($(".checkboxes").length == $(".subscheked:checked").length) {
					$(".chk_all").attr("checked", "checked");
				} else {
					$(".chk_all").removeAttr("checked");
				}

				var checkboxes = document.getElementsByName("sel_pro[]");
				var arrayVal = [];
				for (var i= 0; i<checkboxes.length;i++)
				{
					if (checkboxes[i].checked === true)
					{
						document.getElementById('shop_item_'+checkboxes[i].value).classList.add('select_product_active');
						arrayVal.push(checkboxes[i].value);
						$("#selectd_div").append('<span id="select_pro_'+checkboxes[i].value+'"><input type="hidden" value="'+checkboxes[i].value+'" name="preSel[]"> </span>');
					}
				}

			});

		});

		function nextAction(){
			var checkTeam = [];
			var tb=0;
			var delTeamList = document.getElementsByName("preSel[]");
			for(var h=0; h < delTeamList.length; h++){
				tb++;
			}
			if(tb>0){
				document.form1.submit();
			}else{
				document.getElementById("error_div").innerHTML = '<div class="alert alert-danger" id="errordiv">Please select at least one product. <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>';

			}
		}

		function selectSingle(selId){
			if(document.getElementById("sel_id_"+selId).checked == true){
				document.getElementById('shop_item_'+selId).classList.add('select_product_active');
				$("#selectd_div").append('<span id="select_pro_'+selId+'"><input type="hidden" value="'+selId+'" name="preSel[]"> </span>');
				var currentItem = document.getElementById('shop_item_' +selId);
				var mask = currentItem.childNodes[3]
				mask.classList.add('mask--active');

			}else{
				document.getElementById('shop_item_'+selId).classList.remove('select_product_active');
				var elem = document.getElementById("select_pro_"+selId);
				var currentItem = document.getElementById('shop_item_' +selId);
				var mask = currentItem.childNodes[3]
				mask.classList.remove('mask--active');
				return elem.parentNode.removeChild(elem);
			}
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