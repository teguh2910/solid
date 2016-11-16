@extends('app')

@section('content')
<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
<div class="container-fluid">
  <div class="col-md-7">
    <div class="box box-info">
      <div class="box-body">
        <div class="col-md-6">
            <div class="panel panel-success">
              <div class="panel-heading">
                <font face='calibri'>IMPORT&nbsp;&nbsp;<big><big><b>DATA VENDOR</b></big></big></font>
              </div>
              <div class="panel-info">
                <div class="panel-heading">
                  <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('import/vendor') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="col-md-4">
                        <input type="file" id="file" name="file" required>
                      </div>
                      <div class="col-md-12">
                        <small>
                          <font face='calibri'>Extension file harus <b>.csv</b>, didalam file <b>tidak boleh</b> ada karakter <b>koma ( , )</b>, koma diganti menjadi <b>titik ( . )</b></font>
                        </small>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-sm">
                          <span class='glyphicon glyphicon-import'></span>&nbsp;&nbsp;
                          <font face='calibri'><b>IMPORT</b></font>
                        </button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <div class="col-md-6">
          <div class="panel panel-success">
            <div class="panel-heading">
              <font face='calibri'>IMPORT&nbsp;&nbsp;<big><big><b>DATA INVOICE</b></big></big></font>
            </div>
            <div class="panel-info">
              <div class="panel-heading">
                <div class="panel-body">
                  {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
                  <div class="form-group">
                    <div class="col-md-4">
                      <div style="position:relative;">
                        <a class='btn btn-success btn-xs btn-flat' href='javascript:;'>
                          <i class='glyphicon glyphicon-file'></i>&nbsp;
                          <font face='calibri'><b>CHOOSE FILE</b></font>
                          <input type="file" id="file" name="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());' required >
                        </a>
                        &nbsp;
                        <span class='label label-info' id="upload-file-info"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <small><font face='calibri'>Extension file harus <b>.csv</b>, didalam file <b>tidak boleh</b> ada karakter <b>koma ( , )</b>, koma diganti menjadi <b>titik ( . )</b></font></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-sm">
                        <span class='glyphicon glyphicon-import'></span>&nbsp;&nbsp;
                        <font face='calibri'><b>IMPORT</b></font>
                      </button>
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="col-md-5">
        <div class="box box-warning">
          <div class="box-body">
          <div class="col-md-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <font face='calibri'>MANUAL INPUT&nbsp;&nbsp;<big><big><b>DATA INVOICE</b></big></big></font>
              </div>
              <div class="panel-info">
                <div class="panel-heading">
                  <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/saving') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-12">
                          <font face='calibri'><b>NO PENERIMAAN</b></font>
                          <input type="text" class="form-control" name="no_penerimaan" id="no_penerimaan" value='{{$nomor}}' autofocus required disabled>
                        </div>
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DEPARTMENT</b></font>
                          <select class="form-control select2" name="dept_code" id="dept_code" style="width: 100%;">
                            <option value="1">Purchasing & Exim</option>
                            <option value="2">General Affair</option>
                            <option value="3">BOD</option>
                            <option value="6">HR</option>
                            <option value="5">IT Development</option>
                            <option value="11">IRL</option>
                          </select>
                        </div>
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-12">
                          <font face='calibri'><b>VENDOR</b></font>
                          <select class="form-control select2" name="shipping_qty" id="code_ng_list" style="width: 100%;" required>
                            @foreach ($bank_datas as $k => $v)
                            <option value="{{ $v->id }}">{{ $v->vendor_name }}</option>
                            @endforeach
                          </select>    
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>TANGGAL TERIMA</b></font>
                          <div class='input-group date mypicker' id='en_date'>
                            <input type='text' class="form-control" name="tgl_terima" id="tgl_terima" readonly/>
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DOC NO</b></font>
                          <input type="text" class="form-control" name="doc_no" id="doc_no" required>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DOC DATE</b></font>
                          <div class='input-group date mypicker' id='en_date'>
                            <input type='text' class="form-control" name="doc_date" id="doc_date"  readonly/>
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DUE DATE</b></font>
                          <div class='input-group date mypicker' id='en_date'>
                            <input type='text' class="form-control" name="due_date" id="due_date"  readonly/>
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>CURR</b></font>
                          <input type="text" class="form-control" name="curr" id="curr" required>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>AMOUNT</b></font>
                          <input type="number" class="form-control" name="amount" id="amount" required>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DOC NO</b></font>
                          <input type="number" class="form-control" name="doc_no_2" id="doc_no_2">
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>PO NUMBER</b></font>
                          <input type="text" class="form-control" name="no_po" id="no_po">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-9">
                          <button type="submit" class="btn btn-sm btn-primary">
                            <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;
                            <font face='calibri'><b>SUBMIT</b></font>
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
        </div>
      </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    $('.mypicker').datepicker({
      format: "yyyy-m-d",
      autoclose: true,
      orientation: 'top auto',
    });
  });
</script>
@endsection
