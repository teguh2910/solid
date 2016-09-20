@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
<div class="col-lg-12">
    <big><big><big><font face='calibri' color='grey'><b>DATA PART</b></font></big></big></big>
    <div class="row">
        <div class="col-md-12">
            <div class="clearfix">&nbsp;</div>
            <section id="unseen">
           <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                <font face='calibri'><b>CREATE PART</b></font>
            </button>
            &nbsp;&nbsp;
            <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal2">
                <font face='calibri'><b>IMPORT PART</b></font>
            </button>
            &nbsp;&nbsp;
            <!-- <a href="{{ url('/stock/print_master_part') }}"><button class='btn btn-primary btn-flat btn-sm'><i class='glyphicon glyphicon-print'></i> &nbsp;<font face='calibri'><b>PRINT MASTER PART</b></font></button></a>
             -->
            <!-- <a href="{{ url('/normalize/transaction') }}"><button class='btn btn-success btn-flat btn-sm'><font face='calibri'><b>NORMALIZE TRANSACTION</b></font></button></a>
             --><br/><br/>
            <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <tr bgcolor='#00008B'>
                        <th><font face='calibri' color='white'>ID Area</font></th>
                        <th><font face='calibri' color='white'>Back Number</font></th>
                        <th><font face='calibri' color='white'>Part Number</font></th>
                        <th><font face='calibri' color='white'>Part Name</font></th>
                        <th><font face='calibri' color='white'>Qty Of Box</font></th>
                        <th><font face='calibri' color='white'>Unit</font></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($m_part) > 0)
                    @foreach ($m_part as $k => $v)
                    <tr bgcolor='#ADE8E6'>
                        <td><font face='calibri'>{{ $v->id_area }}</font></td>
                        <td><font face='calibri'>{{ $v->back_number }}</font></td>
                        <td><font face='calibri'>{{ $v->part_number }}</font></td>
                        <td><font face='calibri'>{{ $v->part_name }}</font></td>
                        <td><font face='calibri'>{{ $v->qty_box }}</font></td>
                        <td><font face='calibri'>{{ $v->unit }}</font></td>
                      
                        <td><center>
                            <a href="{{ url('stock/edit_part/'.$v->id) }}" class="btn btn-primary btn-xs">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>&nbsp;
                            <a href="{{ url('stock/delete_part/'.$v->id) }}" class="btn btn-danger btn-xs"  onclick="return confirm('Are you sure to delete part \'{{$v->name_part}}\'?')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </center>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr bgcolor='#FFFFFF'>
                        <td colspan="7"><center><font face='calibri'>No record to display</font></center></td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </section>
        </div>
    </div>
       <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog modal-info">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>IMPORT DATA PART</b></font></h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="form-group">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div style="position:relative;">
                                <a class='btn btn-primary btn-sm' href='javascript:;'>
                                    <font face='calibri'><b>CHOOSE FILE</b></font>
                                    <input type="file" id="file" name="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;'size="40" onchange='$("#upload-file-info").html($(this).val());' autofocus required>
                                </a>
                                &nbsp;
                                <span class='label label-primary' id="upload-file-info"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-6">
                            <small><font face='calibri'>Extension must be <b>.csv</b></font></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <span class='glyphicon glyphicon-import'></span> <font face='calibri'><b>IMPORT</b></font>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
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
              <div class="col-md-7">
                <font face='calibri'><b>ID Area</b></font><br/>
                <select class="form-control select2" name="id_area" id="id_area" style="width: 100%;">
                   @foreach ($m_area as $m_area)  
                   <option value="{{ $m_area->id_area }}">{{ $m_area->id_area }}</option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Type Plant</b></font><br/>
                 <select class="form-control select2" name="type_plant" id="type_plant">
                      <option value="UNIT">UNIT</option>
                      <option value="BODY">BODY</option>
                </select>
              </div>
            </div>
            
            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Back Number</b></font><br/>
                <input type="text" class="form-control" name="back_number" id="back_number">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Part Number</b></font><br/>
                <input type="text" class="form-control" name="part_number" id="part_number" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Part Name</b></font><br/>
                <input type="text" class="form-control" name="part_name" id="part_name" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Quantity of Box</b></font><br/>
                  <input type='text' class="form-control" name="qty_box" id="qty_box" >
                </div>
              </div>
            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Unit</b></font><br/>
                <input type="text" class="form-control" name="unit" id="unit" required>
              </div>
              </div>

            <div class="form-group">
              <div class="col-md-8">
                <button type="submit" class="btn btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>SAVE</b></font>
                </button>&nbsp;&nbsp;
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
