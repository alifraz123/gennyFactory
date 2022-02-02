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
                                    <h3 class="card-title">User Role</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" method="post" id="formId" action="insertRole">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">User Role</label>
                                            <input type="text" id="role" name="role" class="form-control" placeholder="User Role">
                                            <label id="roleError" for=""></label>
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
                                        <th scope="col">User Role</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>{{$role->role}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$role->role}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="roleDelete/{{$role->role}}">Delete</a></td>
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
                                            <form onsubmit="event.preventDefault(); updatecheck();" method="post" id="updateformId" action="updateRole">
                                                @csrf
                                                <input type="hidden" value="" id="modal_id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>User Role</label>
                                                                <input type="text" name="role" id="modal_role" required class="form-control" placeholder="Enter Item Name">
                                                           <label id="errorMessage"></label>
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
    document.getElementById('roleError').style.display = 'none';
    function check() {
        var RoleValue = document.getElementById('role').value;
        if (RoleValue != '') {
            
            // console.log("first")
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: RoleValue
                },
                success: function(data) {
                    console.log("ff :"+data)
                    if (data == "Duplicate") {
                        document.getElementById('roleError').style.display = 'block';
                        document.getElementById('roleError').style.color = 'red';
                        document.getElementById('roleError').innerText = RoleValue + " is already added please change value";
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


    document.getElementById('errorMessage').style.display = 'none';
    function updatecheck() {
        var RoleValue = document.getElementById('modal_role').value;
        var modal_id = document.getElementById('modal_id').value;
        if(modal_id!=RoleValue){
            if (RoleValue != '') {
                // console.log("first")
                $.ajax({
                    url: 'checkDuplication',
                    type: 'get',
                    data: {
                        value: RoleValue
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == "Duplicate") {
                            document.getElementById('errorMessage').style.display = 'block';
                            document.getElementById('errorMessage').style.color = 'red';
                            document.getElementById('errorMessage').innerText = RoleValue + " is already added please change value";
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

    function getValueForEdit(role) {

        $.ajax({
            url: 'roleEdit',
            type: 'get',
            data: {
                role: role
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('modal_id').value = data.role;
                document.getElementById('modal_role').value = data.role;


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection