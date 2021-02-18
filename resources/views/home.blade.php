@extends('layouts.app')

@section('content')
<div class="" style="">
    <div class="row justify-content-center">
        <div class="col-16">
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
                      Import New Item
                    </button>
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_new_supplier">
                      Add New Supplier
                    </button>
          <a href="/items" class="btn btn-success">Items</a>
        <a href="/transaction" class="btn btn-success">View Item Transactions</a>
    </div>
  <!-- Button to Open the Modal -->

{{-- modal import batch item --}}
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
    
        
          {!!Form::open(['action'=>'itemsController@store', 'method'=>'POST','id'=>'import_batch_form'])!!}
            {{Form::label('title','Product Name')}}
            {{Form::text('product_name','',['autofocus'=>'true','class'=>'form-control'])}}
     
            {{Form::label('title','Stock')}}
            {{Form::number('stock','',['class'=>'form-control'])}}
     
            {{Form::label('title','Unit')}}
            {{Form::text('unit','',['class'=>'form-control'])}}
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

  {{-- modal add new supplier --}}
  <div class="modal fade" id="add_new_supplier">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add New Supplier</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       @csrf
       <!--   <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <form method="post" action = "/add_supplier">
          <input type="text" name="name" placeholder="Add Name">
          <input type="submit" name="submit" label="Add">
        </form> -->
          {!!Form::open(['action'=>'SupplierController@store', 'method'=>'POST','id'=>'add_supplier'])!!}
            {{Form::label('title','Supplier Name')}}
            {{Form::text('name','',['autofocus'=>'true'])}}
            {{Form::submit('Add',['class'=>'btn btn-primary'])}}
          {!!Form::close()!!}
      </div>
      </div>

    

    </div>
  </div> 

{{-- modal import --}}
<div class="modal fade" id="import">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Import</h4>
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

          {!!Form::open(['action'=>'itemsController@import', 'method'=>'POST','id'=>'form_import'])!!}
            {{Form::label('title','Stock')}}
            {{Form::number('import_number','',['autofocus'=>'true'])}}
            {{Form::number('item_id','',['hidden'=>'true','id'=>'item_id'])}}
            {{Form::text('action','Import',['hidden'])}}
            {{Form::text('unit','',['id'=>'items_unit','hidden'])}}
            {{Form::submit('Import',['class'=>'btn btn-primary'])}}
          {!!Form::close()!!}
        
      </div>
      </div>

    

    </div>
  </div>

{{-- modal export --}}
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
        {!!Form::open(['action'=>'itemsController@export', 'method'=>'POST','id'=>'form_export'])!!}
            {{Form::label('title','Stock')}}
            {{Form::number('import_number','',['autofocus'=>'true'])}}
            {{Form::number('item_id','',['hidden'=>'true','id'=>'items_id'])}}
            {{Form::text('action','Export',['hidden'])}}
            {{Form::label('title','To')}}
           
          
            {{Form::text('unit','',['id'=>'items_unit_export','hidden'])}}
            {{Form::submit('Export',['class'=>'btn btn-warning'])}}
          {!!Form::close()!!}
      </div>
         
    </div>
  </div>
</div>
    <hr>
    <div class="row">
       <div class="col-sm">
       <h3>Items Data Table</h3>
        @if(count($items) > 0)
        
            <table id="myTable" class="table-hover table table-striped">
                <thead>
                    <tr>
                        <th hidden>ID</th>
                        <th>Name</th>
                        <th>Stock</th>
                        <th>Unit</th>
                        <th>From</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td hidden>{{$item->id}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->stock}}</td>
                            <td>{{$item->unit}}</td>
                            <td>{{$item->from}}</td>

                            <td>
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#import">
                      Import
                    </button>
                     <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#export">
                      Export
                    </button>
            
                          </td>
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
        
        @else
                <h3>No items found</h3>
        @endif
        </div>
        <div class="col-sm">
            <h3>Transactions History Table</h3>
            @if(count($transaction) > 0)
        
            <table id="transactions" class="table-hover table table-striped">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Product Name</th>
                        <th>To</th>
                        <th>Quantity</th>
                        <th>Unit</th>
                        <th>Performed By</th>
                        <th>Performed Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transaction as $trans)
                        <tr>
                           
                            <td>{{$trans->action}}</td>
                            <td>{{$trans->name}}</td>
                            <td>{{$trans->to}}</td>
                            <td>{{$trans->quantity}}</td>
                            <td>{{$trans->unit}}</td>
                            <td>{{$trans->performed_by}}</td>
                            <td>{{$trans->created_at}}</td>
                            
                        </tr>
                        
                    @endforeach
                </tbody>
            </table>
             @else
                <h3>No items found</h3>
        @endif
        
        </div>
    </div>
    {{-- datatables --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>


    <script type="text/javascript">
        $(document).ready(function(){
           // datatables
           var table = $('#myTable').DataTable();
          // buttons on click
          $('#myTable tbody').on('click','td',function(){
            var table_data = table.row(this).data();
            // get the row's info
            var id = table_data[0];
            var name = table_data[1];
            var stock = table_data[2]
            var unit = table_data[3];
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
            $('#items_unit_export').val(unit);
          });
          // add supplier
          $('#add_supplier').submit(function(e){
            e.preventDefault();
            // send to ajax
            $.ajax({
              type:'post',
              url:'{{URL::to('add_supplier')}}',
              data: $(this).serialize(),success:function(data){
                alert(data);
              }
            })
          })
          //submit form import
         $('#form_import').submit(function(e){
         e.preventDefault();
       
         //send to import
         $.ajax({
          type: 'post',
          url: '{{URL::to('import')}}',
          data: $(this).serialize(),success:function(data){

          },
         });
          //send to addTrans
            $.ajax({
                type: 'post',
                url: '{{URL::to('addTrans')}}',
                data: $(this).serialize(),success:function(data){
                    window.alert(data);
                    location.reload();
                }
            });
         });

           //submit form export
         $('#form_export').submit(function(e){
            console.log($(this).serialize());
         e.preventDefault();
       
         //send to import
         $.ajax({
          type: 'post',
          url: '{{URL::to('export')}}',
          data: $(this).serialize(),success:function(data){
            console.log('success');
          },
         });
          //send to addTrans
            $.ajax({
                type: 'post',
                url: '{{URL::to('addTrans')}}',
                data: $(this).serialize(),success:function(data){
                    window.alert(data);
                    location.reload();
                }
            });
         });
         // import batch
         $('#import_batch_form').submit(function(e){
            e.preventDefault();
            console.log($(this).serialize());
           // send to store
            $.ajax({
                type:'post',
                url: '{{URL::to('store')}}',
                data: $(this).serialize(),
                success: function(data){
                    // window.alert(data);
                    // location.reload();
                }
            });
            // send to batch
            $.ajax({
                type: 'post',
                url: '{{URL::to('storeBatch')}}',
                data: $(this).serialize(),
                success: function(data){
                    window.alert(data);
                    location.reload();
                }
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
