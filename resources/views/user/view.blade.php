@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <font face='calibri' color='grey'><b><big><big><big>DATA USER</big></big></big></b></font><br/>
            <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                <font face='calibri'><b>CREATE USER</b></font>
            </button>
            <br/>
        	<div class="clearfix">&nbsp;</div>
                <table class="table table-striped table-bordered">
                <thead>
                    <tr class='success'>
                        <th><center><small><font face='calibri'>NAME</font></small></center></th>
                        <th><center><small><font face='calibri'>E-MAIL ADDRESS</font></small></center></th>
                        <th><center><small><font face='calibri'>DEPARTMENT</font></small></center></th>
                        <th><center><small><font face='calibri'>ACCESS ROLE</font></small></center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user as $user)
                <tr class='warning'>
                    <td><font face='calibri'>{{ $user->name }}</font></td>
                    <td><font face='calibri'>{{ $user->email }}</font></td>
                    <td><font face='calibri'>
                    @if ($user->dept_code == '1')
                        Purchasing
                    @elseif ($user->dept_code == '2')
                        General Affair
                    @elseif ($user->dept_code == '3')
                        BOD
                    @elseif ($user->dept_code == '4')
                        Finance & Accounting
                    @elseif ($user->dept_code == '5')
                        MIS
                    @elseif ($user->dept_code == '6')
                        HRD
                    @endif
                    </font></td>
                    <td><font face='calibri'>
                    @if ($user->role == '1')
                        User
                    @elseif ($user->role == '2')
                        Accounting
                    @elseif ($user->role == '3')
                        Finance
                    @elseif ($user->role == '4')
                        Cashier
                    @endif
                    </font></td>
                    <td><center>
                        <a href="{{ url('user/edit/'.$user->id) }}" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a href="{{ url('user/reset/'.$user->id) }}" class="btn btn-info btn-xs"
                            onclick="return confirm('Are you sure to reset password this user to aiia?')">
                                <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a href="{{ url('user/delete/'.$user->id) }}" class="btn btn-danger btn-xs"
                            onclick="return confirm('Are you sure to delete this user?')">
                                <i class="glyphicon glyphicon-trash"></i>
                        </a></center>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE USER</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/user/save_create') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Name</b></font></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="name" id="name" autofocus required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>E-Mail Address</b></font></label>
              <div class="col-md-8">
                <input type="email" class="form-control" name="email" id="email" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Department</b></font></label>
              <div class="col-md-8">
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
              <label class="col-md-3 control-label"><font face='calibri'><b>Access Role</b></font></label>
              <div class="col-md-8">
                <select class="form-control" name="role" id="role">
                     <option value="1">User</option>
                     <option value="2">Accounting</option>
                     <option value="3">Finance</option>
                     <option value="4">Cashier</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Password</b></font></label>
              <div class="col-md-8">
                <input type="password" class="form-control" name="password" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Confirm Password</b></font></label>
              <div class="col-md-8">
                <input type="password" class="form-control" name="password1" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8 col-md-offset-3">
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
<br/>

@if (count($user) > 0)
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