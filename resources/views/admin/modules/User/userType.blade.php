@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
           

            <div  class="row">
                <div class="col-md-12">
                @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                    @endif
                    <div style="margin-top: 15px;" class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">User Type</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form method="post" onsubmit="event.preventDefault(); check();" id="formId" action="insertUserType">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">User Type</label>
                                            <input type="text" id="userType" name="userType" class="form-control" placeholder="User Type">
                                            <label id="errorMessage" for=""></label>
                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" style="margin-top: 32px;" class="btn btn-success" value="Save">

                                    </div>

                                </div>
                            </form>


                            
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit UserType</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form onsubmit="event.preventDefault(); updatecheck();" method="post" id="updateformId" action="updateUserType">
                                                @csrf
                                                <input type="hidden" value="" id="modal_id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>UserType</label>
                                                                <input type="text" name="userType" id="modal_userType" required class="form-control" placeholder="Enter UserType">
                                                           <label id="modal_errorMessage"></label>
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

                            <table id="example2" class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">User Role</th>
                                                <th scope="col">Edit</th>
                                                <th scope="col">Delte</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($userTypes as $userType)
                                            <tr>
                                                <td>{{$userType->userType}}</td>
                                                <td><button class="btn btn-success" onclick="getValueForEdit('{{$userType->userType}}')">Edit</button></td>
                                                <td><a class="btn btn-danger" href="userTypeDelete/{{$userType->userType}}">Delete</a></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>


<script>
    document.getElementById('errorMessage').style.display = 'none';
    function check() {
        var recieveValue = document.getElementById('userType').value;
        if (recieveValue != '') {
            // console.log("first")
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: recieveValue,
                    type:'userType'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('errorMessage').style.display = 'block';
                        document.getElementById('errorMessage').style.color = 'red';
                        document.getElementById('errorMessage').innerText = recieveValue + " is already added please change value";
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

    document.getElementById('modal_errorMessage').style.display = 'none';
    function updatecheck() {
        var RoleValue = document.getElementById('modal_userType').value;
        var modal_id = document.getElementById('modal_id').value;
        if(modal_id!=RoleValue){
            if (RoleValue != '') {
                // console.log("first")
                $.ajax({
                    url: 'checkDuplication',
                    type: 'get',
                    data: {
                        value: RoleValue,
                    type:'userType'
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == "Duplicate") {
                            document.getElementById('modal_errorMessage').style.display = 'block';
                            document.getElementById('modal_errorMessage').style.color = 'red';
                            document.getElementById('modal_errorMessage').innerText = RoleValue + " is already added please change value";
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

    function getValueForEdit(userType){
        
        $.ajax({
            url: 'userTypeEdit',
            type: 'get',
            data: {
                userType: userType
            },
            success: function(data) {
                console.log(data)
                document.getElementById('modal_id').value = data.userType;
                document.getElementById('modal_userType').value = data.userType;
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection