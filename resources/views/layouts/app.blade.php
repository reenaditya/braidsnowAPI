@guest
	@include("layouts.header")
	@yield('content')
	@include("layouts.footer")
@endguest

@auth
	@include("layouts.header-after-login")
	@include("layouts.side")
	@yield('content')
	@include("layouts.footer-after-login")
@endauth
