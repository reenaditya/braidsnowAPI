<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">

					<!-- begin:: Aside -->
					<div class="kt-aside__brand kt-grid__item  " id="kt_aside_brand">
						<div class="kt-aside__brand-logo">
							<a href="demo3/index.html">
								<img alt="Logo" src="./assets/media/logos/logo-4.png" />
							</a>
						</div>
					</div>

					<!-- end:: Aside -->

					<!-- begin:: Aside Menu -->
					<div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">
						<div id="kt_aside_menu" class="kt-aside-menu  kt-aside-menu--dropdown " data-ktmenu-vertical="1" data-ktmenu-dropdown="1" data-ktmenu-scroll="0">
							<ul class="kt-menu__nav ">
<li class="kt-menu__item  kt-menu__item{{ request()->routeIs("dashboard")?'--active':'' }}" aria-haspopup="true"><a href="{{ route('dashboard') }}" class="kt-menu__link "><i class="kt-menu__link-icon flaticon2-gear"></i><span class="kt-menu__link-text">Dashboard</span></a></li>

<li class="kt-menu__item  kt-menu__item{{ request()->routeIs("services.*")?'--active':'' }}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
	<a href="{{ route('services.index') }}" class="kt-menu__link ">
		<i class="kt-menu__link-icon flaticon2-layers-1"></i>
		<span class="kt-menu__link-text">Services</span>
	</a>
	<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
		<ul class="kt-menu__subnav">
			
			<li class="kt-menu__item " aria-haspopup="true">
				<a href="{{ route('services.create') }}" class="kt-menu__link ">
					<i class="kt-menu__link-bullet kt-menu__link-bullet--line">
						<span></span>
					</i>
					<span class="kt-menu__link-text">Add New</span>
				</a>
			</li>
			
	 		<li class="kt-menu__item " aria-haspopup="true">
	 			<a href="{{ route('services.index') }}" class="kt-menu__link ">
	 				<i class="kt-menu__link-bullet kt-menu__link-bullet--line">
	 					<span></span>
	 				</i>
	 				<span class="kt-menu__link-text">View</span>
	 			</a>
	 		</li>
			
		</ul>
	</div>
</li>
	
								

			</ul>
						</div>
					</div>

					<!-- end:: Aside Menu -->
				</div>