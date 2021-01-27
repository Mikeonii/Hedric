@extends('layouts.app')

@section('content')

<div class="container">
	<h1>Transactions</h1>
	<a href="/home" class="btn btn-info">Back to Dashboard</a>
	<div class="row">
		<div class="col-sm">
			<hr>
			<h3>Item Transactions</h3>

			<table id = "item_table" class="table">
				<thead>
					<tr>
						<th>Action</th>
						<th>Product Name</th>
						<th>Unit</th>
						<th>Stock</th>			
						<th>To</th>
						<th>Performed By</th>
						<th>Created at</th>

					</tr>
				</thead>
				<tbody>
					@if(count($item)>0)
						@foreach($item as $it)
						<tr>
							<td>{{$it->action}}</td>
							<td>{{$it->name}}</td>
							<td>{{$it->unit}}</td>
							<td>{{$it->quantity}}</td>
							<td>{{$it->to}}</td>
							<td>{{$it->performed_by}}</td>
							<td>{{$it->created_at}}</td>
						</tr>
							
						@endforeach

					@else
						<h3>No records found</h3>
					@endif
				</tbody>
			</table>
		</div>
		<div class="col-sm">
			<hr>
			<h3>Batch Item Transactions</h3>
			<table id = "batch_item_table" class="table">
				<thead>
					<tr>
						<th>Product Name</th>
						<th>Stock</th>
						<th>Unit</th>
						<th>FROM</th>
						<th>Action</th>
						<th>Performed By</th>
						<th>Created at</th>

					</tr>
				</thead>
				<tbody>
					@if(count($batch)> 0)
						@foreach($batch as $bat)
						<tr>
							<td>{{$bat->product_name}}</td>
							<td>{{$bat->stock}}</td>
							<td>{{$bat->unit}}</td>
							<td>{{$bat->from}}</td>
							<td>{{$bat->action}}</td>
							<td>{{$bat->performed_by}}</td>
							<td>{{$bat->created_at}}</td>
						</tr>
						@endforeach
					@else
						<h3>No records found</h3>

					@endif
				</tbody>
			</table>
		</div>
			

	</div>
	
</div>
 {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>

    <script type="text/javascript">
    	$(document).ready(function(){
    		$('#batch_item_table').DataTable();
    		$('#item_table').DataTable();
    	});
    </script>
@endsection 

