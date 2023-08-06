@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <font face='calibri' color="grey"><b><big><big><big>MASTER BANK</big></big></big></b></font><br/><br/>
                    <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                        <font face='calibri'><b>CREATE BANK</b></font>
                    </button>
                    <br/>
                	<div class="clearfix">&nbsp;</div>
                        <table class="table table-bordered table-condensed">
                        <thead>
                            <tr bgcolor='#00008B'>
                                <th><font face='calibri' color='white'>Bank Code</font></th>
                                <th><font face='calibri' color='white'>Bank Name</font></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($m_bank as $view)
                        <tr class='info'>
                            <td><font face='calibri'>{{ $view->code_bank }}</font></td>
                            <td><font face='calibri'>{{ $view->bank_name }}</font></td>
                            <td class='warning'><center>
                                <a href="{{ url('bank/edit_bank/'.$view->id) }}" class="btn btn-primary btn-xs">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                </a>&nbsp;
                                <a href="{{ url('bank/delete/'.$view->id) }}" class="btn btn-danger btn-xs"
                                    onclick="return confirm('Are you sure to delete bank name \'{{$view->bank_name}}\' ?')">
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
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE BANK</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/bank/save_create') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Bank Name</b></font><br/>
                <input type="text" class="form-control" name="name_bank" id="name_bank" autofocus required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Bank Code</b></font><br/>
                <input type="code_bank" class="form-control" name="code_bank" id="code_bank" required>
              </div>
            </div>
            
                <button type="submit" class="btn btn-sm btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;
                  <font face='calibri'><b>SAVE</b></font>
                </button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-sm btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span>&nbsp;
                  <font face='calibri'><b>RESET</b></font>
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

@if (count($m_bank) > 0)
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