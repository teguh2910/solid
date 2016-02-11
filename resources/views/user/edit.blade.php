@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <font face='calibri' color='grey'><b><big><big><big><big>DATA USER</big></big></big></big></b></font><br/>
            <button class='btn btn-primary btn-flat btn-sm' data-toggle="modal" data-target="#myModal">
                <i class='glyphicon glyphicon-plus'></i> <font face='calibri'><b>CREATE USER</b></font>
            </button>
            <br/>
          <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered table-responsive">
                <thead>
                    <tr class='success'>
                        <th><center><small><font face='calibri'>USERNAME</font></small></center></th>
                        <th><center><small><font face='calibri'>E-MAIL ADDRESS</font></small></center></th>
                        <th><center><small><font face='calibri'>DEPARTMENT</font></small></center></th>
                        <th><center><small><font face='calibri'>ACCESS ROLE</font></small></center></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user_all as $user_all)
                <tr class='info'>
                    <td><font face='calibri'>{{ $user_all->name }}</font></td>
                    <td><font face='calibri'>{{ $user_all->email }}</font></td>
                    <td><font face='calibri'>
                    @if ($user_all->dept_code == '1')
                        Purchasing
                    @elseif ($user_all->dept_code == '2')
                        General Affair
                    @elseif ($user_all->dept_code == '3')
                        BOD
                    @elseif ($user_all->dept_code == '4')
                        Finance & Accounting
                    @elseif ($user_all->dept_code == '5')
                        MIS
                    @elseif ($user_all->dept_code == '6')
                        HRD
                    @endif
                    </font></td>
                    <td><font face='calibri'>
                    @if ($user_all->role == '1')
                        User
                    @elseif ($user_all->role == '2')
                        Accounting
                    @elseif ($user_all->role == '3')
                        Finance
                    @elseif ($user_all->role == '4')
                        Cashier
                    @endif
                    </font></td>
                    <td class='warning'><center>
                        <a href="{{ url('user/edit/'.$user_all->id) }}" class="btn btn-primary btn-flat btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                        </a>
                        <a href="{{ url('user/reset/'.$user_all->id) }}" class="btn btn-info btn-flat btn-xs"
                            onclick="return confirm('Are you sure to reset password this user to aiia?')">
                                <i class="glyphicon glyphicon-refresh"></i>
                        </a>
                        <a href="{{ url('user/delete/'.$user_all->id) }}" class="btn btn-danger btn-flat btn-xs"
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
        <div class="modal-dialog modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE USER</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/user/save_create') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Username</b></font></label>
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
              <div class="col-md-4">
                <select class="form-control" name="dept_code" id="dept_code">
                    <option value="3">BOD</option>
                    <option value="4">Finance&Accounting</option>
                    <option value="2">General Affair</option>
                    <option value="6">HRD</option>
                    <option value="5">MIS</option>
                    <option value="1">Purchasing</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Access Role</b></font></label>
              <div class="col-md-4">
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
                <button type="submit" class="btn btn-primary btn-flat">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>SAVE</b></font>
                </button>
                <button type="reset" class="btn btn-danger btn-flat">
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
<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-success">
        <div class="panel-heading"><center> <font face='calibri'>&nbsp;<b>UPDATE DATA USER</b></font></center></div>
        <div class="panel-info"><div class="panel-heading">
        <div class="panel-body">
        <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/user/save_edit') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach ($user as $user)
            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Username</b></font></label>
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
              <div class="col-md-4">
                <select class="form-control" name="dept_code" id="dept_code">
                    <option value="3">BOD</option>
                    <option value="4">Finance&Accounting</option>
                    <option value="2">General Affair</option>
                    <option value="6">HRD</option>
                    <option value="5">MIS</option>
                    <option value="1">Purchasing</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label"><font face='calibri'><b>Access Role</b></font></label>
              <div class="col-md-4">
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
                <button type="submit" class="btn btn-primary btn-flat">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>UPDATE</b></font>
                </button>
                <button type="reset" class="btn btn-danger btn-flat">
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
