@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        @if(session('status'))
        <div class="alert alert-success">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            {{session('status')}}
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            {{session('failed')}}
        </div>
        @endif

        <div class="container-fluid">

            <div class="row">
                <h4>Company</h4>
            </div>
            <div class="card card-body">


                <form method="post" action="save_company">
                    @csrf

                    <div class="row">
                        <div class="col-sm-5">
                            <!-- text input -->
                            <div class="form-group">
                                <label>Company</label>
                                <input type="text" name="company" required class="form-control" placeholder="Enter Company Name">
                            </div>
                        </div>

                        <div class="col-md-2">
                            <button style="margin-top:32px;" type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                   
                </form>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog mw-100 w-50" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Company</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="edit_company">
                                @csrf
                                <input type="hidden" value="" id="id" name="id">
                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-8">
                                            <div class="form-group">
                                                <label>Company</label>
                                                <input type="text"  id="company" name="Company" value="" required class="form-control" placeholder="Enter Company">
                                            </div>
                                        </div>
                                        <div class="col-md-2">

                                            <button style="margin-top:32px" type="submit" class="btn btn-primary">Update</button>
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


            <div class="card card-primary">

                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>

                                <th>Company</th>

                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody id="companydata">
                            @foreach($companies as $company)
                            <tr>
                                <td> {{$company->companyName}}</td>

                                <td><button onclick="show_modal('{{$company->companyName}}')" class="btn btn-success">Edit</button> </td>
                                <td><a href='delete_company/{{$company->companyName}}' class="btn btn-danger">Delete</a> </td>
                            </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
                <!-- /.card-body -->
            </div>



        </div>
</div>
</section>
<script>
    function show_modal(company) {
        document.getElementById('company').value = company;
        document.getElementById('id').value = company;
        $('#exampleModal').modal('show');
    }
</script>


@endsection