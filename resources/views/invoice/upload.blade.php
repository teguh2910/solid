@extends('app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-success">
                <div class="panel-heading"><center><font face='calibri'>IMPORT DATA</font></center></div>
                <div class="panel-body">
            
            {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
            <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <!-- <input id="file" type="file" name="file" class="btn btn-file"></input> -->
                    <div style="position:relative;">
                            <a class='btn btn-info btn-sm' href='javascript:;'>
                                <font face='calibri'><b>CHOOSE FILE</b></font>
                                <input type="file" id="file" name="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());' required >
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
@endsection
