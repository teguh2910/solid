@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
        <div class="col-md-12">
            <font face='calibri' color="grey"><b><big><big><big>VIEW DETAIL
            </big></big></big></b></font>
            <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered table-condensed">
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
                        <th><small><font face='calibri'>LAST STATUS</font></small></th>
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
                    @elseif ($invoice_master->dept_code == '11')
                        IRL
                    @endif
                    </font></td>
                    <td><font face='calibri'>{{ $invoice_master->vendor }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice_master->tgl_terima }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice_master->doc_no }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice_master->doc_date }}</font></center></td>
                    <td><center><font face='calibri'>{{ $invoice_master->due_date }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice_master->curr }}</font></td>
                    <td><font face='calibri'>{{ number_format((float)$invoice_master->amount) }}</font></td>  <!-- hotfix-3.0.7, by yudo, 20170508, number format -->
                    <td><font face='calibri'>{{ $invoice_master->doc_no_2 }}</font></td>
                    <td><font face='calibri'>{{ $invoice_master->no_po }}</font></td>
                    <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d');
                    if ($invoice_master->due_date < $date) {
                        echo"<td bgcolor='red'>";
                    } else {
                        echo"<td class='warning'>";
                    }
                    ?>
                    <font face='calibri'>
                    @if ($invoice_master->status=="1")
                        <b>Waiting Approval User</b>
                    @elseif ($invoice_master->status=="2")
                        <b>Checked by User</b>
                    @elseif ($invoice_master->status=="3")
                        <b>Approved by Accounting</b>
                    @elseif ($invoice_master->status=="4")
                        <b>Checked by Finance</b>
                    @elseif ($invoice_master->status=="5")
                        <b>Rejected by User</b>
                    @elseif ($invoice_master->status=="6")
                        <b>Rejected by Accounting</b>
                    @elseif ($invoice_master->status=="7")
                        <b>Rejected by Finance</b>
                    @elseif ($invoice_master->status=="8")
                        <b>Ready To Pay</b>
                    @endif
                    </font></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7 col-md-offset-3">
            <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered table-condensed">
                    <tr class='success'>
                        <th><small><font face='calibri'><center>STATUS</center></font></small></th>
                        <th><small><font face='calibri'><center>DATE</center></font></small></th>
                    </tr>
                <tbody>
                @foreach ($history as $history)
                   <tr>
                        <td class="info"><font face="calibri">{{ $history->name_status }}</font></td>
                        <td class="info"><font face="calibri"><center>{{ $history->tanggal }}</center></font></td>    
                   </tr>
                @endforeach
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
@endsection