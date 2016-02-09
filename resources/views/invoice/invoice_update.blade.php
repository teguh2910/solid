@extends('app')

@section('content')
<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/invoice/op') }}"><button class='btn btn-info btn-sm btn-flat'><font face='calibri'><b>BACK</b></font></button></a>
            <br/>
          <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered">
                <thead>
                    <tr class='success'>
                        <th><center><small><font face='calibri'>NO PENERIMAAN</font></small></center></th>
                        <th><center><small><font face='calibri'>DEPT CODE </font></small></center></th>
                        <th><center><small><font face='calibri'>VENDOR</font></small></center></th>
                        <th><center><small><font face='calibri'>TGL TERIMA</font></small></center></th>
                        <th><center><small><font face='calibri'>DOC NO</font></small></center></th>
                        <th><center><small><font face='calibri'>DOC DATE</font></small></center></th>
                        <th><center><small><font face='calibri'>DUE DATE</font></small></center></th>
                        <th><center><small><font face='calibri'>CURR</font></small></center></th>
                        <th><center><small><font face='calibri'>AMOUNT</font></small></center></th>
                        <th><center><small><font face='calibri'>DOC NO</font></small></center></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($invoice as $invoice_master)
                <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d');
                    if ($invoice_master->due_date < $date) {
                        echo"<tr class='danger'>";
                    } else {
                        echo"<tr class='info'>";
                    }
                    ?>
                    <td><font face='calibri'>{{ $invoice_master->no_penerimaan }}</font></td>
                    <td><font face='calibri'>
                    @if ($invoice_master->dept_code == '1')
                        Purchasing
                    @elseif ($invoice_master->dept_code == '2')
                        General Affair
                    @elseif ($invoice_master->dept_code == '3')
                        BOD
                    @elseif ($invoice_master->dept_code == '5')
                        MIS
                    @elseif ($invoice_master->dept_code == '6')
                        HRD
                    @endif
                    </font></td>
                    <td><font face='calibri'>{{ $invoice_master->vendor }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice_master->tgl_terima }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice_master->doc_no }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice_master->doc_date }}</font></center></td>
                    <td><center><font face='calibri'>{{ $invoice_master->due_date }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice_master->curr }}</font></td>
                    <td><font face='calibri'>{{ $invoice_master->amount }}</font></td>
                    <td><font face='calibri'>{{ $invoice_master->doc_no_2 }}</font></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
    <div class="col-md-7 col-md-offset-3">
      <div class="panel panel-success">
        <div class="panel-heading"><center><font face='calibri'><b>UPDATE INVOICE</b></font></center></div>
        <div class="panel-info"><div class="panel-heading">
        <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/update/save') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach ($invoice as $invoice)
            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>No Penerimaan</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="no_penerimaan" id="no_penerimaan" value="{{$invoice->no_penerimaan}}" autofocus>
                <input type="hidden" class="form-control" name="id" id="id" value="{{$invoice->id}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Department</b></font></label>
              <div class="col-md-4">
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
                <input type="text" class="form-control" name="vendor" id="vendor" value="{{$invoice->vendor}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Tanggal Terima</b></font></label>
              <div class="col-md-5">
                <div class='input-group date mypicker' id='en_date'>
                  <input type='text' class="form-control" name="tgl_terima" id="tgl_terima" value="{{$invoice->tgl_terima}}" readonly/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>DOC No.</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="doc_no" id="doc_no" value="{{$invoice->doc_no}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>DOC Date</b></font></label>
              <div class="col-md-5">
                <div class='input-group date mypicker' id='en_date'>
                  <input type='text' class="form-control" name="doc_date" id="doc_date" value="{{$invoice->doc_date}}" readonly/>
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
                  <input type='text' class="form-control" name="due_date" id="due_date" value="{{$invoice->due_date}}" readonly/>
                    <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                      </span>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Curr</b></font></label>
              <div class="col-md-3">
                <input type="text" class="form-control" name="curr" id="curr" value="{{$invoice->curr}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>Amount</b></font></label>
              <div class="col-md-7">
                <input type="text" class="form-control" name="amount" id="amount" value="{{$invoice->amount}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'><b>DOC No.</b></font></label>
              <div class="col-md-7">
                <input type="number" class="form-control" name="doc_no_2" id="doc_no_2" value="{{$invoice->doc_no_2}}">
              </div>
            </div>
            @endforeach
            <div class="form-group">
              <div class="col-md-9 col-md-offset-3">
                <button type="submit" class="btn btn-primary btn-flat btn-flat">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>UPDATE</b></font>
                </button>&nbsp;
                <button type="reset" class="btn btn-danger btn-flat btn-flat">
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
