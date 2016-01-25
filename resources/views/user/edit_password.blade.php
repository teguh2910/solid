@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-7 col-md-offset-3">
			<div class="panel panel-warning">
				<div class="panel-heading"><center><span class='glyphicon glyphicon-lock'></span><font face='calibri'>&nbsp;&nbsp; <b>CHANGE PASSWORD</b></font></center></div>
				<div class="panel-success"><div class="panel-heading">
				<div class="panel-body">
					
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/save_edit_password') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label"><font face='calibri'><b>Current Password</b></font></label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password1" id="password1" autofocus required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"><font face='calibri'><b>New Password</b></font></label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password2" id="password2" required>
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label"><font face='calibri'><b>Confirm New Password</b></font></label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password3" id="password3" required>
							</div>
						</div>

						<div class="form-group">
              				<div class="col-md-6 col-md-offset-4">
               					<button type="submit" class="btn btn-primary">
                					<span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'> <b>UPDATE</b></font>
                				</button>
                				<button type="reset" class="btn btn-danger">
                  					<span class='glyphicon glyphicon-repeat'></span><font face='calibri'> <b>RESET</b></font>
                				</button>
              				</div>
            			</div>
					</form>

				</div>
			</div></div>
			</div>
		</div>
	</div>
</div>

@endsection
