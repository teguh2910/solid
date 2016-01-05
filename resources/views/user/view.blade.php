@extends('app')
@section('content')
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <font face='calibri'><b><big><big><big>DATA USER</big></big></big></b></font><br/>
            <a href="{{ url('user/create') }}"><button class='btn btn-primary btn-sm'><font face='calibri'><b>CREATE USER</b></font></button></a>
            <br/>
        	<div class="clearfix">&nbsp;</div>
                <table class="table table-striped table-bordered">
                <thead>
                    <tr class='success'>
                        <th><center><small><font face='calibri'>NAME</font></small></center></th>
                        <th><center><small><font face='calibri'>E-MAIL ADDRESS</font></small></center></th>
                        <th><center><small><font face='calibri'>DEPARTMENT</font></small></center></th>
                        <th><center><small><font face='calibri'>ACCESS ROLE</font></small></center></th>
                        <th><center><small><font face='calibri'>MENU</font></small></center></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($user as $user)
                <tr>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $user->name }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $user->email }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>
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
                    <td bgcolor='#FFFFFF'><font face='calibri'>
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
                    <td bgcolor='#FFFFFF'><center>
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
</div>


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