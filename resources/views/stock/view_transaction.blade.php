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
                <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                <font face='calibri'><b>CREATE TRANSACTION</b></font>
            </button>
            <br/><br/>
            <table  class="table table-condensed table-bordered table-hover">
                <thead>
                    <tr class='info'>
                        <th><font face='calibri'>ID Area</font></th>
                        <th><font face='calibri'>Back No</font></th>
                        <th><font face='calibri'>Part Number</font></th>
                        <th><font face='calibri'>Part Name</font></th>
                        <th><font face='calibri'>Quantity/Box</font></th>
                        <th><font face='calibri'>Unit</font></th>
                        <th><font face='calibri'>Amount Of Box</font></th>
                        <th><font face='calibri'>Uncomplete</font></th>  
                        <th><font face='calibri'>Total(Pcs)</font></th>
                        
                    </tr>
                </thead>
                <tbody>
                    @if (count($t_transaction) > 0)
                      @foreach($t_transaction as $k)
                    @if ($k->total_pcs == '0')
                    <tr bgcolor='#FFFFFF'>
                    @else
                    <tr bgcolor='#DCDCDC'>
                    @endif
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
                        <td colspan="9"><center><font face='calibri'>No record to display</font></center></td>
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
              <div class="col-md-7">
                <font face='calibri'><b>ID AREA</b></font><br/>
                <select class="form-control select2" name="id_area" id="id_area" style="width: 100%;" required>
                   @foreach ($m_area as $m_area)  
                   <option value="{{ $m_area->id_area }}">{{ $m_area->id_area }}</option>
                  @endforeach
                </select>
              </div>
            </div>  

            <div class="form-group">
              <div class="col-md-8">
                <button type="submit" class="btn btn-primary btn-sm">
                  <span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;<font face='calibri'><b>SEARCH</b></font>
                </button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-danger btn-sm">
                  <span class='glyphicon glyphicon-repeat'></span>&nbsp;&nbsp;<font face='calibri'><b>RESET</b></font>
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
