@include('admin.z_header')
<title>Edit Products | Top Shelf Menu</title>
<link href="{{URL::to('/')}}/admin/css/jquery-ui.css" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/smooth-products.css" rel="stylesheet" />
<script>
	function preview_images()
	{
		$('#image_preview').html("");
		$('#diffult_img').hide();
		var total_file=document.getElementById("files-input-upload").files.length;
		for(var i=0;i<total_file;i++)
		{
			$('#image_preview').append("<div class='thumb_preview'><img class='img-responsive' style='width: 100%; height: 100%;' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
		}
	}
</script>
</head>

<body>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->
		@include('admin.z_top')
		<!-- End Header -->

		<div class="clearfix"></div>

		<!-- Shop Item Detail Section -->
		<section class="main__container">
			<div class="">
				<div class="page-breadcrumb"> <a href="{{URL::to('/')}}/admin/index">Home</a>/<span>Update Your Product</span> </div>
				<form role="form" id="form-stander" name="standardType" onSubmit="return validateEditFrm();" action="{{URL::to('/')}}/admin/update_product" method="POST" enctype="multipart/form-data">
					<input type="hidden" value="0" id="save_status" name="save_status" />
					<input type="hidden" value="{{$product_data->prod_id}}" id="edit_id" name="edit_id" />
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<div class="row page__main__heading">
						<div class="col-sm-6 hidden-xs">
						</div>
						<div class="col-sm-6 hidden-xs">
							<div class="text-right">
								<?php if($pro_id>'0'){?>

								<?php
	$product_det = DB::table('products')->where('prod_id', '=', $pro_id)->first();
	$UrlNames = str_replace("/","",str_replace(",",",",str_replace("","_",str_replace("-","_",str_replace("&","",str_replace("*","",str_replace("+","",str_replace("=","",str_replace("%","",str_replace("@","",str_replace("$","",str_replace("#","",str_replace("{","",str_replace("}","",str_replace("(","",str_replace(")","",str_replace(">","",str_replace("<","",str_replace(";","",str_replace("'","",str_replace('"',"",str_replace('`',"",str_replace('!',"",str_replace(':',"",str_replace('~',"",trim($product_det->pro_title))))))))))))))))))))))))));
	$UrlNames = str_replace("?","",$UrlNames);
	$UrlNames = str_replace("^","",$UrlNames);
	$UrlNames = str_replace("%","",$UrlNames);
	$UrlNames = str_replace(" ","",$UrlNames);
								?>

								<a  class="btn___green" href="{{URL::to('/')}}/{{ Session::get('member_name') }}/product-details/{{$pro_id}}/{{$UrlNames}}" target="_blank"><i class="far fa-share-square"></i> View This Product</a>
								<?php }?>
								<button  class="btn__white__border" type="button" id="saveDarf"><img src="{{URL::to('/')}}/admin/images/icon/draft.png" style="margin-right:5px; margin-top:-2px;" />Save as Draft</button>

							</div>
						</div>
					</div>
					@if (Session::has('success'))
					<div class="alert alert-success" id='errordiv'>{{ Session::get('success') }}
						@if(!empty(Session::get('Product_id')))
						<a href="{{URL::to('/')}}/{{ Session::get('member_name') }}/product-details/{{ Session::get('Product_id') }}/{{$UrlNames}}" target="_blank" style="font-weight:600; background-color: #fff; font-size: 14px;  color:#22aa00;  padding: 4px 10px;">View Product</a>
						@else
						<a href="{{URL::to('/')}}/admin/saved-products" target="_blank" style="font-weight:600; background-color: #fff; font-size: 14px;  color:#22aa00;  padding: 4px 10px;">View Product</a>
						@endif
						<span  onclick="hideErrorDiv();" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >×</span></div>
					@endif
					<div style="background-color:#fff;">
						<div class="row mt-30">
							<div class="col-md-12">
								<div class="tree-top-content">
									<!-- Tab -->
									<div>

										<div style="background-color:#fff; padding-top:30px;" class="box__shadow">
											<div class="heading_style"> <span class="title" style="font-size:26px !important;">Update {{$product_data->pro_title}}</span> </div>
											<div style="padding: 10px 30px 30px 30px;">
												<div class="row">

													<div class="col-md-8 col-sm-9 col-xs-12">
														<div class="mb-30">
															<div class="heading_style_left mb-10"> <span class="title">Product Info</span> </div>
															<div class="row">
																<div class="col-md-12">
																	<div class="brdr_btm_br">
																		<label>Product Title <span class="text-danger">*</span> </label>
																		<input type="text" class="input-group-lg full_input" id="pro_title" name="pro_title"  placeholder="Product Title *" value="{{$product_data->pro_title}}" >
																		<span id="pro_title_error" style="color: red; display: none;"></span>
																	</div>
																	<div class="brdr_btm_br">
																		<label>Product Category <span class="text-danger">*</span> </label>
																		<div><select name="pro_type" id="pro_type" class="cart_quantity  full_input" style="max-width: 100% !important;" >
																			<option value="">Product Category *</option>
																			@foreach($type as $key => $value)
																			<option value="{{$value->type_id}}" {{ $product_data->pro_type == $value->type_id ? 'selected="selected"' : '' }} >{{$value->type_name}}</option>
																			@endforeach
																			</select>  </div>
																		<span id="pro_type_error" style="color: red; display: none;"></span>
																	</div>

																	<div class="brdr_btm_br">
																		<label>Sub Categories </label>
																		<div><select name="sub_cat" id="sub_cat" class="cart_quantity  full_input" style="max-width: 100% !important;" >
																			@foreach($sub_cat as $key => $value)
																			<option value="{{$value->type_id}}" {{ $product_data->sub_cat == $value->type_id ? 'selected="selected"' : '' }} >{{$value->type_name}}</option>
																			@endforeach
																			</select>  </div>

																	</div>


																	<div class="brdr_btm_br">
																		<label>Select Brand <span class="text-danger">*</span> </label>
																		<select name="brand" id="brand" class="cart_quantity  full_input" style="max-width: 100%; !important;" >
																			<option value="">Select Brand *</option>
																			@foreach($brand as $key => $value)
																			<option value="{{$value->brand_id}}" {{ $product_data->brand == $value->brand_id ? 'selected="selected"' : '' }}>{{$value->name}}</option>
																			@endforeach
																		</select>
																		<span id="brand_error" style="color: red; display: none;"></span>
																	</div>


																	<div class="brdr_btm_br">
																		<label>Product Short Description  </label>
																		<input type="text" class="input-group-lg full_input" id="short_desc" name="short_desc" value="{{$product_data->short_desc}}" placeholder="Product Short Description" >
																		<span id="short_desc_error" style="color: red; display: none;"></span>
																	</div>
																	<div class="brdr_btm_br">
																		<label>Product Long Description  </label>
																		<textarea class="input-group-lg full_input" style="height:180px;" id="pro_desc" name="pro_desc" placeholder="Product Long Description">
																			{{$product_data->pro_desc}}</textarea>
																		<span id="pro_desc_error" style="color: red; display: none;"></span>
																	</div>
																</div>
															</div>

														</div>
													</div>

													<div class="col-md-4 col-sm-3 col-xs-12">
														<div id="image_preview" ></div>
														<?php
														if($product_data->pro_image!=''){?>
														<div class="thumb_preview" ><img class='img-responsive' style='width: 100%; height: 100%;' src="{{URL::to('/')}}/product_images/{{$product_data->prod_id}}/{{$product_data->pro_image}}"></div>
														<?php }else{?>
														<div class="thumb_preview" id="diffult_img"><img src="{{URL::to('/')}}/default.png" class="img-responsive" /> </div>
														<?php }?>
														<?php
														$gallery = DB::table('products_image')
															->where('pro_id','=', $product_data->prod_id)->get();
														if(count($gallery)>0)
														{  $k=1;
														 foreach($gallery as $key => $img_list){
															 if($k!=1){?>
														<div class="thumb_preview" >
															<img class='img-responsive' style='width: 100%; height: 100%;' src="{{URL::to('/')}}/product_images/{{$product_data->prod_id}}/{{$img_list->image}}"></div>


														<?php }
															 $k++;}}?>


														<div class="">
															<div class="row  mt-15">
																<div class="col-xs-12 mt-15"><b>Update Image</b></div>
																<div class="col-xs-12">
																	<div class="input-group">
																		<input type="file" name="images[]" multiple  onchange="preview_images();" id="files-input-upload" style="display:none">
																		<input type="text"  id="fake-file-input-name"   disabled="disabled" placeholder="Choose File" class="input-group-lg browse___input">
																		<span class="input-group-btn">
																			<button id="fake-file-button-browse" type="button" class="btn browse___btn"> Browse </button>
																		</span>
																	</div>
																	<span id="pro_image_error" style="color: red; display: none;"></span>
																</div>

															</div>
														</div>
													</div>
												</div>

												<div class="mb-30">
													<div class="row">

														<div class="col-md-8 col-sm-9 col-xs-12">
															<div class="heading_style_left mb-10"> <span class="title">Price</span> </div>


															<div class="row">
																<div class="col-md-12">
																	<?php $i = 1 ?>
																	@if($i==1)
																	<div class="{{ $i == 1 ?'input_fields_wrap' : '' }}">
																		@endif

																		@foreach($item as $key => $value)

																		<div class="row">
																			<div class="col-sm-6 col-xs-12"><div class="mb-20">
																				<input type="text" class="input-group-lg full_input" value="{{$value->qty}}"  name="question_{{$i}}" id="question_{{$i}}" placeholder="Add the quantity/weight" >
																				<span id="question_error_{{$i}}" style="color: red; display: none;"></span>
																				</div></div>
																			<div class="col-sm-6 col-xs-12"><div class="mb-20">
																				<input type="number" class="input-group-lg full_input" value="{{$value->price}}" name="ans_{{$i}}" id="ans_{{$i}}" placeholder="Add the Price" >
																				<span id="ans_error_{{$i}}" style="color: red; display: none;"></span>
																				</div>
																			</div>
																		</div>
																		@endforeach
																		@if($i==1)
																	</div>
																	@endif
																	<div class="clearfix"></div>
																	<div class="mb-20 text-right">
																		<button  class="add_field_button tt_green_text"><i class="fa fa-plus"></i> Add more</button>
																	</div>

																	<input type="hidden" id="totalInvoice" name="totalInvoice" value="{{count($item)}}" />

																</div>
															</div>
														</div>
														<div class="col-md-4 col-sm-3 col-xs-12"></div>
													</div>

												</div>

												<div class="mb-30">
													<div class="row">

														<div class="col-md-8 col-sm-9 col-xs-12">

															<div class="row">
																<div class="col-md-12">
																	<div class="heading_style_left mb-10"> <span class="title">Effects</span> </div>
																	<div class="mb-30">


																		<div class="row">
																			<div class="col-xs-12">
																				<table class="table table-bordered table-padding">
																					<tbody>
																						<tr>
																							<th style="width:50%;">Name</th>
																							<th>Percentage</th>
																						</tr>
																						<?php $k=1;?>
																						@foreach($effact as $key => $value)
																						<tr>
																							<td><input type="text" class="input-group-lg full_input mb-5" name="effects_title_<?php echo $k;?>" id="effects_title_<?php echo $k;?>" value="{{$value->name}}"  >
																								<span id="effects_title_error_<?php echo $k;?>" style="color: red; display: none;"></span></td>
																							<td><div class="input-group">
																								<input type="text" class="input-group-lg full_input" onKeyUp="if(!isNum(this.value)) this.value='';" maxlength="4" name="effects_per_<?php echo $k;?>" id="effects_per_<?php echo $k;?>" value="{{$value->percentage}}" placeholder="Percentage">
																								<span class="input-group-addon">%</span>
																								</div>
																								<span id="effects_per_error_<?php echo $k;?>" style="color: red; display: none;"></span></td>
																						</tr>
																						<?php $k++;?>
																						@endforeach
																					</tbody>
																				</table>
																			</div>
																		</div>
																	</div>

																	<div class="mt-20 text-right">
																		<button type="submit" class="btn___green">Publish Product</button>
																	</div>
																</div>
															</div>

														</div>
													</div>
													<div class="col-md-4 col-sm-3 col-xs-12"></div>
												</div>



												<div class="clearfix"></div>
											</div>
											<div class="clearfix"></div>
											<script type="text/javascript">
												document.getElementById('fake-file-button-browse').addEventListener('click', function() {
													document.getElementById('files-input-upload').click();
												});

												document.getElementById('files-input-upload').addEventListener('change', function() {
													document.getElementById('fake-file-input-name').value = this.value;

												});
											</script>



										</div>


									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</section>
		<!-- End Shop Item Section -->

		<div class="clearfix"></div>
	</div>
	<!-- Site Wraper End -->

	@include('admin.z_footer')
	<script src="{{URL::to('/')}}/admin/js/owl.carousel.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/isotope.pkgd.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/imagesloaded.pkgd.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/mediaelement-and-player.min.js"></script>
	<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/extra/validation_product.js?218"></script>

	<script type="text/javascript">

		$(document).ready(function() {
			var max_fields      = 15; //maximum input boxes allowed
			var wrapper         = $(".input_fields_wrap"); //Fields wrapper
			var add_button      = $(".add_field_button"); //Add button ID

			var x = 1; //initlal text box count
			$(add_button).click(function(e){ //on add input button click
				e.preventDefault();
				if(x < max_fields){ //max input box allowed
					x++; //text box increment
					document.getElementById('totalInvoice').value=x;
					$(wrapper).append('<div class="mb-20" style="clear:both;"><div style="background-color:#59d028; height:1px; margin-bottom:20px;"></div><div class="row"><div class="col-sm-6 col-xs-12"><div class="mb-20"><input type="text" class="input-group-lg full_input" placeholder="Add the quantity/weight" name="question_'+x+'" id="question_'+x+'"><span id="question_error_'+x+'" style="color: red; display: none;"></span></div></div><div class="col-sm-6 col-xs-12"><div class="mb-20"><input type="number" class="input-group-lg full_input" placeholder="Add the Price" name="ans_'+x+'" id="ans_'+x+'"><span id="ans_error_'+x+'" style="color: red; display: none;"></span></div></div></div><div class="m-b-20" style="clear:both;"></div><a style="text-align: right;float: right;" href="#" class="remove_field tt_green_text"><i class="fa fa-minus" aria-hidden="true"></i> REMOVE</a></div><div class="clearfix" style="clear:both;margin-bottom: 18px;"></div>'); //add input box

				}
			});

			$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault();
				$(this).parent('div').remove(); x--;
				document.getElementById('totalInvoice').value=x;

			})
		});
	</script>

	<script>
		// document.getElementById("next_2").style.display = "block";
		function openTab(cityName,activeTab,nextId,pre) {
			var i, tabcontent, tablinks;
			tabcontent = document.getElementsByClassName("tab-pane");
			for (i = 0; i < tabcontent.length; i++) {
				tabcontent[i].style.display = "none";
			}
			tablinks = document.getElementsByClassName("ui-state-default ui-corner-top ui-tabs-active ui-state-active");
			for (i = 0; i < tablinks.length; i++) {
				tablinks[i].className = tablinks[i].className.replace("ui-state-default ui-corner-top ui-tabs-active ui-state-active", "ui-state-default ui-corner-top");
			}
			//For next
			document.getElementById(cityName).style.display = "block";

			var d = document.getElementById(activeTab);
			d.className += "ui-state-default ui-corner-top ui-tabs-active ui-state-active"; //for active
		}



		//Save as draft
		$(document).ready(function($){
			var form1 =  $("#form-stander");
			$("#saveDarf").click(function(){

				document.getElementById('save_status').value=1;
				document.getElementById("form-stander").setAttribute( "onsubmit", "" );
				var pro_title=jQuery('#pro_title').val();
				var pro_type=jQuery('#pro_type').val();
				var brand=jQuery('#brand').val();
				jQuery('#pro_title_error').hide();
				jQuery('#pro_type_error').hide();
				jQuery('#brand_error').hide();
				/* if(pro_title.trim()=="" || pro_type.trim()=="" || brand.trim()==""){
openTab('tab1','tab_1','next_2','previous_1');
}*/

				if(pro_title.trim()==""){
					jQuery('#pro_title_error').show();
					jQuery('#pro_title_error').html("Please enter product title.");
					jQuery('#pro_title').focus();
					return false;
				}

				if(pro_type.trim()==""){
					jQuery('#pro_type_error').show();
					jQuery('#pro_type_error').html("Please select categorie.");
					jQuery('#pro_type').focus();
					return false;
				}

				if(brand.trim()==""){
					jQuery('#brand_error').show();
					jQuery('#brand_error').html("Please select product brand.");
					jQuery('#brand').focus();
					return false;
				}


				else{ form1.submit();
					}
				// form1.submit();
			});


		});



		$('#pro_type').change(function(){
			var category = $(this).val();
			if(category){
				$.ajax({
					type:"GET",
					url:"{{url('admin/get-subcategory-list')}}?category="+category,
					success:function(res){
						if(res){
							$("#sub_cat").empty();
							$("#sub_cat").append('<option>Select</option>');
							$.each(res,function(key,value){
								$("#sub_cat").append('<option value="'+key+'">'+value+'</option>');
							});

						}else{
							$("#sub_cat").empty();
						}
					}
				});
			}else{
				$("#sub_cat").empty();

			}
		});
	</script>

	<style>
		.ui-corner-bottom{
			padding: 0px !important;

		}
		.tt_green_text  {
			background: none !important ;
		}
		select.cart_quantity {
			height: 54px;
		}
		.heading_style_left .title {
			font-size: 18px !important;
			color: #22aa00 !important;
		}
		.brdr_btm_br{
			border-bottom:1px solid #ddd; margin-bottom: 8px; padding-bottom: 15px;
		}
		.thumb_preview {
			float: left;
			margin: 0px 8px 8px 0px;
			border: 1px solid #ddd;
		}

	</style>
</body>
</html>