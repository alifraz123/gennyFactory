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
                            <h3 class="card-title">Edit City Data</h3>
                        </div>

                        <form method="post" action="../update_city">
                            @csrf
                            <input type="hidden" value="{{$city[0]->cityName}}" name="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>City Name</label>
                                            <input type="text" name="city" value="{{$city[0]->cityName}}" required class="form-control" placeholder="Enter City Name">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Zone</label>
                                            <select name="zone" class="form-control select2 select2bs4">
                                                <option selected disabled value="{{$city[0]->zoneName}}">{{$city[0]->zoneName}}</option>
                                                @foreach($zones as $zone)
                                                <option value="{{$zone->zoneName}}">{{$zone->zoneName}}</option>
                                                @endforeach
                                            </select>

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