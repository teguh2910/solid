@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    @if (Auth::guest())
                    @else
                    <!-- < 8 = renni> -->
                    <li>
                        <a href="{{ url('/invoice/fin/list') }}">
                        <font face='calibri' color='grey'>
                        <b>LIST INVOICE ACC&TAX
                        <span class='badge badge-info'></span></b></font>
                        </a>
                    </li>
                    <li> 
                        <a href="{{ url('/invoice/receive/fin') }}">
                            <font face='calibri' color='grey'>
                            <b>INVOICE RECEIVE
                            <span class='badge badge-info'></span></b></font>
                            
                        </a>
                    </li>                                        
                    <li>
                        <a href="{{ url('/invoice/send/fin') }}">
                        <font face='calibri' color='grey'><b>INVOICE PAYMENT
                                <span class='badge badge-info'></span></b></font>
                       
                        </a>
                    </li>
                    <li class="active">
                        <a href="{{ url('invoice/reject/fin') }}">
                        <big><big><big><font face='calibri' color='grey'><b>INVOICE REJECT
                                <span class='badge badge-info'></span></b></font>
                        </big></big></big>
                        </a>
                    </li>
                    @endif

                </ul>
                <div class="tab-content">
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
                            @endif
                            </font></td>
                            <td><font face='calibri'>{{ $invoice->vendor }}</font></td>
                            <td><center><font face='calibri'>{{ $invoice->tgl_terima }}</font></center></td>
                            <td><font face='calibri'>{{ $invoice->doc_no }}</font></td>
                            <td><center><font face='calibri'>{{ $invoice->doc_date }}</font></center></td>
                            <td><center><font face='calibri'>{{ $invoice->due_date }}</font></center></td>
                            <td><font face='calibri'>{{ $invoice->curr }}</font></td>
                            <td><font face='calibri'>{{ number_format((float)$invoice->amount) }}</font></td>
                            <td><font face='calibri'>{{ $invoice->no_po }}</font></td>
                            
                        </tr>
                        @endforeach
                    @else
                        <tr class='warning'>
                            <td colspan="12"><center><font face='calibri'><b>No record to display</b></font></center></td>
                        </tr>
                    @endif
                        </tbody>
                    </table>
                </div>
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
        "searching": true,
        //hotfix-2.0.4, by Yudo Maryanto, Mengubah paging menjadi 100
        "iDisplayLength": 100
    });
</script>
@endif
@endsection