@extends('app')

@section('content')
<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
      <div class="box box-primary">
        <div class="box-body">
          <big><big><big><font face='calibri'><b>UPDATE PART</b></font></big></big></big></div>
        <div class="panel-body">
         @if (count($m_part) > 0)
        @foreach ($m_part as $k => $v)             
        <form class="form-horizontal" role="form" method="POST" action="{{ url('stock/save_edit_part') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

             <div class="form-group">
              <div class="col-md-5">
                <font face='calibri'><b>ID Area</b></font><br/>  
                 <select class="form-control select2" name="id_area" id="id_area" style="width: 100%;" required>
                   <option selected disabled="">Select ID AREA </option>
                   @foreach ($m_area as $m_area)  
                   <option value="{{ $m_area->id_area }}" required>{{ $m_area->id_area }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <input type="hidden" name="id" value="{{ $v->id }}">
            <div class="form-group">
              <div class="col-md-5">
                <font face='calibri'><b>Back Number</b></font><br/>
                <input type="text" class="form-control" name="back_number" id="back_number" value="{{ $v->back_number }}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-10">
               <font face='calibri'><b>Part Number</b></font><br/>
               <input type="text" class="form-control" name="part_number" id="part_number" value="{{ $v->part_number }}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-10">
                <font face='calibri'><b>Part Name</b></font><br/>
                <input type="text" class="form-control" name="part_name" id="part_name" value="{{ $v->part_name }}">
              </div>
            </div>
             
            <div class="form-group">
              <div class="col-md-3">
                <font face='calibri'><b>Qty Of Box</b></font><br/>
                <input type="text" class="form-control" name="qty_box" id="qty_box" value="{{$v->qty_box}}">
              </div>
            </div>

            <div class="form-group">
              <div class="col-md-5">
                <font face='calibri'><b>Unit</b></font><br/>
                <input type="text" class="form-control" name="unit" id="unit" value="{{ $v->unit }}">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6">
                <button type="submit" class="btn btn-sm btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span>
                  &nbsp;<font face='calibri'><b>UPDATE</b></font>
                </button>&nbsp;&nbsp;
                <button type="reset" class="btn btn-sm btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span>
                  &nbsp;<font face='calibri'><b>RESET</b></font>
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
