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

        <div class="container-fluid">

            <div class="row">
                <h4>City</h4>
            </div>
            <div class="card card-body">


                <form method="post" action="save_city">
                    @csrf

                    <div class="row">
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>City Name</label>
                                <input type="text" name="city" required class="form-control" placeholder="Enter City Name">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Zone</label>
                                <select name="zone" class="form-control select2 select2bs4">
                                    <option selected disabled value="">Choose zone..</option>
                                    @foreach($zones as $zone)
                                    <option value="{{$zone->zoneName}}">{{$zone->zoneName}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>


                    </div>

                    <button style="float:right; margin-right:80px; margin-top: -54px;" type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>

            <div class="card card-primary">

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>City</th>
                                <th>Zone</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($cities as $city)
                            <tr>
                                <td> {{$city->cityName}}</td>
                                <td>{{$city->zoneName}}</td>

                                <td><a href='edit_city/{{$city->cityName}}' class="btn btn-success">Edit</a> </td>
                                <td><a href='delete_city/{{$city->cityName}}' class="btn btn-danger">Delete</a> </td>
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