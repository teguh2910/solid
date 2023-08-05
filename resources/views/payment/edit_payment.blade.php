@extends('app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="box box-primary">
        <div class="box-body">
          <big><big><big><font face='calibri'><b>UPDATE PAYMENT</b></font></big></big></big>
        </div>
        <div class="panel-body">
        <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/payment/save_edit') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach ($m_payment as $m_payment)
            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Vendor Code</b></font><br/>
                <input type="text" class="form-control" name="code_vendor" id="code_vendor" value="{{$m_payment->code_vendor}}" autofocus required >
                <input type="hidden" class="form-control" name="id" id="id" value="{{$m_payment->id}}" required>
               
              </div>
            </div>
            

            <div class="form-group">
              <div class="col-md-4">
                <font face='calibri'><b>Bank Code</b></font><br/>
                <select class="form-control select2" name="code_bank" id="code_bank" value="{{$m_payment->code_bank}}" style="width: 100%;" required>
                    @if ($m_payment->code_bank == '')
                    <option value=''>--Choose Bank--</option>

                    @foreach ($bank_c as $as)
                            <option value="{{ $as->code_bank }}">({{ $as->code_bank }}) {{ $as->bank_name }}</option>
                    @endforeach
                    @else
                    @foreach ($bank_c as $as)
                            @if ($m_payment->code_bank == $as->code_bank)
                            <option value="{{ $as->code_bank }}' selected='selected">({{ $as->code_bank }}) {{ $as->bank_name }}</option>
                            @endif
                            <option value="{{ $as->code_bank }}">({{ $as->code_bank }}) {{ $as->bank_name }}</option>
                    @endforeach

                    @endif
                  </select>
              </div>
            </div>

        

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Part Bank</b></font><br/>
                <input type="text" class="form-control" name="part_bank" id="part_bank" value="{{$m_payment->part_bank}}" required>
                <input type="hidden" class="form-control" name="id" id="id" value="{{$m_payment->id}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Account Number</b></font><br/>
                <input type="text" class="form-control" name="account_no" id="account_no" value="{{$m_payment->account_no}}" required>
                <input type="hidden" class="form-control" name="id" id="id" value="{{$m_payment->id}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Account Name</b></font><br/>
                <input type="text" class="form-control" name="account_name" id="account_name" value="{{$m_payment->account_name}}" required>
                <input type="hidden" class="form-control" name="id" id="id" value="{{$m_payment->id}}" required>
              </div>
            </div>
            @endforeach

            <div class="form-group">
              <div class="col-md-8">
                <button type="submit" class="btn btn-sm btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;
                  <font face='calibri'><b>UPDATE</b></font>
                </button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-sm btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span>&nbsp;
                  <font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>
          </form>
        </div></div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Table -->
 

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


@endsection
