@extends('admin/layouts/mainlayout')
@section('content')
<div class="content-wrapper">
    <div class="container">
        <section id="section" class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h1>Reports</h1>
                    </div>

                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div id="cardStart" style="padding:20px" class="card card-outline card-info">

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Select Party Name :</label>
                                    <select name="PartyName" id="PartyName" required class="form-control select2 select2bs4">
                                        <option disabled selected value="">Choose value...</option>
                                        @foreach($parties as $partydata)
                                        <option value="{{$partydata->PartyName}}"> {{$partydata->PartyName}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">

                                <div class="form-group">
                                    <label>Date From :</label>
                                    <input type="date" name="startDate" id="startDate" required class="form-control" placeholder="Enter Date">
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div>

                            </div>
                            <div class="col-md-2">
                                <div style="margin-top: 32px;" class="form-group">


                                    <!-- <button  class="btn btn-info">Open Invoices</button> -->
                                </div>

                            </div>
                            <!-- /.col-->
                        </div>
                        <div class="row">
                            <div style="margin-right: 30px;" class="col-md-1">
                                <input onclick="getPartyReport()" class="btn btn-primary" value="Party Ledger" type="button">
                            </div>
                            <div  class="col-md-2">
                                <input onclick="getPartyDetailedReport()" class="btn btn-primary" value="Party Complete Report" type="button">
                            </div>
                            <div  class="col-md-2">
                                <input onclick="getCompleteReport()" class="btn btn-primary" value="Complete Report" type="button">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


</div>
</div>
</div>

</div>

<script>
    function getPartyReport() {
        var PartyName = document.getElementById('PartyName').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        
            window.open("PartyLedger?PartyName="+PartyName+"&startDate="+startDate+"&endDate="+endDate, '_blank');
       
       
    }
    function getPartyDetailedReport() {
        var PartyName = document.getElementById('PartyName').value;
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        
            window.open("PartyDetailedLedger?PartyName="+PartyName+"&startDate="+startDate+"&endDate="+endDate, '_blank');
       
       
    }
    function getCompleteReport() {
       
        var startDate = document.getElementById('startDate').value;
        var endDate = document.getElementById('endDate').value;
        
            window.open("completeReport?startDate="+startDate+"&endDate="+endDate, '_blank');
       
       
    }
</script>

</div>

@endsection