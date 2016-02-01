@extends('app')

@section('content')
<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-5">
            <div class="panel panel-warning">
            <div class="panel-heading"><center><font face='calibri'><b>IMPORT DATA</b></font></center></div>
            <div class="panel-success"><div class="panel-heading">
            <div class="panel-body">
            {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
            <div class="form-group">
                <div class="col-md-4"></div>
                <div class="col-md-4">
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
            </div></div>
            </div>
            </div>
        </div>

    <div class="col-md-7">
      <div class="panel panel-warning">
        <div class="panel-heading"><center><font face='calibri'><b>MANUAL INPUT</b></font></center></div>
        <div class="panel-success"><div class="panel-heading">
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
              <div class="col-md-7">
               <select class="form-control" name="dept_code" id="dept_code">
                      <option value="1">Purchasing</option>
                      <option value="2">General Affair</option>
                      <option value="3">BOD</option>
                      <option value="5">MIS</option>
                      <option value="6">HRD</option>
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
              <div class="col-md-5">
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
              <div class="col-md-5">
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
              <div class="col-md-5">
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
              <div class="col-md-5">
                <input type="text" class="form-control" name="curr" id="curr" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Amount</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="amount" id="amount" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>DOC No.</b></font></label>
              <div class="col-md-7">
                <input type="number" class="form-control" name="doc_no_2" id="doc_no_2">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>SUBMIT</b></font>
                </button>
                <button type="reset" class="btn btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span> <font face='calibri'><b>RESET</b></font>
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
