<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SOLID App beta version</title>

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
				<a class="navbar-brand">
					<big><big><font face='calibri'><big>S</big>OLID App</font></big></big> 
					<small><small><small>beta version</small></small></small>
				</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				@if (Auth::guest())
				@elseif (Auth::user()->role == "1")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/user/list') }}"><font face='calibri'><b>INVOICE LIST</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/user/reject/list') }}"><font face='calibri'><b>INVOICE REJECT</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/op/user') }}"><font face='calibri'><b>INVOICE ON PROGRESS</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/rtp/user') }}"><font face='calibri'><b>INVOICE READY TO PAY</b></font></a></li>
				</ul>
				@elseif (Auth::user()->role == "2")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/act/list') }}"><font face='calibri'><b>INVOICE LIST</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/op') }}"><font face='calibri'><b>INVOICE ON PROGRESS</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/rtp') }}"><font face='calibri'><b>INVOICE READY TO PAY</b></font></a></li>
				</ul>
				@elseif (Auth::user()->role == "3")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/fa/list') }}"><font face='calibri'><b>INVOICE LIST</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/op') }}"><font face='calibri'><b>INVOICE ON PROGRESS</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/rtp') }}"><font face='calibri'><b>INVOICE READY TO PAY</b></font></a></li>
				</ul>
				@elseif (Auth::user()->role == "4")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/user/view') }}"><font face='calibri'><b>MASTER USER</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/master/upload') }}"><font face='calibri'><b>UPLOAD INVOICE</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/input') }}"><font face='calibri'><b>INPUT INVOICE</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/pending/list') }}"><font face='calibri'><b>INVOICE REJECT</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/op') }}"><font face='calibri'><b>INVOICE ON PROGRESS</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/rtp') }}"><font face='calibri'><b>INVOICE READY TO PAY</b></font></a></li>
				</ul>
				@endif
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						
					@else
						<li>
							<a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><font face='calibri'><b>{{ Auth::user()->name }}</b></font></a>
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
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				@if ( Session::has('flash_message') )
					<div class="alert {{ Session::get('flash_type') }}">
						{{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>
	</div>
	@yield('content')
	<div class="col-md-10col-md-offset-1">
    	<div>
    		<center><font face='calibri'>SOLID App (AISIN Operational Invoice Document) ©2015 All Rights Reserved by PT. Aisin Indonesia Automotive (Developed by MAP, MIS Dept)</font></center>
        </div>
	</div>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
</body>
</html>
<head>
<style>
body {
    background-color:lightyellow;
}
</style>
</head>