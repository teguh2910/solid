@extends('app')

@section('content')
<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
<div class="container-fluid">
  <div class="col-md-7">
    <div class="box box-info">
      <div class="box-body">
        <div class="col-md-5">
            <!-- <font face='calibri' color="grey"><b><big><big><big>INPUT INVOICE</big></big></big></b></font><br/><br/> -->
            <div class="panel panel-success">
              <div class="panel-heading">
                <font face='calibri'>IMPORT&nbsp;&nbsp;<big><big><b>DATA VENDOR</b></big></big></font>
              </div>
              <div class="panel-info">
                <div class="panel-heading">
                  <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('import/vendor') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="col-md-4">
                        <input type="file" id="file" name="file" required>
                      </div>
                      <div class="col-md-12">
                        <small>
                          <font face='calibri'>Extension file harus <b>.csv</b>, didalam file <b>tidak boleh</b> ada karakter <b>koma ( , )</b>, koma diganti menjadi <b>titik ( . )</b></font>
                        </small>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-md-6">
                        <button type="submit" class="btn btn-primary btn-sm">
                          <span class='glyphicon glyphicon-import'></span>&nbsp;&nbsp;
                          <font face='calibri'><b>IMPORT</b></font>
                        </button>
                      </div>
                    </div>
                    </form>
                  </div>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-success">
            <div class="panel-heading">
              <font face='calibri'>IMPORT&nbsp;&nbsp;<big><big><b>DATA INVOICE</b></big></big></font>
            </div>
            <div class="panel-info">
              <div class="panel-heading">
                <div class="panel-body">
                  {!! Form::open(['class' => 'form-horizontal', 'files' => true]) !!}
                  <div class="form-group">
                    <div class="col-md-4">
                      <div style="position:relative;">
                        <a class='btn btn-success btn-xs btn-flat' href='javascript:;'>
                          <i class='glyphicon glyphicon-file'></i>&nbsp;
                          <font face='calibri'><b>CHOOSE FILE</b></font>
                          <input type="file" id="file" name="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="40"  onchange='$("#upload-file-info").html($(this).val());' required >
                        </a>
                        &nbsp;
                        <span class='label label-info' id="upload-file-info"></span>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <small><font face='calibri'>Extension file harus <b>.csv</b>, didalam file <b>tidak boleh</b> ada karakter <b>koma ( , )</b>, koma diganti menjadi <b>titik ( . )</b></font></small>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-md-6">
                      <button type="submit" class="btn btn-primary btn-sm">
                        <span class='glyphicon glyphicon-import'></span>&nbsp;&nbsp;
                        <font face='calibri'><b>IMPORT</b></font>
                      </button>
                    </div>
                  </div>
                  {!! Form::close() !!}
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="col-md-5">
    <div class="box box-info">
      <div class="box-body">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading"><big><big><font face='calibri'><b>BASIC DATA</b></font></big></big></div>
            <div class="panel-info"><div class="panel-heading">
            <div class="panel-body">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/saving') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Jenis Penerimaan</b></font>
                    <select class="form-control" name="jenis_penerimaan" id="jenis_penerimaan">
                          <option value="">-Please Select-</option>
                          <option value="1">PO</option>
                          <option value="2">Non PO</option>
                          <option value="3">DP</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>No Penerimaan</b></font>
                    <input type="text" class="form-control" name="no_penerimaan" id="no_penerimaan" value='{{$nomor}}' autofocus readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Department</b></font>
                   <select class="form-control" name="dept_code" id="dept_code">
                          <option value="1">Purchasing & Exim</option>
                          <option value="2">General Affair</option>
                          <option value="3">BOD</option>
                          <option value="6">HR</option>
                          <option value="5">IT Development</option>
                          <option value="11">IRL</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Vendor</b></font>
                    <!-- <input type="text" class="form-control" name="vendor" id="vendor" required> -->
                    <select class="form-control select2" name="code_vendor" id="code_vendor" style="width: 100%;" autofocus required>
                        <option value="" selected>-Please Select-</option>
                        @foreach ($bank_datas as $k => $v)
                        <option value="{{ $v->code_vendor }}">{{ $v->vendor_name }}</option>
                        @endforeach
                    </select>    
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Tanggal Terima</b></font>
                    <div class='input-group date mypicker' id='en_date'>
                      <input type='text' class="form-control" name="tgl_terima" id="tgl_terima" readonly/>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                    </div>
                  </div>
                </div>

                <div class="form-group" id="po">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>DOC No.</b></font>
                    <input type="text" class="form-control" name="doc_no" id="doc_no">
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>DOC Date</b></font>
                    <div class='input-group date mypicker' id='en_date'>
                      <input type='text' class="form-control" name="doc_date" id="doc_date"  readonly/>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Due Date</b></font>
                    <div class='input-group date mypicker' id='en_date'>
                      <input type='text' class="form-control" name="due_date" id="due_date"  readonly/>
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                          </span>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Curr</b></font>
                    <input type="text" class="form-control" name="curr" id="curr" required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Amount</b></font>
                    <input type="number" class="form-control" name="amount" id="amount" required>
                  </div>
                </div>

                <div class="form-group" id="po2">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>DOC No.</b></font>
                    <input type="number" class="form-control" name="doc_no_2" id="doc_no_2">
                  </div>
                </div>

                <div class="form-group" >
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Nomor PO</b></font>
                    <input type="text" class="form-control" name="no_po" id="no_po">
                  </div>
                </div> 
                <div class="form-group">
                        <div class="col-md-12">
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
              </div>
            </div>
          </div>
    </div>
  </div>

      <!-- <div class="col-md-5">
        <div class="box box-warning">
          <div class="box-body">
          <div class="col-md-12">
            <div class="panel panel-success">
              <div class="panel-heading">
                <font face='calibri'>MANUAL INPUT&nbsp;&nbsp;<big><big><b>DATA INVOICE</b></big></big></font>
              </div>
              <div class="panel-info">
                <div class="panel-heading">
                  <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/saving') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}">
                      <div class="form-group">
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-12">
                          <font face='calibri'><b>NO PENERIMAAN</b></font>
                          <input type="text" class="form-control" name="no_penerimaan" id="no_penerimaan" value='{{$nomor}}' autofocus required disabled>
                        </div>
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DEPARTMENT</b></font>
                          <select class="form-control select2" name="dept_code" id="dept_code" style="width: 100%;">
                            <option value="1">Purchasing & Exim</option>
                            <option value="2">General Affair</option>
                            <option value="3">BOD</option>
                            <option value="6">HR</option>
                            <option value="5">IT Development</option>
                            <option value="11">IRL</option>
                          </select>
                        </div>
                        <label class="col-md-1 control-label"></label>
                        <div class="col-md-12">
                          <font face='calibri'><b>VENDOR</b></font>
                          <select class="form-control select2" name="shipping_qty" id="code_ng_list" style="width: 100%;" required>
                            @foreach ($bank_datas as $k => $v)
                            <option value="{{ $v->id }}">{{ $v->vendor_name }}</option>
                            @endforeach
                          </select>    
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>TANGGAL TERIMA</b></font>
                          <div class='input-group date mypicker' id='en_date'>
                            <input type='text' class="form-control" name="tgl_terima" id="tgl_terima" readonly/>
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DOC NO</b></font>
                          <input type="text" class="form-control" name="doc_no" id="doc_no" required>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DOC DATE</b></font>
                          <div class='input-group date mypicker' id='en_date'>
                            <input type='text' class="form-control" name="doc_date" id="doc_date"  readonly/>
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DUE DATE</b></font>
                          <div class='input-group date mypicker' id='en_date'>
                            <input type='text' class="form-control" name="due_date" id="due_date"  readonly/>
                            <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                          </div>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>CURR</b></font>
                          <input type="text" class="form-control" name="curr" id="curr" required>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>AMOUNT</b></font>
                          <input type="number" class="form-control" name="amount" id="amount" required>
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>DOC NO</b></font>
                          <input type="number" class="form-control" name="doc_no_2" id="doc_no_2">
                        </div>
                        <label class="col-md-1 control-label">
                        </label>
                        <div class="col-md-12">
                          <font face='calibri'><b>PO NUMBER</b></font>
                          <input type="text" class="form-control" name="no_po" id="no_po">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-md-9">
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
                  </div>
                </div>
