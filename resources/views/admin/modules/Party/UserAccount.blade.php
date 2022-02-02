@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div class="container-fluid">
            <div id="zones" class="row">
                <div class="col-md-12">
                    <div style="margin-top: 15px;" class="card card-default">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3 class="card-title">User Accounts</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertUserAccount">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">User Name</label>
                                            <select id="UserNameValue" class="form-control select2 select2bs4" name="UserName">
                                                <option disabled selected value="">Select UserName...</option>
                                                @foreach($usernames as $username)
                                                <option value="{{$username->name}}">{{$username->name}}</option>
                                                @endforeach
                                            </select>
                                            <label id="nameError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Account Head</label>
                                            <select id="AccountHeadValue" class="form-control select2 select2bs4" name="AccountHead">
                                                <option disabled selected value="">Select AccountHead...</option>
                                                @foreach($parties as $party)
                                                <option value="{{$party}}">{{$party}}</option>
                                                @endforeach
                                            </select>
                                            <label id="accountError"></label>
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
                                        <th scope="col">User Name</th>
                                        <th scope="col">Account Head</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($useraccounts as $useraccount)
                                    <tr>
                                        <td>{{$useraccount->UserName}}</td>
                                        <td>{{$useraccount->AccountHead}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$useraccount->id}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="userAccountDelete/{{$useraccount->id}}">Delete</a></td>
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
                                            <form method="post" action="updateUserAccount">
                                                @csrf
                                                <input type="hidden" value="" id="modal_id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">User Name</label>
                                                                <select class="form-control select2 select2bs4" id="modal_UserName" name="UserName">

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Account Head</label>
                                                                <select class="form-control select2 select2bs4" id="modal_AccountHead" name="AccountHead">

                                                                </select>
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
    var NameError = document.getElementById('nameError');
    var AccountError = document.getElementById('accountError');
    NameError.style.display = "none";
    AccountError.style.display = "none"

    function check() {
        var UserName = document.getElementById('UserNameValue');
        var AccountHead = document.getElementById('AccountHeadValue');

        if (UserName.value != '' && AccountHead.value != '') {
            $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                UserName: UserName.value,
                AccountHead: AccountHead.value,
                type:'userAccountCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    NameError.style="display:none";
                    AccountError.style = "display:none";
                   alert(AccountHead.value+" is already assigned to "+UserName.value+" please change values");
                } else {
                    document.getElementById('formId').submit();
                }

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        }
        if (UserName.value == '' && AccountHead.value != '') {
            NameError.innerText = "Please select user name";
            NameError.style = "display:block;color:red";
            
            AccountError.style = "display:none";
        }
        if (UserName.value != '' && AccountHead.value == '') {
            AccountError.innerText = "Please select account head";
            AccountError.style = "display:block;color:red";
            
            NameError.style = "display:none";
        }
        if (UserName.value == '' && AccountHead.value == '') {
            NameError.innerText = "Please select user name";
            NameError.style = "display:block;color:red";

            AccountError.innerText = "Please select account head";
            AccountError.style = "display:block;color:red";
           
        }
    }


    function getValueForEdit(id) {

        $.ajax({
            url: 'userAccountEdit',
            type: 'get',
            data: {
                id: id
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('modal_id').value = data.id
                let userType = `<option selected readonly value="${data.UserName}">${data.UserName}</option>`;
                userType += '<option disabled  value="">Choose UserName...</option>';
                data.usernames.forEach(el => {
                    userType += `
                    <option value="${el.name}">${el.name}</option>
                    `;
                    document.getElementById('modal_UserName').innerHTML = userType;
                });

                let userType2 = `<option selected readonly value="${data.AccountHead}">${data.AccountHead}</option>`;
                userType2 += '<option disabled  value="">Choose AccountHead...</option>';
                data.parties.forEach(el => {
                    userType2 += `
                    <option value="${el.PartyName}">${el.PartyName}</option>
                    `;
                    document.getElementById('modal_AccountHead').innerHTML = userType2;
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