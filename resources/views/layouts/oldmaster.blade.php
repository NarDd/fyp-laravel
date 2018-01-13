
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Template by FREEHTML5.CO" />
	<meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive" />
	<meta name="author" content="FREEHTML5.CO" />


	<link rel="shortcut icon" href="favicon.ico">

	<!-- <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'> -->

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{URL::asset('css/master/animate.css')}}">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{URL::asset('css/master/icomoon.css')}}">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{URL::asset('css/master/bootstrap.css')}}">
	<!-- Superfish -->
	<link rel="stylesheet" href="{{URL::asset('css/master/superfish.css')}}">

	<link rel="stylesheet" href="{{URL::asset('css/master/style.css')}}">

	<!-- test css -->
	<link rel="stylesheet" href="{{URL::asset('css/master/bootstrap-datetimepicker.min.css')}}">
	<link rel="stylesheet" href="{{URL::asset('http://code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css')}}">

  @yield("css")
	<!-- Modernizr JS -->
	<script src="{{URL::asset('js/master/modernizr-2.6.2.min.js')}}"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>

		<div id="fh5co-wrapper">
		<div id="fh5co-page">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-6 text-left fh5co-link">
						<a href="#">FAQ</a>
						<a href="#">Forum</a>
						<a href="#">Contact</a>
					</div>
					<div class="col-md-6 col-sm-6 text-right fh5co-social">
						<a href="#" class="grow"><i class="icon-facebook2"></i></a>
						<a href="#" class="grow"><i class="icon-twitter2"></i></a>
						<a href="#" class="grow"><i class="icon-instagram2"></i></a>
					</div>
				</div>
			</div>
		</div>
		<header id="fh5co-header-section" class="sticky-banner">
			<div class="container">
				<div class="nav-header">
					<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle dark"><i></i></a>
					<a href="{{ route('home')	}}"><img src="{{ asset('img/MatchIt_Logo.png') }}" style="max-height:80px;padding-top:5px;padding-bottom:5px"></a>
					<!-- START #fh5co-menu-wrap -->
					<nav id="fh5co-menu-wrap" role="navigation">
						<ul class="sf-menu" id="fh5co-primary-menu">
							<li class="active">
								<a href="{{ route('home')	}}">Home</a>
							</li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Get Involved</a>
								<ul class="fh5co-sub-menu">
									<li><a href="#">Upcoming Events</a></li>
									<li><a href="#">Past Events</a></li>
								</ul>
							</li>
							<li>
								<a href="#" class="fh5co-sub-ddown">Manage Event</a>
								 <ul class="fh5co-sub-menu">
								 	<li><a href="{{ route('pages.event.create')	}}">Create New Event</a></li>

								</ul>
							</li>
							<li><a href="#" class="fh5co-sub-ddown">Profile</a>
							 <ul class="fh5co-sub-menu">
								<li><a href="{{ route('pages.profile') }}">View Profile</a></li>
								<li>  <a href="{{ route('logout') }}"
											onclick="event.preventDefault();
															 document.getElementById('logout-form').submit();">
											Logout
									</a>
									<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
											{{ csrf_field() }}
									</form>

								</li>
							</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
		</header>




	</div>
	<!-- END fh5co-wrapper -->
<div id="fh5co-page">

      @yield("content")

</div>
	<!-- jQuery -->


	<script src="{{URL::asset('js/master/jquery.min.js')}}"></script>
	<!-- jQuery Easing -->
	<script src="{{URL::asset('js/master/jquery.easing.1.3.js')}}"></script>
	<!-- Bootstrap -->
	<script src="{{URL::asset('js/master/bootstrap.min.js')}}"></script>
	<!-- Waypoints -->
	<script src="{{URL::asset('js/master/jquery.waypoints.min.js')}}"></script>
	<script src="{{URL::asset('js/master/sticky.js')}}"></script>

	<!-- Stellar -->
	<script src="{{URL::asset('js/master/jquery.stellar.min.js')}}"></script>
	<!-- Superfish -->
	<script src="{{URL::asset('js/master/hoverIntent.js')}}"></script>
	<script src="{{URL::asset('js/master/superfish.js')}}"></script>

	<!--test-->
	<script src="{{URL::asset('js/master/bootstrap-datetimepicker.min.js')}}"></script>

	<!-- Main JS -->
	<script src="{{URL::asset('js/master/main.js')}}"></script>
	<script src="https://use.fontawesome.com/abbc114c8f.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>
	 @yield("scripts")
	</body>
</html>
