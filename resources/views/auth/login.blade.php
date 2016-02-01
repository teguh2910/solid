@extends('app')

@section('content')
<center>
	<big><big><big>
		<font face='calibri' color='grey'><b><big>WELCOME</big><br/>SOLID (Aisin Operational Invoice Document)</b></font>
	</big></big></big>
</center>
<br/><br/>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
					<div class="item active">
						<center>
							<img src="{{ asset('img/bg.JPG') }}" width='75%' class="img-thumbnail img-responsive">
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
							<strong>Pft!</strong> invalid E-Mail Address or Password<br>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<div class='input-group'>
                  				<input type='email' class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" autofocus required/>
                    			<span class="input-group-addon">
                      				<span class="glyphicon glyphicon-envelope"></span>
                      			</span>
                			</div>
						</div>

						<div class="form-group">
							<div class='input-group'>
                  				<input type='password' class="form-control" name="password" placeholder="Password" required/>
                    			<span class="input-group-addon">
                      				<span class="glyphicon glyphicon-lock"></span>
                      			</span>
                			</div>
						</div>
						<div class="form-group">
							<div class="col-md-4 col-md-offset-9">
								<button type="submit" class="btn btn-primary"><big><font face='calibri'><b>LOGIN</b></font></big></button>
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
