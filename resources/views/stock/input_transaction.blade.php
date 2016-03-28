@extends('app')

@section('content')

<div class="container">
   <div class="row">
    <div class="col-md-6 col-md-offset-3">
     
        <br/><br/>
     
      <div class="panel panel-primary">
       
        <div class="panel-heading"><center><span class='glyphicon glyphicon-pencil'></span> <font face='calibri'>&nbsp;<font face='calibri'><b>Input Amount</b></font></center></div>
        <div class="panel-info"><div class="panel-heading">
        <div class="panel-body">
           @foreach($t_transaction as $t_transaction)
        <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/stock/save_transaction') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            
            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'>Part Number</font></label>
              <div class="col-md-8">
               <input type="hidden" name="id" value="{{ $t_transaction->id }}">
                <input type="hidden" name="id_area" value="{{ $t_transaction->id_area }}">
              <input type="text" class="form-control" name="part_number" id="part_number" value="{{$t_transaction->part_number}}" readonly>
              </div>
            </div>

            
           
            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'>Amount of Box</font></label>
              <div class="col-md-8">
                <input type="number" class="form-control" name="amount_box" id="amount_box" value="{{$t_transaction->amount_box}}" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-3 control-label"><font face='calibri'>Amount of PCS</font></label>
              <div class="col-md-5">
                <input type="number" class="form-control" name="amount_pcs"  id="amount_pcs" value="{{$t_transaction->amount_pcs}}" required>
              </div>
            </div>

            
            <div class="form-group">
              <div class="col-md-8 col-md-offset-3">
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
        </div>
        </div></div>
      </div>
    </div>
  </div>
</div>
  <!-- Table -->
 


@endsection
