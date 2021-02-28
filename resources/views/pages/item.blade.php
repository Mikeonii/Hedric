@extends('layouts.app')
@section('content')
<div>
	<div style="padding-left:50px; padding-right:50px;">
		<div class="row">
			<div class="col"><strong><p style="font-size:80px;">{{$item->name}}</p></strong></div>
			<div class="col" style="margin-top:50px;">
			</div>
		</div>
		

		<h4>Stocks left: <strong><span style="color:green; font-size:40px">{{$item->stock}}</span></strong> | Supplier: <strong><span style="color:grey; font-size:40px">{{$item->supplier->supplier_name}}</span></strong> | Unit: <strong><span style="color:grey; font-size:40px">{{$item->unit}}</span></strong> Date Created: <strong><span style="color:grey; font-size:40px">{{$item->created_at}}</span></strong></h4>
		
		<hr>
		<a href="/" class="btn btn-success"><i class="mdi mdi-arrow-left"></i>Back to Dashboard</a>
        {{-- <a href="#" class="btn btn-warning"><i class="mdi mdi-pencil"></i>Edit</a> --}}
        <br>
        <br>
		<h2>My Transactions Table</h2>
		<table class="table table-striped" id="transactions_table">
			<thead>
				<tr>
					<th>Action</th>
					<th>Quantity</th>
					<th>Performed by</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($transactions as $trans)
					<tr>
						<td>{{$trans->action}}</td>
						<td>{{$trans->quantity}}</td>
						<td>{{$trans->performed_by}}</td>
						<td>{{$trans->created_at}}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#transactions_table').DataTable();
	});
</script>

@endsection 