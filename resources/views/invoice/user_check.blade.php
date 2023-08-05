@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @if (Auth::guest())
                    @elseif (Auth::user()->role == "8")
                    <!-- < 8 = renni> -->
                    <li>
                        <a href="{{ url('/invoice/user/newlist') }}">
                            <font face='calibri' color='grey'><b>LIST INVOICE CASHIER
                            <span class='badge badge-info'>@foreach ($result4 as $result4) {{ $result4->d }} @endforeach</span></b></font>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('invoice/user/list') }}">
                            <font face='calibri' color='grey'><b>INVOICE LIST PUD
                            <span class='badge badge-info'>@foreach ($result as $result) {{ $result->a }} @endforeach</span></b></font>
                        </a>
                    </li>
                    @elseif (Auth::user()->role == "1")
                    <li>
                        <a href="{{ url('/invoice/user/list') }}">
                            <font face='calibri' color='grey'><b>LIST INVOICE
                            <span class='badge badge-info'>@foreach ($result as $result) {{ $result->a }} @endforeach</span></b></font>
                        </a>
                    </li>
                    @endif
                    <li class="active">
                        <a href="{{ url('/invoice/user/check') }}">
                            <big><big><big><font face='calibri' color='grey'><b>INVOICE CHECKED
                            <span class='badge badge-info'>@foreach ($result3 as $result3) {{ $result3->c }} @endforeach</span></b></font></big></big></big>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('invoice/user/reject/list') }}">
                            <font face='calibri' color='grey'><b>INVOICE REJECT
                            <span class='badge badge-info'>@foreach ($result2 as $result2) {{ $result2->b }} @endforeach</span></b></font>
                        </a>
                    </li>
                    
                </ul>
                <div class="tab-content">
                <font face='calibri' color='grey'>
                    <b>LIST INVOICE CHECK BY USER</b>
                </font>
        	<div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <tr class='success'>
                        <th><small><font face='calibri'>NO PENERIMAAN</font></small></th>
                        <th><small><font face='calibri'>DEPARTMENT</font></small></th>
                        <th><small><font face='calibri'>VENDOR</font></small></th>
                        <th><small><font face='calibri'>TGL TERIMA</font></small></th>
                        <th><small><font face='calibri'>DOC NO</font></small></th>
                        <th><small><font face='calibri'>DOC DATE</font></small></th>
                        <th><small><font face='calibri'>DUE DATE</font></small></th>
                        <th><small><font face='calibri'>CURR</font></small></th>
                        <th><small><font face='calibri'>AMOUNT</font></small></th>
                        <!-- <th><small><font face='calibri'>DOC NO</font></small></th> -->
                        <th><small><font face='calibri'>NO PO</font></small></th>
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
                    <td><font face='calibri'>{{ number_format((float)$invoice->amount) }}</font></td>
                    <!-- <td><font face='calibri'>{{ $invoice->doc_no_2 }}</font></td> -->
                    <td><font face='calibri'>{{ $invoice->no_po }}</font></td>
                </tr>
                @endforeach
            @else
                <tr class='warning'>
                    <td colspan="11"><center><font face='calibri'><b>No record to display</b></font></center></td>
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
@endsection