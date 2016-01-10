@extends('app')

@section('content')

<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-success">
        <div class="panel-heading"><center> <font face='calibri'>&nbsp;<b>UPDATE DATA USER</b></font></center></div>
        <div class="panel-warning"><div class="panel-heading">
        <div class="panel-body">
        <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/user/save_edit') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach ($user as $user)
            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Name</b></font></label>
              <div class="col-md-6">
                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" autofocus required>
                <input type="hidden" class="form-control" name="id" id="id" value="{{$user->id}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>E-Mail Address</b></font></label>
              <div class="col-md-6">
                <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Department</b></font></label>
              <div class="col-md-6">
                <select class="form-control" name="dept_code" id="dept_code">
                    <option value="1">Purchasing</option>
                    <option value="2">General Affair</option>
                    <option value="3">BOD</option>
                    <option value="4">Finance&Accounting</option>
                    <option value="5">MIS</option>
                    <option value="6">HRD</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Access Role</b></font></label>
              <div class="col-md-6">
                <select class="form-control" name="role" id="role">
                     <option value="1">User</option>
                     <option value="2">Accounting</option>
                     <option value="3">Finance</option>
                     <option value="4">Cashier</option>
                </select>
              </div>
            </div>

            @endforeach
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>UPDATE</b></font>
                </button>
                <button type="reset" class="btn btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span> <font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>
          </form>
        </div></div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Table -->
 


@endsection
