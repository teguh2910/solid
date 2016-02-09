@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ url('/invoice/op') }}"><button class='btn btn-info btn-flat btn-sm'><font face='calibri'><b>BACK</b></font></button></a>
            <br/>
            <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered">
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
                        <th><center><small><font face='calibri'>STATUS</font></small></center></th>
                    </tr>
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
                    <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d');
                    if ($invoice_master->due_date < $date) {
                        echo"<td bgcolor='red'>";
                    } else {
                        echo"<td class='warning'>";
                    }
                    ?>
                    <font face='calibri'><center>
                    @if ($invoice_master->status=="1")
                        <b>Waiting User</b>
                    @elseif ($invoice_master->status=="2")
                        <b>Checked User</b>
                    @elseif ($invoice_master->status=="3")
                        <b>Approve Accounting</b>
                    @elseif ($invoice_master->status=="4")
                        <b>Checked Finance</b>
                    @elseif ($invoice_master->status=="5")
                        <b>Reject User</b>
                    @elseif ($invoice_master->status=="6")
                        <b>Reject Accounting</b>
                    @elseif ($invoice_master->status=="7")
                        <b>Reject Finance</b>
                    @endif
                    </center></font></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered">
                    <tr class='success'>
                        <th><center><small><font face='calibri'>STATUS</font></small></center></th>
                        <th><center><small><font face='calibri'>DATE</font></small></center></th>
                    </tr>
                <tbody>
                @foreach ($invoice as $invoice)
                    <tr class='info'>
                        <td><font face='calibri'>Waiting User</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_input }}</center></font></td>
                    </tr>
                    @if ($invoice->status=="2")
                    <tr class='info'>
                        <td><font face='calibri'>Checked User</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_user }}</center></font></td>
                    </tr>
                    @endif
                    @if ($invoice->status=="3")
                    <tr class='info'>
                        <td><font face='calibri'>Checked User</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_user }}</center></font></td>
                    </tr>
                    <tr class='info'>
                        <td><font face='calibri'>Approve Accounting</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_act }}</center></font></td>
                    </tr>
                    @endif
                    @if ($invoice->status=="4")
                    <tr class='info'>
                        <td><font face='calibri'>Checked User</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_user }}</center></font></td>
                    </tr>
                    <tr class='info'>
                        <td><font face='calibri'>Approve Accounting</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_act }}</center></font></td>
                    </tr>
                    <tr class='info'>
                        <td><font face='calibri'>Checked Finance</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_finance }}</center></font></td>
                    </tr>
                    @endif
                    @if ($invoice->status=="5")
                    <tr class='info'>
                        <td><font face='calibri'>Reject User</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_pending_user }}</center></font></td>
                    </tr>
                    @endif
                    @if ($invoice->status=="6")
                    <tr class='info'>
                        <td><font face='calibri'>Checked User</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_user }}</center></font></td>
                    </tr>
                    <tr class='info'>
                        <td><font face='calibri'>Reject Accounting</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_pending_act }}</center></font></td>
                    </tr>
                    @endif
                    @if ($invoice->status=="7")
                    <tr class='info'>
                        <td><font face='calibri'>Checked User</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_user }}</center></font></td>
                    </tr>
                    <tr class='info'>
                        <td><font face='calibri'>Approve Accounting</font></td>
                        <td><font face='calibri'><center>{{ $invoice->tgl_terima_act }}</center></font></td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
                </table>
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