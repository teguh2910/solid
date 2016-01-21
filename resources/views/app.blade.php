<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SOLID v1.0</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
	
   	<script src="{{asset('/js/jquery-latest.min.js')}}"></script>
   	<script src="{{asset('/js/script.js')}}"></script>
	<script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
	<script src="{{asset('/js/bootstrap.min.js')}}"></script>
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
					@if (Auth::guest())
					<big><i class='glyphicon glyphicon-tasks'></i>&nbsp;
						<font face='calibri'>Welcome to</font> </big><big><big><font face='calibri'><b>SOLID</b> 
						<small><small><small><small><small>v1.0</small></small></small></small></small></font></big></big> 
					@else 
					<big><big><i class='glyphicon glyphicon-tasks'></i>&nbsp;
						<big><font face='calibri'><b>SOLID</b> 
						<small><small><small><small><small>v1.0</small></small></small></small></small>
					</font></big></big></big> 
					@endif
				</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				@if (Auth::guest())
				@elseif (Auth::user()->role == "1")
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/user/list') }}">
							<font face='calibri'><b>INVOICE LIST</b></font>
					</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/op/user') }}">
							<font face='calibri'><b>INVOICE ON PROGRESS</b></font>
					</a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/invoice/rtp/user') }}">
							<font face='calibri'><b>INVOICE READY TO PAY</b></font>
					</a></li>
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
					<li><a href="{{ url('/user/view') }}"><font face='calibri'><b>DATA USER</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/master/upload') }}"><font face='calibri'><b>INPUT INVOICE</b></font></a></li>
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
					<ul class="nav navbar-nav">
						<li><a href="//172.18.3.7/sinta/public"><button class='btn btn-warning btn-sm'><font face='calibri'>&nbsp;<b>NEED HELP ?</b></font></button></a></li>
					</ul>
					@else
						<?php
							date_default_timezone_set('Asia/Jakarta');
							$time = date('H');
							if ($time > 0 and $time <= 12) {
								$par="Good Morning";
							}	
							elseif ($time > 12 and $time <= 17) {
								$par="Good Afternoon";
							}
							elseif ($time > 17 and $time <= 21) {
								$par="Good Night";
							}
							else {
								$par="Good Night";
							} 

						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<font face='calibri'>{{$par}}, <b>{{ Auth::user()->name }}</b></font>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a href="{{ url('/edit_password') }}">
										<font face='calibri'>CHANGE PASSWORD</font>
									</a>
								</li>
							</ul>
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
	<div class="col-md-10 col-md-offset-1">
    	<div>
    		<center>
    			<ol class="breadcrumb">
  				<li>
  					<font face='calibri' color='grey'>
  					<b>SOLID</b></font> <font face='calibri' color='grey'>(Aisin Operational Invoice Document) ©2015 All Rights Reserved, PT Aisin Indonesia Automotive (Developed by Merio, MIS Department)
    			</font></li>
				</ol>
    		</center>
        </div>
	</div>
</body>
</html>
<head>
<style>
body{
background-image: url('{{ asset("img/school.png") }}');
background-repeat: repeat-x repeat-y;
}
</style>
</head>