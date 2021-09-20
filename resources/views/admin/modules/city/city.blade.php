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
                        <div class="col-md-2">

                            <button style=" margin-top: 32px;" type="submit" class="btn btn-primary">Submit</button>
                        </div>


                    </div>


                </form>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="update_city">
                                @csrf
                                <input type="hidden" value="" id="id" name="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-5">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>City Name</label>
                                                <input type="text" name="city" id="city" value="" required class="form-control" placeholder="Enter City Name">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Zone</label>
                                                <select name="zone" id="zone" class="form-control select2 select2bs4">

                                                </select>

                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                            <button style="margin-top: 32px;" type="submit" class="btn btn-primary">Update</button>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-footer">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
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

                                <td><button onclick="show_modal('{{$city->cityName}}')" class="btn btn-success">Edit</button> </td>
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


<script>
    function show_modal(city) {

        $.ajax({
            url: 'edit_city/' + city,
            type: 'get',
            data: {
                city: city
            },
            success: function(data) {

                document.getElementById('id').value = data['city'][0].cityName;
                document.getElementById('city').value = data['city'][0].cityName;
                let output = `<option selected readonly value="${data['city'][0].zoneName}">${data['city'][0].zoneName}</option>`;

                data['zone'].forEach(el => {
                    output += `
                    <option value="${el.zoneName}">${el.zoneName}</option>
                    `;

                    document.getElementById('zone').innerHTML = output;

                });
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection