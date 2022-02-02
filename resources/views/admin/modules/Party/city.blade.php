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
                                    <h3 class="card-title">City</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertCity">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">City Name</label>
                                            <input required id="CityName" onfocusout="checkCityNameDuplication(this.value)" type="text" name="CityName" class="form-control" placeholder="City Name">
                                            <label id="cityError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">City Code</label>
                                            <input required id="CityCode" onfocusout="checkCityCodeDuplication(this.value)" type="text" name="CityCode" class="form-control" placeholder="City Code">
                                            <label id="codeError"></label>
                                        </div>

                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Zone Name</label>
                                            <select required class="form-control select2 select2bs4" name="ZoneName" id="ZoneName">
                                               <option selected disabled >Choose Zone...</option>
                                            @foreach($zones as $zone)
                                                <option value="{{$zone->ZoneName}}">{{$zone->ZoneName}}</option>
                                                @endforeach
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
                                        <th scope="col">City Name</th>
                                        <th scope="col">City Code</th>
                                        <th scope="col">Zone Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cities as $city)
                                    <tr>
                                        <td>{{$city->CityName}}</td>
                                        <td>{{$city->CityCode}}</td>
                                        <td>{{$city->ZoneName}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$city->CityName}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="cityDelete/{{$city->CityName}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit City</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateCity">
                                                @csrf
                                                <input type="hidden" value="" id="id" name="id">
                                                <input type="hidden" value="" id="code" name="code">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">City Name</label>
                                                                <input onfocusout="update_checkCityNameDuplication(this.value)" required type="text" id="modal_CityName" name="CityName" class="form-control" placeholder="City Name">
                                                                <label id="update_cityError"></label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">City Code</label>
                                                                <input onfocusout="update_checkCityCodeDuplication(this.value)" required type="text" id="modal_CityCode" name="CityCode" class="form-control" placeholder="City Code">
                                                                <label id="update_codeError"></label>
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Zone Name</label>
                                                                <select required class="form-control select2 select2bs4" name="ZoneName" id="modal_ZoneName">

                                                                </select>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-2">
                                                            <button style=" margin-top: 32px;" type="submit" class="btn btn-primary">Update</button>

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
    document.getElementById('cityError').style.display = 'none';

    function checkCityNameDuplication(CityName) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: CityName,
                type: 'CityNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('cityError').style.display = 'block';
                    document.getElementById('cityError').style.color = 'red';
                    document.getElementById('cityError').innerText = CityName + " is already added please change value";
                    document.getElementById('CityName').value = '';
                    document.getElementById('CityName').focus();
                } else {
                    document.getElementById('cityError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    document.getElementById('codeError').style.display = 'none';

    function checkCityCodeDuplication(CityCode) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: CityCode,
                type: 'CityCodeCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('codeError').style.display = 'block';
                    document.getElementById('codeError').style.color = 'red';
                    document.getElementById('codeError').innerText = CityCode + " is already added please change value";
                    document.getElementById('CityCode').value = '';
                    document.getElementById('CityCode').focus();
                } else {
                    document.getElementById('codeError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }


    function check() {
       
        var cityValue = '';
        var codeValue = '';
        var count = 0;
        var CityName = document.getElementById('CityName').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: CityName,
                type: 'CityNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('cityError').style.display = 'block';
                    document.getElementById('cityError').style.color = 'red';
                    document.getElementById('cityError').innerText = CityName + " is already added please change value";
                    document.getElementById('CityName').value = '';
                    document.getElementById('CityName').focus();
                } else {
                    cityValue = 'fill';
                    bb(cityValue)
                    document.getElementById('cityError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })

        var CityCode = document.getElementById('CityCode').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: CityCode,
                type: 'CityCodeCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('codeError').style.display = 'block';
                    document.getElementById('codeError').style.color = 'red';
                    document.getElementById('codeError').innerText = CityCode + " is already added please change value";
                    document.getElementById('CityCode').value = '';
                    document.getElementById('CityCode').focus();
                } else {
                    codeValue = 'fill';
                    bb(codeValue)
                    document.getElementById('codeError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })

        function bb(value) {

            if (value != '') {
                count++;
            }
           
            if (count == 2) {
                bbmethod()
            }
        }

        function bbmethod() {
            document.getElementById('formId').submit()
        }


    }


    document.getElementById('update_cityError').style.display = 'none';

    function update_checkCityNameDuplication(update_CityName) {
        var id = document.getElementById('id').value;
        var modal_CityName = document.getElementById('modal_CityName').value;
        if (id != modal_CityName) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: update_CityName,
                    type: 'CityNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_cityError').style.display = 'block';
                        document.getElementById('update_cityError').style.color = 'red';
                        document.getElementById('update_cityError').innerText = update_CityName + " is already added please change value";
                        document.getElementById('modal_CityName').value = '';
                        document.getElementById('modal_CityName').focus();
                    } else {
                        document.getElementById('update_cityError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
    }
    document.getElementById('update_codeError').style.display = 'none';

    function update_checkCityCodeDuplication(update_CityCode) {
        var id = document.getElementById('id').value;
        var modal_CityCode = document.getElementById('modal_CityCode').value;
        if (id != modal_CityCode) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: update_CityCode,
                    type: 'CityCodeCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_codeError').style.display = 'block';
                        document.getElementById('update_codeError').style.color = 'red';
                        document.getElementById('update_codeError').innerText = update_CityCode + " is already added please change value";
                        document.getElementById('modal_CityCode').value = '';
                        document.getElementById('modal_CityCode').focus();
                    } else {
                        document.getElementById('update_codeError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
    }


    function check2() {
        var count = 0;
        var cityValue = '';
        var codeValue = '';

        var id = document.getElementById('id').value;
        var modal_CityName = document.getElementById('modal_CityName').value;
        if (id != modal_CityName) {
           
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: modal_CityName,
                    type: 'CityNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_cityError').style.display = 'block';
                        document.getElementById('update_cityError').style.color = 'red';
                        document.getElementById('update_cityError').innerText = modal_CityName + " is already added please change value";
                        document.getElementById('modal_CityName').value = '';
                        document.getElementById('modal_CityName').focus();
                    } else {
                        cityValue = 'fill';
                        bb(cityValue)
                        document.getElementById('update_cityError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
        else{
       
            cityValue = 'fill';
            bb(cityValue)
        }

        var code = document.getElementById('code').value;
        var modal_CityCode = document.getElementById('modal_CityCode').value;
        if (code != modal_CityCode) {
           
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: modal_CityCode,
                    type: 'CityCodeCheck'
                },
                success: function(data) {
                   
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_codeError').style.display = 'block';
                        document.getElementById('update_codeError').style.color = 'red';
                        document.getElementById('update_codeError').innerText = modal_CityCode + " is already added please change value";
                        document.getElementById('modal_CityCode').value = '';
                        document.getElementById('modal_CityCode').focus();
                    } else {
                        codeValue = 'fill';
                        bb(codeValue)
                        document.getElementById('update_codeError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
        else{
          
            codeValue = 'fill';
            bb(codeValue)
        }
        function bb(value) {

            if (value != '') {
                count++;
            }
          
            if (count == 2) {
                bbmethod()
            }
        }

        function bbmethod() {
            document.getElementById('updateformId').submit()
        }
    }

    function getValueForEdit(CityName) {

        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getZoneNameForEdit',
            type: 'post',
            data: {
                CityName: CityName,
                _token: token
            },
            success: function(data) {
                // console.log(data)
                let userType = `<option selected readonly value="${data.cityZoneName.ZoneName}">${data.cityZoneName.ZoneName}</option>`;
                userType += '<option disabled readonly value="">Choose userType...</option>';
                data.ZoneName.forEach(el => {
                    userType += `
                    <option value="${el.ZoneName}">${el.ZoneName}</option>
                    `;
                    document.getElementById('modal_ZoneName').innerHTML = userType;
                });


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })


        $.ajax({
            url: 'cityEdit',
            type: 'get',
            data: {
                CityName: CityName
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('id').value = data.CityName;
                document.getElementById('code').value = data.CityCode;
                document.getElementById('modal_CityName').value = data.CityName;
                document.getElementById('modal_CityCode').value = data.CityCode;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection