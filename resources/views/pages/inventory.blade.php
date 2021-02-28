@extends('layouts.app')

    @section('content')
    <div class="" style="margin-top: -20px; padding-left:100px; padding-right: 100px;">
    	<h2>Inventory Report</h2>
    	<p>This page displays all the items and its corresponding information</p>
    	<a href="/" class="btn btn-success"><i class="mdi mdi-arrow-left"></i>Back to Dashboard</a>
    	<a href="/items_export" class="btn btn-success"><i class="mdi mdi-microsoft-excel" style="margin-right:5px"></i>Export to Excel</a>
    	<hr>
    	<table class="table table-striped table-hover" id="items_table">
    		<thead>
    			<tr>
    				<th>Item ID</th>
    				<th>Item Name</th>
    				<th>Unit Price</th>
    				<th>Total Import</th>
    				<th>Total Export</th>
    				<th>Stocks Left</th>
    				<th>Unit</th>
    				<th>Supplier Name</th>
    				<th>Date Created</th>

    			</tr>
    		</thead>
    		<tbody>
    			@foreach($items as $key=>$item)
    			<tr>
    				<td>{{$item->get('id')}}</td>
    				<td>{{$item->get('name')}}</td>
    				<td>{{$item->get('unit_price')}}</td>
    				<td>{{$item->get('total_import')}}</td>
    				<td>{{$item->get('total_export')}}</td>
    				<td>{{$item->get('stock')}}</td>
    				<td>{{$item->get('unit')}}</td>
    				<td>{{$item->get('supplier_name')}}</td>
    				<td>{{$item->get('created_at')}}</td>
    			</tr>
    				
    		
    			@endforeach
    		</tbody>
    	</table>
    	<br>

	</div>	
    <script type="text/javascript">
    	 $(document).ready(function(){

    	 	$('#items_table').DataTable({"order": [[ 1, "asc" ]]});

             // buttons on click
          $('#myTable tbody').on('click','td',function(){
            var table_data = table.row(this).data();
            // // get the row's info
            var id = table_data[0];

            // var name = table_data[1];
            // var stock = table_data[2]
            // var unit = table_data[3];
            // //insert into form
            // $('#import_id').text(id);
            // $('#import_name').text(name);
            // $('#import_stock').text(stock);
            // $('#import_unit').text(unit);
            // $('#item_id').val(id);

            // //insert into form export
            // $('#export_id').text(id);
            // $('#export_name').text(name);
            // $('#export_stock').text(stock);
            // $('#export_unit').text(unit);
            // $('#items_id').val(id);
            // $('#items_unit').val(unit);
          });

    	 });
    </script>
 @endsection
