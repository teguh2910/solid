@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
        <div class="col-md-12">
            <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered table-condensed">
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
                        <th><center><small><font face='calibri'>NO PO</font></small></center></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($invoice as $invoice)
                <tr CLASS='info'>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->no_penerimaan }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>
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
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->vendor }}</font></td>
                    <td bgcolor='#FFFFFF'><center><font face='calibri'>{{ $invoice->tgl_terima }}</font></center></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->doc_no }}</font></td>
                    <td bgcolor='#FFFFFF'><center><font face='calibri'>{{ $invoice->doc_date }}</font></center></td>
                    <td bgcolor='#FFFFFF'><center><font face='calibri'>{{ $invoice->due_date }}</font></center></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->curr }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ (float)number_format($invoice->amount) }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->doc_no_2 }}</font></td>
                    <td bgcolor='#FFFFFF'><font face='calibri'>{{ $invoice->no_po }}</font></td>
                </tr>
                </tbody>
            </table>
        </div>
    <div class="col-md-6 col-md-offset-3">
    <div class="panel-body">
        <div class="panel panel-default">
            <div class="panel-success"><div class="panel-heading">
            <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/pending/user1/save') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <br/><div class="form-group" id="gr-pending">
                    <label class="col-md-3 control-label"><font face='calibri'><b>Reject Reason</b></font></label>
                    <div class="col-md-8">
                        <textarea name='remark' class="form-control" id='remark' autofocus required></textarea>
                        <input type='hidden' name='id' value='{{ $invoice->id }}'>
                        @endforeach
                    </div>
                </div>
                <div class="form-group" id="gr-button">
                    <div class="col-md-8 col-md-offset-3">
                        <button type="submit" class="btn btn-primary btn-sm"><span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>SUBMIT</b></font></button>&nbsp;&nbsp;
                        <button type="reset" id="gr-reset" class="btn btn-danger btn-sm"><span class='glyphicon glyphicon-repeat'></span> <font face='calibri'><b>RESET</b></font></button>
                    </div>
                </div>
            </form>
        </div>
        </div></div>
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