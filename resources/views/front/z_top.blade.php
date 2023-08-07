<header id="header" class="header">
	<div class="header-inner" style="padding:0px !important;">
		<div class="row" style="margin:0px; padding:0px;">
			<div class="col-xs-3 plr-0">
				<a id="menu-left-sidebar-list-icon" class="hidden">
					<div class="left-menu-thumb"> 
						<img src="{{URL::to('/')}}/images/icon/left-menu.png"/>
					</div> 
				</a>
			</div>
			<div class="col-xs-6 plr-0">
				<div class="logo"> 
					<a href="{{URL::to('/')}}/{{$user_name}}">
						<img src="{{URL::to('/')}}/{{ Session::get('memberlogo') }}" alt="" />
					</a> 
				</div>
			</div>
			<div class="col-xs-3 plr-0">
				<div class="side-menu-btn">
					<ul>
						<!--Sidebar Menu Icon-->
						<li class=""> <a id="menu-sidebar-list-icon" class="nav-bar-icon">
							<div class="right-cart-thumb"> <img src="{{URL::to('/')}}/images/icon/bag.png" /> <span class="item-counter"><?php echo Cart::count();?></span> </div>
							</a> </li>
						<!-- End Sidebar Menu Icon-->
						<!-- Search Icon -->
						<li class=""> 
							<a class="search-overlay-menu-btn header-icon">
								<div class="search-thumb"> 
									<img src="{{URL::to('/')}}/images/icon/search.png" /> 
								</div>
							</a> 
						</li>
						<!-- End Search Icon -->
					</ul>
				</div>
			</div>
		</div>
	</div>
</header>