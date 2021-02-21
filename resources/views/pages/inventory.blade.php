@extends('layouts.app')

    @section('content')
    <div class="" style="margin-top: -20px; padding-left:50px; padding-right: 50px;">
    	<h2>Inventory Report</h2>
    	<table class="table table-striped table-hover">
    		<thead>
    			<tr>
    				<th>Item ID</th>
    			</tr>
    		</thead>
    	</table>
	</div>	
    <script type="text/javascript">
    	 $(document).ready(function(){

    	 	// $('#item_table').DataTable({"pageLength":5, "order": [[ 0, "asc" ]]});
    	 	// $('#transactions_table').DataTable({"pageLength":3, "order": [[ 5, "desc" ]]});

    	 });
    </script>
 @endsection
