@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div style="margin-top: 1rem;" class="container-fluid">
        
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Items Data</h3>
                        </div>
                      
                        <form method="post" action="../edit_itemsdata">
                            @csrf
                            <input type="hidden" value="{{$data[0]->ItemName}}" name="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Enter Item Name</label>
                                            <input type="text" name="ItemName" value="{{$data[0]->ItemName}}" required class="form-control" placeholder="Enter Item Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Enter Category</label>
                                            <input type="text" name="Category" value="{{$data[0]->Category}}" required class="form-control" placeholder="Enter Category">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Enter Rate</label>
                                            <input type="text" name="Rate" value="{{$data[0]->Rate}}" required class="form-control" placeholder="Enter Rate">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Enter Quantity</label>
                                            <input type="text" name="Quantity" value="{{$data[0]->Quantity}}" required class="form-control" placeholder="Enter Quantity">
                                        </div>
                                    </div>
                                </div>


                                



                                <button style="float:right; margin-right:80px; margin-top: -55px;" type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="card-footer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


           



        </div>
</div>
</section>
@endsection