@include('admin.z_header')
<title>Page Content | Top Shelf Menu</title>
</head>

<body>
	<!-- Site Wraper -->
	<div class="wrapper">
		<!-- Header -->
		@include('admin.z_top')
		<!-- End Header -->

		<div class="clearfix"></div>
		<section class="main__container">
			<div class="page-breadcrumb mb-30"> <a href="{{URL::to('/')}}/admin/index">Account</a>/<span>Page Content</span> </div>

			@if (Session::has('faq_success'))
			<div class="alert alert-{{ Session::get('success_btn') }}" id='errordiv'>{{ Session::get('faq_success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
			@endif
			<div  class="box__shadow"  style="background-color:#fff; padding:30px;">
				<div class="row">
					<div class="col-md-4 col-sm-5 col-xs-12">
						<div class="left__content">
							<div class="tt_green_text">Add your Page Content</div>
							<div class="tt_description_title" style="font-size:29px;">Product Page Content</div>
							<p>Use the How it Works field to communicate with your customers how your personalized Online Menu for your dispensary work. Basically describe what is unique and important for your shop.</p>
							<p>The What&rsquo;s Next field is for you to enter any information you think is necessary for a customer to know after they place an order. Whatever you write in this field will pop up right after a customer finalizes her/his order. This is your opportunity to let them know that they for example &ldquo;have 60 min to pick up your order&rdquo; or that &ldquo;don&rsquo;t forget to bring your ID&rdquo; or &ldquo;we only accept cash but we do have an ATM on site&rdquo;.</p>
						</div>
					</div>
					<div class="col-md-8 col-sm-7 col-xs-12">
						<div class="form__right__box">

							<form role="form" id="form-stander" name="standardType"  action="pageconatinsave" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="_token" value="{{ csrf_token() }}">
								<div class="row">
									<div class="col-md-12">



										<div class="clearfix"></div>


										<div class="heading_style_left mb-10"> <span class="title">Add Page Content</span> </div>
										<div class="mb-10">
											<label>How it Works <span class="text-danger">*</span> | <a href="">See What It Looks Like</a> </label>
											<textarea class="input-group-lg full_input" style="height:120px;" id="how_it_work" name="how_it_work" required  placeholder="Write....">{{$static_data->how_it_work}}</textarea>
											<span id="how_it_work_error" style="color: red; display: none;"></span>
										</div>
										<div class="mb-10">
											<label>What's Next <span class="text-danger">*</span>  | <a href="">See What It Looks Like</a> </label>
											<textarea class="input-group-lg full_input" style="height:120px;" id="what_next" name="what_next" required placeholder="Write....">{{$static_data->what_next}}</textarea>
											<span id="what_next_error" style="color: red; display: none;"></span>
										</div>



										<div class="mb-10">
											<label>Google Analytics Tracking ID </label>
											<input type="text" class="input-group-lg full_input" id="google_analytics" name="google_analytics"  placeholder="UA-123456789-1">{{$static_data->google_analytics}}

										</div>

										<div class="mb-10">
											<label>Facebook Pixel ID </label>
											<input type="text" class="input-group-lg full_input" id="facebook_pixel" name="facebook_pixel"  placeholder="243581234671031">{{$static_data->facebook_pixel}}

										</div>

										<div class="mb-10">
											<label>Main Cover Image <span class="text-danger">*</span>  | <a href="">See What It Looks Like</a> </label>
											<div>
												<div class="input-group">
													<input type="file" name="image"   id="files-input-upload" style="display:none">
													<input type="text" id="fake-file-input-name" disabled="disabled" placeholder="Choose File" class="input-group-lg browse___input">
													<span class="input-group-btn">
														<button id="fake-file-button-browse" type="button" class="btn browse___btn"> Choose </button>
													</span>

												</div>

											</div>

										</div>
										<?php
										if($static_data->cover_image!=''){?>
										<div >
											<img class='img-responsive' style='  border:1px solid #ddd;' src="{{URL::to('/')}}/cover_admin_img/{{$static_data->cover_image}}"></div>
										<?php }?>
										<div class="mt-20 text-right">

											<button type="submit" class="btn___green"><i class="far fa-save"></i> Save Content</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</section>
	</div>
	<!-- Site Wraper End -->
	<script type="text/javascript">
		document.getElementById('fake-file-button-browse').addEventListener('click', function() {
			document.getElementById('files-input-upload').click();
		});

		document.getElementById('files-input-upload').addEventListener('change', function() {
			document.getElementById('fake-file-input-name').value = this.value;

		});
	</script>
	@include('admin.z_footer')
	<link href="{{URL::to('/')}}/admin/css/custom__dashboard.css" rel="stylesheet" type="text/css" />
	<style>
		.ui-corner-bottom{
			padding: 0px !important;

		}
		.tt_green_text  {
			background: none !important ;
		}
		<style>
		.m-t-0{margin-top:0px !important;}


	</style>
	<script src="{{URL::to('/')}}/admin/js/owl.carousel.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/isotope.pkgd.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>
	<script src="{{URL::to('/')}}/admin/js/mediaelement-and-player.min.js"></script>
	<script src="{{URL::to('/')}}/admin/js/jquery.fs.tipper.min.js" type="text/javascript"></script>


</body>
</html>