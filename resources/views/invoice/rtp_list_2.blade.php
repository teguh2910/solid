@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
        <div class="col-md-12">
            <font face='calibri' color="grey">
                <b><big><big>INVOICE READY TO PAY</big></big></b>
            </font>
            <table id="table" class="table table-bordered table-condensed">
                <thead>
                    <tr class='success'>
                        <th><font face='calibri'>NO PENERIMAAN</font></th>
                        @if ($user->role == '4' || $user->role == '3' || $user->role == '2')
                        <th><font face='calibri'>DEPT CODE </font></th>
                        @else
                        @endif
                        <th><font face='calibri'>VENDOR</font></th>
                        <th><font face='calibri'>TGL TERIMA</font></th>
                        <th><font face='calibri'>DOC NO</font></th>
                        <th><font face='calibri'>DOC DATE</font></th>
                        <th><font face='calibri'>DUE DATE</font></th>
                        <th><font face='calibri'>CURR</font></th>
                        <th><font face='calibri'>AMOUNT</font></th>
                        <th><font face='calibri'>DOC NO</font></th>
                        <th><font face='calibri'>NO PO</font></th>
                        <th><font face='calibri'>READY TO PAY</font></th>
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
@if ($user->role == '4' || $user->role == '3' || $user->role == '2')
    <script type="text/javascript">
        $(document).ready(function(){
        var table = $('#table').DataTable({
            "processing": true,
            "autoWidth" : true,
            pageLength:200,
            "searching": true,
            "ordering": true,
            "lengthChange": false,
            processing: true,
            serverSide: true,
            ajax: '{{url("data")}}',
            "createdRow": function( row, data, dataIndex ) {
                $(row).addClass( 'info' );
            },
        });
        
        setInterval( function () {
            table.ajax.reload( null, false );
        }, 5000);
        });
    </script>
@else
    <script type="text/javascript">
        $(document).ready(function(){
        var table = $('#table').DataTable({
            "processing": true,
            "autoWidth" : true,
            pageLength:200,
            "searching": true,
            "ordering": true,
            "lengthChange": false,
            processing: true,
            serverSide: true,
            ajax: '{{url("data_user")}}',
            "createdRow": function( row, data, dataIndex ) {
                $(row).addClass( 'info' );
            },
        });
        
        setInterval( function () {
            table.ajax.reload( null, false );
        }, 5000);
        });
    </script>
@endif
@endsection