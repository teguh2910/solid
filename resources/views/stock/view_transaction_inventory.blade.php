@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-lg-12">
                <big><big><big><font face='calibri' color='grey'><b>DATA TRANSACTION ALL</b></font></big></big></big>
                <br/><br/>
                <font face='calibri'><b>Keterangan :</b></font>&nbsp;&nbsp;<img src = {{ asset ('/img/biru.jpg')}} width='15px'><small><font face='calibri'> Belum di input</font></small>
                &nbsp;&nbsp;&nbsp;&nbsp;<img src = {{ asset ('/img/abu.jpg')}} width='15px'><small><font face='calibri'> Sudah di input</font></small><br/><br/>
                <table class="table table-bordered table-condensed">
                    <thead>
                        <tr bgcolor='#00008B'>
                            <th><font face='calibri' color='white'>Id Area</font></th>
                            <th><font face='calibri' color='white'>Back Number</font></th>
                            <th><font face='calibri' color='white'>Part Number</font></th>
                            <th><font face='calibri' color='white'>Part Name</font></th>
                            <th><font face='calibri' color='white'>Qty / Box</font></th>
                            <th><font face='calibri' color='white'>Unit</font></th>
                            <th><font face='calibri' color='white'>Amount Of Box</font></th>
                            <th><font face='calibri' color='white'>Uncomplete</font></th>  
                            <th><font face='calibri' color='white'>Total (Pcs)</font></th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                    @if (count($t_transaction) > 0)
                        @foreach($t_transaction as $t_transaction)
                            @if ($t_transaction->total_pcs == '0')
                                <tr bgcolor='#ADE8E6'>
                            @else
                                <tr bgcolor='#A9A9A9'>
                            @endif
                            <td><font face='calibri'>{{ $t_transaction->id_area }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->back_number }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->part_number }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->part_name }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->qty_box }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->unit }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->amount_box }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->amount_pcs }}</font></td>
                            <td><font face='calibri'>{{ $t_transaction->total_pcs }}</font></td>
                            <td class='warning'>
                                <center>
                                    <a href="{{ url('stock/input_transaction/inventory/'.$t_transaction->id_transaksi) }}" 
                                        class="btn btn-primary btn-xs" target="blank">
                                        <i class="glyphicon glyphicon-plus"></i>
                                    </a>            
                                </center>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    @else
                        <tr bgcolor='#FFFFFF'>
                            <td colspan="9">
                                <center>
                                    <font face='calibri'>No record to display</font>
                                </center>
                            </td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
</div>
@if (count($t_transaction) > 0)
<script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script>
<script>
    $(document).ready(function(){
        $('.dataTables_filter').addClass('pull-right');
        $('.pagination').addClass('pull-right');
    });

    $('table').dataTable({
        "searching": true,
        pageLength:20
    });
</script>
@endif
@endsection

