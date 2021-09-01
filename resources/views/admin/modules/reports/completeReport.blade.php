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
                        <h2 id="partyORcomplete">Complete Report</h2>
                        <p>Date : From <span style="font-weight: bold;" id="fromDate"></span>
                            To : <span style="font-weight: bold;" id="toDate"></span></p>
                    </div>
                    <div style="text-align: right;" class="col-md-4">
                        <button class="btn btn-primary" onclick="printfun()">Print</button>
                    </div>

                </div>
                <hr>
                <table id="table" class="table table-bordered">
                    <thead>
                        <tr>

                            <th scope="col">PartyName</th>
                            <th scope="col">Rent</th>
                            <th scope="col">Total</th>

                            <th scope="col">Net Sale</th>
                            <th scope="col">Cash</th>
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

    var token = '{{csrf_token()}}';
    $.ajax({
        type: "post",
        url: "getCompleteReport",
        data: {
            startDate: startDate,
            endDate: endDate,
            _token: token
        },
        dataType: "json",
        success: function(data) {
            // console.log(data);
            if (data) {
                var debit = 0;
                var credit = 0;
                var balance = 0;
                var total = 0;
                var rent = 0;

                let output = '';
                data.forEach(el => {
                    debit = debit + el.debit;
                    credit = credit + el.credit;
                    balance = balance + el.balance;
                    rent = rent + el.rent;
                    total = total + el.total;

                    output += `
                                    <tr>
                                        <td>${el.PartyName}</td>
                                        <td>${el.rent}</td>
                                        <td>${el.total}</td>
                                        <td>${el.debit}</td>                                     
                                        <td>${el.credit}</td>
                                        <td>${el.balance}</td>
                                        </tr>

                                    `;
                });
                output += `
                <tr>
                                        
                                        
                                        <td></td>
                                        <td>${rent}</td>
                                        <td>${total}</td>
                                        <td style="font-weight:bold" >${debit}</td>
                                        <td style="font-weight:bold" >${credit}</td>                                      
                                        
                                        <td style="font-weight:bold" id="Balance">${balance}</td>
                                        </tr>
                `;
                if (output) {
                    document.getElementById('table_body').innerHTML = output;
                } else {
                    alert("Sorry not any data between these dates ");
                }

            } else {
                alert("Not any sale between this sale");
            }
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