>>>>>>> c2cf1d6bf4a99de60ac0461e2d024599f423dba6
              </div>
            </div>
          </div>
        </div>
<<<<<<< HEAD -->
<div class="col-md-12">
<div class="panel panel-success">
          <div class="panel-heading"><big><big><font face='calibri'><b>BANK DATA</b></font></big></big></div>
            <div class="panel-info"><div class="panel-heading">
              <div class="panel-body">

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Part Bank</b></font>
                    <!-- <input type="text" class="form-control" name="vendor" id="vendor" required> -->
                    <select class="form-control select2" name="part_bank" id="part_bank" style="width: 100%;" autofocus required>
                      <option value="" selected>-Please Select-</option>
                      @foreach ($part_bank as $k => $v)
                      <option value="{{ $v->part_bank }}">{{ $v->part_bank }}</option>
                      @endforeach
                    </select>  
                    <label id="test"></label>  
                  </div>

                </div>
                <br>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Bank Account</b></font>
                    <input type="text" class="form-control" name="account_no" id="account_no" required disabled>
                    <input name="account_no2" id="account_no2" type="hidden">
                  </div>
                </div>
                <br>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Bank Key</b></font>
                    <input type="text" class="form-control" name="code_bank" id="code_bank" required disabled>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-md-3"></div>
                    <div class="col-md-7">
                    <label id="test2"></label>  
                  </div>
                </div>
                <br>
                <!-- <label id="test"></label>   -->
                <div class="form-group">
              <div class="col-md-9">
                <button type="submit" class="btn btn-sm btn-primary">
                  <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;<font face='calibri'><b>SUBMIT</b></font>
                 </button>&nbsp;&nbsp;
                 <button type="reset" class="btn btn-sm btn-danger">
                  <span class='glyphicon glyphicon-repeat'></span>&nbsp;<font face='calibri'><b>RESET</b></font>
                </button>
              </div>
            </div>

              </div>
            </div>
          </div>
        </div>


            

       </form>
