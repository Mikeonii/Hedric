@extends('layouts.app')

@section('content')


<div class="" style="padding:20px;">
	<a href="/home" class="btn btn-primary">Back to Home</a>
	<h1>Items</h1>
	
	<table id = "table" class="table table-striped">
		<thead>
			<tr>
				<th>ID</th>
				<th>Name</th>
				<th>Stock</th>
				<th>From</th>
				<th>Posted by</th>
				<th>Created at</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@if(count($items) > 0)

				@foreach($items as $item)
					<tr>
						
						<td>{{$item->id}}</td>
						<td>{{$item->name}}</td>
						<td>{{$item->stock}}</td>
						<td>{{$item->from}}</td>
						<td>{{$item->posted_by}}</td>
						<td>{{$item->created_at}}</td>
						<td><span class="btn btn-danger">Delete</span></td>
					</tr>

				@endforeach

			@else
				<h2>No items found</h2>
			@endif
		</tbody>
	</table>
</div>
 {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
    	var table = $('#table').DataTable();

    	$('#table tbody').on('click','td',function(){
    			var table_data = table.row(this).data();

    			if($(this).text()=='Delete'){
    				var id = table_data[0];
	    			console.log(id);
	    			var location = "items/delete/"+id;
	    			window.location.href = location;    			
    			}
    		});
    	});
    </script>
@endsection