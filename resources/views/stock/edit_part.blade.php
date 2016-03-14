@extends('app')

@section('content')
<div class="row mt">
<div class="col-lg-12">
<div class="content-panel">
<div class="container-fluid">
  <div class="row">

        <h4 class="mb"><i class="fa fa-angle-right"></i> UPDATE PART</h4>
        <div class="panel-body">
         @if (count($m_part) > 0)
        @foreach ($m_part as $k => $v)             
        <form class="form-horizontal" role="form" method="POST" action="{{ url('stock/save_edit_part') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">BACK NUMBER</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="back_number" id="back_number" value="{{ $v->back_number }}">
                <input type="hidden" name="id" value="{{ $v->id }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">PART NUMBER</label>
              <div class="col-md-10">
               <input type="text" class="form-control" name="part_number" id="part_number" value="{{ $v->part_number }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">PART NAME</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="part_name" id="part_name" value="{{ $v->part_name }}">
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">QUANTITY OF BOX</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="qty_box" id="qty_box" value="{{$v->qty_box}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">UNIT</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="unit" id="unit" value="{{ $v->unit }}">
              </div>
            </div>

           

            <div class="form-group">
              <div class="col-md-6 col-md-offset-2">
                <button type="submit" class="btn btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span> <font face='calibri'><b>SAVE</b></font>
                </button>
                <button type="reset" class="btn btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span> <font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>
          </form>
          @endforeach
          @endif 
         
        </div>
      </div>
    </div>
    </div>
  </div>
</div>
@endsection
