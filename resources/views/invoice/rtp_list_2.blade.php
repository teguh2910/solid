@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
        <div class="col-md-12">
            <font face='calibri' color="grey"><b><big><big><big>INVOICE READY TO PAY 
            </big></big></big></b></font>
        	<div class="clearfix">&nbsp;</div>
                <table id="table" class="table table-hover table-bordered table-condensed">
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
                        <th><small><font face='calibri'>READY TO PAY</font></small></th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    </div>
</div>

<script src="{{asset('/js/jquery-3.1.1.min.js')}}"></script>
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function(){
    var table = $('#table').DataTable({
        pageLength:18,
        "searching": true,
        "ordering": false,
        "searching": false,
        "lengthChange": false,
        processing: true,
        serverSide: true,
        ajax: '{{url("data")}}',
        // drawCallback: function() {
        //     processInfo(this.api().page.info());
        // }
    });
    
    setInterval( function () {
        table.ajax.reload( null, false );
    }, 5000);
    });
</script>
@endsection