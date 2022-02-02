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
                        <div class="col-md-10">

                            <div style="margin-top: 15px;" class="card card-default">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="card-title">Journal Voucher</h3>
                                        </div>

                                    </div>

                                </div>

                                <div style="margin-left: 15px;margin-top:15px;line-height:0px" class="row">


                                    <div style="width: 20%;margin-right:3px">
                                        <label>Date</label>
                                        <input class="form-control" style="padding: 0;width: 100%;height: 30px;font-size: 14px;" id="Date" name="date" type="date">
                                    </div>
                                    <div style="width: 25%;margin-right:3px">

                                        <label>City</label>
                                        <select name="City" id="City" class="control-form select2" style="width: 100%;" onchange="getAreaOfSelectedCity(this.value)" required>
                                            <option readonly selected value="">Choose City...</option>

                                        </select>
                                    </div>
                                    <div style="width: 25%;margin-right:3px">

                                        <label>Area</label>
                                        <select name="area" id="Area" onchange="getPartiesOfSelectedArea(this.value)" class="control-form select2" style="width: 100%;">


                                        </select>
                                    </div>

                                    <div style="width: 25%;margin-right:3px">

                                        <label>PartyName</label>
                                        <select name="PartyName" id="PartyName" onchange="getDataOfSelectedPartyName(this.value)" class="control-form select2" style="width: 100%;" required>


                                        </select>


                                    </div>


                                </div>

                                <div style="margin: 15px;line-height:0px" class="row">



                                    <div style="width: 20%;margin-right:3px">
                                        <label>Invoice</label>
                                        <input class="form-control" readonly required style="padding: 0;width: 100%;height: 30px;font-size: 14px;" id="Invoice" name="Invoice" type="text">
                                    </div>
                                    <div style="width: 25%;margin-right:3px">
                                        <label>Sale Officer</label>
                                        <input name="saleOfficer" readonly id="saleOfficer" class="form-control" style="width: 100%;padding:0;height:30px">

                                    </div>


                                    <div style="width: 25%;margin-right:3px">
                                        <label>PartyPerson</label>
                                        <input type="text" name="PartyPerson" id="PartyPerson" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                    </div>
                                    <div style="width: 25%;margin-right:3px">
                                        <label>Address</label>
                                        <input type="text" name="address" id="address" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                    </div>


                                </div>


                                <div style="margin-left: 15px;line-height:0px;margin-bottom:20px;" class="row">

                                    <div style="width: 25%;margin-right:3px">

                                        <label>Remarks</label>
                                        <input type="text" style="width: 100%;padding:0;height:30px" class="form-control" name="remarks" id="remarks" placeholder="Remarks">
                                    </div>


                                </div>


                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                            <script>
                                function addRow() {

                                    var ItemName = document.getElementById('ItemName').value;
                                    var qty = document.getElementById('qty').value;
                                    var price = document.getElementById('price').value;
                                    var saving_price = document.getElementById('saving_price').value;
                                    var total = document.getElementById('total').value;
                                    var TO = document.getElementById('TO').value;
                                    var TOA = document.getElementById('TOA').value;
                                    var Sch = document.getElementById('Sch').value;
                                    var SchA = document.getElementById('SchA').value;
                                    var Percent = document.getElementById('Percent').value;
                                    var PercentAmount = document.getElementById('PercentAmount').value;
                                    var finalTotal = document.getElementById('finalTotal').value;

                                    var tr =
                                        `<div style="display:flex;margin-top:5px">
                                        <div style="width: 60%;margin-right:3px">
                                        <input style="width:100%;" readonly type='text' name='ItemName[]' value='${ItemName}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" oninput='changeInvoice_oninput()'  type='number' name='qty[]' value='${qty}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" readonly type='number' name='price[]' value='${price}'>
                                        </div>
                                        <input style="width:100%" type='hidden' name='saving_price[]' value='${saving_price}'>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" readonly type='number' name='total[]' value='${total}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" oninput='changeInvoice_oninput()' type='number' name='TO[]' value='${TO}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" readonly type='number' name='TOA[]' value='${TOA}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" oninput='changeInvoice_oninput()' type='number' name='Sch[]' value='${Sch}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" readonly type='number' name='SchA[]' value='${SchA}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" oninput='changeInvoice_oninput()' type='number' name='Percent[]' value='${Percent}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" readonly type='number' name='PercentAmount[]' value='${PercentAmount}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%" readonly type='number' name='finalTotal[]' value='${finalTotal}'>
                                        </div>

                                        <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                                        </div>
                                        `;

                                    if (ItemName != "" && qty != "" && price != "" && total != "" && TO != "" && TOA != "" &&
                                        Sch != "" && SchA != "" && Percent != "" && PercentAmount != "" && finalTotal != "") {

                                        document.getElementById('whereProductsShow').insertAdjacentHTML("afterbegin", tr);
                                        // $('#whereProductsShow').append(tr);
                                        getTotalSalesBookData();
                                        document.getElementById('qty').value = 0;
                                        document.getElementById('price').value = 0;
                                        document.getElementById('total').value = 0;
                                        document.getElementById('TO').value = 0;
                                        document.getElementById('TOA').value = 0;
                                        document.getElementById('Sch').value = 0;
                                        document.getElementById('SchA').value = 0;
                                        document.getElementById('Percent').value = 0;
                                        document.getElementById('PercentAmount').value = 0;
                                        document.getElementById('finalTotal').value = 0;

                                        $("#ItemName").val('').trigger('change');
                                        document.getElementById('ItemName').focus()

                                    }
                                    // $(".deleteRow").click(function() {
                                    //     $(this).parent().remove();
                                    // });


                                };

                                function changeInvoice_oninput() {

                                    var qty = document.getElementsByName('qty[]');
                                    var price = document.getElementsByName('price[]');
                                    var total = document.getElementsByName('total[]');
                                    var TO = document.getElementsByName('TO[]');
                                    var TOA = document.getElementsByName("TOA[]");
                                    var Sch = document.getElementsByName('Sch[]');
                                    var SchA = document.getElementsByName('SchA[]');
                                    var Percent = document.getElementsByName('Percent[]');
                                    var PercentAmount = document.getElementsByName('PercentAmount[]');
                                    var finalTotal = document.getElementsByName('finalTotal[]');

                                    for (var i = 0; i < qty.length; i++) {
                                        total[i].value = qty[i].value * price[i].value;
                                        TOA[i].value = TO[i].value * qty[i].value;
                                        if (Sch[i].value != 0 && Sch[i].value != '') {
                                            SchA[i].value = (Sch[i].value * price[i].value - Sch[i].value * TO[i].value);
                                        } else {
                                            SchA[i].value = 0;
                                        }
                                        if (Percent[i].value != 0 && Percent[i].value != '') {
                                            PercentAmount[i].value = ((qty[i].value * price[i].value - TO[i].value * qty[i].value - (Sch[i].value * price[i].value - Sch[i].value * TO[i].value)) * Percent[i].value) / 100;
                                        } else {
                                            PercentAmount[i].value = 0;
                                        }
                                        finalTotal[i].value = (qty[i].value * price[i].value - TO[i].value * qty[i].value - (Sch[i].value * price[i].value - Sch[i].value * TO[i].value)) -
                                            ((qty[i].value * price[i].value - TO[i].value * qty[i].value - (Sch[i].value * price[i].value - Sch[i].value * TO[i].value)) * Percent[i].value) / 100;

                                    }
                                    getTotalSalesBookData();
                                }
                            </script>

                        </div>
                        <div class="col-md-2">
                            <div style="margin-top:15px" class="card card-dark">

                                <div style="line-height: 0;padding-top: 10px;" class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Extra Discount</label>
                                                <input type="text" id="ExtraDiscount" value="0" name="ExtraDiscount" style="width: 100%;" required>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Debit</label>
                                                <input type="text" id="Debit" value="0" name="Debit" style="width: 100%;" required>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Credit</label>
                                                <input type="text" id="Credit" value="0" name="Credit" style="width: 100%;" required>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Balance</label>
                                                <input type="text" readonly id="balance" name="balance" style="width: 100%;" required placeholder="Balance">
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <button style="padding: 7px;width:47%;" onclick="dispatch()" class="btn btn-primary">Save</button>
                                            <button style="padding: 7px;width:40%;" onclick="dispatch_print()" class="btn btn-primary">Print</button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>

