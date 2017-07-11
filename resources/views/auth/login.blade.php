<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SOLID v3.0.5 & ELNA v1.4</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='{{ asset("css/bootstrap.min.css") }}' rel="stylesheet" id="bootstrap-css">
    <style type="text/css">
    body{
    background: url('{{ asset("img/back.png") }}');
	background-color: #444;
    background: url('{{ asset("img/pinlayer2.png") }}'),url('{{ asset("img/pinlayer1.png") }}'),url('{{ asset("img/back.png") }}');    
}

.vertical-offset-100{
    padding-top:100px;
}    </style>
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src='{{ asset("js/bootstrap.min.js") }}'></script>
    	<script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenLite.min.js"></script>
        <script type="text/javascript">
        window.alert = function(){};
        var defaultCSS = document.getElementById('bootstrap-css');
        function changeCSS(css){
            if(css) $('head > link').filter(':first').replaceWith('<link rel="stylesheet" href="'+ css +'" type="text/css" />'); 
            else $('head > link').filter(':first').replaceWith(defaultCSS); 
        }
        $( document ).ready(function() {
          var iframe_height = parseInt($('html').height()); 
          // window.parent.postMessage( iframe_height, 'http://bootsnipp.com');
        });
        </script>
</head>
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
<body>

<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>



<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->

<br/><br/><br/><br/><br/><br/><br/><br/><br/>
<div class="container">
	<div class="col-md-5 col-md-offset-4">
		@if (count($errors) > 0)
			@foreach ($errors->all() as $error)
                	<div class="alert alert-danger alert-dismissible" role="alert">
                    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>

                    	<font face='calibri'><b>Error</b>, invalid E-mail Address or Password !</font>

                    	<font face='calibri'><b>Error</b>, invalid E-mail Address or Password</font>

                	</div>
			@endforeach
		@endif	
    <div class="box box-primary">
        <div class="box-body">
					<center>
						<font face='calibri'>

							<big><big><big><big><b>WELCOME</b></big></big></big></big> <!-- <small>v.1.1.1</small> --><!-- <br/> -->
							<!-- Aisin Operational Invoice Document -->

							<big><big><big><big><big><b>SOLID</b></big></big></big></big></big> <!-- <small>v.1.1.1</small> --><!-- <br/> -->
							&nbsp;<small><b>v3.1</b></small>

						</font><br/><br/>
					</center>

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group has-feedback">
							<label class="col-md-2 control-label">
							</label>
							<div class="col-md-8">
								<font face='calibri'><b>E-mail Address</b></font><br/>
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" autofocus required>
							</div>
						</div>
						<div class="form-group has-feedback">
							<label class="col-md-2 control-label">
							</label>
							<div class="col-md-8">
								<font face='calibri'><b>Password</b></font><br/>
								<input type="password" class="form-control" name="password" placeholder="Password" required>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-8 col-md-offset-2">
								<button class="btn btn-flat btn-sm btn-primary">
									<i class='glyphicon glyphicon-lock'></i>&nbsp; 
									<font face='calibri'><b>LOG IN</b></font>
								</button>
							</div>
						</div>
					</form>
		</div>	</div></div>
</div>	<script type="text/javascript">
	$(document).ready(function(){
  $(document).mousemove(function(e){
     TweenLite.to($('body'), 
        .5, 
        { css: 
            {
                backgroundPosition: ""+ parseInt(event.pageX/8) + "px "+parseInt(event.pageY/'12')+"px, "+parseInt(event.pageX/'15')+"px "+parseInt(event.pageY/'15')+"px, "+parseInt(event.pageX/'30')+"px "+parseInt(event.pageY/'30')+"px"
            }
        });
  });
});	</script>
</body>
</html>