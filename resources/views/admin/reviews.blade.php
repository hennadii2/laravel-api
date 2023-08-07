@include('admin.z_header')
<title>Product Reviews | Top Shelf Menu</title>
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
								<div class="heading_style_left"> <span class="title">Product Reviews</span> </div>
							</div>
							<form role="search" id="searchform" action="reviews" method="get">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<input type="hidden" name="page" id="page" value=""  />
								<div class="col-md-3 col-sm-4 col-xs-12  mb-20">
									<div class="input-group btn-block">
										<select name="filter" id="filter" class="cart_quantity full_input" onChange="filterReview(this.value);" style="height:34px !important; max-width:100% !important;">
											<option value="">Filter by Status</option>

											<option value="1" <?php  if (isset($_GET['status'])){ if ($_GET['status'] =='1') {echo 'selected="selected"'; }} ?>>Pending</option>
											<option value="2" <?php  if (isset($_GET['status'])){ if ($_GET['status'] =='2') {echo 'selected="selected"'; }} ?>>Approve</option>
										</select>

									</div>
								</div>
							</form>
						</div>


						<form role="search" id="searchform" action="{{URL::to('/')}}/admin/reviews" method="post" >
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="row mb-5">
								<div class="col-xs-12 col-sm-12 p_lr_5">
									<div class="row">
										<div class="col-xs-12 col-sm-6 mb-10">
											<div class="row">
												<div class="col-xs-9">
													<div class="input-daterange input-group" id="datepicker-range">
														<input type="text" class="form-control" name="start_date" required   id="start_date" />
														<span class="input-group-addon">to</span>
														<input type="text" class="form-control" name="end_date" required id="end_date"  />

													</div>
												</div>
												<div class="col-xs-3" style="padding-left:0px;">
													<button type="submit"  class="btn btn-success btn-block btn-cons"><i class="fa fa-fw fa-search"></i> <span class="hidden-xs">FILTER</span></button>
												</div>
											</div>

										</div>

										<div class="col-xs-12 col-sm-5 col-offset-sm-1 pull-right">
											<div class="row mb-5" style="padding: 0px 10px; margin-bottom:5px;">
												<div class="col-xs-12 col-sm-4"> </div>
												<div class="col-xs-6 col-sm-4" style="padding: 0px 5px;"><a href="#popup_preview"  class="btn btn-success btn-block btn-cons"><i class="fa fa-fw fa-search-plus"></i> PREVIEW</a>   </div>
												<div class="col-xs-6 col-sm-4" style="padding: 0px 5px;"><a href="#popup_edit"  class="btn btn-success btn-block btn-cons"><i class="fa fa-fw fa-pencil"></i> EDIT EMAIL</a> </div>
											</div>



										</div>
									</div>
								</div>

							</div>
						</form>
						<form role="search" id="searchform" action="{{URL::to('/')}}/admin/ratingRequest" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="tree-top-content">
								<div class="row">
									<div class="col-xs-12 col-sm-3 col-md-2 mb-20"><button type="submit"  class="btn btn-primary btn-block btn-cons" style="background-color:#333;"><i class="fa fa-fw fa-send-o"></i> SEND REVIEW</button>  </div>
								</div>
								<div class="table-responsive">
									<table class="table table-striped table-bordered">
										<tbody>
											<tr>
												<th class="no_brdr th_brdr_3 ">
													<div class="checkbox m-0" style="margin-top:1px !important;">
														<label class="p-0" style="color:#333 !important; margin-top:0px !important;">
															<input type="checkbox" id="select_all"/>
															<span class="cr" style=" border-color:#22aa00 !important;">
																<i class="cr-icon fa fa-check" style="color:#333 !important;"></i>
															</span>

														</label>
													</div>
												</th>
												<th class="no_brdr th_brdr_3 ">Order Id</th>
												<th class="no_brdr th_brdr_3 ">Name</th>
												<th class="no_brdr th_brdr_3 ">Email</th>
												<th class="no_brdr th_brdr_3 ">Total Amount</th>
												<th class="no_brdr th_brdr_3 ">Review Status</th>
												<th class="no_brdr th_brdr_3 ">Action</th>
											</tr>
											@if (count($review_list) > 0)
											@foreach($review_list as $key => $value)
											<?php
											$status='';
											if($value->review_status!='0'){
												if($value->review_status=='1'){
													$status='Pending';
												}
												if($value->review_status=='2'){
													$status='Approved';
												}
											}  ?>
											<tr>

												<?php if($value->rating_status=='0'){ ?>
												<td class="no_brdr" valign="top"><div class="checkbox m-0" style="margin-top:1px !important;">
													<label class="p-0" style="color:#333 !important; margin-top:0px !important;">

														<input class="checkbox" type="checkbox" name="check[]" value="{{$value->orderid}}"  >
														<span class="cr" style=" border-color:#22aa00 !important;">
															<i class="cr-icon fa fa-check" style="color:#333 !important;"></i>
														</span>

													</label>
													</div>
												</td>
												<?php }else{?>
												<td></td>
												<?php }?>
												<td class="no_brdr" valign="top">{{$value->order_id}} </td>
												<td class="no_brdr" valign="top">{{ucfirst($value->fname)}} {{ucfirst($value->lname)}}</td>
												<td class="no_brdr" valign="top">{{$value->email}}</td>

												<td class="no_brdr 3_brder"> ${{number_format($value->order_amount,2)}}</td>
												<td class="no_brdr" valign="top">{{$status}}</td>

												<?php if($value->review_status!='0'){ ?>
												<td class="no_brdr 3_brder"> <a href="review_details/<?php echo base64_encode($value->orderid);?>" class="btn___green" style="padding:8px 25px !important; position:relative;"><i class="fa fa-fw fa-pencil"></i> EDIT</a></td>
												<?php }else{?>
												<td class="no_brdr 3_brder"></td>
												<?php }?>


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
						</form>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- Site Wraper End -->

	<!-- preview popup -->
	<div id="popup_preview" class="overlay_how_it_work">
		<div class="popup_how_it_work">
			<h4>Preview</h4> <a class="close" href="#">x</a>

			<div style="background-color:#fff;">
				<div style="width:140px;  margin:0px auto !important; border-radius: 50%;"><div style="width:130px; height:120px; background-color:#22242d; display:table-cell; vertical-align:middle; text-align:center; overflow:hidden; border-radius:50%; padding:10px;">
					<img src="http://topshelfmenu.us/public/images/logo.png" style="max-width:100%;" alt="" /></div></div>
				<h2 style="font-weight:600; color:#22aa00; text-align:center; padding-top:0px;">Review Product</h2>

				<div style="margin-bottom:10px;"><b>Hi [USER_NAME],</b></div>

				<p> <?php echo nl2br(htmlspecialchars_decode(stripslashes($mail_contain->re_message)));?></p>
				<div style="text-align:center; margin:60px 30px 30px 30px;">
					<a style="background-color: #22aa00; border:2px solid #22aa00; text-transform:uppercase; font-size: 16px; font-weight: 600;  color: #fff; padding: 10px 30px; text-decoration:none;" href="">Review the Prodcuct</a> </div>
				<div style="background-color:#F0FFFF; text-align:center; padding:20px; margin-bottom:20px; margin-top:20px;">
					<div>Have A Question ?</div>
					<div><a href="#" style="margin:3px 5px;">support@topshelfmenu.us</a></div>
				</div>

			</div>

		</div>
	</div>
	<!-- preview popup -->

	<!-- edit popup -->
	<div id="popup_edit" class="overlay_how_it_work">
		<div class="popup_how_it_work">
			<h4>Edit</h4> <a class="close" href="#">x</a>

			<div style="background-color:#fff;">
				<form  name="myform" action="review_mail_update" method="post" >
					<input type="hidden" name="_token" value="{{ csrf_token() }}">

					<div class="brdr_btm_br">
						<textarea class="input-group-lg full_input" style="height:180px;" id="re_message" name="re_message" ><?php echo stripslashes($mail_contain->re_message);?></textarea>
						<span id="pro_desc_error" style="color: red; display: none;"></span>
					</div>

					<div class="mt-20 text-right">
						<button type="submit" name="submit" class="btn___green">UPDATE</button>
					</div>
				</form>

			</div>

		</div>
	</div>
	<!-- edit popup -->

	<!-- how it work popup -->


	@include('admin.z_footer')
	<style>
		.table>tbody>tr>td, .table>tbody>tr>th{ padding:12px 10px 10px 15px !important; color:#808080 !important;}
		th.th__head {

			font-weight: bold;
			color: #222222 !important;
		}
	</style>
	<script src="{{URL::to('/')}}/admin/js/extra/review.js"></script>  >
	<script type="text/javascript">
		var select_all = document.getElementById("select_all"); //select all checkbox
		var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

		//select all checkboxes
		select_all.addEventListener("change", function(e){
			for (i = 0; i < checkboxes.length; i++) {
				checkboxes[i].checked = select_all.checked;
			}
		});


		for (var i = 0; i < checkboxes.length; i++) {
			checkboxes[i].addEventListener('change', function(e){ //".checkbox" change
				//uncheck "select all", if one of the listed checkbox item is unchecked
				if(this.checked == false){
					select_all.checked = false;
				}
				//check "select all" if all checkbox items are checked
				if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
					select_all.checked = true;
				}
			});
		}
	</script>
</body>
</html>