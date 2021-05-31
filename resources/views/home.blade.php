@extends('layouts.app')

@section('content')
<div class="" style="margin-top: -30px;">
    <div class="">
        <div class="">
            <div class="">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

    

    <div style="margin-top:-30px;">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#import_new_item">
            <i class="mdi mdi-plus" style="margin-right:5px"></i>
                      Import New Item
                    </button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_new_supplier">
            <i class="mdi mdi-account-plus" style="margin-right:5px"></i>
                      Add New Supplier
                    </button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#suppliers_view_modal">
            <i class="mdi mdi-account-group"  style="margin-right:5px"></i>
                      View Supplier
                    </button>

          <a href="/inventory" class="btn btn-success">
            <i class="mdi mdi-file-table-box-multiple-outline" style="margin-right:5px"></i>Inventory Report</a>
        {{-- <a href="/transaction" class="btn btn-success">View Item Transactions</a> --}}
    </div>
  <!-- Button to Open the Modal -->

{{-- ADD NEW ITEM MODAL --}}
<div class="modal fade" id="import_new_item">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Import New Item</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body form-group">
          {!!Form::open(['action'=>'itemsController@store', 'method'=>'POST','id'=>'add_new_item'])!!}
            {{Form::label('title','Product Name')}}
            {{Form::text('product_name','',['autofocus'=>'true','class'=>'form-control','placeholder'=>'E.g Colgate'])}}
            {{Form::label('title','Unit Price')}}
            {{Form::text('unit_price','',['class'=>'form-control','placeholder'=>'10.25'])}}
            {{Form::label('title','Quantity')}}
            {{Form::number('stock','',['class'=>'form-control','placeholder'=>'10'])}}
            {{Form::label('title','Unit')}}
            {{Form::text('unit','',['class'=>'form-control','placeholder'=>'E.g Carton'])}}
           
            {{Form::text('action','Batch Import',['hidden'])}}
            {{Form::label('title','From')}}
            {{Form::select('supplier',$suppliers,null,['class'=>'form-control'])}}
            <hr>
            {{Form::submit('Import Item',['class'=>'btn btn-primary'])}}
          {!!Form::close()!!}
        
      </div>
      </div>
    </div>
  </div>

  {{-- SUPPLIER MODAL --}}
  <div class="modal fade" id="add_new_supplier">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- SUPPLIER MODAL Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Supplier</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- SUPPLIER Modal body -->
      <div class="modal-body">
          {!!Form::open(['action'=>'SupplierController@store', 'method'=>'POST','id'=>'add_supplier'])!!}
            {{Form::label('title','Supplier Name')}}
            {{Form::text('name','',['autofocus'=>'true'])}}
            {{Form::submit('Add',['class'=>'btn btn-primary'])}}
          {!!Form::close()!!}
      </div>
      </div>
    </div>
  </div> 

{{-- ADD STOCKS MODAL --}}
<div class="modal fade" id="import">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Stocks</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <table class="table table-striped table-dark" >
            <thead>
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Unit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id ="import_id"></td>
                <td id = "import_name"></td>
                <td id = "import_stock"></td>
                <td id = "import_unit"></td>
              </tr>
            </tbody>
          </table>
          {{-- ADD STOCKS FORM --}}
          {!!Form::open(['action'=>'itemsController@add_stocks', 'method'=>'POST','id'=>'add_stocks_form'])!!}
            {{Form::label('title','Stock')}}
            {{Form::number('import_number','',['autofocus'=>'true'])}}
            {{Form::number('item_id','',['hidden'=>'true','id'=>'item_id'])}}
            {{Form::text('action','Add Stock',['hidden'])}}
            {{Form::submit('Add',['class'=>'btn btn-primary'])}}
          {!!Form::close()!!}
        
      </div>
      </div>

    

    </div>
  </div>

{{-- EXPORT MODAL --}}
<div class="modal fade" id="export">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Export</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Stock</th>
                <th>Unit</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td id ="export_id"></td>
                <td id = "export_name"></td>
                <td id = "export_stock"></td>
                <td id = "export_unit"></td>
              </tr>
            </tbody>
          </table>
        {!!Form::open(['action'=>'itemsController@export', 'method'=>'POST','id'=>'export_stocks'])!!}
            {{Form::label('title','Stock')}}
            {{Form::number('export_number','',['autofocus'=>'true'])}}
            {{Form::number('item_id','',['hidden'=>'true','id'=>'items_id'])}}        
            {{Form::submit('Export',['class'=>'btn btn-warning'])}}
          {!!Form::close()!!}
      </div>
         
    </div>
  </div>
</div>

{{-- SUPPLIERS VIEW MODAL --}}
<div class="modal fade" id="suppliers_view_modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Select Supplier</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body form-group">
          {!!Form::open(['action'=>'PagesController@suppliers', 'method'=>'POST','id'=>'select_supplier'])!!}
          
            {{Form::label('title','Select Supplier')}}
            {{Form::select('supplier',$suppliers,null,['class'=>'form-control'])}}
            <hr>
            {{Form::submit('View',['class'=>'btn btn-primary'])}}
          {!!Form::close()!!}
        
      </div>
      </div>
    </div>
  </div>
    <hr>

