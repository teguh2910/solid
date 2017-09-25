@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-lg-12">
                <big><big><big><font face='calibri' color='grey'><b>STO REPORT</b></font></big></big></big>
                <br/><br/>
                <div class="row">
                <div class="col-md-12">
                    <section id="unseen">
                    <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                        <font face='calibri'><b>IMPORT ENDING</b></font>
                    </button>
                    <br><br>
                    <table class="table table-bordered table-condensed">
                        <thead>
                            <tr bgcolor='#FFFF00'>
                                <th colspan="5"><font face='calibri' color='black'></font></th>
                                <th colspan="2"><font face='calibri' color='black'>STO</font></th>
                                <th colspan="2"><font face='calibri' color='black'>Ending</font></th>
                                <th colspan="2"><font face='calibri' color='black'>Different</font></th>
                                <th><font face='calibri' color='black'></font></th>
                            </tr>
                            <tr bgcolor='#FFFF00'>
                                <th rowspan="2"><font face='calibri' color='black'>Part number</font></th>
                                <th rowspan="2"><font face='calibri' color='black'>Part Name</font></th>
                                <th rowspan="2"><font face='calibri' color='black'>V Class</font></th>
                                <th rowspan="2"><font face='calibri' color='black'>Kind</font></th>
                                <th rowspan="2"><font face='calibri' color='black'>Price</font></th>
                                <th ><font face='calibri' color='black'>Qty</font></th>
                                <th ><font face='calibri' color='black'>Amount</font></th>
                                <th ><font face='calibri' color='black'>Qty</font></th>
                                <th ><font face='calibri' color='black'>Amount</font></th>
                                <th ><font face='calibri' color='black'>Qty</font></th>
                                <th ><font face='calibri' color='black'>Amount</font></th>
                                <th rowspan="2"><font face='calibri' color='black'>Add</font></th>
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
                                <td><font face='calibri'>{{ $t_transaction->part_number }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->part_name }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->v_class }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->kind }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->harga }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->sto_qty }}</font></td> 
                                <td><font face='calibri'>{{ $t_transaction->sto_amount }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->amount_pcs }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->total_pcs }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->total_amount }}</font></td>
                                <td><font face='calibri'>{{ $t_transaction->total_amount }}</font></td>
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
    </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>IMPORT DATA ENDING</b></font></h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
                    <div class="form-group">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div style="position:relative;">
                                <a class='btn btn-primary btn-sm' href='javascript:;'>
                                    <font face='calibri'><b>CHOOSE FILE</b></font>
                                    <input type="file" id="file" name="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;'size="40" onchange='$("#upload-file-info").html($(this).val());' autofocus required>
                                </a>
                                &nbsp;
                                <span class='label label-primary' id="upload-file-info"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 control-label"></label>
                        <div class="col-md-6">
                            <small><font face='calibri'>Extension must be <b>.csv</b></font></small>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <span class='glyphicon glyphicon-import'></span> <font face='calibri'><b>IMPORT</b></font>
                            </button>
                        </div>
                    </div>
                    {!! Form::close() !!}
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

