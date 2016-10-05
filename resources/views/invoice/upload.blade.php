@extends('app')

@section('content')
<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
<div class="container-fluid">
    <div class="box box-success">
      <div class="box-body">
        <div class="col-md-5">
            <font face='calibri' color="grey"><b><big><big><big>INPUT INVOICE</big></big></big></b></font><br/><br/>
            <div class="panel panel-success">
            <div class="panel-heading"><font face='calibri'><b>IMPORT DATA</b></font></div>
            <div class="panel-info"><div class="panel-heading">
            <div class="panel-body">
            {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
            <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div style="position:relative;">
                            <a class='btn btn-success btn-sm' href='javascript:;'>
                                <i class='glyphicon glyphicon-file'></i>&nbsp;
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
                <small><font face='calibri'>Extension file harus <b>.csv</b>, didalam file <b>tidak boleh</b> ada karakter <b>koma ( , )</b>, koma diganti menjadi <b>titik ( . )</b></font></small>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4">
                <button type="submit" class="btn btn-primary btn-sm">
                  <span class='glyphicon glyphicon-import'></span>&nbsp;<font face='calibri'><b>IMPORT</b></font>
                </button>
              </div>
            </div>
            {!! Form::close() !!}
            </div></div>
            </div>
            </div>
        </div>

    <div class="col-md-7">
      <div class="panel panel-success">
        <div class="panel-heading"><big><big><font face='calibri'><b>MANUAL INPUT</b></font></big></big></div>
        <div class="panel-info"><div class="panel-heading">
        <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/saving') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>No Penerimaan</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="no_penerimaan" id="no_penerimaan" autofocus required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Department</b></font></label>
              <div class="col-md-4">
               <select class="form-control" name="dept_code" id="dept_code">
                      <option value="1">Purchasing & Exim</option>
                      <option value="2">General Affair</option>
                      <option value="3">BOD</option>
                      <option value="6">HR</option>
                      <option value="5">IT Development</option>
                      <option value="11">IRL</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Vendor</b></font></label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="vendor" id="vendor" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Tanggal Terima</b></font></label>
              <div class="col-md-4">
                <div class='input-group date mypicker' id='en_date'>
                  <input type='text' class="form-control" name="tgl_terima" id="tgl_terima" readonly/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>DOC No.</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="doc_no" id="doc_no" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>DOC Date</b></font></label>
              <div class="col-md-4">
                <div class='input-group date mypicker' id='en_date'>
                  <input type='text' class="form-control" name="doc_date" id="doc_date"  readonly/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Due Date</b></font></label>
              <div class="col-md-4">
                <div class='input-group date mypicker' id='en_date'>
                  <input type='text' class="form-control" name="due_date" id="due_date"  readonly/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Curr</b></font></label>
              <div class="col-md-3">
                <input type="text" class="form-control" name="curr" id="curr" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Amount</b></font></label>
              <div class="col-md-7">
                <input type="number" class="form-control" name="amount" id="amount" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>DOC No.</b></font></label>
              <div class="col-md-7">
                <input type="number" class="form-control" name="doc_no_2" id="doc_no_2">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Nomor PO</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="no_po" id="no_po">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-sm btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;<font face='calibri'><b>SUBMIT</b></font>
                </button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-sm btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span>&nbsp;<font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>
          </form>
        </div>
        </div></div>
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
