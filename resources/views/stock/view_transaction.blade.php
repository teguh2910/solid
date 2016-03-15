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
                    @if (count($t_transaction) > 0)
                      @foreach($t_transaction as $k)
                    <tr bgcolor='#FFFFFF'>
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
                    <tr class='info'>
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
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/stock/input_transaction') }}">
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
                   <option selected disabled="">Select Area Code </option>
                   @foreach ($m_area as $m_area)  
                   <option value="{{ $m_area->code_area }}">{{ $m_area->code_area }}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Area Name</b></font></label>
              <div class="col-md-7">
               <select class="form-control select2" name="name_area" id="name_area" style="width: 100%;" required >
                 <option selected disabled="">Select Area Name</option>
                 @foreach ($m_area2 as $m_area2)  
                 <option value="{{ $m_area2->name_area }}">{{ $m_area2->name_area }}</option> 
                 @endforeach
                 
               </select>
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Part Number/Back Number</b></font></label>
              <div class="col-md-7">
                <select class="form-control select2" name="part_number" id="part_number" style="width: 100%;" required >
                 <option selected disabled="">Select Part Number/Back Number</option>
                  @foreach ($m_part as $m_part)
                 <option value="{{ $m_part->part_number }}">{{ $m_part->part_number }}</option>
                 <option value="{{ $m_part->back_number }}">{{ $m_part->back_number }}</option>
                 @endforeach  
               </select>
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