</div>

<script>
    var AccountHead = document.getElementById('AccountHeadValue').innerText;
    var CompanyName = document.getElementById('AccountHeadCompanyName').innerText;
    if (AccountHead != '' && CompanyName != '') {
        $.ajax({
            url: 'getCitiesOfSelectedAccountHead',
            type: 'get',
            data: {
                AccountHead: AccountHead
            },
            success: function(data) {
                // console.log(data)
                if (data.length != 0) {
                    let City = '<option disabled selected readonly value="">Choose City...</option>';
                    data.forEach(el => {
                        City += `
                        <option value="${el.City}">${el.City}</option>
                        `;
                        document.getElementById('City').innerHTML = City;
                    });

                } else {
                    document.getElementById('City').innerHTML = '';
                }
            }
        })


    }

    function getAreaOfSelectedCity(City) {
        $.ajax({
            url: 'getAreaOfSelectedCity_sale',
            type: 'get',
            data: {
                City: City
            },
            success: function(data) {
                // console.log(data)
                if (data.length != 0) {
                    let Area = '<option disabled selected readonly value="">Choose Area...</option>';
                    data.forEach(el => {
                        Area += `
                        <option value="${el.Area}">${el.Area}</option>
                        `;
                        document.getElementById('Area').innerHTML = Area;
                    });

                } else {
                    document.getElementById('Area').innerHTML = '';
                }
            }
        })

    }
    0

    function getPartiesOfSelectedArea(Area) {
        $.ajax({
            url: 'getPartiesOfSelectedArea',
            type: 'get',
            data: {
                Area: Area
            },
            success: function(data) {
                // console.log(data)
                if (data.length != 0) {
                    let Bookers = '<option disabled selected readonly value="">Choose booker...</option>';
                    data.forEach(el => {
                        Bookers += `
                        <option value="${el.PartyName}">${el.PartyName}</option>
                        `;
                        document.getElementById('PartyName').innerHTML = Bookers;
                    });

                } else {
                    document.getElementById('PartyName').innerHTML = '';
                }
            }
        })
    }


    var PartyType = '';

    function getDataOfSelectedPartyName(PartyName) {
        $.ajax({
            url: 'getDataOfSelectedPartyName_sale',
            type: 'get',
            data: {
                PartyName: PartyName
            },
            success: function(data) {
                console.log(data)
                document.getElementById('saleOfficer').value = data.PartyBooker;
                document.getElementById('PartyPerson').value = data.PartyPerson;
                document.getElementById('address').value = data.Addres;
                PartyType = data.PartyType;
                document.getElementById('balance').value = data.debit - data.credit;
                document.getElementById('Invoice').value = data.Invoice;
            }
        })
    }



    todatDate();

    function dispatch() {

        var Date = document.getElementById('Date').value;
        var Invoice = document.getElementById('Invoice').value;
        var PartyName = document.getElementById('PartyName').value;
        var City = document.getElementById('City').value;
        var Area = document.getElementById('Area').value;
        var booker = document.getElementById('saleOfficer').value;
        var CompanyName = document.getElementById('AccountHeadCompanyName').innerText;
        var AccountHead = document.getElementById('AccountHeadValue').innerText;
        var ExtraDiscount = document.getElementById('ExtraDiscount').value;
        var Credit = document.getElementById('Credit').value;
        var Debit = document.getElementById('Debit').value;
        var Remarks = document.getElementById('remarks').value;
        var Balance = document.getElementById('balance').value;

        var InvoiceStatus = 'Enable';

        if (Date != '' && PartyName != '' && City != '' && Area != '' && booker != '' && CompanyName != '' && AccountHead != '' &&
             Remarks != '' && InvoiceStatus != '') {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "dispatch_journalVoucher",
                data: {

                    Date: Date,
                    Invoice: Invoice,
                    PartyName: PartyName,
                    City: City,
                    Area: Area,
                    booker: booker,
                    CompanyName: CompanyName,
                    AccountHead: AccountHead,

                    ExtraDiscount: ExtraDiscount,
                    Debit: Debit,
                    Credit: Credit,
                    Remarks: Remarks,
                    Balance: Balance,
                    InvoiceStatus: InvoiceStatus,
                    _token: token
                },
                // dataType: "text",
                success: function(data) {
                    if (data == "inserted") {
                        var output = `
                                <div class="alert alert-success">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            Dispatched Successfuly
        </div>    
                                `;
                        document.getElementById('show_insert_status').innerHTML = output;




                    } else {
                        var output = `
                        <div class="alert alert-danger">
                        <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
                         Not Dispatched
                         </div>   
                            `;
                        document.getElementById('show_insert_status').innerHTML = output;
                    }



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


            todatDate();

        }


        $("#City").val('').trigger('change');
        $("#Area").val('').trigger('change');
        $("#saleOfficer").val('').trigger('change');
        $("#PartyName").val('').trigger('change');
        document.getElementById('remarks').value = '';
        document.getElementById('PartyPerson').value = '';
        document.getElementById('address').value = '';
        document.getElementById('SaleTotal').value = '';
        document.getElementById('TODiscount').value = '';
        document.getElementById('schemeDiscount').value = '';
        document.getElementById('PercentDiscount').value = '';
        document.getElementById('extraDiscount').value = '';
        document.getElementById('SaleFinalTotal').value = '';
        document.getElementById('Credit').value = '';
        document.getElementById('balance').value = '';
        document.getElementById('whereProductsShow').remove();
    }

    function todatDate() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        $('#Date').val(today);
    }

    // var quantity = document.getElementById("quantity");
    // quantity.addEventListener("keydown", function(e) {
    //     if (e.key === "Enter") {

    //         document.getElementById('addRow').click();

    //     }
    // });
</script>



@endsection