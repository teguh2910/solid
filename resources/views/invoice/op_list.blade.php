@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <font face='calibri' color="grey"><b><big><big><big><span class='label label-info'>INVOICE ON PROGRESS <span class='badge badge-success'>@foreach ($result as $result) {{$result->a}} @endforeach</span></span></big></big></big></b></font>
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
                <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d');
                    if ($invoice->due_date < $date) {
                        echo"<tr class='danger'>";
                    } else {
                        echo"<tr class='info'>";
                    }
                    ?>
                    <td><font face='calibri'>
                        {{ $invoice->no_penerimaan }}
                    </font></td>
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
                    @endif
                    </font></td>
                    <td><font face='calibri'>{{ $invoice->vendor }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice->tgl_terima }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice->doc_no }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice->doc_date }}</font></center></td>
                    <td><center><font face='calibri'>{{ $invoice->due_date }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice->curr }}</font></td>
                    <td><font face='calibri'>{{ $invoice->amount }}</font></td>
                    <td><font face='calibri'>{{ $invoice->doc_no_2 }}</font></td>
                    <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d');
                    if ($invoice->due_date < $date) {
                        echo"<td bgcolor='red'>";
                    } else {
                        echo"<td class='warning'>";
                    }
                    ?>
                    <a href="{{ url('invoice/approval/detail/'.$invoice->id) }}">
                    <font face='calibri'><center>
                    @if ($invoice->status=="1")
                        <b>Waiting User</b>
                        <br/><small>{{$invoice->tgl_input}}</small>
                    @elseif ($invoice->status=="2")
                        <b>Checked User</b>
                        <br/><small>{{$invoice->tgl_terima_user}}</small>
                    @elseif ($invoice->status=="3")
                        <b>Approve Accounting</b>
                        <br/><small>{{$invoice->tgl_terima_act}}</small>
                    @elseif ($invoice->status=="4")
                        <b>Checked Finance</b>
                        <br/><small>{{$invoice->tgl_terima_finance}}</small>
                    @elseif ($invoice->status=="5")
                        <b>Reject User</b>
                        <br/><small>{{$invoice->tgl_pending_user}}</small>
                    @elseif ($invoice->status=="6")
                        <b>Reject Accounting</b>
                        <br/><small>{{$invoice->tgl_pending_act}}</small>
                    @elseif ($invoice->status=="7")
                        <b>Reject Finance</b>
                    @endif
                    </center></font></a></td>
                     @if (Auth::user()->role == "4")
                        <td class='warning'>
                            <center>
                                <a href="{{ url('invoice/update/'.$invoice->id) }}" class="btn btn-info btn-flat btn-xs">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a> 
                                <a href="{{ url('invoice/delete/'.$invoice->id) }}" class="btn btn-danger btn-flat btn-xs"
                                onclick="return confirm('Are you sure to delete invoice with no penerimaan \'{{$invoice->no_penerimaan}}\' ?')">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </a>
                            </center>
                        </td>
                    @else
                    @endif
                </tr>
                @endforeach
            @else
                <tr class='info'>
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