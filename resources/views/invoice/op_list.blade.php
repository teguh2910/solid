@extends('app')
@section('content')
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <font face='calibri'><b><big><big><big>INVOICE ON PROGRESS</big></big></big></b></font>
        	<div class="clearfix">&nbsp;</div>
                <table class="table table-striped table-bordered">
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
                        <th><center><small><font face='calibri'>STATUS</font></small></center></th>
                        @if (Auth::user()->role == "4")
                        <th></th>
                        @else
                        @endif
                        
                    </tr>
                </thead>
                <tbody>
            @if (count($invoice) > 0)
                @foreach ($invoice as $invoice)
                <tr>
                    <td bgcolor='#FFFFFF'><font face='calibri'>
                        {{ $invoice->no_penerimaan }}
                    </font></td>
                    <td bgcolor='#FFFFFF'><center><font face='calibri'>
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
                    @endif
                    </font></center></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->vendor }}</font></td>
                    <td bgcolor='#FFFFFF'><center><font face='calibri'>{{ $invoice->tgl_terima }}</font></center></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->doc_no }}</font></td>
                    <td bgcolor='#FFFFFF'><center><font face='calibri'>{{ $invoice->doc_date }}</font></center></td>
                    <td bgcolor='#FFFFFF'><center><font face='calibri'>{{ $invoice->due_date }}</font></center></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->curr }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->amount }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->doc_no_2 }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>
                    @if ($invoice->status=="1")
                        Waiting User
                        <br/>( {{$invoice->tgl_input}} )
                    @elseif ($invoice->status=="2")
                        Approve User
                        <br/>( {{$invoice->tgl_terima_user}} )
                    @elseif ($invoice->status=="3")
                        Approve Accounting
                        <br/>( {{$invoice->tgl_terima_act}} )
                    @elseif ($invoice->status=="4")
                        Ready To Pay
                        <br/>( {{$invoice->tgl_terima_finance}} )
                    @elseif ($invoice->status=="5")
                        Reject User
                        <br/>( {{$invoice->tgl_pending_user}} )
                    @elseif ($invoice->status=="6")
                        Reject Accounting
                        <br/>( {{$invoice->tgl_pending_act}} )
                    @elseif ($invoice->status=="7")
                        Reject Finance
                    @endif
                    </font></td>
                     @if (Auth::user()->role == "4")
                        <td><center><a href="{{ url('invoice/delete/'.$invoice->id) }}" class="btn btn-danger btn-xs"
                            onclick="return confirm('Are you sure to delete this invoice?')">
                                <i class="glyphicon glyphicon-trash"></i>
                        </a></center></td>
                    @else
                    @endif
                </tr>
                @endforeach
            @else
                <tr bgcolor='#FFFFFF'>
                    @if (Auth::user()->role == "4")
                    <td colspan="12"><center><font face='calibri'>No record to display</font></center></td>
                    @else
                    <td colspan="11"><center><font face='calibri'>No record to display</font></center></td>
                    @endif
                </tr>
            @endif
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