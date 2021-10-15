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

                            <div class="card card-dark">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h3 class="card-title">Edit Sales Book Detail Data</h3>
                                            <input style="float: right;" id="Date" name="date" type="date">
                                        </div>
                                    </div>


                                </div>
                                <div style="margin-left: 15px;margin-top: 15px;line-height:0px" class="row">
                                    <div style="width: 30%;margin-right:3px">
                                        <input type="hidden" id="invoice_edit" name="invoice_edit" value="{{$salebook[0]->Invoice}}">
                                        <label>City</label>
                                        <select name="City" id="City" class="form-control select2 " style="width: 100%;" onchange="getAreaOfSelectedCity(this.value)" required>
                                            <option readonly selected value="{{$salebook[0]->City}}">{{$salebook[0]->City}}</option>
                                            @foreach($cities as $city)
                                            <option value="{{$city->City}}"> {{$city->City}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div style="width: 25%;margin-right:3px">

                                        <label>Area</label>
                                        <select name="Area" id="Area" onchange="getBookerOfSelectedArea(this.value)" class="control-form select2" style="width: 100%;">


                                        </select>
                                    </div>

                                    <div style="width: 25%;margin-right:3px">
                                        <label>Sale Officer</label>
                                        <select name="SaleOfficer" id="SaleOfficer" onchange="getPartyNamesOfSelectedBooker(this.value)" class="control-form select2" style="width: 100%;">


                                        </select>
                                    </div>


                                </div>

                                <!-- Add Product Detail -->
                                <div style="line-height: 0;" class="card-body">

                                    <div style="margin-left: -4px;" class="row">
                                        <div style="width: 25%;margin-right:3px">

                                            <label>PartyName</label>
                                            <select name="PartyName" id="PartyName" onchange="getDataOfSelectedPartyName(this.value)" class="control-form select2" style="width: 100%;" required>


                                            </select>
                                        </div>
                                        <div style="width: 25%;margin-right:3px">

                                            <label>Remarks</label>
                                            <input type="text" name="Remarks" id="Remarks" style="width: 100%;padding:0;height:30px" class="form-control" placeholder="Remarks">
                                        </div>

                                        <div style="width: 20%;margin-right:3px">
                                            <label>PartyPerson</label>
                                            <input type="text" name="PartyPerson" id="PartyPerson" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                        </div>
                                        <div style="width: 25%;margin-right:3px">
                                            <label>Address</label>
                                            <input type="text" name="Address" id="Address" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                        </div>

                                    </div>


                                    <div class="card-body">

                                        <div style="display: flex;margin-left:-23px">

                                            <div style="width: 60%;margin-right:3px">
                                                <label>Item Name</label>
                                                <select name="Itemname[]" onchange="getPriceOfSelectedItemName(this.value)" id="ItemName" style="width: 100%;" required class="select2">


                                                </select>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">

                                                <label>Qty</label>
                                                <input type="number" oninput="getTotalPrice()" name="Quantity" id="Quantity" style="width:100%;height:28px;">
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>Price</label>
                                                <input name="Price" id="Price" readonly style="width: 100%;height:28px;" type="number" required>

                                            </div>

                                            <input type="hidden" id="saving_price" name="saving_price">

                                            <div style="width: 10%;margin-right:3px">
                                                <label>Total</label>
                                                <input name="Total" readonly id="Total" style="width: 100%;height:28px;" type="number" required>

                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>TO</label>
                                                <input name="TO" id="TO" oninput="getTotalPrice()" style="width: 100%;height:28px;" type="number" required>

                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>TOA</label>
                                                <input name="TOA" readonly id="TOA" style="width: 100%;height:28px;" type="number" required>

                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>Sch</label>
                                                <input name="Sch" id="Sch" oninput="getTotalPrice()" style="width: 100%;height:28px;" type="number" required>

                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>SchA</label>
                                                <input name="SchA" readonly id="SchA" style="width: 100%;height:28px;" type="number" required>

                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>%</label>
                                                <input name="Percent" oninput="getTotalPrice()" id="Percent" style="width: 100%;height:28px;" type="number" required>

                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>%A</label>
                                                <input name="PercentAmount" readonly id="PercentAmount" style="width: 100%;height:28px;" type="number" required>

                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <label>F.Total</label>
                                                <input name="finalTotal" readonly id="finalTotal" style="width: 100%;height:28px;" type="number" required>

                                            </div>

                                            <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 28px;margin-top: 7px;background:green;color:white;border:none" class="addRow">+</button>

                                        </div>

                                    </div>


                                    <div id="whereProductsShow">



                                        @foreach($salebook_detail as $sbd)
                                        <div style="display:flex; line-height: 3;margin-left:-3px;margin-top:-1%;">
                                            <div style="width: 60%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" value="{{$sbd->ItemName}}" readonly type='text' name='ItemName[]'>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" oninput="changeInvoice_oninput()" value="{{$sbd->Quantity}}"  type='text' name='Quantity[]'>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" readonly value="{{$sbd->Price}}" type='text' name='Price[]'>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" value="{{$sbd->Total}}" type='text' name='Total[]' required>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" oninput="changeInvoice_oninput()" value="{{$sbd->TOValue}}" type='text' name='TO[]' required>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" readonly value="{{$sbd->TODiscount}}" type='text' name='TOA[]' required>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px"  oninput="changeInvoice_oninput()" value="{{$sbd->Scheme}}" type='text' name='Sch[]' required>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" readonly value="{{$sbd->SchemeDiscount}}" type='text' name='SchA[]' required>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" oninput="changeInvoice_oninput()" value="{{$sbd->Percent}}" type='text' name='Percent[]' required>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" readonly value="{{$sbd->PercentDiscount}}" type='text' name='PercentAmount[]' required>
                                            </div>
                                            <div style="width: 10%;margin-right:3px">
                                                <input style="width:100%;padding:0;height:30px" value="{{$sbd->FinalTotal}}" type='text' name='finalTotal[]' required>
                                            </div>

                                            <button style="line-height:0;margin-top:5px; margin-left:-1.5px;width: 5%;height: 30px;background:red;color:white;border:none" class='deleteRow'>&times;</button>

                                        </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                            <script>
                                $(".deleteRow").click(function() {

                                    $(this).parent().remove();

                                });

                                function addRow() {

                                    var ItemName = document.getElementById('ItemName').value;
                                    var qty = document.getElementById('Quantity').value;
                                    var price = document.getElementById('Price').value;
                                    var saving_price = document.getElementById('saving_price').value;
                                    var total = document.getElementById('Total').value;
                                    var TO = document.getElementById('TO').value;
                                    var TOA = document.getElementById('TOA').value;
                                    var Sch = document.getElementById('Sch').value;
                                    var SchA = document.getElementById('SchA').value;
                                    var Percent = document.getElementById('Percent').value;
                                    var PercentAmount = document.getElementById('PercentAmount').value;
                                    var finalTotal = document.getElementById('finalTotal').value;

                                    var tr =
                                        `<div style="display:flex;margin-top:0px;margin-left:-3px;margin-bottom:6px">
                                        <div style="width: 60%;margin-right:3px">
                                        <input style="width:100%;height:30px" readonly type='text' name='ItemName[]' value='${ItemName}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" oninput='changeInvoice_oninput()'  type='number' name='Quantity[]' value='${qty}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" readonly type='number' name='Price[]' value='${price}'>
                                        </div>
                                        <input style="width:100%" type='hidden' name='saving_price[]' value='${saving_price}'>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" readonly type='number' name='Total[]' value='${total}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" oninput='changeInvoice_oninput()' type='number' name='TO[]' value='${TO}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" readonly type='number' name='TOA[]' value='${TOA}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" oninput='changeInvoice_oninput()' type='number' name='Sch[]' value='${Sch}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" readonly type='number' name='SchA[]' value='${SchA}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" oninput='changeInvoice_oninput()' type='number' name='Percent[]' value='${Percent}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" readonly type='number' name='PercentAmount[]' value='${PercentAmount}'>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                        <input style="width:100%;height:30px" readonly type='number' name='finalTotal[]' value='${finalTotal}'>
                                        </div>

                                        <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 30px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                                        </div>
                                        `;

                                    if (ItemName != "" && qty != "" && price != "" && total != "" && TO != "" && TOA != "" &&
                                        Sch != "" && SchA != "" && Percent != "" && PercentAmount != "" && finalTotal != "") {

                                        document.getElementById('whereProductsShow').insertAdjacentHTML("afterbegin", tr);
                                        // $('#whereProductsShow').append(tr);
                                        getTotalSalesBookData();
                                        // alert("by append , getTotalSalebookdata is called")
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
                            </script>

                        </div>
                        <div class="col-md-2">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="card-title">Sales Book Data</h3>
                                        </div>
                                    </div>
                                </div>

                                <div style="line-height: 0;padding-top: 10px;" class="card-body">
                                    <div class="row">
                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input id="SaleTotal" value="{{$salebook[0]->Total}}" readonly placeholder="Total" name="Total" style="width: 100%;" type="text" required>
                                            </div>
                                        </div>

                                        <div style="width: 100%;" class="form-group">
                                            <label>TO Disc.</label>

                                            <input type="text" value="{{$salebook[0]->TODiscount}}" readonly placeholder="TO Discount" name="TODiscount" id="TODiscount" class="control-form" style="width: 100%;" required>

                                        </div>


                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Scheme Disc</label>
                                                    <input type="text" value="{{$salebook[0]->SchemeDiscount}}" readonly id="schemeDiscount" name="schemeDiscount" style="width: 100%;" required placeholder="Scheme Disc.">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>% Disc</label>
                                                    <input type="text" value="{{$salebook[0]->PercentDiscount}}" readonly id="PercentDiscount" name="PercentDiscount" style="width: 100%;" required class="" placeholder="% Discount">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Extra Discount</label>
                                                    <input type="text" value="{{$salebook[0]->ExtraDiscount}}" oninput="getSaleFinalTotal(this.value)" id="extraDiscount" name="extraDiscount" style="width: 100%;" required class="" placeholder="Extra Discount">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>F. Total</label>
                                                    <input type="text" value="{{$salebook[0]->FinalTotal}}" readonly id="SaleFinalTotal" name="finalTotal" style="width: 100%;" required class="" placeholder="Final Total">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Debit</label>
                                                    <input type="text" value="{{$salebook[0]->Debit}}" readonly id="debit" name="debit" style="width: 100%;" required placeholder="Debit">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Balance</label>
                                                    <input type="text" value="{{$salebook[0]->Balance}}" readonly id="balance" name="balance" style="width: 100%;" required placeholder="Balance">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <button style="padding: 7px;width:47%;" onclick="update_dispatch()" class="btn btn-primary">Submit</button>
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

</div>

<script>
    function getAreaOfSelectedCity(City) {
        $.ajax({
            url: '../getAreaOfSelectedCity_sale',
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

    function getBookerOfSelectedArea(Area) {
        $.ajax({
            url: '../getBookerOfSelectedArea_sale',
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
                        <option value="${el.booker}">${el.booker}</option>
                        `;
                        document.getElementById('SaleOfficer').innerHTML = Bookers;
                    });

                } else {
                    document.getElementById('SaleOfficer').innerHTML = '';
                }
            }
        })
    }

    function getPartyNamesOfSelectedBooker(Booker) {
        $.ajax({
            url: '../getPartyNamesOfSelectedBooker_sale',
            type: 'get',
            data: {
                Booker: Booker
            },
            success: function(data) {
                // console.log(data)
                if (data.length != 0) {
                    let PartyName = '<option disabled selected readonly value="">Choose PartyName...</option>';
                    data.forEach(el => {
                        PartyName += `
                        <option value="${el.PartyName}">${el.PartyName}</option>
                        `;
                        document.getElementById('PartyName').innerHTML = PartyName;
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
            url: '../getDataOfSelectedPartyName_sale',
            type: 'get',
            data: {
                PartyName: PartyName
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('PartyPerson').value = data.PartyPerson;
                document.getElementById('Address').value = data.Addres;
                PartyType = data.PartyType;
                document.getElementById('balance').value = data.debit - data.credit;
            }
        })
    }

    var AccountHead = document.getElementById('AccountHeadValue').innerText;
    var CompanyName = document.getElementById('AccountHeadCompanyName').innerText;
    $.ajax({
        url: '../getItemNames_Of_Selected_AccountHead_And_CompanyName',
        type: 'get',
        data: {
            AccountHead: AccountHead,
            CompanyName: CompanyName
        },
        success: function(data) {
            // console.log(data)
            if (data.length != 0) {
                let ItemName = '<option disabled selected readonly value="">Choose Item Name...</option>';
                data.forEach(el => {
                    ItemName += `
                        <option value="${el.ItemName}">${el.ItemName}</option>
                        `;
                    document.getElementById('ItemName').innerHTML = ItemName;
                });
                document.getElementById('Quantity').value = 0;
                document.getElementById('Price').value = 0;
                document.getElementById('Total').value = 0;
                document.getElementById('TO').value = 0;
                document.getElementById('TOA').value = 0;
                document.getElementById('Sch').value = 0;
                document.getElementById('SchA').value = 0;
                document.getElementById('Percent').value = 0;
                document.getElementById('PercentAmount').value = 0;
                document.getElementById('finalTotal').value = 0;


            } else {
                document.getElementById('ItemName').innerHTML = '';
            }
        }
    })


    function getPriceOfSelectedItemName(ItemName) {
        var ItemName = document.getElementById('ItemName').value;

        $.ajax({
            url: '../getPriceFromRateTable_sale',
            type: 'get',
            data: {
                ItemName: ItemName,
                PartyType: PartyType,
                AccountHead: AccountHead,
                CompanyName: CompanyName
            },
            success: function(data) {
                console.log(data)
                document.getElementById('Price').value = data.Rate;
            }
        })


        $.ajax({
            url: '../getPriceFromItemsTable_sale',
            type: 'get',
            data: {
                ItemName: ItemName,
                Company: CompanyName
            },
            success: function(data) {
                // console.log(data)
                document.getElementById('saving_price').value = data.Rate;
            }
        })
    }

    function getTotalPrice() {
        var qty = document.getElementById('Quantity');
        var price = document.getElementById('Price');
        var total = document.getElementById('Total');
        var TO = document.getElementById('TO');
        var TOA = document.getElementById("TOA");
        var Sch = document.getElementById('Sch');
        var SchA = document.getElementById('SchA');
        var Percent = document.getElementById('Percent');
        var PercentAmount = document.getElementById('PercentAmount');
        var finalTotal = document.getElementById('finalTotal');

        total.value = qty.value * price.value;
        TOA.value = TO.value * qty.value;
        if (Sch.value != 0 && Sch.value != '') {
            SchA.value = (Sch.value * price.value - Sch.value * TO.value);
        } else {
            SchA.value = 0;
        }
        if (Percent.value != 0 && Percent.value != '') {
            PercentAmount.value = ((qty.value * price.value - TO.value * qty.value - (Sch.value * price.value - Sch.value * TO.value)) * Percent.value) / 100;
        } else {
            PercentAmount.value = 0;
        }
        finalTotal.value = (qty.value * price.value - TO.value * qty.value - (Sch.value * price.value - Sch.value * TO.value)) -
            ((qty.value * price.value - TO.value * qty.value - (Sch.value * price.value - Sch.value * TO.value)) * Percent.value) / 100;
            getTotalSalesBookData();
    }

    function changeInvoice_oninput() {

        var qty = document.getElementsByName('Quantity[]');
        var price = document.getElementsByName('Price[]');
        var total = document.getElementsByName('Total[]');
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

    function getTotalSalesBookData() {
        // alert("called")
        var total1 = 0;
        var TOA1 = 0;
        var SchA1 = 0;
        var PercenDiscount1 = 0;

        var ItemName = document.getElementsByName('ItemName[]');
        var total = document.getElementsByName('Total[]');
        var TOA = document.getElementsByName('TOA[]');
        var SchA = document.getElementsByName('SchA[]');
        var PercentAmount = document.getElementsByName('PercentAmount[]');

        for (var i = 0; i < ItemName.length; i++) {

            total1 = total1 + parseInt(total[i].value);
            TOA1 = TOA1 + parseInt(TOA[i].value);
            SchA1 = SchA1 + parseInt(SchA[i].value);
            PercenDiscount1 = PercenDiscount1 + parseFloat(PercentAmount[i].value);

        }
        document.getElementById('SaleTotal').value = total1;
        document.getElementById('TODiscount').value = TOA1;
        document.getElementById('schemeDiscount').value = SchA1;
        document.getElementById('PercentDiscount').value = PercenDiscount1;
        document.getElementById('SaleFinalTotal').value = total1 - TOA1 - SchA1 - PercenDiscount1;
        document.getElementById('debit').value = total1 - TOA1 - SchA1 - PercenDiscount1;
    }
    todatDate();
    function update_dispatch() {

        var ItemName = document.getElementsByName('ItemName[]');
        var qty = document.getElementsByName('Quantity[]');
        var price = document.getElementsByName('Price[]');
        var total = document.getElementsByName('Total[]');
        var TO = document.getElementsByName('TO[]');
        var TOA = document.getElementsByName('TOA[]');
        var Sch = document.getElementsByName('Sch[]');
        var SchA = document.getElementsByName('SchA[]');
        var Percent = document.getElementsByName('Percent[]');
        var PercentAmount = document.getElementsByName('PercentAmount[]');
        var finalTotal = document.getElementsByName('finalTotal[]');

        var obj = [];
        for (var i = 0; i < ItemName.length; i++) {
            var ItemName1 = ItemName[i].value;
            var qty1 = qty[i].value;
            var price1 = price[i].value;
            var total1 = total[i].value;
            var TO1 = TO[i].value;
            var TOA1 = TOA[i].value;
            var Sch1 = Sch[i].value;
            var SchA1 = SchA[i].value;
            var Percent1 = Percent[i].value;
            var PercentAmount1 = PercentAmount[i].value;
            var finalTotal1 = finalTotal[i].value;
            
            var obje;
            obje = {
                ItemName: ItemName1,
                Qty: qty1,
                Price: price1,
                Total: total1,
                TO: TO1,
                TOA: TOA1,
                Sch: Sch1,
                SchA: SchA1,
                Percent: Percent1,
                PercentAmount: PercentAmount1,
                FinalTotal: finalTotal1,
            };
            obj.push(obje);
        }
        console.log(obj);

        var PartyName = document.getElementById('PartyName').value;
        var City = document.getElementById('City').value;
        var Area = document.getElementById('Area').value;
        var booker = document.getElementById('SaleOfficer').value;
        var Total = document.getElementById('SaleTotal').value;
        var TODiscount = document.getElementById('TODiscount').value;
        var SchemeDiscount = document.getElementById('schemeDiscount').value;
        var PercentDiscount = document.getElementById('PercentDiscount').value;
        var ExtraDiscount = document.getElementById('extraDiscount').value;
        var FinalTotal = document.getElementById('SaleFinalTotal').value;
        var Debit = document.getElementById('debit').value;
        var Remarks = document.getElementById('Remarks').value;
        var Balance = document.getElementById('balance').value;

        if (PartyName != '' && City != '' && Area != '' && booker != ''&& Total != '' && TODiscount != '' &&
         SchemeDiscount != '' && PercentDiscount != '' && FinalTotal != '' && Debit != '' && Remarks != '') {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "../update_dispatch",
                data: {
                    obj: obj,
                   Date : document.getElementById('Date').value,
                    PartyName: PartyName,
                    City: City,
                    Area: Area,
                    booker: booker,
                    Total: Total,
                    TODiscount: TODiscount,
                    SchemeDiscount: SchemeDiscount,
                    PercentDiscount: PercentDiscount,
                    ExtraDiscount: ExtraDiscount,
                    FinalTotal: FinalTotal,
                    Debit: Debit,
                    Remarks: Remarks,
                    invoice_edit: document.getElementById('invoice_edit').value,
                    _token: token
                },
                dataType: "text",
                success: function(data) {
                    console.log("returned data is :" + data);

                    if (data == "inserted") {
                        var output = `
                                <div class="alert alert-success">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            Updated Successfuly
        </div>    
                                `;
                        document.getElementById('show_insert_status').innerHTML = output;

                    } else {
                        var output = `
                        <div class="alert alert-danger">
            <button class="close" style="font-size: 30px;" data-dismiss="alert">&times</button>
            Not Updated
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
            Something Went Wrong !
        </div>
                                `;
                    document.getElementById('show_insert_status').innerHTML = output;
                }
            });


            // $("#company").val('').trigger('change');
            // $("#itemname").val('').trigger('change');
            // $("#varient").val('').trigger('change');
            // $("#quantity").val('').trigger('change');
            // $("#City").val('').trigger('change');
            // document.getElementById('address').value = '';
            // document.getElementById('zone').value = '';
            // document.getElementById('gatePass').value = '';
            // document.getElementById('BuiltyNo').value = '';
            // document.getElementById('Remarks').value = '';
            // $("#whereProductsShow tr").remove();
            // $("#supplier").val('').trigger('change');

        }

    }


    var cNo = document.getElementById("cNo");
    cNo.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            document.getElementById('addRow').click();

        }
    });
    
    function todatDate() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        $('#Date').val(today);
    }
    var itemname = document.getElementById("itemname");
    itemname.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            document.getElementById('addRow').click();

        }
    });
    var varient = document.getElementById("varient");
    varient.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            document.getElementById('addRow').click();

        }
    });
    var quantity = document.getElementById("quantity");
    quantity.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            document.getElementById('addRow').click();

        }
    });
</script>



@endsection