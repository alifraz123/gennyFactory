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

                                <div style="line-height: 0.5;
    padding-top: 10.2px;" class="card-body">
                                    <div class="row">




                                        <input type="hidden" id="invoice" value="{{$cashbook->invoice}}">

                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Enter Party Name</label>
                                                <input type="text" class="form-control" id="PartyName" disabled value="{{$cashbook->PartyName}}">

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Party Code</label>
                                                <input type="number" disabled value="{{$partyCode_and_partyAddress->PartyCode}}" name="PartyCode" id="PartyCode" class="form-control">

                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Address</label>

                                                <textarea type="text" class="form-control" disabled rows="5" name="Adress" placeholder="Adress" id="Adress">
                                                {{$partyCode_and_partyAddress->Adress}}
                                                </textarea>

                                            </div>

                                        </div>

                                    </div>

                                </div>


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

                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Enter Cash</label>
                                                <input type="number" class="form-control" value="{{$cashbook->Cash}}" name="Cash" placeholder="Enter Cash" id="Cash">

                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Balance</label>
                                                <input type="text" disabled name="Balance[]" id="Balance" value="{{$cashbook->Balance}}" required class="form-control" placeholder="Your Balance">
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
                                                        {{$cashbook->Remarks }}
                                                        </textarea>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div style="padding-top: 16px;" class="col-sm-4">

                                            <button style="width: 100%;" onclick="updateCashbookData()" class="btn btn-primary addRow">UPDATE CASH +</button>
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
               
                

                function updateCashbookData() {

                    var Cash = document.getElementById('Cash').value;
                    var Remarks = document.getElementById('Remarks').value;
                    var invoice = document.getElementById('invoice').value;

                    if (Cash != '' && Remarks != '') {
                       
                        var token = '{{csrf_token()}}';
                        $.ajax({
                            type: "post",
                            url: "../updateCashbookData",
                            data: {
                                Cash: Cash,
                                Remarks: Remarks,
                                invoice: invoice,
                                _token: token
                            },
                            dataType: "text",
                            success: function(data) {
                                console.log(data);
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

                    $.ajax({
                        type: "post",
                        url: "../getBalanceOfCurrentParty",
                        data: {
                            PartyName: document.getElementById('PartyName').value,
                            _token: token
                        },
                        dataType: "text",
                        success: function(data) {

                            console.log("balance is  :" + data);
                            document.getElementById('Balance').value = data;

                        },
                        error: function(req, status, error) {
                            console.log(error);
                        }
                    });


                }

                var token = '{{csrf_token()}}';  //when update cash then after this show updated balance
                $.ajax({
                    type: "post",
                    url: "../getBalanceOfCurrentParty",
                    data: {
                        PartyName: document.getElementById('PartyName').value,
                        _token: token
                    },
                    dataType: "text",
                    success: function(data) {

                        console.log("balance is  :" + data);
                        document.getElementById('Balance').value = data;

                    },
                    error: function(req, status, error) {
                        console.log(error);
                    }
                });
            </script>



            @endsection