</div>
</div>

       
      </div>
   </div>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    $('.mypicker').datepicker({
      format: "yyyy-m-d",
      autoclose: true,
      orientation: 'top auto',
    });
  });
</script>

<script type="text/javascript">

    $('#po').hide();
    $('#po2').hide();

    var code_vendor ;
    var no_penerimaan = "";
    $("#code_vendor").change(function() {
      code_vendor = $('option:selected', this).val();
    });

    $("#jenis_penerimaan").change(function() {
      no_penerimaan = $('option:selected', this).val();
        // alert(no_penerimaan);
      

      if (no_penerimaan == 1)
      {
        $('#po').show();
        $('#po2').hide();

      }
      else{
        $('#po').hide();
        $('#po2').show();
      }
    });

    $("#part_bank").change(function() {
         
         var namaSupplier = $('option:selected', this).val();

         var data = {
            _token: '{{ csrf_token() }}',
        };
         $.ajax({
                type: "POST",
                data: {id: namaSupplier, id2 : code_vendor, _token: "{{ csrf_token() }}"},
                url :"{{ url('json/account').'/'}}"+code_vendor+"/"+namaSupplier,
                dataType: 'json',
                success: function(myData) {

                  
                   if(myData)
                {
                    var len = myData.length;
                    // var myData = "";
                    if(len > 0)
                    {         
                        for(var i=0;i<len;i++)
                        {
                            
                            $('#test').text(myData[i].account_name);
                            $('#test2').text(myData[i].bank_name);
                            $('#account_no').val(myData[i].account_no);
                            $('#account_no2').val(myData[i].account_no);
                            $('#code_bank').val(myData[i].code_bank);
                                  
                        }
                       
                    }
                }                       
                }
        });
    });

     


</script>



@endsection
