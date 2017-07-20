@extends('app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body">
                    <font face='calibri' color="grey"><b><big><big><big>VENDOR PAYMENT</big></big></big></b></font><br/><br/>
                    <button class='btn btn-primary btn-sm' data-toggle="modal" data-target="#myModal">
                        <font face='calibri'><b>CREATE PAYMENT</b></font>
                    </button>
                    <br/>
                	<div class="clearfix">&nbsp;</div>
                        <table class="table table-bordered table-condensed">
                        <thead>
                            <tr bgcolor='#00008B'>
                                <th><font face='calibri' color='white'>Vendor Code</font></th>
                                <th><font face='calibri' color='white'>Bank Code</font></th>
                                 <th><font face='calibri' color='white'>Part Bank</font></th>
                                <th><font face='calibri' color='white'>Account Number</font></th>
                                 <th><font face='calibri' color='white'>Account Name</font></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($m_payment as $view)
                        <tr class='info'>
                            <td><font face='calibri'>{{ $view->code_vendor }}</font></td>
                            <td><font face='calibri'>{{ $view->code_bank }}</font></td>
                            <td><font face='calibri'>{{ $view->part_bank }}</font></td>
                            <td><font face='calibri'>{{ $view->account_no }}</font></td>
                            <td><font face='calibri'>{{ $view->account_name}}</font></td>
                            <!-- @if ($view->country == 'ID')
                                Indonesia
                            @elseif ($view->country == 'JP')
                                Japan
                            @elseif ($view->country == 'US')
                                America
                            @elseif ($view->country == 'CN')
                                China
                            @elseif ($view->country == 'SG')
                                Singapura  
                            @elseif ($view->country == 'TH')
                                Thailand
                            @elseif ($view->country == 'TW')
                                Taiwan       
                            @endif -->
                            </font></td>
                            <td class='warning'><center>
                                <a href="{{ url('payment/edit_payment/'.$view->id) }}" class="btn btn-primary btn-xs">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                </a>&nbsp;
                                <a href="{{ url('payment/delete/'.$view->id) }}" class="btn btn-danger btn-xs"
                                    onclick="return confirm('Are you sure to delete vendor name \'{{$view->vendor_name}}\' ?')">
                                        <i class="glyphicon glyphicon-trash"></i>
                                </a></center>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><font face='calibri'><b>CREATE PAYMENT</b></font></h4>
                </div>
                <div class="modal-body">
    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/payment/save_payment') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Vendor Code</b></font><br/>
                <input type="text" class="form-control" name="code_vendor" id="code_vendor" autofocus required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-4">
                <font face='calibri'><b>Bank Code</b></font><br/>
                <select class="form-control select2" name="code_bank" id="code_bank" style="width: 100%;" required>
                    <option value=''>--Choose Bank--</option>
                    @foreach ($bank_c as $as)
                            <option value="{{ $as->code_bank }}">({{ $as->code_bank }}) {{ $as->bank_name }}</option>
                    @endforeach
<!--                     <option value="ID">Indonesia</option>
                    <option value="TH">Thailand</option>
                    <option value="SG">Singapura</option>
                    <option value="JP">Jepang</option>
                    <option value="TW">Taiwan</option>
                    <option value="CN">China</option>
                    <option value="US">Amerika</option> -->
                </select>
              </div>
            </div>

             <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Part Bank</b></font><br/>
                <input type="text" class="form-control" name="part_bank" id="part_bank" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Account Number</b></font><br/>
                <input type="text" class="form-control" name="account_no" id="account_no" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Account Name</b></font><br/>
                <input type="text" class="form-control" name="account_name" id="account_name" required>
              </div>
            </div>

                <button type="submit" class="btn btn-sm btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;
                  <font face='calibri'><b>SAVE</b></font>
                </button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-sm btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span>&nbsp;
                  <font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>
          </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>

@if (count($view) > 0)
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