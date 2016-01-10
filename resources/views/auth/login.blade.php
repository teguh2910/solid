@extends('app')

@section('content')
<style>
.textglow{ text-align:center; font-size:25px; color:grey; animation:blur .90s ease-out infinite; text-shadow:0px 0px 5px #fff, 0px 0px 7px #fff; }
@keyframes blur{ from{ text-shadow:0px 0px 10px #fff, 0px 0px 10px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 25px #fff, 0px 0px 50px #fff, 0px 0px 50px #fff, 0px 0px 50px #7B96B8, 0px 0px 150px #7B96B8, 0px 10px 100px #7B96B8, 0px 10px 100px #7B96B8, 0px 10px 100px #7B96B8, 0px 10px 100px #7B96B8, 0px -10px 100px #7B96B8, 0px -10px 100px #7B96B8;} }
</style>
<br/>
<div class="textglow">
<font face='calibri'><b>SOLID (AISIN Operational Invoice Document)</b></font>
</div><br/><br/>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-7">
			<div class="carousel slide" id="carousel-718875">
				<ol class="carousel-indicators">
					<li class="active" data-slide-to="0" data-target="#carousel-718875"></li>
					<li data-slide-to="1" data-target="#carousel-718875"></li>					
				</ol>
				<div class="carousel-inner">
					<div class="item active">
						<center>
							<img alt="Carousel Bootstrap First" src="{{ asset('img/bg.jpg') }}" width='80%' class="img-thumbnail img-rounded img-responsive">
						</center>
					</div>
				</div> 
			</div>
		</div>
		<div class="col-md-5">
			<div class="panel panel-warning">
				<div class="panel-heading"><font face='calibri'><b><center>LOGIN TO YOUR ACCOUNT</center></b></font></div>
				<div class="panel-info"><div class="panel-heading">
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Pfft!</strong> Your E-mail Address & Password combination is wrong!<br>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-3 control-label"><font face='calibri'><b>E-Mail Address</b></font></label>
							<div class="col-md-9">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" autofocus required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label"><font face='calibri'><b>Password</b></font></label>
							<div class="col-md-9">
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-9 col-md-offset-3">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> <font face='calibri'>Remember Me</font>
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-9 col-md-offset-3">
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
