@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
    <big><big><big><font face='calibri' color='grey'><b>DATA AREA</b></font></big></big></big>
    <div class="row">
        <div class="col-md-12">
            <div class="clearfix">&nbsp;</div>
            <section id="unseen">
           <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                <font face='calibri'><b>CREATE AREA</b></font>
            </button>
               &nbsp;&nbsp;
            <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal2">
                <font face='calibri'><b>IMPORT AREA</b></font>
            </button>
            <br/><br/>
            <table  class="table table-condensed table-bordered">
                <thead>
                    <tr bgcolor='#00008B'>
                        <th><font face='calibri' color='white'>ID Area</font></th>
                        <th><font face='calibri' color='white'>Plant Type</font></th>
                        <th><font face='calibri' color='white'>Area Code</font></th>
                        <th><font face='calibri' color='white'>Area Name</font></th>
                        <th><font face='calibri' color='white'>PIC</font></th>
                        <th><font face='calibri' color='white'>Contact</font></th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($m_area) > 0)
                    @foreach ($m_area as $m_area)
                    <tr bgcolor='#ADE8E6'>
                        <td><font face='calibri'>{{ $m_area->id_area }}</font></td>
                        <td><font face='calibri'>{{ $m_area->type_plant }}</font></td>
                        <td><font face='calibri'>{{ $m_area->code_area }}</font></td>
                        <td><font face='calibri'>{{ $m_area->name_area }}</font></td>
                        <td><font face='calibri'>{{ $m_area->pic_name }}</font></td>
                        <td><font face='calibri'>{{ $m_area->pic_contact }}</font></td>
                        <td><center>
                            <a href="{{ url('stock/edit_area/'.$m_area->id) }}" class="btn btn-primary btn-xs" target="/blank">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </a>
                            &nbsp;
                            <a href="{{ url('stock/delete_area/'.$m_area->id) }}" class="btn btn-danger btn-xs"  
                                onclick="return confirm('Apakah anda yakin akan menghapus area \'{{$m_area->name_area}}\'?')">
                                <i class="glyphicon glyphicon-trash"></i>
                            </a>
                        </center>
                        </td>
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
   <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>IMPORT DATA AREA</b></font></h4>
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
                                <span class='label label-info' id="upload-file-info"></span>
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
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE AREA</b></font></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/stock/save_area') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
             
    
           

            <div class="form-group">
              <div class="col-md-7">
                <font face='calibri'><b>Plant</b></font><br/>
               <select class="form-control select2" name="type_plant" id="type_plant">
                      <option value="UNIT">UNIT</option>
                      <option value="BODY">BODY</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-4">
                <font face='calibri'><b>Code Area</b></font><br/>
                <input type="text" class="form-control" name="code_area" id="code_area" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                    <font face='calibri'><b>Area Name</b></font><br/>
                  <input type='text' class="form-control" name="name_area" id="name_area" placeholder="use underscore for space, exp : PPIC_UNIT"required>
                </div>
              </div>
           

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>PIC</b></font><br/>
                <input type="text" class="form-control" name="pic_name" id="pic_name" required>
              </div>
              </div>
            

            <div class="form-group">
              <div class="col-md-7">
                    <font face='calibri'><b>Contact</b></font><br/>
                  <input type='text' class="form-control" name="pic_contact" id="pic_contact"  required>
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
</div>
</div>
@if (count($m_area) > 0)
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
@endsection
