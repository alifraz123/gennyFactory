@extends('admin/layouts/mainlayout')
@section('content')

<style>
    .container {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        width: 100%;
    }

    input[type="file"] {
        position: absolute;
        z-index: -1;
        top: 10px;
        left: 8px;
        font-size: 17px;
        color: #b8b8b8;
    }

    .button-wrap {
        position: relative;
    }

    .button {
        display: inline-block;
        padding: 12px 18px;
        cursor: pointer;
        border-radius: 5px;
        background-color: #8ebf42;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
    }
</style>

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="roles" class="row">
                <div class="col-md-12">
                    @if (session('status'))
                    <h6 class="alert alert-success">{{ session('status') }}</h6>
                    @endif
                    <div class="card card-default" style="margin-top: 15px;">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">Create User</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" method="post" id="formId" enctype="multipart/form-data" action="insertCreatedUser">
                                @csrf
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="text" required onfocusout="chechNameDuplication(this.value)" id="name" name="name" class="form-control" placeholder="Name">
                                                    <label id="nameError" for=""></label>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Email</label>
                                                    <input type="email" required onfocusout="chechEmailDuplication(this.value)" id="email" name="email" class="form-control" placeholder="Email">
                                                    <label id="emailError" for=""></label>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Password</label>
                                                    <input required type="text" name="password" class="form-control" placeholder="Password">

                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>userType</label>
                                                        <select required name="userType" class="form-control select2bs4" style="width: 100%;">
                                                            <option disabled selected>Select a userType</option>
                                                            @foreach($userData as $userType)
                                                            <option value="{{$userType->userType}}">{{$userType->userType}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Role</label>
                                                    <select required class="select2" name="role[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                                        @foreach($roles as $role)
                                                        <option value="{{$role->role}}">{{$role->role}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Cell</label>
                                                    <input required type="text" name="cell" class="form-control" placeholder="Cell">

                                                </div>

                                            </div>

                                        </div>



                                    </div>
                                    <div class="col-md-4">

                                        <div style="display: flex; justify-content:center;margin-bottom:20px" class="row">
                                            <img id="image" src="adminassets/dist/img/avatar5.png" style="border-radius:50%;width: 150px;height:150px" alt="">

                                        </div>


                                        <div style="display: flex; justify-content:center" class="row">
                                            <div class="form-group">
                                                <label class="button" for="upload">
                                                    Choose file
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                        <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                                    </svg>

                                                </label>
                                                <input required id="upload" name="image" type="file">

                                            </div>

                                        </div>

                                    </div>
                                    <div class="col-md-2">
                                        <input type="submit" style="margin-bottom: 30px;" class="btn btn-success" value="Save">

                                    </div>
                                </div>

                        </div>

                    </div>

                    </form>

                    <table id="example1" class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>

                                <th scope="col">userType</th>
                                <th scope="col">Role</th>
                                <th scope="col">Cell</th>

                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>

                                <td>{{$user->userType}}</td>
                                <td>{{$user->role}}</td>
                                <td>{{$user->cell}}</td>

                                <td><button class="btn btn-success" onclick="getValueForEdit('{{$user->id}}')">Edit</button></td>
                                <td><a class="btn btn-danger" href="createdUserDelete/{{$user->id}}">Delete</a></td>
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
                                    <form method="post" onsubmit="event.preventDefault(); check2();" id="updateformId" enctype="multipart/form-data" action="updateCreatedUser">
                                        @csrf
                                        <input type="hidden" name="modal_id" id="modal_id">
                                        <input type="hidden" name="modal_idname" id="modal_idname">
                                        <input type="hidden" name="modal_idemail" id="modal_idemail">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Name</label>
                                                            <input type="text" required onfocusout="updateNameCheck(this.value)" name="modal_name" id="modal_name" class="form-control" placeholder="Name">
                                                            <label id="update_nameError"></label>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <input type="email" required onfocusout="updateEmailCheck(this.value)" name="modal_email" id="modal_email" class="form-control" placeholder="Email">
                                                            <label id="update_emailError"></label>
                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Password</label>
                                                            <input type="text" required id="modal_password" name="modal_password" class="form-control" placeholder="Password">

                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <label>userType</label>
                                                                <select required name="modal_userType" id="modal_userType" class="form-control select2bs4" style="width: 100%;">


                                                                </select>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Role</label>
                                                            <select required class="select2" id="modal_role" name="modal_role[]" multiple="multiple" data-placeholder="Select a Role" style="width: 100%;">

                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Cell</label>
                                                            <input required type="text" id="modal_cell" name="modal_cell" class="form-control" placeholder="Cell">

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <input type="submit" style="margin-bottom: 30px;" class="btn btn-success" value="Update">

                                                    </div>

                                                </div>

                                            </div>
                                            <div class="col-md-4">

                                                <div style="display: flex; justify-content:center;margin-bottom:20px" class="row">
                                                    <img id="modal_image" style="border-radius:50%;width: 150px;height:150px" alt="">

                                                </div>


                                                <div style="display: flex; justify-content:center" class="row">
                                                    <div class="form-group">
                                                        <label class="button" for="modal_upload">
                                                            Choose file
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-card-image" viewBox="0 0 16 16">
                                                                <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                                                <path d="M1.5 2A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13zm13 1a.5.5 0 0 1 .5.5v6l-3.775-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12v.54A.505.505 0 0 1 1 12.5v-9a.5.5 0 0 1 .5-.5h13z" />
                                                            </svg>

                                                        </label>
                                                        <input id="modal_upload" name="modal_image" type="file">

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                </div>

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
    document.getElementById('nameError').style.display = 'none';

    function chechNameDuplication(name) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: name,
                type: 'createUserNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('nameError').style.display = 'block';
                    document.getElementById('nameError').style.color = 'red';
                    document.getElementById('nameError').innerText = name + " is already added please change value";
                    document.getElementById('name').value = '';
                    document.getElementById('name').focus();
                } else {
                    document.getElementById('nameError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
    }


    document.getElementById('update_nameError').style.display = 'none';

    function updateNameCheck(name) {
        var modal_id = document.getElementById('modal_idname').value;
        if (modal_id != name) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: name,
                    type: 'createUserNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_nameError').style.display = 'block';
                        document.getElementById('update_nameError').style.color = 'red';
                        document.getElementById('update_nameError').innerText = name + " is already added please change value";
                        document.getElementById('modal_name').value = '';
                        document.getElementById('modal_name').focus();
                    } else {
                        document.getElementById('update_nameError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        }
    }

    function check() {
        var nameValue = '';
        var emailValue = '';
        var name = document.getElementById('name').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: name,
                type: 'createUserNameCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {

                    document.getElementById('nameError').style.display = 'block';
                    document.getElementById('nameError').style.color = 'red';
                    document.getElementById('nameError').innerText = name + " is already added please change value";
                    document.getElementById('name').value = '';
                    document.getElementById('name').focus();
                } else {
                    nameValue = 'fill';
                    bb(nameValue);
                    document.getElementById('nameError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })

        var email = document.getElementById('email').value;
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: email,
                type: 'createUserEmailCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {

                    document.getElementById('emailError').style.display = 'block';
                    document.getElementById('emailError').style.color = 'red';
                    document.getElementById('emailError').innerText = email + " is already added please change value";
                    document.getElementById('email').value = '';
                    document.getElementById('email').focus();
                } else {
                    emailValue = 'fill';
                    bb(emailValue);
                    document.getElementById('emailError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error)
            }
        })
        var count = 0;

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

    document.getElementById('emailError').style.display = 'none';

    function chechEmailDuplication(email) {
        $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                value: email,
                type: 'createUserEmailCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    document.getElementById('emailError').style.display = 'block';
                    document.getElementById('emailError').style.color = 'red';
                    document.getElementById('emailError').innerText = email + " is already added please change value";
                    document.getElementById('email').value = '';
                    document.getElementById('email').focus();
                } else {
                    document.getElementById('emailError').style.display = 'none';

                }
            },
            error: function(req, status, error) {
                console.log(error);
            }
        })
    }

    document.getElementById('update_emailError').style.display = 'none';

    function updateEmailCheck(email) {
        var modal_id = document.getElementById('modal_idemail').value;
        if (modal_id != email) {
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: email,
                    type: 'createUserEmailCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_emailError').style.display = 'block';
                        document.getElementById('update_emailError').style.color = 'red';
                        document.getElementById('update_emailError').innerText = email + " is already added please change value";
                        document.getElementById('modal_email').value = '';
                        document.getElementById('modal_email').focus();
                    } else {
                        document.getElementById('update_emailError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        }
    }




    function check2() {
        var updateNameValue = '';
        var updateEmailValue = '';
        var count = 0;
        var name = document.getElementById('modal_name').value;
        var modal_id = document.getElementById('modal_idname').value;
        if (modal_id != name) {
            updateNameValue = '';
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: name,
                    type: 'createUserNameCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                       
                        document.getElementById('update_nameError').style.display = 'block';
                        document.getElementById('update_nameError').style.color = 'red';
                        document.getElementById('update_nameError').innerText = name + " is already added please change value";
                        document.getElementById('modal_name').value = '';
                        document.getElementById('modal_name').focus();
                    } else {
                        updateNameValue = 'fill';
                        bb(updateNameValue)
                        document.getElementById('update_nameError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        } else {
            updateNameValue = 'fill';
           
            bb(updateNameValue)
        }

        var email = document.getElementById('modal_email').value;
        var modal_id = document.getElementById('modal_idemail').value;
        if (modal_id != email) {
            updateEmailValue = '';
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: email,
                    type: 'createUserEmailCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('update_emailError').style.display = 'block';
                        document.getElementById('update_emailError').style.color = 'red';
                        document.getElementById('update_emailError').innerText = email + " is already added please change value";
                        document.getElementById('modal_email').value = '';
                        document.getElementById('modal_email').focus();
                    } else {
                        
                        updateEmailValue = 'fill';
                        bb(updateEmailValue)
                        document.getElementById('update_emailError').style.display = 'none';

                    }
                },
                error: function(req, status, error) {
                    console.log(error)
                }
            })
        } else {
            updateEmailValue = 'fill';
          
            bb(updateEmailValue)
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

    let input = document.getElementById('upload');
    let img = document.getElementById('image');

    input.addEventListener('change', () => {
        let file = input.files[0];

        if (file) {
            let reader = new FileReader();
            reader.addEventListener('load', () => img.src = reader.result);
            reader.readAsDataURL(file);
        } else {
            img.src = "images/blank.png";

        }
    });
    let input2 = document.getElementById('modal_upload');
    let img2 = document.getElementById('modal_image');

    input2.addEventListener('change', () => {
        let file = input2.files[0];

        if (file) {
            let reader = new FileReader();
            reader.addEventListener('load', () => img2.src = reader.result);
            reader.readAsDataURL(file);
        } else {
            img2.src = "images/blank.png";

        }
    });

    function getUserTypeAndRoleFromDB(id) {
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getUserTypeAndRoleFromDB',
            type: 'post',
            data: {
                id: id,
                _token: token
            },
            success: function(data) {
                // console.log(data.role.role)
                var abc = JSON.parse(data.role.role);
                if (data) {
                    let userType = `<option selected readonly value="${data.userType.userType}">${data.userType.userType}</option>`;
                    userType += '<option disabled readonly value="">Choose userType...</option>';
                    data.userTypeData.forEach(el => {
                        userType += `
                    <option value="${el.userType}">${el.userType}</option>
                    `;
                        document.getElementById('modal_userType').innerHTML = userType;
                    });

                    let roleValues = '';
                    if (abc != null) {
                        for (var a = 0; a < abc.length; a++) {
                            roleValues += `<option selected  value="${abc[a]}">${abc[a]}</option>`;
                        }

                    }
                    roleValues += '<option disabled readonly value="">Choose roles...</option>';
                    data.roles.forEach(el => {
                        roleValues += `
                    <option value="${el.role}">${el.role}</option>
                    `;
                        document.getElementById('modal_role').innerHTML = roleValues;
                    });


                }


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
    }

    function getValueForEdit(id) {
        getUserTypeAndRoleFromDB(id);
        $.ajax({
            url: 'createdUserEdit',
            type: 'get',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('modal_id').value = data.id;
                document.getElementById('modal_idname').value = data.name;
                document.getElementById('modal_idemail').value = data.email;
                document.getElementById('modal_name').value = data.name;
                document.getElementById('modal_email').value = data.email;
                document.getElementById('modal_password').value = data.password;
                document.getElementById('modal_cell').value = data.cell;
                if (data.image != null) {

                    document.getElementById('modal_image').src = '../storage/app/' + data.image;

                }


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection