@extends('app')

@section('content')

<center>
	<div class="login-logo">
        <font color='grey'>WELCOME</font><br/>
        <font color='grey'><b>SOLID</b> (Aisin Operational Invoice Document)</font>
    </div>
</center>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="item active">
				<center>
					<img src="{{ asset('img/bg.JPG') }}" width='75%' class="img-responsive img-thumbnail">
				</center>
			</div>
		</div>
		<div class="col-md-4">
			<center>
			<div class="panel panel-success">
				<div class="panel-heading"><big><big><big><center><font face='calibri'><b>LOG IN</b></font></center></big></big></big></div>
				<div class="panel-info"><div class="panel-heading">
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Pft,</strong> invalid E-Mail Address or Password<br>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group has-feedback">
            				<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" autofocus required>
            				<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          				</div>
          				<div class="form-group has-feedback">
            				<input type="password" class="form-control" name="password" placeholder="Password" required>
            				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
          				</div>
						<div class="form-group">
							<div class="col-md-4 col-md-offset-9">
								<button type="submit" class="btn btn-primary btn-flat"><b>LOG IN</b></button>
							</div>
						</div>
					</form>
				</div>
				</div>
				</div>
			</div>
		</center>
		</div>
	</div>
</div>
<br/><br/>
@endsection
