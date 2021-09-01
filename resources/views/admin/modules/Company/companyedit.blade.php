@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div style="margin-top: 1rem;" class="container-fluid">
        
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Company Data</h3>
                        </div>
                      
                        <form method="post" action="../edit_company">
                            @csrf
                            <input type="hidden" value="{{$company[0]->companyName}}" name="id">
                            <div class="card-body">
                                <div class="row">
                                   
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Company</label>
                                            <input type="text" name="Company" value="{{$company[0]->companyName}}" required class="form-control" placeholder="Enter Company">
                                        </div>
                                    </div>
                                </div>
                               
                                <button style="float:right; margin-right:32rem; margin-top: -55px;" type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="card-footer">
                            </div>
                        </form>
                    </div>
                </div>
            </div>


           



        </div>
</div>
</section>
@endsection