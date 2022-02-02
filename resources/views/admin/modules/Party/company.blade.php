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
                                    <h3 class="card-title">Company</h3>
                                </div>

                            </div>

                        </div>
                        <div class=" card-body">
                            <form onsubmit="event.preventDefault(); check();" id="formId" method="post" action="insertCompany">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Company Name</label>
                                            <input required  id="company" type="text" name="company" class="form-control" placeholder="Company Name">
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
                                        <th scope="col">Company Name</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delte</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $company)
                                    <tr>
                                        <td>{{$company->CompanyName}}</td>
                                        <td><button class="btn btn-success" onclick="getValueForEdit('{{$company->CompanyName}}')">Edit</button></td>
                                        <td><a class="btn btn-danger" href="companyDelete/{{$company->CompanyName}}">Delete</a></td>
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
                                            <form onsubmit="event.preventDefault(); updatecheck();" id="updateformId" method="post" action="updateCompany">
                                                @csrf
                                                <input type="hidden" value="" id="modal_id" name="id">
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-sm-5">
                                                            <!-- text input -->
                                                            <div class="form-group">
                                                                <label>Company Name</label>
                                                                <input required type="text" name="company" id="modal_company" required class="form-control">
                                                            <label id="updateCompanyError"></label>
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

document.getElementById('companyError').style.display = 'none';
    function check() {
        var RoleValue = document.getElementById('company').value;
        if (RoleValue != '') {
            // console.log("first")
            $.ajax({
                url: 'checkDuplication',
                type: 'get',
                data: {
                    value: RoleValue,
                    type:'companyCheck'
                },
                success: function(data) {
                    console.log(data)
                    if (data == "Duplicate") {
                        document.getElementById('companyError').style.display = 'block';
                        document.getElementById('companyError').style.color = 'red';
                        document.getElementById('companyError').innerText = RoleValue + " is already added please change value";
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


    document.getElementById('updateCompanyError').style.display = 'none';
    function updatecheck() {
        var RoleValue = document.getElementById('modal_company').value;
        var modal_id = document.getElementById('modal_id').value;
        console.log(RoleValue+modal_id)
        if(modal_id!=RoleValue){
            if (RoleValue != '') {
                // console.log("first")
                $.ajax({
                    url: 'checkDuplication',
                    type: 'get',
                    data: {
                        value: RoleValue,
                        type:'companyCheck'
                    },
                    success: function(data) {
                        console.log(data)
                        if (data == "Duplicate") {
                            document.getElementById('updateCompanyError').style.display = 'block';
                            document.getElementById('updateCompanyError').style.color = 'red';
                            document.getElementById('updateCompanyError').innerText = RoleValue + " is already added please change value";
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


    function getValueForEdit(company) {

        $.ajax({
            url: 'companyEdit',
            type: 'get',
            data: {
                company: company
            },
            success: function(data) {
                console.log(data)
                document.getElementById('modal_id').value = data.CompanyName;
                document.getElementById('modal_company').value = data.CompanyName;


            },
            error: function(req, status, error) {
                console.log(error)

            }
        })
        $('#exampleModal').modal('show');
    }
</script>
@endsection