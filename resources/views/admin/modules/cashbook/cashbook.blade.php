@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">

    <section class="content">
        <div id="show_insert_status">

        </div>
        <div style="margin-top: 1rem;" class="container-fluid">

            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-5">

                            <div class="card card-dark">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="card-title">Cash Book Data</h3>
                                        </div>
                                    </div>
                                </div>
                                <form method="post" action="save_salesbookdata">
                                    @csrf
                                    <div style="line-height: 0.5;
    padding-top: 10.2px;" class="card-body">
                                        <div class="row">




                                            <input type="hidden" name="Date" id="Date" required class="form-control" placeholder="Enter Date">

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
                                                document.getElementById('Date').value = cYear + "-" + cMonth + "-" + cDay;
                                            </script>
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Enter Party Name</label>
                                                    <select name="PartyName" onchange="getPartyData()" id="PartyName" required class="form-control select2 select2bs4" placeholder="Enter Party Name">
                                                        <option disabled selected value="">Choose value</option>
                                                        @foreach($parties as $partydata)
                                                        <option value="{{$partydata->PartyName}}"> {{$partydata->PartyName}}</option>
                                                        @endforeach

                                                    </select>

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Party Code</label>
                                                    <input type="number" name="PartyCode" id="PartyCode" class="form-control">

                                                </div>
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label>Address</label>

                                                    <textarea type="text" class="form-control" rows="5" name="Adress" id="Adress">

                                                </textarea>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </form>
                            </div>


                        </div>
                        <div class="col-md-7">

                            <div class="card card-dark">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="card-title">Cash Book Detail Data</h3>
                                        </div>

                                    </div>


                                </div>
                                <!-- Add Product Detail -->
                                <div style="padding: 12px;line-height: 0.5;" class="card-body">
                                    @csrf
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Enter Cash</label>
                                                <input type="number" class="form-control" name="Cash" placeholder="Enter Cash" id="Cash">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Balance</label>
                                                <input type="number" disabled name="Balance[]" id="Balance" required class="form-control" placeholder="Your Balance">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row bb">

                                        <div class="col-sm-4">

                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>Enter Remarks</label>
                                                        <textarea name="Remarks" id="Remarks" style="width: 100%;" rows="5" required class="form-control" placeholder="Enter Remarks">
                                                        </textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="padding-top: 16px;" class="col-sm-4">

                                            <button style="width: 100%;" onclick="sendCashbookData()" class="btn btn-primary addRow">ADD CASH +</button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>



                        </div>
                    </div>
                </div>

            </div>

            <script>
                function getPartyData() {

                    var token = '{{csrf_token()}}';
                    $.ajax({
                        type: "post",
                        url: "getPartyData",
                        data: {
                            PartyName: document.getElementById('PartyName').value,
                            _token: token
                        },
                        dataType: "json",
                        success: function(data) {
                           

                            document.getElementById('PartyCode').value = data.PartyCode;
                            document.getElementById('Adress').value = data.Adress;
                           

                        },
                        error: function(req, status, error) {
                            console.log(error);
                        }
                    });
                  
                    $.ajax({
                        type: "post",
                        url: "getBalanceOfCurrentParty",
                        data: {
                            PartyName: document.getElementById('PartyName').value,
                            _token: token
                        },
                        dataType: "text",
                        success: function(data) {

                            console.log(data);
                            document.getElementById('Balance').value = data;

                        },
                        error: function(req, status, error) {
                            console.log(error);
                        }
                    });

                }


                function sendCashbookData() {
                    let currentDate = new Date();
                    let cDay = currentDate.getDate();
                    let cMonth = currentDate.getMonth() + 1;
                    if (cMonth >= 1 || cMonth <= 9) {
                        cMonth = "0" + cMonth;

                    } else {
                        cMonth = cMonth;

                    }
                    let cYear = currentDate.getFullYear();
                    var todayDate = cYear + "-" + cMonth + "-" + cDay;

                    var PartyName = document.getElementById('PartyName').value;

                    var PartyCode = document.getElementById('PartyCode').value;
                    var Adress = document.getElementById('Adress').value;
                    // var invoice = document.getElementById('invoice').value;
                    var Cash = document.getElementById('Cash').value;
                    var Balance = document.getElementById('Balance').value;
                    var Remarks = document.getElementById('Remarks').value;
                    if (PartyName != '' && PartyCode != '' && Adress != '' && Cash != '' &&
                        Balance != '' && Remarks != '') {

                        var token = '{{csrf_token()}}';
                        $.ajax({
                                type: "post",
                                url: "sendCashbookData",
                                data: {


                                    PartyName: document.getElementById('PartyName').value,
                                    Date: todayDate,
                                    PartyCode: document.getElementById('PartyCode').value,
                                    Adress: document.getElementById('Adress').value,
                                    // invoice: document.getElementById('invoice').value,
                                    Cash: document.getElementById('Cash').value,
                                    Balance: Balance-Cash,
                                    Remarks: document.getElementById('Remarks').value,
                                    _token: token
                                },
                                dataType: "text",
                                success: function(data) {
                                    console.log(data);
                                    document.getElementById('PartyName').value = '';
                                    document.getElementById('PartyCode').value = '';
                                    document.getElementById('Adress').value = '';

                                    document.getElementById('Cash').value = '';
                                    document.getElementById('Balance').value = '';
                                    document.getElementById('Remarks').value = '';

                                    var output = `
                                <div class="alert alert-success">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            Inserted Successfuly
        </div>    
                                `;
                                    document.getElementById('show_insert_status').innerHTML = output;

                                },
                                error: function(req, status, error) {
                                    console.log(error);
                                    var output = `
                                <div class="alert alert-danger">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            Not Inserted
        </div>
                                `;
                                    document.getElementById('show_insert_status').innerHTML = output;
                                
                            }
                        });





                }



                }
            </script>



            @endsection