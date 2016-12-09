<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	@if (Auth::user()->role == "7" or Auth::user()->role == "5" or Auth::user()->role == "6")
	<title>ELNA v1.5.1</title>
	@elseif (Auth::user()->role == "1" or Auth::user()->role == "2" or Auth::user()->role == "3" or Auth::user()->role == "4")
	<title>SOLID v2.2</title>
	@else
	<title>Welcome</title>
	@endif
	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dataTables.bootstrap.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ asset('/css/AdminLTE.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/_all-skins.min.css') }}">
	<link rel="stylesheet" href="{{ asset('/css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset ('/css/select2.min.css') }}">
	
   	<script src="{{asset('/js/jquery-latest.min.js')}}"></script>
   	<script src="{{asset('/js/script.js')}}"></script>
	<script src="{{asset('/js/jquery-2.1.3.min.js')}}"></script>
	<script src="{{asset('/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('/js/select2.full.min.js') }}"></script>


	<script>
      $(function () {
        $(".select2").select2();
      });
    </script>
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
				@if (Auth::user()->role == "7" or Auth::user()->role == "5" or Auth::user()->role == "6")
				<a class="navbar-brand">
					<font color='grey' face='calibri'><i class='glyphicon glyphicon-transfer'></i>&nbsp;
					<big><b>ELNA</b></big> <small><small><small>v1.5.1</small></small></small></font>
				</a>
				@else 
				<a class="navbar-brand">
					<font color='grey' face='calibri'><i class='glyphicon glyphicon-comment'></i>&nbsp;
					<big><b>SOLID</b></big> <small><small><small>v2.2</small></small></small></font>
				</a>
				@endif
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
					<li><a href="{{ url('/user/view') }}"><font face='calibri'><b>MASTER USER</b></font></a></li>
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
				@elseif (Auth::user()->role == "5")	
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/user/view') }}"><font face='calibri'><b>USER</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/view_area') }}"><font face='calibri'><b>AREA</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/view_part') }}"><font face='calibri'><b>PART</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/view_transaction') }}"><font face='calibri'><b>TRANSACTION</b></font></a></li>
				</ul>
				<!-- <ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/print_report') }}"><font face='calibri'><b>PRINT REPORT</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/print_report_plant') }}"><font face='calibri'><b>PRINT PLANT REPORT</b></font></a></li>
				</ul> -->
				@elseif (Auth::user()->role == "6")	
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/view_transaction') }}"><font face='calibri'><b>TRANSACTION</b></font></a></li>
				</ul>
				@elseif (Auth::user()->role == "7")
				<!--  <ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/view_area') }}"><font face='calibri'><b>AREA</b></font></a></li>
				</ul>
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/view_part') }}"><font face='calibri'><b>PART</b></font></a></li>
				</ul> -->
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/stock/view_transaction') }}"><font face='calibri'><b>TRANSACTION</b></font></a></li>
				</ul>
				@endif
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
					<ul class="nav navbar-nav">
						<li><a href="//172.18.3.7/sinta/public">
							<button class="btn btn-primary btn-flat btn-sm">
							<i class="glyphicon glyphicon-send"></i>&nbsp;&nbsp;NEED HELP?
						</button>
                  	</a></li>
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

							$role=Auth::user()->role;
							if ($role == '1') {
		                        $a = 'User';
		                    }    
		                    elseif ($role == '2') {
		                        $a = 'Accounting';
		                    }
		                    elseif ($role == '3') {
		                        $a = 'Finance';
		                    }
		                    elseif ($role == '4') {
		                        $a = 'Cashier';
		                    }
		                    elseif ($role == '5') {
		                        $a = 'Inventory';  
		                    }
		                    elseif ($role == '6') {
		                        $a = 'Leader';
		                    }
		                    elseif ($role == '7') {
		                        $a = 'Supervisor'; 
		                    }    

						?>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
								<font face='calibri'><b>{{ Auth::user()->name }}</b> ({{$a}})</font>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu" role="menu">
								<li>
									<a  data-toggle="modal" data-target="#changePassword">
										<font face='calibri'>Change Password</font>
									</a>
								</li>
							</ul>
						</li>
						<li>
							<a href="{{ url('/auth/logout') }}">
								<button class="btn bg-maroon btn-sm">
									<div ><span class='glyphicon glyphicon-off'></span></div>
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
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						{{ Session::get('flash_message') }}
					</div>
				@endif
			</div>
		</div>
	</div>

	@yield('content')
	<div id="changePassword" class="modal fade" role="dialog">
        <div class="modal-dialog modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CHANGE PASSWORD</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/save_edit_password') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'>Current Password</font></label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password1" id="password1" autofocus required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'>New Password</font></label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password2" id="password2" required>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'>Confirm New Password</font></label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password3" id="password3" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-flat">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>UPDATE</b></font>
                </button>
              </div>
            </div>
          </form>
                </div>
            </div>
        </div>
    </div>
	<div class="col-md-10 col-md-offset-1">
    	<div>
    		<center>
    			<ol class="breadcrumb">
  				<li>
  					@if (Auth::user()->role == "7" or Auth::user()->role == "5" or Auth::user()->role == "6")
  					<font face='calibri' color='grey'>
  					<b>ELNA</b></font> <font face='calibri' color='grey'>(Electronic Ledger Stock Opname AiiA) ©2015 All Rights Reserved, PT Aisin Indonesia Automotive (Developed by ITD Department)
    				</font>
  					@elseif (Auth::user()->role == "1" or Auth::user()->role == "2" or Auth::user()->role == "3" or Auth::user()->role == "4")
  					<font face='calibri' color='grey'>
  					<b>SOLID</b></font> <font face='calibri' color='grey'>(Aisin Operational Invoice Document) ©2015 All Rights Reserved, PT Aisin Indonesia Automotive (Developed by ITD Department & <b>BAYMAX TEAM</b>)
    				</font>
    				@else
    				<font face='calibri' color='grey'>Finance Accounting Project ©2015 All Rights Reserved, PT Aisin Indonesia Automotive (Developed by ITD Department)
    				</font>
    				@endif
    			</li>
				</ol>
    		</center>
        </div>
	</div>
</body>
</html>

<head>
@if (Auth::user()->role == "7" or Auth::user()->role == "5" or Auth::user()->role == "6")
<style>
body{
background-image: url('{{ asset("img/img_elna.png") }}');
background-repeat: repeat-x repeat-y;
}
</style>
@else 
<style>
body{
background-image: url('{{ asset("img/school.png") }}');
background-repeat: repeat-x repeat-y;
}
</style>
@endif
</head>