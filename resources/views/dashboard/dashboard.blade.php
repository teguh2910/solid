@extends('app')
@section('content')
<div class="container-fluid">
    <div class="box box-primary">
        <div class="box-body">
            <div class="col-lg-12">
                <big><big><big><font face='calibri' color='grey'><b>DASHBOARD</b></font></big></big></big>
                <div class="row">
                    <div class="col-md-12">
                        <div class="clearfix">&nbsp;</div>
                        <br/><br/>
                        <table class="table table-bordered table-condensed" id="tableku">
                            <thead>
                                <tr bgcolor='#00008B'>
                                    <th><font face='calibri' color='white'>No</font></th>
                                    <th ><font face='calibri' color='white'>KODE AREA</font></th>
                                    <th ><font face='calibri' color='white'>NAMA AREA</font></th>
                                    <th ><font face='calibri' color='white'>LEADER</font></th>
                                    <th ><font face='calibri' color='white'>SPV</font></th>
                                    <th ><font face='calibri' color='white'>MANAGER</font></th>
                                    <th ><font face='calibri' color='white'>AUDITOR</font></th>
                                    <!-- <th colspan="3"><font face='calibri' color='white'>PERHITUNGAN</font></th>  
                                    <th colspan="3"><font face='calibri' color='white'>DATA ENTRY</font></th> -->
                                    <th><font face='calibri' color='black'>8-9</font></th>  
                                    <th><font face='calibri' color='black'>9-10</font></th>
                                    <th><font face='calibri' color='black'>10-11</font></th>
                                    <th><font face='calibri' color='black'>9-10</font></th>
                                    <th><font face='calibri' color='black'>10-11</font></th>
                                    <th><font face='calibri' color='black'>11-12</font></th>
                                    <th><font face='calibri' color='white'>ISI</font></th>
                                </tr>
                            </thead>
                            <tbody>
                            @if(count($data)>0)
                            @foreach($data as $x)
                                <tr>
                                  <td>{{$x->id}}</td> 
                                  <td>{{$x->kode_area}}</td> 
                                  <td>{{$x->nama_area}}</td> 
                                  <td>{{$x->leader}}</td> 
                                  <td>{{$x->supervisor}}</td>
                                  <td>{{$x->manager}}</td> 
                                  <td>{{$x->auditor}}</td>
                                  <td>{{$x->hitung_8}}</td> 
                                  <td>{{$x->hitung_9}}</td> 
                                  <td>{{$x->hitung_10}}</td> 
                                  <td>{{$x->entry_9}}</td> 
                                  <td>{{$x->entry_10}}</td> 
                                  <td>{{$x->entry_11}}</td>
                                  <td><a href='view_save_dashboard/{{$x->id}}'><span class="glyphicon glyphicon-pencil"></span></a></td>
                                </tr>
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

</div>
</div>

<!-- <script src="{{asset('/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/js/dataTables.bootstrap.js')}}"></script> -->

<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<link href="https://nightly.datatables.net/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
<script src="https://nightly.datatables.net/js/jquery.dataTables.js"></script>

<script>
$(document).ready(function(){
        $('.dataTables_filter').addClass('pull-right');
        $('.pagination').addClass('pull-right');
        
});

// $('table').dataTable({
//         "searching": true,
//         pageLength:20,
//         "paging": true
//     });

    $(document).ready(function(){
        $('.dataTables_filter').addClass('pull-right');
        $('.pagination').addClass('pull-right');

    });

    var table = $('#tableku').DataTable({
        pageLength: 10,
        // "searching":false,
        // "ordering":false
    });

        // Get the page info, so we know what the last is
        var pageInfo = table.page.info();
        var i=-1;
        // Start an interval to go to the "next" page every 3 seconds
        var interval = setInterval(function(){
        // "Next" ...
        table.page( 'next' ).draw( 'page' );
        // alert(table.page())
        // If were on the last page, clear the interval
        // setTimeout(function() {i=i+1; }, 1000);
        i++;
        if(i==3){
          table.page('first').draw(true);
          i=-1;
        }

        }, 3000); // 3 seconds

</script>
@endsection
