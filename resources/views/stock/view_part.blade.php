@extends('app')
@section('content')
<div class="row mt">
<div class="col-lg-12">
<div class="content-panel">
<div class="container-fluid">
    <h4><i class="fa fa-angle-right"></i> DATA PART</h4>
    <div class="row">
        <div class="col-md-12">
            <div class="clearfix">&nbsp;</div>
            <section id="unseen">
           <button class='btn btn-primary btn-flat btn-sm' data-toggle="modal" data-target="#myModal">
                <i class='glyphicon glyphicon-plus'></i> <font face='calibri'><b>CREATE PART</b></font>
            </button>
            <br/><br/>
            <table  class="table table-condensed table-bordered">
                <thead>
                    <tr>
                        <th><center><font face='calibri'>BACK NUMBER</font></center></th>
                        <th><center><font face='calibri'>PART NUMBER</font></center></th>
                        <th><center><font face='calibri'>PART NAME</font></center></th>
                        <th><center><font face='calibri'>QUANTITY OF BOX</font></center></th>
                        <th><center><font face='calibri'>UNIT</font></center></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($m_part) > 0)
                    @foreach ($m_part as $m_part)
                    <tr bgcolor='#FFFFFF'>
                        <td><font face='calibri'>{{ $m_part->back_number }}</font></td>
                        <td><font face='calibri'>{{ $m_part->part_number }}</font></td>
                        <td><font face='calibri'>{{ $m_part->part_name }}</font></td>
                        <td><font face='calibri'>{{ $m_part->qty_box }}</font></td>
                        <td><font face='calibri'>{{ $m_part->unit }}</font></td>
                        <td><center>
                            <a href="{{ url('stock/edit_part/'.$m_part->id) }}" class="btn btn-info btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            
                            <a href="{{ url('stock/delete_part/'.$m_part->id) }}" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure to delete part \'{{$m_part->name_part}}\'?')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </center>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr class='info'>
                        <td colspan="8"><center><font face='calibri'>No record to display</font></center></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </section>
        </div>
    </div>
     <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE PART</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/stock/save_part') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
    
            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Back Number</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="back_number" id="back_number" autofocus required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Part Number</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="part_number" id="part_number" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Part Name</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="part_name" id="part_name" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Quantity of Box</b></font></label>
              <div class="col-md-7">
                  <input type='text' class="form-control" name="qty_box" id="qty_box" required>
                </div>
              </div>
           

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Unit</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="unit" id="unit" required>
              </div>
              </div>
          


            <div class="form-group">
              <div class="col-md-8 col-md-offset-3">
                <button type="submit" class="btn btn-flat btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>SAVE</b></font>
                </button>
                <button type="reset" class="btn btn-flat btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span> <font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>
@if (count($m_part) > 0)
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.dataTables_filter').addClass('pull-right');
        $('.pagination').addClass('pull-right');
    });

    $('table').dataTable({
        "searching": true
    });
</script>
@endif
<br/>

@endsection
