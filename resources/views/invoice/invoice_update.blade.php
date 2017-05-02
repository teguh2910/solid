@extends('app')

@section('content')
<script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>
<div class="container-fluid">
      <div class="box box-primary">
        <div class="box-body">
        <div class="col-md-12">
            <a href="{{ url('/invoice/op') }}"><button class='btn btn-info btn-sm'><i class='glyphicon glyphicon-chevron-left'></i> <font face='calibri'><b>BACK</b></font></button></a>
            <br/>
          <div class="clearfix">&nbsp;</div>
                <table class="table table-hover table-bordered table-condensed">
                <thead>
                    <tr class='success'>
                        <th><small><font face='calibri'>NO PENERIMAAN</font></small></th>
                        <th><small><font face='calibri'>DEPT CODE </font></small></th>
                        <th><small><font face='calibri'>VENDOR</font></small></th>
                        <th><small><font face='calibri'>TGL TERIMA</font></small></th>
                        <th><small><font face='calibri'>DOC NO</font></small></th>
                        <th><small><font face='calibri'>DOC DATE</font></small></th>
                        <th><small><font face='calibri'>DUE DATE</font></small></th>
                        <th><small><font face='calibri'>CURR</font></small></th>
                        <th><small><font face='calibri'>AMOUNT</font></small></th>
                        <!-- <th><small><font face='calibri'>DOC NO</font></small></th> -->
                        <th><small><font face='calibri'>NO PO</font></small></th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($invoice as $invoice_master)
                <?php 
                    date_default_timezone_set('Asia/Jakarta');
                    $date = date('Y-m-d');
                    if ($invoice_master->due_date < $date) {
                        echo"<tr class='danger'>";
                    } else {
                        echo"<tr class='info'>";
                    }
                    ?>
                    <td><font face='calibri'>{{ $invoice_master->no_penerimaan }}</font></td>
                    <td><font face='calibri'>
                    @if ($invoice_master->dept_code == '1')
                        Purchasing
                    @elseif ($invoice_master->dept_code == '2')
                        General Affair
                    @elseif ($invoice_master->dept_code == '3')
                        BOD
                    @elseif ($invoice_master->dept_code == '5')
                        MIS
                    @elseif ($invoice_master->dept_code == '6')
                        HRD
                    @elseif ($invoice_master->dept_code == '11')
                        IRL
                    @endif
                    </font></td>
                    <td><font face='calibri'>{{ $invoice_master->vendor }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice_master->tgl_terima }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice_master->doc_no }}</font></td>
                    <td><center><font face='calibri'>{{ $invoice_master->doc_date }}</font></center></td>
                    <td><center><font face='calibri'>{{ $invoice_master->due_date }}</font></center></td>
                    <td><font face='calibri'>{{ $invoice_master->curr }}</font></td>
                    <td><font face='calibri'>{{ number_format($invoice->amount, 2) }}</font></td>
                    <!-- <td><font face='calibri'>{{ $invoice_master->doc_no_2 }}</font></td> -->
                    <td><font face='calibri'>{{ $invoice_master->no_po }}</font></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
    <div class="col-md-7 col-md-offset-3">
      <div class="box box-info">
      <div class="box-body">
        <div class="col-md-12">
          <div class="panel panel-success">
            <div class="panel-heading"><big><big><font face='calibri'><b>BASIC DATA</b></font></big></big></div>
            <div class="panel-info"><div class="panel-heading">
            <div class="panel-body">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/invoice/update/save') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                
                @foreach($invoice as $invoice_basic)
                <input name="id_update" id="id_update" value="{{$invoice_basic->part_bank}}" type="hidden">
                <input name="id" id="id" value="{{$id}}" type="hidden">
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
                    <input type="text" class="form-control" value="{{$invoice_basic->no_penerimaan}}" name="no_penerimaan" id="no_penerimaan" autofocus readonly>
                  </div>
                </div>
                

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Department</b></font>
                    <input name="hidden_dept" id="hidden_dept" value="{{$invoice_basic->dept_code}}" type="hidden">
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
                @endforeach

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Vendor</b></font>
                     <select name="code_vendor" id="code_vendor" class="form-control select2" >
                    @foreach ($vendor as $vendor)
                    @if ($vendor->code_vendor == $selected)
                    <option value="{{$vendor->code_vendor}}" selected>{{$vendor->vendor_name}}</option>
                    @else
                    <option value="{{$vendor->code_vendor}}" >{{$vendor->vendor_name}}</option>
                    @endif
                    @endforeach
                  </select>
                  <input name="vendor_name" value="{{$selected2}}" id="vendor_name" type="hidden">
                  </div>
                </div>

                @foreach($invoice as $invoice_basic)
                <div class="form-group" id="po">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>DOC No.</b></font>
                    <input type="text" class="form-control" value="{{$invoice_basic->doc_no}}" name="doc_no" id="doc_no">
                  </div>
                </div>

                  <div class="form-group" >
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Nomor PO</b></font>
                    <input type="text" class="form-control" value="{{$invoice_basic->no_po}}" name="no_po" id="no_po">
                  </div>
                </div> 
                
              </div>



              <div class="col-xs-6">
               
                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Tanggal Terima</b></font>
                    <div class='input-group date mypicker' id='en_date'>
                      <input type='text' class="form-control" value="{{$invoice_basic->tgl_input}}" name="tgl_terima" id="tgl_terima" readonly/>
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
                      <input type='text' class="form-control" value="{{$invoice_basic->doc_date}}" name="doc_date" id="doc_date"  readonly/>
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
                      <input type='text' class="form-control" value="{{$invoice_basic->due_date}}" name="due_date" id="due_date"  readonly/>
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
                    <input type="text" class="form-control" value="{{$invoice_basic->curr}}" name="curr" id="curr"  required>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Amount</b></font>
                    <input type="number" class="form-control" value="{{$invoice_basic->amount}}" name="amount" id="amount" required>
                  </div>
                </div>

                 <div class="form-group" id="po">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Keterangan</b></font>
                    <input type="text" class="form-control" value="{{$invoice_basic->description}}" name="description" id="description">
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
                  <div class="col-md-12" >
                    <font face='calibri'><b>Part Bank</b></font>
                    <select class="form-control" name="part_bank" value="{{$invoice_basic->part_bank}}" id="part_bank" style="width: 100%;" autofocus required>
                    </select>  
                    <label id="test" >{{$invoice_basic->account_name}}</label>  
                  </div>

                </div>
                <br>

                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Bank Account</b></font>
                    <input type="text" class="form-control" value="{{$invoice_basic->account_no}}" name="account_no" id="account_no" required disabled>
                    <input name="account_no2" value="{{$invoice_basic->account_no}}" id="account_no2" type="hidden">
                  </div>
                </div>
  
                <div class="form-group">
                  <label class="col-md-1 control-label"></label>
                  <div class="col-md-12">
                    <font face='calibri'><b>Bank Key</b></font>
                    <input type="text" class="form-control" value="{{$invoice_basic->code_bank}}" name="code_bank" id="code_bank" required disabled>
                    <label id="test2">{{$invoice_basic->bank_name}}</label> 
                  </div>
                </div>

                <br>
                 @endforeach
               
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
</div>

