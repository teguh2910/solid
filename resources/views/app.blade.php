<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>F&A Document App</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dropzone.css') }}" type="text/css" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/css/styles.css') }}">

   	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
   	<script src="{{asset('/js/script.js')}}"></script>
	<script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
	<script src="{{asset('/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/js/dropzone.js')}}" type="text/javascript"></script>
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">F&A Document App</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				@if (Auth::guest())
				@elseif (Auth::user()->role == "1")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><font face='calibri'>Home</font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/user/list') }}"><font face='calibri'>Invoice List (User)</font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/pending/list') }}"><font face='calibri'>Invoice Pending</font></a></li>
				</ul>
				@elseif (Auth::user()->role == "2")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><font face='calibri'>Home</font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/act/list') }}"><font face='calibri'>Invoice List (Act)</font></a></li>
				</ul>
				@elseif (Auth::user()->role == "3")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><font face='calibri'>Home</font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/fa/list') }}"><font face='calibri'>Invoice List (Finance)</font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/fa/rtp_list') }}"><font face='calibri'>Invoice Ready to Pay</font></a></li>
				</ul>
				@elseif (Auth::user()->role == "4")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/') }}"><font face='calibri'>Home</font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/master/upload') }}"><font face='calibri'>Upload Invoice</font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/add') }}"><font face='calibri'>Input Invoice</font></a></li>
				</ul>
				@endif
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">
							<button class='btn btn-primary btn-sm'>
								<font face='calibri'>
								LOGIN
							</font>
							</button>
						</a></li>
						<li><a href="{{ url('/user/create') }}">
							<button class='btn btn-info btn-sm'>
							<font face='calibri'>
							REGISTER
						</font>
					</button>
						</a></li>
					@else
						<li>
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }}</a>
						</li>
						<li>
							<a href="{{ url('/auth/logout') }}">
								<button class="btn btn-danger btn-sm">
									<span class='glyphicon glyphicon-off'></span> 
									<font face='calibri'><b>LOGOUT</b></font>
								</button>
							</a>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
