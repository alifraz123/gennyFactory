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
                            <h3 class="card-title">Edit Zone Data</h3>
                        </div>
                      
                        <form method="post" action="../update_zone">
                            @csrf
                            <input type="hidden" value="{{$zone[0]->zoneName}}" name="zone_hidden_id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Zone Name</label>
                                            <input type="text" name="zone" value="{{$zone[0]->zoneName}}" required class="form-control" placeholder="Enter Item Name">
                                        </div>
                                    </div>
                                </div>
                               
                                <button style="float:right; margin-right:32rem; margin-top: -55px;" type="submit" class="btn btn-primary">Update</button>
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