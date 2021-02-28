@extends('layouts.app')

    @section('content')
    <div class="" style="margin-top: -20px; padding-left:50px; padding-right: 50px;">
      <strong><p style="font-size:80px;">{{$info[0]->supplier->supplier_name}}</p></strong> 
      <h4>Number of Items: <strong><span style="color:grey; font-size:40px">{{count($items)}}</span></strong> | Number of Transactions: <strong><span style="color:grey; font-size:40px">{{count($transactions)}}</span></strong></h4>
       <a href="/" class="btn btn-success"><i class="mdi mdi-arrow-left"></i>Back to Dashboard</a>
       {{-- <a href="#" class="btn btn-warning"><i class="mdi mdi-pencil"></i>Edit</a> --}}
       <hr>
   {{--    <table id="suppliers_table" class="table-hover table table-striped">
     			<thead>
     				<tr>
     					<th>Supplier ID</th>
     					<th>Supplier's Name</th>
     					<th>Date Inserted</th>
     					<th>Number of Items Associated</th>
     				</tr>
     			</thead>
     			<tbody>
     				<tr>
     					<td>{{$info[0]->supplier->id}}</td>
     					<td>{{$info[0]->supplier->supplier_name}}</td>
     					<td>{{$info[0]->supplier->created_at}}</td>
     					<td>{{count($info)}}</td>
     				</tr>
     			</tbody>
     		</table> --}}

     		
     		<div class="row">
     			<div class="col">
     				<h2 style="">My Items Table</h2>
     		@if(count($info) > 0)
     		<table id="item_table" class="table-hover table table-striped">
     			<thead>
     				<tr>
     					<th>Name</th>
     					<th>Total Import</th>
     					<th>Total Export</th>
                        <th>Unit Price</th>
     					<th>Stock</th>
     					<th>Unit</th>
     					<th>Posted by</th>
     					<th>Created at</th>
     				</tr>
     			</thead>
     			<tbody>
     			@foreach($items as $key =>$item)
     				<tr>
     					<td>{{$item->get('name')}}</td>     					
     					<td>{{$item->get('total_import')}}</td>
     					<td>{{$item->get('total_export')}}</td>
                        <td>{{$item->get('unit_price')}}</td>
     					<td>{{$item->get('stock')}}</td>
     					<td>{{$item->get('unit')}}</td>
     					<td>{{$item->get('posted_by')}}</td>
     					<td>{{$item->get('created_at')}}</td>
     				</tr>
     			@endforeach
     			</tbody>
     		</table>
     		
     		@else
     		<p>No Data Found</p>
     		@endif
     	
     			</div>
     			<div class="col">
     				<h2>My Transactions Table</h2>
     				<table class="table table-striped table-hover" id="transactions_table">
     					<thead>
     						<tr>
     							<th>Item Name</th>
     							<th>Action</th>
     							<th>Quantity</th>
     							<th>Unit</th>
     							<th>Performed by</th>
     							<th>Performed at</th>
     						</tr>
     					</thead>
     					<tbody>
     						@foreach($transactions as $key => $trans)
     							<tr>
     								<td>{{$trans->item->name}}</td>
     								<td>{{$trans->action}}</td>
     								<td>{{$trans->quantity}}</td>
     								<td>{{$trans->unit}}</td>
     								<td>{{$trans->performed_by}}</td>
     								<td>{{$trans->created_at}}</td>
     							</tr>
     						@endforeach
     					</tbody>
     				</table>
     			</div>
     		</div>
     		
    </div>
    <script type="text/javascript">
    	 $(document).ready(function(){

    	 	$('#item_table').DataTable({"pageLength":5, "order": [[ 0, "asc" ]]});
    	 	$('#transactions_table').DataTable({"pageLength":3, "order": [[ 5, "desc" ]]});

    	 });
    </script>
 @endsection
