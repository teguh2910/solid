@extends('app')

@section('content')
<div class="row mt">
<div class="col-lg-12">
<div class="content-panel">
<div class="container-fluid">
  <div class="row">

        <h4 class="mb"><i class="fa fa-angle-right"></i> UPDATE AREA</h4>
        <div class="panel-body">
         @if (count($m_area) > 0)
        @foreach ($m_area as $k => $v)             
        <form class="form-horizontal" role="form" method="POST" action="{{ url('stock/save_edit_area') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">ID AREA</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="id_area" id="id_area" value="{{ $v->id_area }}">
                <input type="hidden" name="id" value="{{ $v->id }}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">PLANT TYPE</label>
              <div class="col-md-10">
                <select class="form-control" name="type_plant" id="type_plant">
                      <option value="UNIT">UNIT</option>
                      <option value="BODY">BODY</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">AREA CODE</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="code_area" id="code_area" value="{{ $v->code_area }}">
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">AREA NAME</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="name_area" id="name_area" value="{{$v->name_area}}">
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">PIC</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="pic_name" id="pic_name" value="{{ $v->pic_name }}">
              </div>
            </div>
             
            <div class="form-group">
              <label class="col-sm-2 col-sm-2 control-label">CONTACT</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="pic_contact" id="pic_contact" value="{{$v->pic_contact}}">
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