<script type="text/javascript">
    $(function() {
      var code_vendor = "";
      var id_vendor = "";
      var cuco = "" ;
      $('#dept_code').val($('#hidden_dept').val());
      // alert($('#hidden_dept').val())
      code_vendor = $("#code_vendor option:selected").val();
      part_bank = $('#id_update').val();

      
        $('.mypicker').datepicker({
            format: "yyyy-m-d",
            autoclose: true,
            orientation: 'top auto',
        });

        var data = {
            _token: '{{ csrf_token() }}',
        };

        //dev-3.0, by yudo, selected part_bank
        $.ajax({
          type: "POST",
          async : true,
          data: {id: code_vendor, _token: "{{ csrf_token() }}"},
          url :"{{ url('json/part_bank').'/'}}"+code_vendor,
          dataType: 'json',
          success: function(myData) {
                 var $el = $("#part_bank");
                $el.empty(); // remove old options
                $el.append($("<option></option>")
                    .attr("value", '').text('Please Select'));
                $.each(myData, function(value, key) {
                  if (key.part_bank == part_bank)
                  {
                    $el.append($("<option selected='selected'></option>")
                    .attr("value", key.part_bank).text(key.part_bank));
                  }
                  else{
                   $el.append($("<option></option>")
                    .attr("value", key.part_bank).text(key.part_bank));
                   }
            
              });   

            }
          });

        var code_vendor_selected;
        var no_penerimaan = "";
        $("#code_vendor").change(function() {
            $('#vendor_name').val($("#code_vendor option:selected").text()); 
            code_vendor_selected = $('option:selected', this).val();
            var data = {
                _token: '{{ csrf_token() }}',
        };

        //dev-3.0, by yudo, selected part_bank
        $.ajax({
          type: "POST",
          data: {id: code_vendor_selected, _token: "{{ csrf_token() }}"},
          url :"{{ url('json/part_bank').'/'}}"+code_vendor_selected,
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

        $("#part_bank").change(function() {
         
         var namaSupplier = $('option:selected', this).val();

         var data = {
            _token: '{{ csrf_token() }}',
        };

        //dev-3.0, by yudo, retrieve data part_bank
         $.ajax({
                type: "POST",
                async : true,
                data: {id: namaSupplier, id2 : code_vendor_selected, _token: "{{ csrf_token() }}"},
                url :"{{ url('json/account').'/'}}"+code_vendor_selected+"/"+namaSupplier,
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
});

</script>
@endsection
