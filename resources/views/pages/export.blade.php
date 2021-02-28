
	{{-- <h1>Hedric Store</h1>
	<p>P-2 PLAZA St., BRGY Magosilom, Cantilan, SDS</p>

	<h3>SUMMARY OF STOCK INVENTORY FOR THE YEAR</h3>
	<p>Ended December 31, 2020</p> --}}
	{{-- {{$items}} --}}
	<table>
		@foreach($items as $item)
		<tr>
			<td>N/a</td>
			<td>{{$item->name}}</td>		
			<td>Cantilan, SDS</td>
			<td>CO</td>
			<td>Supplier</td>
			<td>Fifo</td>
			<td>{{$item->unit_price}}</td>
			<td>{{$item->stock}}</td>
			<td>N/a</td>
			<td>N/a</td>
			<td>{{$item->unit_price*$item->stock}}</td>			
		</tr>
		@endforeach
	</table>
	{{-- <table>
		<thead>
			<tr>
				<th>Product Inventory Code</th>
				<th>Item Description</th>
				<th>
					<table>
						<tr>
							<th colspan="3">
							Location (Note1)
							</th>
						</tr>
						<tr>
							<td>Address</td>
							<td>Code</td>
							<td>Remarks</td>
						</tr>
					</table>
				</th>
				<th>Inventory Evaluation Method (Note2)</th>
				<th>Unit Price</th>
				<th>Quantity in Stocks</th>
				<th>
					<table>
						<tr>
							<th>Unit of Measurement (in weight or volume)</th>
						</tr>
						<tr>e.g Kilos,grams,liters etc.</tr>
					</table>
				</th>
				<th>Total Weight Volume</th>
				<th>Total Cost</th>
				
			</tr>
		</thead>
		<tbody>
			@foreach($items as $item)
				<tr>
					<td>N/a</td>
					<td>{{$item->name}}</td>
					<td>
						<table>
						<tr>
							<td>Cantilan, SDS</td>
							<td>CO</td>
							<td>Supplier</td>
						</tr>
						</table>
					</td>
					<td>Fifo</td>
					<td>{{$item->unit_price}}</td>
					<td>{{$item->stock}}</td>
					<td>N/a</td>
					<td>N/a</td>
					<td>{{$item->unit_price*$item->stock}}</td>
					
				</tr>
			@endforeach
		</tbody>
	</table> --}}
	<style type="text/css">
         th, td {
            border: 1px solid black;
           

         }
         table{
         	text-align: center;
         }
         body{
         	font-family: sans-serif;
         }
	</style>