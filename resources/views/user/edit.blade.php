@extends('app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-success">
        <div class="panel-heading">
          <a href="{{ url('user/view') }}" class="btn btn-info btn-sm">
            <font face='calibri'><b>BACK</b></font>
          </a>&nbsp;&nbsp;
          <big><big><font face='calibri'>&nbsp;<b>UPDATE DATA USER</b></font></big></big>
        </div>
        <div class="panel-info"><div class="panel-heading">
        <div class="panel-body">
        <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/user/save_edit') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach ($user as $user)
            <div class="form-group">
              <div class="col-md-6">
                <font face='calibri'><b>Username</b></font><br/>
                <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" autofocus required>
                <input type="hidden" class="form-control" name="id" id="id" value="{{$user->id}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-6">
                <font face='calibri'><b>E-mail Address</b></font><br/>
                <input type="email" class="form-control" name="email" id="email" value="{{$user->email}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-4">
                <font face='calibri'><b>Department</b></font><br/>
                <select class="form-control" name="dept_code" id="dept_code">
                    <option value="3">BOD</option>
                    <option value="4">Finance&Accounting</option>
                    <option value="2">General Affair</option>
                    <option value="6">HRD</option>
                    <option value="5">MIS</option>
                    <option value="1">Purchasing</option>
                    <option value="7">PPIC Body</option>
                    <option value="8">PPIC Unit</option>
                    <option value="9">Production Body</option>
                    <option value="10">Purchasing</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-4">
                <font face='calibri'><b>Access Role</b></font><br/>
                <select class="form-control" name="role" id="role">
                     <option value="1">User</option>
                     <option value="2">Accounting</option>
                     <option value="3">Finance</option>
                     <option value="4">Cashier</option>
                     <option value="5">Inventory</option>
                     <option value="6">Leader</option>
                     <option value="7">Supervisor</option>
                </select>
                <br/>
              </div>
            </div>

            @endforeach
            <div class="form-group">
              <div class="col-md-8">
                <button type="submit" class="btn btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;<font face='calibri'><b>UPDATE</b></font>
                </button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span>&nbsp;<font face='calibri'><b>RESET</b></font>
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
 
@if (count($user_all) > 0)
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        $('input[type="search"]').removeClass('form-control').removeClass('input-sm');
        $('.dataTables_filter').addClass('pull-right');
        $('.pagination').addClass('pull-right');
    });

    $('table').dataTable({
        "searching": true
    });
</script>
@endif

@endsection
