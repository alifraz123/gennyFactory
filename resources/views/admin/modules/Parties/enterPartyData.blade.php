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
                            <h3 class="card-title">Parties Data</h3>
                        </div>
                        <form method="post" action="save_partydata">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Enter Party Code</label>
                                            <input type="text" name="PartyCode" value="{{$pc}}" required class="form-control" placeholder="Enter Party Code">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Enter Party Name</label>
                                            <input type="text" name="PartyName" required class="form-control" placeholder="Enter Party Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Enter CNIC</label>
                                            <input type="number" name="CNIC" required class="form-control" placeholder="Enter CNIC">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Enter NTN</label>
                                            <input type="text" name="NTN" required class="form-control" placeholder="Enter NTN">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Enter Sales Tax</label>
                                            <input type="text" name="SalesTex" required class="form-control" placeholder="Enter Company Name">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Enter Cell</label>
                                            <input type="number" name="Cell" required class="form-control" placeholder="Enter Sales Tax">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label>Enter Address</label>
                                            <input type="text" name="Adress" required class="form-control" placeholder="Enter Address">
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label>Enter City</label>
                                           
<select name="City" required class="form-control">
@foreach($data as $partydata)
    <option value="{{$partydata->CityName}}"> {{$partydata->CityName}}</option>
    @endforeach
</select>
                                            

                                            
                                        </div>
                                    </div>
                                </div>
                                <button style="float:right; margin-right:80px; margin-top: -55px;" type="submit" class="btn btn-primary">Submit</button>
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