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
                            <div class="col-md-2">

                                <button style="margin-top: 32px;" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    </div>
                </form>


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog mw-100 w-50" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Supplier And Vendar</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="edit_svdata">
                                    @csrf
                                    <input type="hidden" value="" id="id" name="id">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Name</label>
                                                <input type="text" id="name" name="name" value="" required class="form-control" placeholder="Enter City">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Phone No.</label>
                                                <input type="text" id="phoneNo" name="phoneNo" value="" required class="form-control" placeholder="Enter phoneNo">
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>CNIC</label>
                                                <input type="text" id="cnic" name="cnic" value="" required class="form-control" placeholder="Enter CNIC">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Zone</label>

                                                <select class="form-control" name="zone" required id="zone">
                                                   
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>City</label>

                                                <select class="form-control" name="city" required id="city">
                                                    
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Type</label>

                                                <select class="form-control" name="type" required id="type">

                                                </select>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" id="address" required rows="3" class="form-control" placeholder="Enter Address">
                                               
                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button style=" margin-top: 32px;" type="submit" class="btn btn-primary">Submit</button>

                                        </div>
                                    </div>


                                </form>
                            </div>

                        </div>
                    </div>
                </div>


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
                                <td><button onclick="show_modal('{{$sv->phoneNo}}')" class="btn btn-success">Edit</button> </td>
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


<script>
    function show_modal(phoneNo) {

        $.ajax({
            url: 'edit_svdata/' + phoneNo,
            type: 'get',
            data: {
                phoneNo: phoneNo
            },
            success: function(data) {
                document.getElementById('id').value = data['data'][0].phoneNo;
                document.getElementById('name').value = data['data'][0].name;
                document.getElementById('phoneNo').value = data['data'][0].phoneNo;
                document.getElementById('cnic').value = data['data'][0].cnic;
                document.getElementById('address').innerHTML = data['data'][0].address;

                let zone = `<option selected readonly value="${data['data'][0].zone}">${data['data'][0].zone}</option>`;
                let city = `<option selected readonly value="${data['data'][0].city}">${data['data'][0].city}</option>`;
                let type = `<option selected readonly value="${data['data'][0].type}">${data['data'][0].type}</option>`;

                data['zones'].forEach(el => {
                    zone += `
                    <option value="${el.zoneName}">${el.zoneName}</option>
                    `;
                    document.getElementById('zone').innerHTML = zone;

                });

                data['cities'].forEach(el => {
                    city += `
                    <option value="${el.cityName}">${el.cityName}</option>
                    `;
                    document.getElementById('city').innerHTML = city;

                });

                type += `
                    <option value="Supplier">Supplier</option>
                    <option value="Vender">Vender</option>
                    `;
                    document.getElementById('type').innerHTML = type;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>

@endsection