@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
<div class="col-lg-12">
    <big><big><big><font face='calibri' color='grey'><b>DATA TRANSACTION</b></font></big></big></big>
    <div class="row">
        <div class="col-md-12">
            <div class="clearfix">&nbsp;</div>
            <section id="unseen">
              @if(!\Auth::user()->role_checker)
                <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                <font face='calibri'><b>CREATE TRANSACTION</b></font>
            </button>
            @endif

            @if(\Auth::user()->role_checker)
            <button class='btn btn-warning btn-sm' data-toggle="modal" data-target="#checkerModal">
                <font face='calibri'><b>CREATE TRANSACTION FOR CHECKER</b></font>
            </button>
            @endif
            <br/><br/>
            <font face='calibri'><b>Keterangan :</b></font>&nbsp;&nbsp;<img src = {{ asset ('/img/biru.jpg')}} width='15px'><small><font face='calibri'> Belum di input</font></small>
                &nbsp;&nbsp;&nbsp;&nbsp;<img src = {{ asset ('/img/abu.jpg')}} width='15px'><small><font face='calibri'> Sudah di input</font></small><br/><br/>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr bgcolor='#00008B'>
                        <th><font face='calibri' color='white'>Id Area</font></th>
                        <th><font face='calibri' color='white'>Back Number</font></th>
                        <th><font face='calibri' color='white'>Part Number</font></th>
                        <th><font face='calibri' color='white'>Part Name</font></th>
                        <th><font face='calibri' color='white'>Qty / Box</font></th>
                        <th><font face='calibri' color='white'>Unit</font></th>
                        <th><font face='calibri' color='white'>Amount Of Box</font></th>
                        <th><font face='calibri' color='white'>Uncomplete</font></th>  
                        <th><font face='calibri' color='white'>Total (Pcs)</font></th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($t_transaction) > 0)
                      @foreach($t_transaction as $k)
                    @if ($k->total_pcs == '0')
                    <tr bgcolor='#ADE8E6'>
                    @else
                    <tr bgcolor='#A9A9A9'>
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
        <div class="modal-dialog">
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
                <font face='calibri'><b>Id Area</b></font><br/>
                <select class="form-control select2" name="id_area" id="id_area" style="width: 100%;" required>
                   @foreach ($m_areas as $m_area)  
                   <option value="{{ $m_area->id_area }}">{{ $m_area->id_area }}</option>
                  @endforeach
                </select>
              </div>
            </div>  

            <div class="form-group">
              <div class="col-md-8">
                <button type="submit" class="btn btn-primary btn-sm">
                  <span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;
                  <font face='calibri'><b>SEARCH</b></font>
                </button>
              </div>
            </div>
        </form>
        </div>
    </div>
</div>
</div>

<div id="checkerModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE TRANSACTION</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="post" action="{{ url('/stock/view_list_checker') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Id Area</b></font><br/>
                <select class="form-control select2" name="id_area_c" id="id_area_c" style="width: 100%;" required>
                   @foreach ($m_areas as $m_area)  
                   <option value="{{ $m_area->id_area }}">{{ $m_area->id_area }}</option>
                  @endforeach
                </select>
              </div>
            </div>  

            <div class="form-group">
              <div class="col-md-8">
                <button type="submit" class="btn btn-warning btn-sm">
                  <span class='glyphicon glyphicon-search'></span>&nbsp;&nbsp;
                  <font face='calibri'><b>SEARCH</b></font>
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
        "searching": true,
        pageLength:20
    });
</script>
@endif
@endsection
