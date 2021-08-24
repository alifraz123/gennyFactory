@extends('admin/layouts/reportlayout')
@section('content')
<input type="hidden" id="hidden_debit">
<input type="hidden" id="hidden_credit">
<div class="container">
    <section style="margin-top: 40px;" class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                        ABDUL WAHAB ENGINEERING WORKS
                    </div>
                    <div style="text-align: center;" class="col-md-4">
                        <h2 id="partyORcomplete">Party Detailed Ledger</h2>
                        <p>Date : From <span style="font-weight: bold;" id="fromDate"></span>
                            To : <span style="font-weight: bold;" id="toDate"></span></p>
                    </div>
                    <div style="text-align: right;" class="col-md-4">
                        <button class="btn btn-primary" onclick="printfun()">Print</button>
                    </div>

                </div>
                <hr>

                <div class="row">
                    <div class="col-md-4">
                        <p><span>Party Code: </span> <span id="partycode"></span></p>
                        <p><span>Party Name :</span> <span id="partyname"></span></p>
                    </div>
                    <div style="text-align: center;" class="col-md-4">
                        <p><span>City: </span> <span id="city"></span></p>
                        <p><span>Address :</span> <span id="address"></span></p>
                    </div>
                    <div class="col-md-4">
                        Cell : <span id="Cell"></span>

                    </div>

                </div>

                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Ref</th>
                            <th scope="col">Invoice</th>
                            <th scope="col">Date</th>
                            <th scope="col">Rent</th>
                            <th scope="col">Total</th>
                            <th scope="col">Net Sale</th>
                            <th scope="col">Cash</th>

                            <th scope="col">Remarks</th>
                            <th scope="col">Balance</th>

                        </tr>
                    </thead>
                    <tbody id="table_body">

                    </tbody>
                </table>

            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    var url = new URL(window.location.href);
    var PartyName = url.searchParams.get('PartyName');
    var startDate = url.searchParams.get('startDate');
    var endDate = url.searchParams.get('endDate');
    document.getElementById('fromDate').innerHTML = startDate;
    document.getElementById('toDate').innerHTML = endDate;
    document.getElementById('partyname').innerHTML = PartyName;

    var token = '{{csrf_token()}}';
    $.ajax({
        type: "post",
        url: "getPartyNameForReport",
        data: {
            PartyName: PartyName,
            _token: token
        },
        dataType: "json",
        success: function(data) {
            console.log(data);
            document.getElementById('partycode').innerHTML = data[0].PartyCode;
            document.getElementById('city').innerHTML = data[0].City;
            document.getElementById('address').innerHTML = data[0].Adress;
            document.getElementById('Cell').innerHTML = data[0].Cell;

        },
        error: function(req, status, error) {
            console.log(error);
        }
    });

    var latest_balance = 0;
    $.ajax({
        type: "post",
        url: "getOpeningBalance",
        data: {
            PartyName: PartyName,
            startDate: startDate,
            endDate: endDate,
            _token: token
        },
        dataType: "json",
        success: function(data) {
            // console.log(data);
            var debit = data.debit;
            var credit = data.credit;
            var balance = debit - credit;
            latest_balance = balance;

            $.ajax({
                type: "post",
                url: "getPartyLedger",
                data: {
                    PartyName: PartyName,
                    startDate: startDate,
                    endDate: endDate,
                    _token: token
                },
                dataType: "json",
                success: function(data) {
                    if (data) {
                        var total_debit = 0;
                        var total_credit = 0;
                        var total_balance = 0;
                        let output = '';
                        output += `
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>Your opening balance is</td>
                                        <td id="ob">${latest_balance}</td>
                                        </tr>

                                    `;
                        var total_debit = 0;
                        var total_credit = 0;
                        var total_balance = 0;
                        var aa = 0;
                        var final_total = 0;
                        data.forEach(el => {
                            total_debit = total_debit + parseInt(el.Debit);
                            total_credit = total_credit + parseInt(el.Credit);
                            aa = latest_balance + parseInt(el.Debit) - parseInt(el.Credit);
                            latest_balance = aa;
                            final_total = parseInt(el.Rent) + parseInt(el.Total);

                            output += `
                                    <tr>
                                        <td>${el.Ref}</td>
                                        <td>${el.invoice}</td>
                                        <td>${el.Date}</td>
                                        <td>${el.Rent}</td>
                                        <td>${el.Total}</td>
                                        <td>${final_total}</td>
                                        <td>${el.Cash}</td>
                                        <td>${el.Remarks}</td>
                                        <td>${latest_balance}</td>
                                        </tr>

                                    `;

                        });
                        output += `
                                        <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td style="font-weight:bold" id="Debit">${total_debit}</td>
                                        <td style="font-weight:bold" id="Credit">${total_credit}</td>                                      
                                        <td style="font-weight:bold">Your Balance Till Date(<span id="tillDate">${endDate}</span>) </td>
                                        <td style="font-weight:bold" id="Balance">${latest_balance}</td>
                                        </tr>
                `;

                        if (output) {
                            document.getElementById('table_body').innerHTML = output;

                        } else {
                            alert("Sorry not any data between these dates ");
                        }
                    }
                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        },
        error: function(req, status, error) {
            console.log(error);
        }
    });


    function printfun() {
        window.print();
    }
</script>



@endsection