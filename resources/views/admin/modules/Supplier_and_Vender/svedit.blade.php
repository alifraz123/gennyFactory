@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div style="margin-top: 1rem;" class="container-fluid">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Supplier or Vender Data</h3>
                </div>
                <div class="card card-body">

                    <form method="post" action="../edit_svdata">
                        @csrf
                        <input type="hidden" value="{{$data[0]->phoneNo}}" name="id">
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{$data[0]->name}}" required class="form-control" placeholder="Enter City">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Phone No.</label>
                                    <input type="text" name="phoneNo" value="{{$data[0]->phoneNo}}" required class="form-control" placeholder="Enter phoneNo">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>CNIC</label>
                                    <input type="text" name="cnic" value="{{$data[0]->cnic}}" required class="form-control" placeholder="Enter CNIC">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Zone</label>

                                    <select class="form-control" name="zone" required id="">
                                        <option disabled selected value="{{$data[0]->zone}}">{{$data[0]->zone}}</option>
                                        @foreach($zones as $zone)
                                        <option value="{{$zone->zoneName}}">{{$zone->zoneName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>City</label>

                                    <select class="form-control" name="city" required id="">
                                        <option disabled selected value="{{$data[0]->city}}">{{$data[0]->city}}</option>
                                        @foreach($cities as $city)
                                        <option value="{{$city->cityName}}">{{$city->cityName}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Type</label>

                                    <select class="form-control" name="type" required id="">

                                        <option value="{{$data[0]->type}}">{{$data[0]->type}}</option>
                                        <option value="Vender">Vender</option>


                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea name="address" required rows="3" class="form-control" placeholder="Enter Address">
                                    {{$data[0]->address}}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                        <button style="float:right; margin-right:31rem; margin-top: -55px;" type="submit" class="btn btn-primary">Submit</button>


                    </form>
                </div>

            </div>

        </div>
</div>
</section>
@endsection