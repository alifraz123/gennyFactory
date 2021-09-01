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
                        
                    </div>

                    <button style="float:right; margin-right:32rem; margin-top: -54px;" type="submit" class="btn btn-primary">Submit</button>

                </form>
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
                                
                                <td><a href='edit_company/{{$company->companyName}}' class="btn btn-success">Edit</a> </td>
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



@endsection