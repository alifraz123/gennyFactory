@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="roles" class="row">
                <div class="col-md-12">
                    <div style="margin-top: 15px;" class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Party</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertParty">
                                @csrf
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Party Name *</label>
                                            <input id="PartyName" onfocusout="checkPartyDuplication(this.value)" type="text" required name="PartyName" class="form-control" placeholder="Party Name">
                                            <label id="partyError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Party Type *</label>
                                            <select required class="form-control select2 select2bs4" name="partyType">
                                                <option selected disabled value="">Select party Type</option>
                                                @foreach($partyTypes as $partyType)
                                                <option value="{{$partyType->partyType}}">{{$partyType->partyType}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Party Person</label>
                                            <input type="text" name="PartyPerson" class="form-control" placeholder="Party Person">

                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Cell</label>
                                            <input type="text" name="Cell" class="form-control" placeholder="Cell Number">

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CNIC</label>
                                            <input type="text" name="cnic" class="form-control" placeholder="CNIC">

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">NTN</label>
                                            <input type="text" name="ntn" class="form-control" placeholder="NTN">

                                        </div>

                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Sales Tax</label>
                                            <input type="text" name="st" class="form-control" placeholder="Sales Tax">

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Percent %</label>
                                            <input type="number" name="percent" class="form-control" placeholder="Percent">

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Address</label>
                                            <input type="text" name="addres" class="form-control" placeholder="Address">

                                        </div>

                                    </div>
                                </div>

                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Zone *</label>
                                            <select required onchange="getCitiesOfSelectedZone(this.value)" class="form-control select2 select2bs4" name="zone">
                                                <option selected disabled value="">Select Zone</option>
                                                @foreach($zones as $zone)
                                                <option value="{{$zone->ZoneName}}">{{$zone->ZoneName}}</option>
                                                @endforeach
                                            </select>

                                        </div>


                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">City *</label>
                                            <select required id="City" onchange="getAreaOfSelectedCity(this.value)" class="form-control select2 select2bs4" name="city">


                                            </select>

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Area *</label>
                                            <select required id="Area" class="form-control select2 select2bs4" name="area">

                                            </select>

                                        </div>

                                    </div>
                                </div>


                                <div class="row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Account Head *</label>
                                            <input required class="form-control" value="{{$accountHead}}" readonly name="AccountHead">

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Booker *</label>
                                            <select required class="form-control select2 select2bs4" name="booker">
                                                <option selected disabled value="">Select booker...</option>
                                                @foreach($bookers as $booker)
                                                <option value="{{$booker->EmployeeName}}">{{$booker->EmployeeName}}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">CompanyName</label>
                                            <input required class="form-control" value="{{$companyName}}" readonly name="CompanyName">
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" style="margin-top: 32px;" class="btn btn-success" value="Save">

                                    </div>
                                </div>



                            </form>

                            <table id="example1" class="table ">
                                <thead>
                                    <tr>

                                        <th scope="col">PartyName</th>
                                        <th scope="col">PartyType</th>
                                        <th scope="col">Party Person</th>
                                        <th scope="col">Booker</th>
                                        <th scope="col">Cell</th>
                                        <th scope="col">CNIC</th>
                                        <th scope="col">NTN</th>
                                        <th scope="col">Sales Tax</th>
                                        <th scope="col">Percent%</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Zone</th>
                                        <th scope="col">AccountHead</th>
                                        <th scope="col">Edit</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($parties as $partyType)
                                    <tr>

                                        <td>{{$partyType->PartyName}}</td>
                                        <td>{{$partyType->PartyType}}</td>
                                        <td>{{$partyType->PartyPerson}}</td>
                                        <td>{{$partyType->booker}}</td>
                                        <td>{{$partyType->Cell}}</td>
                                        <td>{{$partyType->CNIC}}</td>
                                        <td>{{$partyType->NTN}}</td>
                                        <td>{{$partyType->SalesTax}}</td>
                                        <td>{{$partyType->Percent}}</td>
                                        <td>{{$partyType->Addres}}</td>
                                        <td>{{$partyType->Status}}</td>
                                        <td>{{$partyType->Area}}</td>
                                        <td>{{$partyType->City}}</td>
                                        <td>{{$partyType->Zone}}</td>
                                        <td>{{$partyType->AccountHead}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$partyType->PartyName}}')">Edit</button></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div style="width: 60%;" class="modal-dialog mw-100 " role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Party</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); check2();" id="updateformId" method="post" action="updateParty">
                                                @csrf
                                                <input type="hidden" id="modal_id" name="id">
                                                <input type="hidden" id="modal_pn" name="id_PartyName">
                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Party Name *</label>
                                                            <input required onfocusout="updateCheckPartyDuplication(this.value)" type="text" id="modal_PartyName" name="PartyName" class="form-control" placeholder="Party Name">
                                                            <label for="" id="updatePartyError"></label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Party Type *</label>
                                                            <select class="form-control select2 select2bs4" id="modal_PartyType" name="PartyType">

                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Party Person</label>
                                                            <input type="text" id="modal_PartyPerson" name="PartyPerson" class="form-control" placeholder="Party Person">

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Cell</label>
                                                            <input type="text" id="modal_Cell" name="Cell" class="form-control" placeholder="Cell Number">

                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">CNIC</label>
                                                            <input type="text" id="modal_cnic" name="CNIC" class="form-control" placeholder="CNIC">

                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">NTN</label>
                                                            <input type="text" id="modal_ntn" name="NTN" class="form-control" placeholder="NTN">

                                                        </div>

                                                    </div>

                                                    <div class="row">

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Sales Tax</label>
                                                            <input type="text" id="modal_st" name="SalesTax" class="form-control" placeholder="Sales Tax">

                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Percent %</label>
                                                            <input type="number" id="modal_percent" name="Percent" class="form-control" placeholder="Percent">

                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Address</label>
                                                            <input type="text" id="modal_addres" name="Addres" class="form-control" placeholder="Address">

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Select Status</label>
                                                            <select id="modal_status" class="form-control" name="Status">

                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Zone *</label>
                                                            <select id="modal_ZoneName" onchange="getCitiesOfSelectedZone2(this.value)" class="form-control select2 select2bs4" name="Zone">

                                                            </select>

                                                        </div>


                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">City *</label>
                                                            <select onchange="getAreaOfSelectedCity2(this.value)" id="modal_CityName" class="form-control select2 select2bs4" name="City">

                                                            </select>

                                                        </div>

                                                    </div>
                                                </div>


                                                <div class="row">

                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Area *</label>
                                                            <select id="modal_Area" class="form-control select2 select2bs4" name="Area">

                                                            </select>

                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Account Head *</label>

                                                            <input class="form-control" value="{{$accountHead}}" id="modal_AccountHead" readonly name="AccountHead">
                                                        </div>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="">Booker *</label>

                                                            <select id="modal_booker" class="form-control select2 select2bs4" name="booker">

                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="submit" class="btn btn-success" value="Update">

                                                    </div>
                                                </div>
                                                <div class="row">


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
    document.getElementById('partyError').style.display = 'none';

    function checkPartyDuplication(PartyName) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: PartyName,
                type: 'PartyNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('partyError').style.display = 'block';
                    document.getElementById('partyError').style.color = 'red';
                    document.getElementById('partyError').innerText = PartyName + " is already added please change value";
                    document.getElementById('PartyName').value = '';
                    document.getElementById('PartyName').focus();
                } else {
                    document.getElementById('partyError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    function check() {
        var PartyName = document.getElementById('PartyName').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: PartyName,
                type: 'PartyNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('partyError').style.display = 'block';
                    document.getElementById('partyError').style.color = 'red';
                    document.getElementById('partyError').innerText = PartyName + " is already added please change value";
                    document.getElementById('PartyName').value = '';
                    document.getElementById('PartyName').focus();
                } else {
                    document.getElementById('partyError').style.display = 'none';
                    if(PartyName!=''){
                        document.getElementById('formId').submit()

                    }

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    document.getElementById('updatePartyError').style.display = 'none';

    function updateCheckPartyDuplication(updatePartyName) {
        var id = document.getElementById('modal_id').value;
        var PartyName = document.getElementById('modal_PartyName').value;
        if (id != PartyName) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: updatePartyName,
                    type: 'PartyNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('updatePartyError').style.display = 'block';
                        document.getElementById('updatePartyError').style.color = 'red';
                        document.getElementById('updatePartyError').innerText = updatePartyName + " is already added please change value";
                        document.getElementById('modal_PartyName').value = '';
                        document.getElementById('modal_PartyName').focus();
                    } else {
                        document.getElementById('updatePartyError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
    }

    function check2() {
        var id = document.getElementById('modal_id').value;
        var PartyName = document.getElementById('modal_PartyName').value;
        if (id != PartyName) {
            var PartyName = document.getElementById('modal_PartyName').value;
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: PartyName,
                    type: 'PartyNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('updatePartyError').style.display = 'block';
                        document.getElementById('updatePartyError').style.color = 'red';
                        document.getElementById('updatePartyError').innerText = PartyName + " is already added please change value";
                        document.getElementById('modal_PartyName').value = '';
                        document.getElementById('modal_PartyName').focus();
                    } else {
                        document.getElementById('updatePartyError').style.display = 'none';
                        if(PartyName!=''){
                            document.getElementById('updateformId').submit()

                        }

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        } else {
            if(PartyName!=''){
                            document.getElementById('updateformId').submit()

                        }
        }
    }

    function getCitiesOfSelectedZone(ZoneName) {
        document.getElementById('City').innerHTML = '';
        document.getElementById('Area').innerHTML = '';
        $.ajax({
            url: 'getCitiesOfSelectedZone',
            type: 'get',
            data: {
                ZoneName: ZoneName
            },
            success: function(data) {
                // console.log(data)

                if (data.length != 0) {
                    var userType = '<option disabled selected value="">Choose City...</option>';
                    data.forEach(el => {
                        userType += `
                    <option value="${el.CityName}">${el.CityName}</option>
                    `;
                        document.getElementById('City').innerHTML = userType;
                    });
                } else {
                    var userType = '';
                    document.getElementById('City').innerHTML = userType;
                }



            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    function getAreaOfSelectedCity(cityName) {

        $.ajax({
            url: 'getCityNameForMakingPartyCode',
            type: 'get',
            data: {
                cityName: cityName
            },
            success: function(data) {
                // console.log(data)
                if (data.length != 0) {

                    var userType = '<option disabled selected value="">Choose Area...</option>';
                    data.forEach(el => {
                        userType += `
                    <option value="${el.Area}">${el.Area}</option>
                    `;
                        document.getElementById('Area').innerHTML = userType;
                    });
                } else {

                    var userType = '';

                    document.getElementById('Area').innerHTML = userType;

                }


            },
            error: function(req, status, error) {
                console.log(error)
            }
        })

    }

    function getCitiesOfSelectedZone2(ZoneName) {
        document.getElementById('modal_CityName').innerHTML = '';
        document.getElementById('modal_Area').innerHTML = '';
        $.ajax({
            url: 'getCitiesOfSelectedZone2',
            type: 'get',
            data: {
                ZoneName: ZoneName
            },
            success: function(data2) {
                // console.log(data2)
                if (data2.length != 0) {
                    var userTypecities = '<option disabled selected value="">Choose City...</option>';
                    data2.forEach(el2 => {
                        userTypecities += `
                        <option value="${el2.CityName}">${el2.CityName}</option>
                        `;
                        document.getElementById('modal_CityName').innerHTML = userTypecities;
                    });

                } else {
                    var userTypecities = '<option disabled selected value="">Choose City...</option>';
                    document.getElementById('modal_CityName').innerHTML = userTypecities;
                }

            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }

    function getAreaOfSelectedCity2(cityName) {
        $.ajax({
            url: 'getCityNameForMakingPartyCode2',
            type: 'get',
            data: {
                cityName: cityName,
               
            },
            success: function(data) {
                console.log(data)
                if (data.length != 0) {
                    var userType = '<option disabled selected value="">Choose Area...</option>';
                    data.forEach(el => {
                        userType += `
                    <option value="${el.Area}">${el.Area}</option>
                    `;
                        document.getElementById('modal_Area').innerHTML = userType;
                    });
                } else {
                    var userType = '';

                    document.getElementById('modal_Area').innerHTML = userType;

                }


            },
            error: function(req, status, error) {
                console.log(error)
            }
        })

    }

    function getValueForEdit(PartyName) {
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getPartyCodeForEdit',
            type: 'post',
            data: {
                PartyName: PartyName,
                _token: token
            },
            success: function(data) {
                // console.log(data)
                let userType = `<option selected readonly value="${data.AccountHead}">${data.AccountHead}</option>`;
                userType += '<option disabled readonly value="">Choose AccountHead...</option>';
                data.companies.forEach(el => {
                    userType += `
                    <option value="${el.CompanyName}">${el.CompanyName}</option>
                    `;
                    document.getElementById('modal_AccountHead').innerHTML = userType;
                });

                let userType2 = `<option selected readonly value="${data.partyPartyType}">${data.partyPartyType}</option>`;
                userType2 += '<option disabled readonly value="">Choose partyType...</option>';
                data.partyTypes.forEach(el => {
                    userType2 += `
                    <option value="${el.partyType}">${el.partyType}</option>
                    `;
                    document.getElementById('modal_PartyType').innerHTML = userType2;
                });

                let userType5 = `<option selected readonly value="${data.zone}">${data.zone}</option>`;
                userType5 += '<option disabled  value="">Choose ZoneName...</option>';
                data.zones.forEach(el => {
                    userType5 += `
                    <option value="${el.ZoneName}">${el.ZoneName}</option>
                    `;
                    document.getElementById('modal_ZoneName').innerHTML = userType5;
                });

                let userType6 = `<option selected readonly value="${data.bookerData}">${data.bookerData}</option>`;
                userType6 += '<option disabled  value="">Choose booker...</option>';
                data.bookers.forEach(el => {
                    userType6 += `
                    <option value="${el.EmployeeName}">${el.EmployeeName}</option>
                    `;
                    document.getElementById('modal_booker').innerHTML = userType6;
                });


                let userType4 = `<option selected readonly value="${data.city}">${data.city}</option>`;
                $.ajax({
                    url: 'getCityNameOfSelectedZone2',
                    type: 'get',
                    data: {
                        ZoneName: data.zone,
                    },
                    success: function(data) {
                        // console.log(data)

                        userType4 += '<option disabled  value="">Choose cityname...</option>';
                        data.forEach(el => {
                            userType4 += `
                    <option value="${el.CityName}">${el.CityName}</option>
                    `;
                            document.getElementById('modal_CityName').innerHTML = userType4;
                        });

                    },
                    error: function(req, status, error) {
                        console.log(error)
                    }
                })




                let userType3 = `<option selected readonly value="oop${data.area}">${data.area}</option>`;
                $.ajax({
                    url: 'getCityNameForMakingPartyCode2',
                    type: 'get',
                    data: {
                        cityName: data.city,
                    },
                    success: function(data) {
                        console.log("ggg "+data)

                        userType3 += '<option disabled  value="">Choose area...</option>';
                        data.forEach(el => {
                            userType3 += `
                    <option value="${el.Area}">${el.Area}</option>
                    `;
                            document.getElementById('modal_Area').innerHTML = userType3;
                        });

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
            url: 'partyEdit',
            type: 'get',
            data: {
                PartyName: PartyName
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('modal_id').value = data.PartyName;
                document.getElementById('modal_pn').value = data.PartyName;
                document.getElementById('modal_PartyName').value = data.PartyName;
                document.getElementById('modal_PartyPerson').value = data.PartyPerson;
                document.getElementById('modal_Cell').value = data.Cell;
                document.getElementById('modal_cnic').value = data.CNIC;
                document.getElementById('modal_ntn').value = data.NTN;
                document.getElementById('modal_st').value = data.SalesTax;
                document.getElementById('modal_percent').value = data.Percent;
                document.getElementById('modal_addres').value = data.Addres;

                let userType = `<option selected readonly value="${data.Status}">${data.Status}</option>`;
                userType += '<option disabled readonly value="">Choose Status...</option>';
                userType += `
                    <option value="Enable">Enable</option>
                    <option value="Disable">Disable</option>
                    `;
                document.getElementById('modal_status').innerHTML = userType;
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection