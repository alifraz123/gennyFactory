@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
    @if(session('status'))
        <div class="alert alert-success">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            {{session('status')}}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            {{session('failed')}}
        </div>
        @endif
        <div style="margin-top: 1rem;" class="container-fluid">
        <div style="margin-top: 1rem;" class="container-fluid">
            <div class="row">
                <a style="margin-bottom: 20px;" href="enterItemData"> <button class="btn btn-primary">Insert Items</button> </a>
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Items Data Show Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Rate</th>
                                <th>Quantity</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($items as $item)
                        <tr>
                               <td> {{$item->ItemName}}</td>
                               <td>{{$item->Category}}</td>
                               <td> {{$item->Rate}}</td}>
                               <td>{{$item->Quantity}}</td>
                               <td><a href='edit_itemsdata/{{$item->ItemName}}' class="btn btn-success">Edit</a> </td>
                               <td><a href='delete_itemsdata/{{$item->ItemName}}' class="btn btn-danger">Delete</a> </td>
                           </tr>
                        @endforeach
            
                        </tbody>
                       
                    </table>
                   
                </div>
                <!-- /.card-body -->
            </div>



        </div>
</div>
</section>



@endsection