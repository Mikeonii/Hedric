@extends('layouts.app')

@section('content')

 <table id="sampleTable">
      <thead>
        <tr>
          <th>Name</th>
           <th>Stock</th>
           <th></th>
        </tr>
      </thead>
    </table>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
	  $(document).ready(function(){

	  var table = $('#sampleTable').DataTable({
            "ajax":{
            	url:"{{route('view_items')}}",dataSrc:""
            },            
            "columns":[
              {
                data:"item_id",
                name:"Name",
              },
              {
                data:"action",
                name:"Stock",
              },
              {
                data:null,
                render:function(data,type,row){
              return"<button>"+data.action+"</button>";
                }
              }
            ],
           
            });
	});
</script>
@endsection
