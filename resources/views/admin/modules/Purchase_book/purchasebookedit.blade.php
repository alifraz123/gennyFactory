@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Purchasebook Invoice Edit</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div style="padding:20px" class="card card-outline card-info">
                    <form method="get" action="getPurchaseInvoicesForEdit">

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Date From :</label>
                                    <input type="date" name="startDate" id="startDate" required class="form-control" >
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date To :</label>
                                    <input type="date" name="endDate" id="endDate" required class="form-control" >
                                </div>
                            </div>
                           
                            <!-- /.col-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Vender Name</label>
                                    <select name="supplier" id="supplier" required class="form-control select2 select2bs4">
                                        <option disabled selected value="">Choose value...</option>
                                        @foreach($parties as $partydata)
                                        <option value="{{$partydata->name}}"> {{$partydata->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div style="margin-top: 32px;" class="form-group">
                                    <input class="btn btn-primary" type="submit">
                                    <!-- <button onclick="getInvoicesForEdit()" class="btn btn-info">Open Invoices</button> -->
                                </div>

                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    var now = new Date();
var day = ("0" + now.getDate()).slice(-2);
var month = ("0" + (now.getMonth() + 1)).slice(-2);
var today = now.getFullYear()+"-"+(month)+"-"+(day) ;
document.getElementById('startDate').value = today;
document.getElementById('endDate').value = today;
</script>

@endsection