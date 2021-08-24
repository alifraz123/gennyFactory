@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">

                    <h1>Sales Invoice Edit</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div style="padding:20px" class="card card-outline card-info">
                    <form method="get" action="getInvoicesForEdit">

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    <label>Date From :</label>
                                    <input type="date" name="startDate" id="startDate" required class="form-control" placeholder="Enter Date">
                                </div>

                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date To :</label>
                                    <input type="date" name="endDate" id="endDate" required class="form-control" placeholder="Enter Date">
                                </div>
                            </div>
                            <script>
                                let currentDate = new Date();
                                let cDay = currentDate.getDate();
                                let cMonth = currentDate.getMonth() + 1;
                                if (cMonth >= 1 || cMonth <= 9) {
                                    cMonth = "0" + cMonth;

                                } else {
                                    cMonth = cMonth;

                                }
                                let cYear = currentDate.getFullYear();
                                document.getElementById('startDate').value = cYear + "-" + cMonth + "-" + cDay;
                                document.getElementById('endDate').value = cYear + "-" + cMonth + "-" + cDay;
                            </script>
                            <!-- /.col-->
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Enter Party Name</label>
                                    <select name="PartyName" id="PartyName" required class="form-control select2 select2bs4">
                                        <option disabled selected value="">Choose value...</option>
                                        @foreach($parties as $partydata)
                                        <option value="{{$partydata->PartyName}}"> {{$partydata->PartyName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div style="margin-top: 32px;" class="form-group">
                                    <input type="submit">
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


@endsection