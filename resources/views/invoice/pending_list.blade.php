@extends('app')
@section('content')
<div class="container-fluid">
        <div class="box box-primary">
            <div class="box-body">
                <div class="col-md-12">
                    <font face='calibri' color='grey'><b><big><big><big>INVOICE REJECT</big></big></big></b>
                    <br/><b>LIST INVOICE REJECT FROM USER</b>
                    </font>
                	<div class="clearfix">&nbsp;</div>
                        <table class="table table-hover table-bordered table-condensed">
                        <thead>
                            <tr class='success'>
                                <th><small><font face='calibri'>NO PENERIMAAN</font></small></th>
                                <th><small><font face='calibri'>DEPT CODE </font></small></th>
                                <th><small><font face='calibri'>VENDOR</font></small></th>
                                <th><small><font face='calibri'>TGL TERIMA</font></small></th>
                                <th><small><font face='calibri'>DOC NO</font></small></th>
                                <th><small><font face='calibri'>DOC DATE</font></small></th>
                                <th><small><font face='calibri'>DUE DATE</font></small></th>
                                <th><small><font face='calibri'>CURR</font></small></th>
                                <th><small><font face='calibri'>AMOUNT</font></small></th>
                                <th><small><font face='calibri'>DOC NO</font></small></th>
                                <th><small><font face='calibri'>NO PO</font></small></th>
                                <th><small><font face='calibri'>REJECT REASON</font></small></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                    @if (count($invoice) > 0)
                        @foreach ($invoice as $invoice)
                        <?php 
                            date_default_timezone_set('Asia/Jakarta');
                            $date = date('Y-m-d');
                            if ($invoice->due_date < $date) {
                                echo"<tr class='danger'>";
                            } else {
                                echo"<tr class='info'>";
                            }
                            ?>
                            <td><font face='calibri'>{{ $invoice->no_penerimaan }}</font></td>
                            <td><font face='calibri'>
                            @if ($invoice->dept_code == '1')
                                Purchasing
                            @elseif ($invoice->dept_code == '2')
                                General Affair
                            @elseif ($invoice->dept_code == '3')
                                BOD
                            @elseif ($invoice->dept_code == '5')
                                MIS
                            @elseif ($invoice->dept_code == '6')
                                HRD
                            @elseif ($invoice->dept_code == '11')
                                IRL
                            @endif
                            </font></td>
                            <td><font face='calibri'>{{ $invoice->vendor }}</font></td>
                            <td><center><font face='calibri'>{{ $invoice->tgl_terima }}</font></center></td>
                            <td><font face='calibri'>{{ $invoice->doc_no }}</font></td>
                            <td><center><font face='calibri'>{{ $invoice->doc_date }}</font></center></td>
                            <td><center><font face='calibri'>{{ $invoice->due_date }}</font></center></td>
                            <td><font face='calibri'>{{ $invoice->curr }}</font></td>
                            <td><font face='calibri'>{{ number_format($invoice->amount, "2") }}</font></td>
                            <td><font face='calibri'>{{ $invoice->doc_no_2 }}</font></td>
                            <td><font face='calibri'>{{ $invoice->no_po }}</font></td>
                            <td><font face='calibri'><small><b>{{ $invoice->remark }}</b> <br/>{{$invoice->tgl_pending_user}}</small></font></td>
                            <td class='warning'>
                                <center>
                                    <a href="{{ url('invoice/pending/user/checked/'.$invoice->id) }}" class="btn btn-primary btn-xs" onclick="return confirm('Apakah anda yakin akan melakukan check untuk invoice dengan no penerimaan \'{{$invoice->no_penerimaan}}\'?')">
                                        <font face='calibri'><b>Checked</b></font>
                                    </a>
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class='info'>
                            <td colspan="13"><center><font face='calibri'><b>No record to display</b></font></center></td>
                        </tr>
                    @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>

@if (count($invoice) > 0)
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        $('input[type="search"]').removeClass('form-control').removeClass('input-sm');
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