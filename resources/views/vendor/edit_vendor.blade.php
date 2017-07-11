@extends('app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="box box-primary">
        <div class="box-body">
          <big><big><big><font face='calibri'><b>UPDATE VENDOR</b></font></big></big></big>
        </div>
        <div class="panel-body">
        <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/vendor/save_edit') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            @foreach ($m_vendor as $m_vendor)
            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Vendor Name</b></font><br/>
                <input type="text" class="form-control" name="vendor_name" id="vendor_name" value="{{$m_vendor->vendor_name}}" autofocus required >
                <input type="hidden" class="form-control" name="id" id="id" value="{{$m_vendor->id}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-8">
                <font face='calibri'><b>Vendor Code</b></font><br/>
                <input type="code_vendor" class="form-control" name="code_vendor" id="code_vendor" value="{{$m_vendor->code_vendor}}" required>
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-4">
                <font face='calibri'><b>Country</b></font><br/>
                <select class="form-control select2" name="country" id="country" style="width: 100%;">
                    <option value="ID">Indonesia</option>
                    <option value="TH">Thailand</option>
                    <option value="SG">Singapura</option>
                    <option value="JP">Jepang</option>
                    <option value="TW">Taiwan</option>
                    <option value="CN">China</option>
                    <option value="US">Amerika</option>
                </select>
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
 
@if (count($vendor_all) > 0)
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