{{-- TABLES --}}
   
    <div class="row">
       <div class="col-7">
       <h3>Items Data Table</h3>
        @if(count($items) > 0)
        
            <table id="myTable" class="table-hover table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>

                        <th>Name</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Date Inserted</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      
                    </tr>
                </thead>
                <tfoot>
                   <tr>
                        <th>ID</th>

                        <th>Name</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>Unit Price</th>
                        <th>Date Inserted</th>
                        <th></th>
                        <th></th>
                        <th></th>
                      
                    </tr>
                </tfoot> 
            </table>
        
        @else
                <h3>No items found</h3>
        @endif
        </div>
        <div class="col">
            <h3>Transactions History Table</h3>

            @if(count($transaction) > 0)
        
            <table id="transactions_table" class="table-hover table table-striped">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Performed Date</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Action</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Performed Date</th>
                    </tr>
                </tfoot>
            </table>
             @else
                <h3>No items found</h3>
        @endif
         <p>Note: This table only shows 50 latest results. To all the transactions from each item, click the "View Item" button inside the Items Data Table.</p>
        </div>
    </div>
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
  
           // datatables
           // var table = $('#myTable').DataTable({"pageLength":5,  "order": [[ 6, "desc" ]], "processing":true,});
         
           // var trans_table = $('#transactions_table').DataTable({"pageLength":5, "order": [[ 4, "desc" ]],
           //  "processing":true,
           //  "deferRender":true});

           var trans_table = $('#transactions_table').DataTable({
            // "processing":true,
            "order": [[ 4, "desc" ]],
            "pageLength":8,
            "deferRender":true,
            "ajax":{
              url:"{{route('view_transactions')}}",dataSrc:""
            },            
            "columns":[
              {
                data:"action",
                name:"Action",
              },
             
              {
                data:"item.name",
                name:"Product Name",
              },
              {
                data:"quantity",
                name:"Quantity",
              },
               {
                data:"unit",
                name:"Unit",
              },
               {
                data:"created_at",
                name:"Performed Date",
              }
                ],
           
            });
    

            var table = $('#myTable').DataTable({
            // "processing":true,
            "pageLength":8,
            "deferRender":true,
            "ajax":{
              url:"{{route('view_items')}}",dataSrc:""
            },            
            "columns":[
            {
                data:"id",
                name:"ID",
              },
             
              {
                data:"name",
                name:"Name",
              },
              {
                data:"stock",
                name:"Stock",
              },
               {
                data:"unit",
                name:"Unit",
              },
               {
                data:"unit_price",
                name:"Unit Price",
              },
              
              {
                data:"created_at",
                name:"Date Inserted",
              },
              {
                data:null,
                render:function(data,type,row){
              return"<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#import'><i class='mdi mdi-application-import'></i>Add</button>";
                }
              },
              {
                data:null,
                render:function(data,type,row){
              return"<button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#export'><i class='mdi mdi-application-export'></i> Export </button>";
                }
              },
              {
                data:null,
                render:function(data,type,row){
              return"<a href='/item/"+data.id+"' class='btn btn-success'>View Item</a>";
                }
              },
             
            ],
           
            });
//                   setInterval( function () {
//     table.ajax.reload();
// }, 3000 ); 
          // add supplier // buttons on click
          $('#myTable tbody').on('click','td',function(){
            var table_data = table.row(this).data();
            // console.log(table_data);
            // get the row's info
            var id = table_data.id;
            var name = table_data.name;
            var stock = table_data.stock;
            var unit = table_data.unit;
            
            //insert into form
            $('#import_id').text(id);
            $('#import_name').text(name);
            $('#import_stock').text(stock);
            $('#import_unit').text(unit);
            $('#item_id').val(id);

            //insert into form export
            $('#export_id').text(id);
            $('#export_name').text(name);
            $('#export_stock').text(stock);
            $('#export_unit').text(unit);
            $('#items_id').val(id);
            $('#items_unit').val(unit);

          });

          $('#add_supplier').submit(function(e){
            e.preventDefault();
            // send to ajax
            $.ajax({
              type:'post',
              url:'{{URL::to('add_supplier')}}',
              data: $(this).serialize(),success:function(response){
                alert(response);
              }
            })
          })

          // ADD NEW ITEM
         $('#add_new_item').submit(function(e){
            e.preventDefault();
           // send to store
            $.ajax({
                type:'post',
                url: '{{URL::to('add_new_item')}}',
                data: $(this).serialize(),
                success: function(response){
                    alert(response);
                    trans_table.ajax.reload();
                }
            });
         });

          // ADD STOCKS FORM
         $('#add_stocks_form').submit(function(e){
         e.preventDefault();

         //send to add_stocks
         $.ajax({
          type: 'post',
          url: '{{URL::to('add_stocks')}}',
          data: $(this).serialize(),success:function(data){
            alert(data);
            table.ajax.reload();
             trans_table.ajax.reload();
            },
         });
          
         });

          // EXPORT STOCKS FORM
         $('#export_stocks').submit(function(e){
          // console.log($(this).serialize());
         e.preventDefault();
        
           // send to export_stocks
           $.ajax({
            type: 'post',
            url: '{{URL::to('export')}}',
            data: $(this).serialize(),success:function(data){
              alert(data);
               trans_table.ajax.reload();
            },
           });
         });
        });
    </script>
  

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
