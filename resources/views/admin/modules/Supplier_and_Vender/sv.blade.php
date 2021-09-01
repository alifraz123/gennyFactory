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
            <div class="row">
                <h4>Supplier and Venders</h4>
            </div>
            <div class="card card-primary">
                <form method="post" action="save_svdata">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" required class="form-control" placeholder="Enter Supplier Name">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Phone No.</label>
                                    <input type="text" name="phoneNo" required class="form-control" placeholder="Enter phoneNo">
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>CNIC</label>
                                    <input type="text" name="cnic" required class="form-control" placeholder="Enter CNIC">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                        <div class="col-sm-4">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Zone</label>

                                    <select class="form-control" name="zone" required id="">
                                        <option disabled selected value="">Choose zone...</option>
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
                                        <option disabled selected value="">Choose city ..</option>
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
                                        <option disabled selected value="">Choose ..</option>
                                        <option value="Supplier">Supplier</option>
                                        <option value="Vender">Vender</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea type="text" name="address" required rows="3" class="form-control" placeholder="Enter Address">
                                            </textarea>
                                </div>
                            </div>
                        </div>
                        <button style="float:right; margin-right:31rem; margin-top: -55px;" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="card-footer">
                    </div>
                </form>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Phone No.</th>
                                <th>CNIC</th>
                                <th>City</th>
                                <th>Zone</th>
                                <th>Address</th>
                                <th>Type</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="companydata">

                            @foreach($sup_and_ven as $sv)
                            <tr>

                                <td>{{$sv->name}}</td>
                                <td>{{$sv->phoneNo}}</td>
                                <td>{{$sv->cnic}}</td>
                                <td>{{$sv->city}}</td>
                                <td>{{$sv->zone}}</td>
                                <td>{{$sv->address}}</td>
                                <td>{{$sv->type}}</td>
                                <td><a href='edit_svdata/{{$sv->phoneNo}}' class="btn btn-success">Edit</a> </td>
                                <td><a href='delete_svdata/{{$sv->phoneNo}}' class="btn btn-danger">Delete</a> </td>
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