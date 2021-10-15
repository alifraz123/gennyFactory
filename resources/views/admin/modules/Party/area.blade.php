@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="zones" class="row">
                <div class="col-md-12">
                    @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                    @endif
                    <div style="margin-top: 15px;" class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Area</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check()" id="formId" method="post" action="insertArea">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Area</label>
                                            <input onfocusout="checkAreaDuplication(this.value)" id="Area" required type="text" name="Area" class="form-control" placeholder="Area Name">
                                            <label id="areaError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Zone Name</label>
                                            <select required onchange="getCitiesOfSelectedZone(this.value)" class="form-control select2 select2bs4" name="ZoneName" id="ZoneName">
                                                <option value="" selected disabled>Select Zone Name...</option>
                                                @foreach($zones as $zone)
                                                <option value="{{$zone->ZoneName}}">{{$zone->ZoneName}}</option>
                                                @endforeach
                                            </select>

                                        </div>


                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">City Name</label>
                                            <select required class="form-control select2 select2bs4" name="CityName" id="CityName">

                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" style="margin-top: 32px;" class="btn btn-success" value="Save">

                                    </div>
                                </div>
                            </form>

                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Area Name</th>
                                        <th scope="col">City City</th>
                                        <th scope="col">Zone Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($areas as $area)
                                    <tr>
                                        <td>{{$area->Area}}</td>
                                        <td>{{$area->CityName}}</td>
                                        <td>{{$area->ZoneName}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$area->Area}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="areaDelete/{{$area->Area}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Area</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateArea">
                                                @csrf
                                                <input type="hidden" value="" id="id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Area Name</label>
                                                                <input required onfocusout="updateCheckAreaDuplication(this.value)" type="text" id="modal_Area" name="Area" class="form-control" placeholder="Area Name">
                                                                <label id="updateAreaError"></label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Zone Name</label>
                                                                <select onchange="getCitiesOfSelectedZone2(this.value)" required class="form-control select2 select2bs4" name="ZoneName" id="modal_ZoneName">

                                                                </select>
                                                            </div>


                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">City Name</label>
                                                                <select required class="form-control select2 select2bs4" name="CityName" id="modal_CityName">

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-2">
                                                            <input style=" margin-top: 32px;" type="submit" value="Update" class="btn btn-primary">

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

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>


<script>
    function getCitiesOfSelectedZone(ZoneName) {

        $.ajax({
            url: 'getCitiesOfSelectedZone',
            type: 'get',
            data: {
                ZoneName: ZoneName,
            },
            success: function(data) {
                console.log(data)
                if (data.length != 0) {
                    let userType = '<option disabled selected readonly value="">Choose City Name...</option>';
                    data.forEach(el => {
                        userType += `
                        <option value="${el.CityName}">${el.CityName}</option>
                        `;
                        document.getElementById('CityName').innerHTML = userType;
                    });

                } else {
                    let userType = '';
                    document.getElementById('CityName').innerHTML = userType;
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }


    function getCitiesOfSelectedZone2(ZoneName) {

        $.ajax({
            url: 'getCitiesOfSelectedZone',
            type: 'get',
            data: {
                ZoneName: ZoneName,
            },
            success: function(data) {
                console.log(data)
                if (data.length != 0) {
                    let userType = '<option disabled selected readonly value="">Choose City Name...</option>';
                    data.forEach(el => {
                        userType += `
                <option value="${el.CityName}">${el.CityName}</option>
                `;
                        document.getElementById('modal_CityName').innerHTML = userType;
                    });

                } else {
                    let userType = '';
                    document.getElementById('modal_CityName').innerHTML = userType;
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }

    document.getElementById('areaError').style.display = 'none';

    function checkAreaDuplication(area) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: area,
                type: 'areaCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('areaError').style.display = 'block';
                    document.getElementById('areaError').style.color = 'red';
                    document.getElementById('areaError').innerText = area + " is already added please change value";
                    document.getElementById('Area').value = '';
                    document.getElementById('Area').focus();
                } else {
                    document.getElementById('areaError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    function check() {
        var area = document.getElementById('Area').value;
        var CityName = document.getElementById('CityName').value;
        var ZoneName = document.getElementById('ZoneName').value
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: area,
                type: 'areaCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('areaError').style.display = 'block';
                    document.getElementById('areaError').style.color = 'red';
                    document.getElementById('areaError').innerText = area + " is already added please change value";
                    document.getElementById('Area').value = '';
                    document.getElementById('Area').focus();
                } else {
                    document.getElementById('areaError').style.display = 'none';
                    if (area != '' && CityName != '' && ZoneName != '') {
                        document.getElementById('formId').submit()
                    }

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    document.getElementById('updateAreaError').style.display = 'none';

    function updateCheckAreaDuplication(updateArea) {
        var id = document.getElementById('id').value;
        var modal_Area = document.getElementById('modal_Area').value;
        if (id != modal_Area) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: updateArea,
                    type: 'areaCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('updateAreaError').style.display = 'block';
                        document.getElementById('updateAreaError').style.color = 'red';
                        document.getElementById('updateAreaError').innerText = updateArea + " is already added please change value";
                        document.getElementById('modal_Area').value = '';
                        document.getElementById('modal_Area').focus();
                    } else {
                        document.getElementById('updateAreaError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
    }

    function check2() {
        var id = document.getElementById('id').value;
        var modal_Area = document.getElementById('modal_Area').value;
        if (id != modal_Area) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: modal_Area,
                    type: 'areaCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('updateAreaError').style.display = 'block';
                        document.getElementById('updateAreaError').style.color = 'red';
                        document.getElementById('updateAreaError').innerText = modal_Area + " is already added please change value";
                        document.getElementById('modal_Area').value = '';
                        document.getElementById('modal_Area').focus();
                    } else {
                        document.getElementById('updateAreaError').style.display = 'none';
                        if (updateArea != '') {
                            document.getElementById('updateformId').submit()

                        }

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        } else {
            if (modal_Area != '') {
                document.getElementById('updateformId').submit()

            }
        }

    }

    function getValueForEdit(Area) {

        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getZoneNameCityNameForEdit',
            type: 'post',
            data: {
                Area: Area,
                _token: token
            },
            success: function(data) {
                // console.log(data)

                let userType2 = `<option selected readonly value="${data.areaZoneName.ZoneName}">${data.areaZoneName.ZoneName}</option>`;
                userType2 += '<option disabled readonly value="">Choose userType...</option>';
                data.zones.forEach(el => {
                    userType2 += `
                    <option value="${el.ZoneName}">${el.ZoneName}</option>
                    `;
                    document.getElementById('modal_ZoneName').innerHTML = userType2;
                });


                let userType = `<option selected readonly value="${data.areaCityName.CityName}">${data.areaCityName.CityName}</option>`;
                
                $.ajax({
            url: 'getCitiesOfSelectedZone',
            type: 'get',
            data: {
                ZoneName: data.areaZoneName.ZoneName,
            },
            success: function(data) {
                console.log(data)
                if (data.length != 0) {
                     userType += '<option disabled selected readonly value="">Choose City Name...</option>';
                    data.forEach(el => {
                        userType += `
                        <option value="${el.CityName}">${el.CityName}</option>
                        `;
                        document.getElementById('modal_CityName').innerHTML = userType;
                    });

                } else {
                    let userType = '';
                    document.getElementById('modal_CityName').innerHTML = userType;
                }
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

                

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })


        $.ajax({
            url: 'areaEdit',
            type: 'get',
            data: {
                Area: Area
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('id').value = data.Area;
                document.getElementById('modal_Area').value = data.Area;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection