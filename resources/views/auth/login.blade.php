@extends('app')

@section('content')
<style>
.textglow{ text-align:center; font-size:30px; color:grey; animation:blur .75s ease-out infinite; text-shadow:0px 0px 5px #fff, 0px 0px 7px #fff; }
@keyframes blur{ from{ text-shadow:0px 0px 10px #fff, 0px 0px 10px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 50px #fff, 0px 0px 50px #fff, 0px 0px 50px #7B96B8, 0px 0px 150px #7B96B8, 0px 10px 100px #7B96B8, 0px 10px 100px #7B96B8, 0px 10px 100px #7B96B8, 0px 10px 100px #7B96B8, 0px -10px 100px #7B96B8, 0px -10px 100px #7B96B8;} }
</style>
<br/><br/>
<div class="textglow">
<font face='calibri'><b>SOLID (AISIN Operational Invoice Document)</b></font>
</div><br/><br/>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-warning">
				<div class="panel-heading"><font face='calibri'><b><center>LOGIN TO YOUR ACCOUNT</center></b></font></div>
				<div class="panel-info"><div class="panel-heading">
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label"><font face='calibri'><b>E-Mail Address</b></font></label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" autofocus required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"><font face='calibri'><b>Password</b></font></label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> <font face='calibri'>Remember Me</font>
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary"><span class='glyphicon glyphicon-lock'></span>&nbsp;<font face='calibri'><b>LOGIN</b></font></button>
							</div>
						</div>
					</form>
				</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<br/><br/>
@endsection
