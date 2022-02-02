@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="roles" class="row">
                <div class="col-md-12">
                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                    @endif
                    <div style="margin-top: 15px;" class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Party Type</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertPartyType">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Party Type Name</label>
                                            <input id="partyType" required type="text" name="partyType" class="form-control" placeholder="Party Type Name">
                                            <label id="partyError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="button" style="margin-top: 32px;" class="btn btn-success" value="Save">

                                    </div>



                                </div>
                            </form>

                            <table id="example1" class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Party Type Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($partyTypes as $partyType)
                                    <tr>
                                        <td>{{$partyType->partyType}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$partyType->partyType}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="partyTypeDelete/{{$partyType->partyType}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Role</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); updatecheck();" id="updateformId" method="post" action="updatePartyType">
                                                @csrf
                                                <input type="hidden" value="" id="id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>Party Type Name</label>
                                                                <input type="text" name="partyType" id="modal_partyType" required class="form-control" >
                                                            <label id="updatePartyError"></label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-2">
                                                            <button style=" margin-top: 32px;"  class="btn btn-primary">Update</button>

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
    document.getElementById('partyType').focus()

document.getElementById('partyError').style.display = 'none';
    function check() {
        var RoleValue = document.getElementById('partyType').value;
        if (RoleValue != '') {
            // console.log("first")
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: RoleValue,
                    type:'partyTypeCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('partyError').style.display = 'block';
                        document.getElementById('partyError').style.color = 'red';
                        document.getElementById('partyError').innerText = RoleValue + " is already added please change value";
                    } else {

                        document.getElementById('formId').submit()
                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        }

    }


    document.getElementById('updatePartyError').style.display = 'none';
    function updatecheck() {
        var RoleValue = document.getElementById('modal_partyType').value;
        var modal_id = document.getElementById('id').value;
        if(modal_id!=RoleValue){
            if (RoleValue != '') {
                // console.log("first")
                $.ajax({
                    url: 'checkDuplication',
                    type: 'get',
                    data: {
                        value: RoleValue,
                        type:'partyTypeCheck'
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == "Duplicate") {
                            document.getElementById('updatePartyError').style.display = 'block';
                            document.getElementById('updatePartyError').style.color = 'red';
                            document.getElementById('updatePartyError').innerText = RoleValue + " is already added please change value";
                        } else {
    
                            document.getElementById('updateformId').submit()
                        }
                    },
                    error: function(req, status, error) {
                        console.log(error)
                    }
                })
            } 
        }
        else{
            document.getElementById('updateformId').submit()
        }

    }


    function getValueForEdit(partyType) {
        
        $.ajax({
            url: 'partyTypeEdit',
            type: 'get',
            data: {
                partyType: partyType
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('id').value = data.partyType;
                document.getElementById('modal_partyType').value = data.partyType;


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection