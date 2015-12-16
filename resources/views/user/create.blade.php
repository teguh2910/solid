@extends('app')

@section('content')

<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading"><center><span class='glyphicon glyphicon-user'></span> <font face='calibri'>&nbsp;<font face='calibri'><b>FORM USER REGISTRATION</b></font></center></div>
        <div class="panel-body">
          
        <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/user/save_create') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Name</b></font></label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="name" id="name" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>E-Mail Address</b></font></label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Department</b></font></label>
              <div class="col-md-6">
                <select class="form-control" name="dept_code" id="dept_code">
                     <option value="1">Purchasing</option>
                     <option value="2">General Affair</option>
                     <option value="3">BOD</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Role</b></font></label>
              <div class="col-md-6">
                <select class="form-control" name="role" id="role">
                     <option value="1">User</option>
                     <option value="2">Accounting</option>
                     <option value="3">Finance</option>
                     <option value="4">Cashier</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Password</b></font></label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Confirm Password</b></font></label>
              <div class="col-md-6">
                <input type="password" class="form-control" name="password1" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>SAVE</b></font>
                </button>
                <button type="reset" class="btn btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span> <font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Table -->
 


@endsection
