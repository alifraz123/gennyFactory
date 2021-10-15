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
                                    <h3 class="card-title">Zone</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check()" id="formId" method="post" action="insertZone">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Zone Name</label>
                                            <input id="ZoneName" required onfocusout="checkZoneNameDuplication(this.value)" type="text" name="ZoneName" class="form-control" placeholder="Zone Name">
                                            <label id="zoneError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Zone Code</label>
                                            <input id="ZoneCode" required onfocusout="checkZoneCodeDuplication(this.value)" type="text" name="ZoneCode" class="form-control" placeholder="Zone Code">
                                            <label id="codeError"></label>
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
                                        <th scope="col">Zone Name</th>
                                        <th scope="col">Zone Code</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($zones as $zone)
                                    <tr>
                                        <td>{{$zone->ZoneName}}</td>
                                        <td>{{$zone->ZoneCode}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$zone->ZoneName}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="zoneDelete/{{$zone->ZoneName}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Zone</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); check2()" id="updateformId" method="post" action="updateZone">
                                                @csrf
                                                <input type="hidden" value="" id="id" name="id">
                                                <input type="hidden" value="" id="code" name="code">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Zone Name</label>
                                                                <input required onfocusout="update_checkZoneNameDuplication(this.value)" type="text" id="modal_ZoneName" name="ZoneName" class="form-control" placeholder="Zone Name">
                                                                <label id="update_zoneError"></label>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Zone Code</label>
                                                                <input required onfocusout="update_checkZoneCodeDuplication(this.value)" type="text" id="modal_ZoneCode" name="ZoneCode" class="form-control" placeholder="Zone Code">
                                                                <label id="update_codeError"></label>
                                                            </div>

                                                        </div>

                                                        <div class="col-md-2">
                                                            <button style=" margin-top: 32px;" class="btn btn-primary">Update</button>

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
    var zoneValue = '';
    var codeValue = '';
    document.getElementById('zoneError').style.display = 'none';

    function checkZoneNameDuplication(ZoneName) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: ZoneName,
                type: 'ZoneNameCheck'
            },
            success: function(data) {
                if (data == "Duplicate") {
                    document.getElementById('zoneError').style.display = 'block';
                    document.getElementById('zoneError').style.color = 'red';
                    document.getElementById('zoneError').innerText = ZoneName + " is already added please change value";
                    document.getElementById('ZoneName').value = '';
                    document.getElementById('ZoneName').focus();
                } else {
                    // console.log(data)
                    zoneValue = "zoneValue fill";

                    document.getElementById('zoneError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }



    document.getElementById('codeError').style.display = 'none';

    function checkZoneCodeDuplication(ZoneCode) {

        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: ZoneCode,
                type: 'ZoneCodeCheck'
            },
            success: function(data) {
                if (data == "Duplicate") {
                    document.getElementById('codeError').style.display = 'block';
                    document.getElementById('codeError').style.color = 'red';
                    document.getElementById('codeError').innerText = ZoneCode + " is already added please change value";
                    document.getElementById('ZoneCode').value = '';
                    document.getElementById('ZoneCode').focus();
                } else {

                    codeValue = 'codeValue fill';

                    console.log("nn :" + codeValue)
                    console.log(data)
                    document.getElementById('codeError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }


    function check() {

        var count = 0;
        var ZoneName = document.getElementById('ZoneName').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: ZoneName,
                type: 'ZoneNameCheck'
            },
            success: function(data) {
                if (data == "Duplicate") {
                    document.getElementById('zoneError').style.display = 'block';
                    document.getElementById('zoneError').style.color = 'red';
                    document.getElementById('zoneError').innerText = ZoneName + " is already added please change value";
                    document.getElementById('ZoneName').value = '';
                    document.getElementById('ZoneName').focus();
                } else {
                    // console.log(data)
                    zoneValue = "zoneValue fill";

                    bb(zoneValue)
                    document.getElementById('zoneError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })

        var ZoneCode = document.getElementById('ZoneCode').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: ZoneCode,
                type: 'ZoneCodeCheck'
            },
            success: function(data) {
                if (data == "Duplicate") {
                    document.getElementById('codeError').style.display = 'block';
                    document.getElementById('codeError').style.color = 'red';
                    document.getElementById('codeError').innerText = ZoneCode + " is already added please change value";
                    document.getElementById('ZoneCode').value = '';
                    document.getElementById('ZoneCode').focus();
                } else {

                    codeValue = 'codeValue fill';
                    bb(codeValue)
                    console.log("nn :" + codeValue)
                    console.log(data)
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
            // alert(count)
            if (count == 2) {
                bbmethod()
            }
        }

        function bbmethod() {
            document.getElementById('formId').submit()
        }

    }


    document.getElementById('update_zoneError').style.display = 'none';

    function update_checkZoneNameDuplication(update_ZoneName) {
        var id = document.getElementById('id').value;
        if (id != modal_ZoneName) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: update_ZoneName,
                    type: 'ZoneNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_zoneError').style.display = 'block';
                        document.getElementById('update_zoneError').style.color = 'red';
                        document.getElementById('update_zoneError').innerText = update_ZoneName + " is already added please change value";
                        document.getElementById('modal_ZoneName').value = '';
                        document.getElementById('modal_ZoneName').focus();
                    } else {
                        document.getElementById('update_zoneError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        }
    }

    document.getElementById('update_codeError').style.display = 'none';

    function update_checkZoneCodeDuplication(update_ZoneCode) {
        var id = document.getElementById('id').value;
        if (id != modal_ZoneCode) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: update_ZoneCode,
                    type: 'ZoneCodeCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_codeError').style.display = 'block';
                        document.getElementById('update_codeError').style.color = 'red';
                        document.getElementById('update_codeError').innerText = update_ZoneCode + " is already added please change value";
                        document.getElementById('modal_ZoneCode').value = '';
                        document.getElementById('modal_ZoneCode').focus();
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
        var zoneValue = '';
        var codeValue = '';
        count = 0;
        var id = document.getElementById('id').value;
        var update_ZoneName = document.getElementById('modal_ZoneName').value;
        if (id != update_ZoneName) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: update_ZoneName,
                    type: 'ZoneNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_zoneError').style.display = 'block';
                        document.getElementById('update_zoneError').style.color = 'red';
                        document.getElementById('update_zoneError').innerText = update_ZoneName + " is already added please change value";
                        document.getElementById('modal_ZoneName').value = '';
                        document.getElementById('modal_ZoneName').focus();
                    } else {

                        document.getElementById('update_zoneError').style.display = 'none';
                        zoneValue = 'fill';
                        bb(zoneValue)
                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        } else {
            zoneValue = 'fill';
            bb(zoneValue)
        }

        var update_ZoneCode = document.getElementById('modal_ZoneCode').value
        var id = document.getElementById('id').value;
        if (id != update_ZoneCode) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: update_ZoneCode,
                    type: 'ZoneCodeCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_codeError').style.display = 'block';
                        document.getElementById('update_codeError').style.color = 'red';
                        document.getElementById('update_codeError').innerText = update_ZoneCode + " is already added please change value";
                        document.getElementById('modal_ZoneCode').value = '';
                        document.getElementById('modal_ZoneCode').focus();
                    } else {
                        document.getElementById('update_codeError').style.display = 'none';
                        codeValue = 'fill';
                        bb(codeValue);
                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })

        } else {
            codeValue = 'fill';
            bb(codeValue);
        }

        function bb(value) {

            if (value != '') {
                count++;
            }
            // alert(count)

            if (count == 2) {
                bbmethod()
            }
        }

        function bbmethod() {

            document.getElementById('updateformId').submit()
        }
    }

    function getValueForEdit(ZoneName) {

        $.ajax({
            url: 'zoneEdit',
            type: 'get',
            data: {
                ZoneName: ZoneName
            },
            success: function(data) {
                console.log(data)
                document.getElementById('id').value = data.ZoneName;
                document.getElementById('code').value = data.ZoneCode;
                document.getElementById('modal_ZoneName').value = data.ZoneName;
                document.getElementById('modal_ZoneCode').value = data.ZoneCode;

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection