@include('admin.z_header')
<link href="{{URL::to('/')}}/admin/css/jquery-ui.css?5" rel="stylesheet" type="text/css" />
<link href="{{URL::to('/')}}/admin/css/smooth-products.css" rel="stylesheet" />
<script src="{{URL::to('/')}}/admin/js/extra/register_val.js"></script>
</head>

<body>
	<!-- Site Wraper -->
	<div class="wrapper"  style="overflow:hidden !important;">

		<div class="row">
			@include('admin.z_login_cover')
			<div class="col-md-8 col-sm-6 col-xs-12">
				<div class="right__form__outer">
					<div class="text-right">
						<span class="top_____right">Already have an account?</span><a href="{{URL::to('/')}}/admin/login" class="btn__white__border">Sign In</a>
					</div>

					<div class="form_____outer" style="max-width:500px; margin:10% auto !important;">
						<div class="form____title mb-0">Register absolutely free.</div>
						<p class="color__80 mb-15">Enter your details below.</p>
						<form action="registerForm" onSubmit="return validateRegiFrm();" accept-charset="UTF-8" method="POST" autocomplete="off">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="status" value="1">

							<div class="row">
								<div class="col-md-12">
									@if (Session::has('error'))
									<div class="alert alert-danger" id='errordiv'>{{ Session::get('error') }} <span  onclick="hideErrorDiv()" class="pull-right"  style="color:#933432; font-size: 20px;line-height: 15px; cursor: pointer;" >x</span></div>
									@endif

									@if (Session::has('success'))
									<div class="alert alert-success" id='errordiv'>{{ Session::get('success') }} <span  onclick="hideErrorDiv()" class="pull-right" style="color:#2b542c; font-size: 20px;line-height: 15px;cursor: pointer;" >x</span></div>
									@endif
									<div class="mb-20">
										<input type="text" class="input-group-lg full_input" name="fname" id="fname" placeholder="First Name" >
										<span id="fname_error" style="color: red; display: none;"></span>
									</div>
									<div class="mb-20">
										<input type="text" class="input-group-lg full_input" name="lname" id="lname" placeholder="Last Name" >
										<span id="lname_error" style="color: red; display: none;"></span>
									</div>
									<div class="mb-20">
										<input type="text" class="input-group-lg full_input" name="email" id="reg_email" placeholder="Email Address" >
										<span id="reg_email_error" style="color: red; display: none;"></span>
									</div>

									<div class="mb-20">
										<input type="text" class="input-group-lg full_input" name="username" id="username" pattern="[a-zA-Z0-9-_]{2,64}" placeholder="Username" >
										<span id="username_error" style="color: red; display: none;"></span>
										<p> https://topshelfmenu.us/<span id="username_title" style="color:#22aa00;border: none;"></span></p>


									</div>

									<div class="mb-20">
										<input type="password" class="input-group-lg full_input" name="password" id="password" placeholder="Password" >
										<span id="password_error" style="color: red; display: none;"></span>
									</div>

									<div class="mb-20">
										<input type="text" class="input-group-lg full_input" name="phone" id="reg_phone" placeholder="Phone Number" >
										<span id="reg_phone_error" style="color: red; display: none;"></span>
									</div>
									<div class="mb-20">
										<input type="text" class="input-group-lg full_input" name="website" id="reg_website" placeholder="Website" >
										<span id="reg_website_error" style="color: red; display: none;"></span>
									</div>
									<div class="mb-20">
										<input type="text" class="input-group-lg full_input" name="company" id="company" placeholder="Company Name" >
										<span id="company_error" style="color: red; display: none;"></span>
									</div>




									<div class="mt-20 text-center">
										<button type="submit" class="btn___green">Create My Account</button>
										<p class="color__80 mt-20">By clicking "Create My Account" I agree to Top Shelf Menu LLC <a href="/terms">Terms</a> & <a href="/terms">Privacy Policy</a>.</p>
									</div>

								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
	</div>
	<!-- Site Wraper End -->

	@include('admin.z_footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>

	<script>
		$(window).load(function()
					   {
			var phones = [{ "mask": "(###) ###-####"}, { "mask": "(###) ###-####"}];
			$('#reg_phone').inputmask({
				mask: phones,
				greedy: false,
				definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
		});
	</script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(function() {
			var $username = $('#username'),
				$output = $('#username_title'),
				keyHandler = function(e) {
					var key = e.which || e.keyCode;

					if (
						// Letters
						key >= 65 && key <= 90 ||
						// Dash and Underscore
						key == 173 ||
						// Numbers
						!e.shiftKey && key >= 48 && key <= 57 ||
						// Numeric keypad
						key >= 96 && key <= 105 ||
						// Backspace and Tab and Enter
						key == 8 || key == 9 || key == 13 ||
						// Home and End
						key == 35 || key == 36 ||
						// Left and Right arrows
						key == 37 || key == 39 ||
						// Del and Ins
						key == 46 || key == 45) {
						updateOutput();

						return true;
					}

					return false;
				},
				updateOutput = function() {
					setTimeout(function() {
						$output.text($username.val());
					}, 50);
				};

			$username.keydown(keyHandler).change(updateOutput);
		});
	</script>
</body>
</html>