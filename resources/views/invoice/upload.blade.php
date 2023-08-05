@extends('app')

@section('content')
<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
<div class="container-fluid">
  <div class="col-md-4">
    <div class="box box-info">
      <div class="box-body">
        <div class="col-md-12">
            <!-- <font face='calibri' color="grey"><b><big><big><big>INPUT INVOICE</big></big></big></b></font><br/><br/> -->
            <div class="row">
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

         <div class="row">
            <div class="panel panel-success">
              <div class="panel-heading">
                <font face='calibri'>IMPORT&nbsp;&nbsp;<big><big><b>DATA BANK</b></big></big></font>
              </div>
              <div class="panel-info">
                <div class="panel-heading">
                  <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('import/bank') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="col-md-4">
                        <input type="file" id="file_bank" name="file_bank" required>
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

        <div class="row">
            <div class="panel panel-success">
              <div class="panel-heading">
                <font face='calibri'>IMPORT&nbsp;&nbsp;<big><big><b>VENDOR - BANK</b></big></big></font>
              </div>
              <div class="panel-info">
                <div class="panel-heading">
                  <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('import/vendor_bank') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="col-md-4">
                        <input type="file" id="file_vendor_bank" name="file_vendor_bank" required>
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

          <div class="row">
            <div class="panel panel-success">
              <div class="panel-heading">
                <font face='calibri'>EXPORT&nbsp;&nbsp;<big><big><b>INVOICE</b></big></big></font>
              </div>
              <div class="panel-info">
                <div class="panel-heading">
                  <div class="panel-body">
                    <form class="form-horizontal" role="form" enctype='multipart/form-data' method="POST" action="{{ url('invoice_list/print') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group">
                      <div class="col-md-8">
                        <!-- <input type="file" id="file_vendor_bank" name="file_vendor_bank" required> -->
                          <div class='input-group date mypicker' id='en_date'>
                              <input type='text' class="form-control" name="ex_tgl_terima" id="ex_tgl_terima" readonly/>
                              <span class="input-group-addon">
                              <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                          </div>
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
                          <font face='calibri'><b>EXPORT</b></font>
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

        </div>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-info">
      <div class="box-body">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading"><big><big><font face='calibri'><b>BASIC DATA</b></font></big></big></div>
            <div class="panel-info"><div class="panel-heading">
            <div class="panel-body">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/saving') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-xs-6">
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
                    <input name="vendor_name" id="vendor_name" type="hidden">     
                  </div>
                </div>

                <div class="form-group" id="po">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>DOC No.</b></font>
                    <input type="text" class="form-control" name="doc_no" id="doc_no">
                  </div>
                </div>

                  <div class="form-group" >
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Nomor PO</b></font>
                    <input type="text" class="form-control" name="no_po" id="no_po">
                  </div>
                </div> 
                
              </div>



              <div class="col-xs-6">
               
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
                    <!-- <input type="text" class="form-control" name="curr" id="curr"  required> -->
                    <select class="form-control" name="curr" id="curr" required>
                          <option value="IDR">IDR</option>
                          <option value="JPY">YEN</option>
                          <option value="THB">THB</option>
                          <option value="USD">USD</option>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Amount</b></font>
                    <input class="form-control" name="amount" id="amount"  required>
                  </div>
                </div>

                 <div class="form-group" id="po">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Keterangan</b></font>
                    <input type="text" class="form-control" name="description" id="description">
                  </div>
                </div>

              </div>     
              </div>
            </div> 
          </div>
    </div>
  </div>

<div class="col-md-12">
<div class="panel panel-success">
          <div class="panel-heading"><big><big><font face='calibri'><b>BANK DATA</b></font></big></big></div>
            <div class="panel-info"><div class="panel-heading">
              <div class="panel-body">
                <div class="col-xs-6">
                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Part Bank</b></font>
                    
                    <select class="form-control select2" name="part_bank" id="part_bank" style="width: 100%;" autofocus required>  
                    </select>
                    <label id="account_name"></label>  
                    <input name="account_name_hide" id="account_name_hide" type="hidden">
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
  
                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Bank Key</b></font>
                    <input type="text" class="form-control" name="code_bank" id="code_bank" required disabled>
                    <label id="bank_name"></label> 
                  </div>

                </div>

                <div class="form-group">
                  <div class="col-md-3"></div>
                    <div class="col-md-7">
                    <label id="bank_name"></label>  
                  </div>
                </div>
                <br>
                <!-- <label id="test"></label>   -->
               </div>
               <div class="col-xs-6">
               </div>             
              </div>
            </div>
          </div>
        </div>
        <center>               
          <button type="submit" class="btn btn-sm btn-primary">
            <span class='glyphicon glyphicon-floppy-saved'></span>&nbsp;<font face='calibri'><b>SUBMIT</b></font>
            </button>&nbsp;&nbsp;
            <button type="reset" class="btn btn-sm btn-danger">
            <span class='glyphicon glyphicon-repeat'></span>&nbsp;<font face='calibri'><b>RESET</b></font>
          </button>
        </center>
 
       </form>
    </div>
   </div>     
      </div>
   </div>
  </div>
</div>
<script type="text/javascript">
  $(function() {
    var today = new Date();
    var nowDate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
 
    $('#tgl_terima').val(nowDate);
    $('.mypicker').datepicker({
      format: "yyyy-m-d",
      autoclose: true,
      orientation: 'top auto',
    });
  });


</script>

<script type="text/javascript">
    

    var code_vendor ;
    var no_penerimaan = "";
    $("#code_vendor").change(function() {
        $('#vendor_name').val($("#code_vendor option:selected").text()); //hotfix-3.0.2, by yudo, add vendor_name
        code_vendor = $('option:selected', this).val();
        var data = {
            _token: '{{ csrf_token() }}',
        };
        $.ajax({
          type: "POST",
          data: {id: code_vendor, _token: "{{ csrf_token() }}"},
          url :"{{ url('json/part_bank').'/'}}"+code_vendor,
          dataType: 'json',
          success: function(myData) {
                 var $el = $("#part_bank");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", '').text('Please Select'));
                $.each(myData, function(value, key) {
                $el.append($("<option></option>")
                    .attr("value", value.part_bank).text(key.part_bank));
              });                              
            }
          });
        });
    // });
  // $("input").keyup(function(){
    $("#amount").keyup(function() {
      var x = $(this).val();
      $(this).val(x.toString().replace(/,/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });
    // alert(new_value);



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
                            
                            $('#account_name').text(myData[i].account_name);
                            $('#account_name_hide').text(myData[i].account_name_hide);
                            $('#bank_name').text(myData[i].bank_name);
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
