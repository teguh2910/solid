@extends('app')
@section('content')
<div class="row mt">
<div class="col-lg-12">
<div class="content-panel">
<div class="container-fluid">
    <big><big><big><font face='calibri' color='grey'><b>DATA TRANSACTION</b></font></big></big></big>
    <div class="row">
        <div class="col-md-12">
            <div class="clearfix">&nbsp;</div>
            <section id="unseen">
                <button class='btn btn-primary btn-flat btn-sm' data-toggle="modal" data-target="#myModal">
                <i class='glyphicon glyphicon-plus'></i> <font face='calibri'><b>CREATE TRANSACTION</b></font>
            </button>
            <br/><br/>
            <table  class="table table-condensed table-bordered">
                <thead>
                    <tr class='info'>
                        <th><center><font face='calibri'>ID Area</font></center></th>
                        <th><center><font face='calibri'>Back No</font></center></th>
                        <th><center><font face='calibri'>Part Number</font></center></th>
                        <th><center><font face='calibri'>Part Name</font></center>
                        <th><center><font face='calibri'>Quantity/Box</font></center></th>
                        <th><center><font face='calibri'>Unit</font></center></th>
                        <th><center><font face='calibri'>Amount Of Box</font></center>
                        <th><center><font face='calibri'>Uncomplete</font></center>  
                        <th><center><font face='calibri'>Total(Pcs)</font></center></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if (count($t_transaction) > 0)
                      @foreach($t_transaction as $k)
                    <tr bgcolor='#FFFFFF'>
                        <td><font face='calibri'>{{ $k->id_area }}</font></td>
                        <td><font face='calibri'>{{ $k->back_number }}</font></td>
                        <td><font face='calibri'>{{ $k->part_number }}</font></td>
                        <td><font face='calibri'>{{ $k->part_name }}</font></td>
                        <td><font face='calibri'>{{ $k->qty_box }}</font></td>
                        <td><font face='calibri'>{{ $k->unit }}</font></td>
                        <td><font face='calibri'>{{ $k->amount_box }}</font></td>
                        <td><font face='calibri'>{{ $k->amount_pcs }}</font></td>
                        <td><font face='calibri'>{{ $k->total_pcs }}</font></td>

                    </tr>
                    @endforeach
                   @else
                    <tr bgcolor='#FFFFFF'>
                        <td colspan="8"><center><font face='calibri'>No record to display</font></center></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </section>
        </div>
    </div>
  </div>
</div>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE TRANSACTION</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="post" action="{{ url('/stock/view_list') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>ID AREA</b></font></label>
              <div class="col-md-7">
                <select class="form-control select2" name="id_area" id="id_area" style="width: 100%;" required>
                   @foreach ($m_area as $m_area)  
                   <option value="{{ $m_area->id_area }}">{{ $m_area->id_area }}</option>
                  @endforeach
                </select>
              </div>
            </div>  

            <div class="form-group">
              <div class="col-md-8 col-md-offset-3">
                <button type="submit" class="btn btn-flat btn-primary">
                  <span class='glyphicon glyphicon-search'></span> <font face='calibri'><b>SEARCH</b></font>
                </button>&nbsp;
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
@if (count($t_transaction) > 0)
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
       function test (e) {
        if($('#action1').val()=="UNIT"){
            // $('#pending_reason').attr('disabled','disabled');
            $('#gr-UNIT').hide();
            $('#gr-BODY').hide();
            $('#gr-button').show();
            $('#gr-reset').hide();
        }else {
            $('#gr-UNIT').hide();
            $('#gr-BODY').hide();
            $('#gr-button').hide();
        }
    }
</script>
@endif
<br/>

@endsection
