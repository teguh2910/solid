@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
    <div class="box box-primary">
        <div class="box-body">
        <big><big><big>
          <font face='calibri'><b>INPUT DASHBOARD</b></font>
        </big></big></big>
      </div>
          <div class="panel-body"> 
            <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/save_dashboard') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <input type="hidden" name="id" value="{{ $data->id }}">
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>KODE AREA</b></font><br/>
                    <input type="text" name="kode_area" id="kode_area" value="{{ $data->kode_area }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>NAMA AREA</b></font><br/>
                    <input type="text" name="nama_area" id="nama_area" value="{{ $data->nama_area }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>LEADER</b></font><br/>
                    <input type="text" name="leader" id="leader" value="{{ $data->leader }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>SUPERVISOR</b></font><br/>
                    <input type="text" name="spv" id="spv" value="{{ $data->supervisor }}" class="form-control">
                </div>
              </div>
               <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>MANAGER</b></font><br/>
                    <input type="text" name="manager" id="manager" value="{{ $data->manager }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>AUDITOR</b></font><br/>
                    <input type="text" name="auditor" id="auditor" value="{{ $data->auditor }}" class="form-control">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>PERHITUNGAN JAM 8 ~ 9</b></font><br/>
                    <input type="number" name="hitung_8" id="hitung_8" value="{{ $data->hitung_8 }}" class="form-control" min="0" max="100">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>PERHITUNGAN JAM 9 ~ 10</b></font><br/>
                    <input type="number" name="hitung_9" id="hitung_9" value="{{ $data->hitung_9 }}" class="form-control" min="0" max="100">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>PERHITUNGAN JAM 10 ~ 11</b></font><br/>
                    <input type="number" name="hitung_10" id="hitung_10" value="{{ $data->hitung_10 }}" class="form-control" min="0" max="100">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>DATA ENTRY JAM 9 ~ 10</b></font><br/>
                    <input type="number" name="entry_9" id="entry_9" value="{{ $data->entry_9 }}" class="form-control" min="0" max="100">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>DATA ENTRY JAM 10 ~ 11</b></font><br/>
                    <input type="number" name="entry_10" id="entry_10" value="{{ $data->entry_10 }}" class="form-control" min="0" max="100">
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>DATA ENTRY JAM 11 ~ 12</b></font><br/>
                    <input type="number" name="entry_11" id="entry_11" value="{{ $data->entry_11 }}" class="form-control" min="0" max="100">
                </div>
              </div>
              
              <div class="form-group">
                <div class="col-md-8">
                  <button type="submit" class="btn btn-sm btn-warning">
                    <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;
                    <font face='calibri'><b>SUBMIT</b></font>
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
</div>
</div>
@endsection
