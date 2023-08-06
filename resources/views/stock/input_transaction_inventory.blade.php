@extends('app')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
    @foreach($t_transaction as $t_transaction)
    <div class="box box-primary">
        <div class="box-body">
        <big><big><big>
          <font face='calibri'><b>INPUT AMOUNT</b></font>
        </big></big></big>
      </div>
          <div class="panel-body"> 
            <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('/stock/save_transaction/inventory') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <div class="col-md-9">
                  <font face='calibri'><b>Part Number</b></font><br/>
                  <input type="hidden" name="id" value="{{ $t_transaction->id }}">
                  <input type="hidden" name="id_area" value="{{ $t_transaction->id_area }}">
                  <input type="hidden" name="qty_box" value="{{ $t_transaction->qty_box }}">
                  <input type="text" class="form-control" name="part_number" id="part_number" value="{{$t_transaction->part_number}}" readonly>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-5">
                  <font face='calibri'><b>Back Number</b></font><br/>
                  <input type="text" class="form-control" value="{{$t_transaction->back_number}}" readonly>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-12">
                  <font face='calibri'><b>Part Name</b></font><br/>
                  <input type="text" class="form-control" value="{{$t_transaction->part_name}}" readonly>
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-3">
                  <font face='calibri'><b>Qty / Box</b></font><br/>
                  <input type="text" class="form-control" value="{{$t_transaction->qty_box}} {{$t_transaction->unit}}" readonly>
                </div>
              </div>
              @if (($t_transaction->qty_box == 0 || $t_transaction->qty_box = "") && (\Auth::user()->dept_code == "9" || \Auth::user()->dept_code == "10"))
              <!-- <input type="hidden" class="form-control" name="amount_box" id="amount_box" value='null'> -->
              <input type="hidden" class="form-control" name="amount_box" id="amount_box" value="{{\Auth::user()->dept_code}}">
              @else
              <div class="form-group">
                <div class="col-md-3">
                  <font face='calibri'><b>Amount of Box</b></font><br/>
                  @if ($t_transaction->amount_box == "0") 
                  <input type="number" class="form-control" name="amount_box" id="amount_box" placeholder="{{$t_transaction->amount_box}}" autofocus>
                  @else
                  <input type="number" class="form-control" name="amount_box" id="amount_box" value="{{$t_transaction->amount_box}}" autofocus>
                  @endif
                </div>
              </div> 
              @endif
              <div class="form-group">
                <div class="col-md-3">
                  <font face='calibri'><b>Uncomplete</b></font><br/>
                  @if ($t_transaction->amount_pcs == "0") 
                  <input type="number" class="form-control" name="amount_pcs"  id="amount_pcs" placeholder="{{$t_transaction->amount_pcs}}">
                  @else
                  <input type="number" class="form-control" name="amount_pcs"  id="amount_pcs" value="{{$t_transaction->amount_pcs}}">
                  @endif
                </div>
              </div>
              <div class="form-group">
                <div class="col-md-8">
                  <button type="submit" class="btn btn-sm btn-primary">
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
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection
