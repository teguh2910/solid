@extends('app')
@section('content')
<div class="row mt">
<div class="col-lg-12">
<div class="content-panel">
<div class="container-fluid">
    <h4><i class="fa fa-angle-right"></i> DATA STOCK</h4>
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
                    <tr>
                        <th><center><font face='calibri'>BACK NO</font></center></th>
                        <th><center><font face='calibri'>PART NO</font></center></th>
                        <th><center><font face='calibri'>PART NAME</font></center>
                        <th><center><font face='calibri'>QUANTITY/BOX</font></center></th>
                        <th><center><font face='calibri'>UNIT</font></center></th>
                        <th><center><font face='calibri'>AMOUNT OF BOX</font></center>
                        <th><center><font face='calibri'>AMOUNT OF PCS</font></center>  
                        <th><center><font face='calibri'>TOTAL(PCS)</font></center></th>
                        
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach ($m_part as $v)
                    <tr bgcolor='#FFFFFF'>
                        <td><font face='calibri'>{{ $v->back_number }}</font></td>
                        <td><font face='calibri'>{{ $v->part_number }}</font></td>
                        <td><font face='calibri'>{{ $v->part_name }}</font></td>
                        <td><font face='calibri'>{{ $v->qty_box }}</font></td>
                        <td><font face='calibri'>{{ $v->unit }}</font></td>
                        @endforeach
                     @foreach($t_transaction as $k)
                        <td><font face='calibri'>{{ $k->amount_box }}</font></td>
                        <td><font face='calibri'>{{ $k->amount_pcs }}</font></td>
                        <td><font face='calibri'>{{ $k->total_pcs }}</font></td>
                        @endforeach
                    </tr>
                   
                    <tr class='info'>
                        <td colspan="8"><center><font face='calibri'>No record to display</font></center></td>
                    </tr>
                    
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
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/stock/save_transaction') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
    
            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Plant Type</b></font></label>
              <div class="col-md-7">
                  <select class="form-control" name="type_plant" id="type_plant" onclick="test(this)">
                      <option selected disabled="">Select Plant</option>
                      <option value="UNIT">UNIT</option>
                      <option value="BODY">BODY</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Area Code</b></font></label>
              <div class="col-md-7">
                <select class="form-control select2" name="code_area" id="code_area" style="width: 100%;" required >
                    @foreach ($m_area as $m_area)
                     <option selected disabled="">Select Area Code </option>
                     <option value="{{ $m_area->code_area }}">{{ $m_area->code_area }}</option>
                   
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Area Name</b></font></label>
              <div class="col-md-7">
               <select class="form-control select2" name="name_area" id="name_area" style="width: 100%;" required >
                
                 <option selected disabled="">Select Area Name</option>
                 <option value="{{ $m_area->name_area }}">{{ $m_area->name_area }}</option>
                 @endforeach
               </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Part Number</b></font></label>
              <div class="col-md-7">
                  <input type='text' class="form-control" name="part_number" id="part_number" required>
                </div>
              </div>
           

          
            <div class="form-group">
              <div class="col-md-8 col-md-offset-3">
                <button type="submit" class="btn btn-flat btn-primary">
                  <span class='glyphicon glyphicon-search'></span> <font face='calibri'><b>SEARCH</b></font>
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
