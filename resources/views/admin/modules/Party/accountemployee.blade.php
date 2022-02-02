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
                                    <h3 class="card-title">Accounts Employee</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertAccountEmployee">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Account Head</label>
                                            <select id="AccountHeadValue" class="form-control select2 select2bs4" name="AccountHead">
                                                <option disabled selected value="">Select Account Head...</option>
                                                @foreach($userAccount_AccountHeads as $userAccount_AccountHead)
                                                <option value="{{$userAccount_AccountHead->AccountHead}}">{{$userAccount_AccountHead->AccountHead}}</option>
                                                @endforeach
                                            </select>
                                            <label id="accountError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Employee Name</label>
                                            <select id="EmployeeNameValue" class="form-control select2 select2bs4" name="EmployeeName">
                                            <option disabled selected value="">Select Employee Name...</option>
                                                @foreach($names as $name)
                                                <option value="{{$name->name}}">{{$name->name}}</option>
                                                @endforeach
                                            </select>
                                            <label id="employeeNameError"></label>
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
                                        <th scope="col">Account Head</th>
                                        <th scope="col">Employee Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accountemployees as $accountemployee)
                                    <tr>
                                        <td>{{$accountemployee->AccountHead}}</td>
                                        <td>{{$accountemployee->EmployeeName}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$accountemployee->id}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="accountEmployeeDelete/{{$accountemployee->id}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Accounts Employee</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="updateAccountEmployee">
                                                @csrf
                                                <input type="hidden" value="" id="modal_id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Account Head</label>
                                                                <select class="form-control select2 select2bs4" id="modal_AccountHead" name="AccountHead">

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="col-md-5">
                                                            <div class="form-group">
                                                                <label for="">Employee Name</label>
                                                                <select class="form-control select2 select2bs4" id="modal_EmployeeName" name="EmployeeName">

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

var accountError = document.getElementById('accountError');
    var employeeNameError = document.getElementById('employeeNameError');
    accountError.style.display = "none";
    employeeNameError.style.display = "none"

    function check() {
        var AccountHeadValue = document.getElementById('AccountHeadValue');
        var EmployeeNameValue = document.getElementById('EmployeeNameValue');

        if (AccountHeadValue.value != '' && EmployeeNameValue.value != '') {
            $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                AccountHeadValue: AccountHeadValue.value,
                EmployeeNameValue: EmployeeNameValue.value,
                type:'accountEmployeeCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    accountError.style = "display:none";
                    employeeNameError.style="display:none";
                   alert(AccountHeadValue.value+" is already assigned to "+EmployeeNameValue.value+" please change values");
                } else {
                    document.getElementById('formId').submit();
                }

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        }
        if (AccountHeadValue.value == '' && EmployeeNameValue.value != '') {
            accountError.innerText = "Please select account head";
            accountError.style = "display:block;color:red";

            employeeNameError.style = "display:none";
        }
        if (AccountHeadValue.value != '' && EmployeeNameValue.value == '') {
            employeeNameError.innerText = "Please select employee name";
            employeeNameError.style = "display:block;color:red";

            accountError.style = "display:none";
        }
        if (AccountHeadValue.value == '' && EmployeeNameValue.value == '') {
            accountError.innerText = "Please select account head";
            accountError.style = "display:block;color:red";

            employeeNameError.innerText = "Please select employee name";
            employeeNameError.style = "display:block;color:red";

        }
    }



    function getValueForEdit(id) {

        $.ajax({
            url: 'accountEmployeeEdit',
            type: 'get',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data)
                document.getElementById('modal_id').value = data.id
                let userType = `<option selected readonly value="${data.AccountHead}">${data.AccountHead}</option>`;
                userType += '<option disabled readonly value="">Choose Account Head...</option>';
                data.AccountHeads.forEach(el => {
                    userType += `
                    <option value="${el.AccountHead}">${el.AccountHead}</option>
                    `;
                    document.getElementById('modal_AccountHead').innerHTML = userType;
                });

                let userType2 = `<option selected readonly value="${data.EmployeeName}">${data.EmployeeName}</option>`;
                userType2 += '<option disabled readonly value="">Choose Employee Name...</option>';
                data.employees.forEach(el => {
                    userType2 += `
                    <option value="${el.name}">${el.name}</option>
                    `;
                    document.getElementById('modal_EmployeeName').innerHTML = userType2;
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