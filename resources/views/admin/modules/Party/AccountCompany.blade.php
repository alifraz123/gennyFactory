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
                                    <h3 class="card-title">Accounts Company</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertAccountCompany">
                                @csrf
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Account Head</label>
                                            <select id="AccountHeadValue" class="form-control select2 select2bs4" name="AccountHead">
                                                <option disabled selected value="">Select Account Head...</option>
                                                @foreach($parties as $party)
                                                <option value="{{$party->AccountHead}}">{{$party->AccountHead}}</option>
                                                @endforeach
                                            </select>
                                            <label id="accountError"></label>
                                        </div>

                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="">Company Name</label>
                                            <select id="CompanyNameValue" class="form-control select2 select2bs4" name="CompanyName">
                                            <option disabled selected value="">Select Company Name...</option>
                                                @foreach($companies as $company)
                                                <option value="{{$company->CompanyName}}">{{$company->CompanyName}}</option>
                                                @endforeach
                                            </select>
                                            <label id="companyError"></label>
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
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($accountscompanies as $accountCompany)
                                    <tr>
                                        <td>{{$accountCompany->AccountHead}}</td>
                                        <td>{{$accountCompany->CompanyName}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$accountCompany->id}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="accountCompanyDelete/{{$accountCompany->id}}">Delete</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog mw-100 w-50" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit Accounts Company</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="updateAccountCompany">
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
                                                                <label for="">Company Name</label>
                                                                <select class="form-control select2 select2bs4" id="modal_CompanyName" name="CompanyName">

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
    var companyError = document.getElementById('companyError');
    accountError.style.display = "none";
    companyError.style.display = "none"

    function check() {
        var AccountHeadValue = document.getElementById('AccountHeadValue');
        var CompanyNameValue = document.getElementById('CompanyNameValue');

        if (AccountHeadValue.value != '' && CompanyNameValue.value != '') {

            $.ajax({
            url: 'checkDuplication',
            type: 'get',
            data: {
                AccountHeadValue: AccountHeadValue.value,
                CompanyNameValue: CompanyNameValue.value,
                type:'accountCompanyCheck'
            },
            success: function(data) {
                console.log(data)
                if (data == "Duplicate") {
                    accountError.style="display:none";
                    companyError.style = "display:none";
                   alert(CompanyNameValue.value+" is already assigned to "+AccountHeadValue.value+" please change values");
                } else {
                    document.getElementById('formId').submit();
                }

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
            
        }
        if (AccountHeadValue.value == '' && CompanyNameValue.value != '') {
            accountError.innerText = "Please select account head";
            accountError.style = "display:block;color:red";
            
            companyError.style = "display:none";
        }
        if (AccountHeadValue.value != '' && CompanyNameValue.value == '') {
            companyError.innerText = "Please select company";
            companyError.style = "display:block;color:red";
            
            accountError.style = "display:none";
        }
        if (AccountHeadValue.value == '' && CompanyNameValue.value == '') {
            accountError.innerText = "Please select account head";
            accountError.style = "display:block;color:red";

            companyError.innerText = "Please select company name";
            companyError.style = "display:block;color:red";
           
        }

        


    }


    function getValueForEdit(id) {

        $.ajax({
            url: 'accountCompanyEdit',
            type: 'get',
            data: {
                id: id
            },
            success: function(data) {
                console.log(data)
                document.getElementById('modal_id').value = data.id
                let userType = `<option selected readonly value="${data.AccountHead}">${data.AccountHead}</option>`;
                userType += '<option disabled readonly value="">Choose Account Head...</option>';
                data.parties.forEach(el => {
                    userType += `
                    <option value="${el.AccountHead}">${el.AccountHead}</option>
                    `;
                    document.getElementById('modal_AccountHead').innerHTML = userType;
                });

                let userType2 = `<option selected readonly value="${data.CompanyName}">${data.CompanyName}</option>`;
                userType2 += '<option disabled readonly value="">Choose Company Name...</option>';
                data.companies.forEach(el => {
                    userType2 += `
                    <option value="${el.CompanyName}">${el.CompanyName}</option>
                    `;
                    document.getElementById('modal_CompanyName').innerHTML = userType2;
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