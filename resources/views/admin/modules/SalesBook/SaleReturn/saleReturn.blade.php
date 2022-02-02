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
                                            <h3 class="card-title">Sale Return</h3>
                                        </div>
                                        <div class="col-md-6">

                                            <input class="form-control" style="float:right;padding: 0;width: 50%;height: 30px;font-size: 14px;" id="Date" name="date" type="date">

                                        </div>

                                    </div>

                                </div>

                                <div style="margin-left: 15px;margin-top:15px;line-height:0px" class="row">





                                </div>

                                <div style="margin: 15px;line-height:0px" class="row">
                                    <div style="width: 30%;margin-right:3px">

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

                                    <div style="width: 15%;margin-right:3px">
                                        <label>Invoice</label>
                                        <input class="form-control" readonly required style="padding: 0;width: 100%;height: 30px;font-size: 14px;" id="Invoice" name="Invoice" type="text">
                                    </div>


                                </div>


                                <div style="margin-left: 15px;line-height:0px" class="row">
                                    <div style="width: 25%;margin-right:3px">
                                        <label>Sale Officer</label>
                                        <input name="saleOfficer" readonly id="saleOfficer" class="form-control" style="width: 100%;padding:0;height:30px">

                                    </div>
                                    <div style="width: 25%;margin-right:3px">

                                        <label>Remarks</label>
                                        <input type="text" style="width: 100%;padding:0;height:30px" class="form-control" name="remarks" id="remarks" placeholder="Remarks">
                                    </div>

                                    <div style="width: 20%;margin-right:3px">
                                        <label>PartyPerson</label>
                                        <input type="text" name="PartyPerson" id="PartyPerson" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                    </div>
                                    <div style="width: 25%;margin-right:3px">
                                        <label>Address</label>
                                        <input type="text" name="address" id="address" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                    </div>


                                </div>

                                <h3 style="text-align: center;">Fresh Return</h3>
                                <!-- Add Product Detail Fresh Return -->
                                <div style="line-height: 0;margin-left:-4px;margin-top:-1%;margin-bottom:-2%" class="card-body">

                                    <div style="display: flex;">

                                        <div style="width: 60%;margin-right:3px">
                                            <label>Item Name</label>
                                            <select name="FItemName" id="FItemName" onchange="getPriceOfSelectedItemName(this.value,'F')" style="width: 100%;" required class="select2">


                                            </select>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">

                                            <label>Qty</label>
                                            <input type="number" oninput="getTotalPrice('F')" name="Fqty" id="Fqty" style="width:100%;height:28px;">
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>Price</label>
                                            <input name="Fprice" id="Fprice" style="width: 100%;height:28px;" type="number" required>

                                        </div>

                                        <input type="hidden" id="saving_price" name="saving_price">

                                        <div style="width: 10%;margin-right:3px">
                                            <label>Total</label>
                                            <input name="total" readonly id="Ftotal" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>TO</label>
                                            <input name="FTO" id="FTO" oninput="getTotalPrice('F')" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>TOA</label>
                                            <input name="FTOA" readonly id="FTOA" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>Sch</label>
                                            <input name="FSch" id="FSch" oninput="getTotalPrice('F')" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>SchA</label>
                                            <input name="FSchA" readonly id="FSchA" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>%</label>
                                            <input name="FPercent" oninput="getTotalPrice('F')" id="FPercent" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>%A</label>
                                            <input name="FPercentAmount" readonly id="FPercentAmount" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>F.Total</label>
                                            <input name="FfinalTotal" readonly id="FfinalTotal" style="width: 100%;height:28px;" type="number" required>

                                        </div>

                                        <button onclick="addRowF()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                                    </div>
                                    <div style="line-height: 0;" id="whereProductsShowF">
                                    </div>
                                </div>


                                <h3 style="text-align: center;">Damage Return</h3>
                                <!-- Add Product Detail Damage Return-->
                                <div style="line-height: 0;margin-left:-4px;margin-top:-1%" class="card-body">

                                    <div style="display: flex;">

                                        <div style="width: 60%;margin-right:3px">
                                            <label>Item Name</label>
                                            <select name="DItemname" onchange="getPriceOfSelectedItemName(this.value,'D')" id="DItemName" style="width: 100%;" required class="select2">


                                            </select>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">

                                            <label>Qty</label>
                                            <input type="number" oninput="getTotalPrice('D')" name="Dqty" id="Dqty" style="width:100%;height:28px;">
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>Price</label>
                                            <input name="Dprice" id="Dprice" readonly style="width: 100%;height:28px;" type="number" required>

                                        </div>

                                        <input type="hidden" id="saving_price" name="saving_price">

                                        <div style="width: 10%;margin-right:3px">
                                            <label>Total</label>
                                            <input name="Dtotal" readonly id="Dtotal" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>TO</label>
                                            <input name="DTO" id="DTO" oninput="getTotalPrice('D')" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>TOA</label>
                                            <input name="DTOA" readonly id="DTOA" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>Sch</label>
                                            <input name="DSch" id="DSch" oninput="getTotalPrice('D')" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>SchA</label>
                                            <input name="DSchA" readonly id="DSchA" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>%</label>
                                            <input name="DPercent" oninput="getTotalPrice('D')" id="DPercent" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>%A</label>
                                            <input name="DPercentAmount" readonly id="DPercentAmount" style="width: 100%;height:28px;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>F.Total</label>
                                            <input name="DfinalTotal" readonly id="DfinalTotal" style="width: 100%;height:28px;" type="number" required>

                                        </div>

                                        <button onclick="addRowD()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                                    </div>
                                    <div style="line-height: 0;" id="whereProductsShowD">
                                    </div>
                                </div>

                            </div>


                        </div>
                        <div class="col-md-2">
                            <div style="margin-top:15px" class="card card-dark">

                                <div style="line-height: 0;padding-top: 10px;" class="card-body">
                                    <div class="row">

                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>F.Return</label>
                                                <input id="FreshReturn" readonly placeholder="FreshReturn" name="FreshReturn" style="width: 100%;" type="text" required>

                                            </div>
                                        </div>

                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>D.Return</label>
                                                <input id="DamageReturn" readonly placeholder="DamageReturn" name="DamageReturn" style="width: 100%;" type="text" required>

                                            </div>
                                        </div>


                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>Total</label>
                                                <input id="SaleTotal" readonly placeholder="Total" name="Total" style="width: 100%;" type="text" required>

                                            </div>
                                        </div>

                                        <div style="width: 100%;" class="form-group">
                                            <label>TO Disc.</label>

                                            <input type="text" readonly placeholder="TO Discount" name="TODiscount" id="TODiscount" class="control-form" style="width: 100%;" required>

                                        </div>


                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Scheme Disc</label>
                                                    <input type="text" readonly id="schemeDiscount" name="schemeDiscount" style="width: 100%;" required placeholder="Scheme Disc.">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>% Disc</label>
                                                    <input type="text" readonly id="PercentDiscount" name="PercentDiscount" style="width: 100%;" required class="" placeholder="% Discount">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Extra Discount</label>
                                                    <input type="text" oninput="getSaleFinalTotal(this.value)" id="extraDiscount" name="extraDiscount" style="width: 100%;" required class="" placeholder="Extra Discount">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>F. Total</label>
                                                    <input type="text" readonly id="SaleFinalTotal" name="finalTotal" style="width: 100%;" required class="" placeholder="Final Total">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Credit</label>
                                                    <input type="text" readonly id="Credit" name="Credit" style="width: 100%;" required placeholder="Credit">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Balance</label>
                                                    <input type="text" readonly id="balance" name="balance" style="width: 100%;" required placeholder="Balance">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <button style="padding: 7px;width:47%;" onclick="dispatch()" class="btn btn-primary">Submit</button>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script>
    function addRowF() {

        var ItemName = document.getElementById('FItemName').value;
        var qty = document.getElementById('Fqty').value;
        var price = document.getElementById('Fprice').value;
        var saving_price = document.getElementById('saving_price').value;
        var total = document.getElementById('Ftotal').value;
        var TO = document.getElementById('FTO').value;
        var TOA = document.getElementById('FTOA').value;
        var Sch = document.getElementById('FSch').value;
        var SchA = document.getElementById('FSchA').value;
        var Percent = document.getElementById('FPercent').value;
        var PercentAmount = document.getElementById('FPercentAmount').value;
        var finalTotal = document.getElementById('FfinalTotal').value;

        var tr =
            `<div style="display:flex;margin-top:5px">
    <div style="width: 60%;margin-right:3px">
    <input style="width:100%;" readonly type='text' name='FItemName[]' value='${ItemName}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" oninput="changeInvoice_oninput('F')"  type='number' name='Fqty[]' value='${qty}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" readonly type='number' name='Fprice[]' value='${price}'>
    </div>
    <input style="width:100%" type='hidden' name='saving_price[]' value='${saving_price}'>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" readonly type='number' name='Ftotal[]' value='${total}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" oninput="changeInvoice_oninput('F')" type='number' name='FTO[]' value='${TO}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" readonly type='number' name='FTOA[]' value='${TOA}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" oninput="changeInvoice_oninput('F')" type='number' name='FSch[]' value='${Sch}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" readonly type='number' name='FSchA[]' value='${SchA}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" oninput="changeInvoice_oninput('F')" type='number' name='FPercent[]' value='${Percent}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" readonly type='number' name='FPercentAmount[]' value='${PercentAmount}'>
    </div>
    <div style="width: 10%;margin-right:3px">
    <input style="width:100%" readonly type='number' name='FfinalTotal[]' value='${finalTotal}'>
    </div>

    <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
    </div>
    `;

        if (ItemName != "" && qty != "" && price != "" && total != "" && TO != "" && TOA != "" &&
            Sch != "" && SchA != "" && Percent != "" && PercentAmount != "" && finalTotal != "") {

            document.getElementById('whereProductsShowF').insertAdjacentHTML("afterbegin", tr);
            // $('#whereProductsShow').append(tr);
            getTotalSalesBookData('F');
            document.getElementById('Fqty').value = 0;
            document.getElementById('Fprice').value = 0;
            document.getElementById('Ftotal').value = 0;
            document.getElementById('FTO').value = 0;
            document.getElementById('FTOA').value = 0;
            document.getElementById('FSch').value = 0;
            document.getElementById('FSchA').value = 0;
            document.getElementById('FPercent').value = 0;
            document.getElementById('FPercentAmount').value = 0;
            document.getElementById('FfinalTotal').value = 0;

            $("#FItemName").val('').trigger('change');
            document.getElementById('FItemName').focus()

        }

    };


    function addRowD() {

        var ItemName = document.getElementById('DItemName').value;
        var qty = document.getElementById('Dqty').value;
        var price = document.getElementById('Dprice').value;
        var saving_price = document.getElementById('saving_price').value;
        var total = document.getElementById('Dtotal').value;
        var TO = document.getElementById('DTO').value;
        var TOA = document.getElementById('DTOA').value;
        var Sch = document.getElementById('DSch').value;
        var SchA = document.getElementById('DSchA').value;
        var Percent = document.getElementById('DPercent').value;
        var PercentAmount = document.getElementById('DPercentAmount').value;
        var finalTotal = document.getElementById('DfinalTotal').value;

        var tr =
            `<div style="display:flex;margin-top:5px">
<div style="width: 60%;margin-right:3px">
<input style="width:100%;" readonly type='text' name='DItemName[]' value='${ItemName}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" oninput="changeInvoice_oninput('D')"  type='number' name='Dqty[]' value='${qty}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" readonly type='number' name='Dprice[]' value='${price}'>
</div>
<input style="width:100%" type='hidden' name='saving_price[]' value='${saving_price}'>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" readonly type='number' name='Dtotal[]' value='${total}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" oninput="changeInvoice_oninput('D')" type='number' name='DTO[]' value='${TO}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" readonly type='number' name='DTOA[]' value='${TOA}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" oninput="changeInvoice_oninput('D')" type='number' name='DSch[]' value='${Sch}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" readonly type='number' name='DSchA[]' value='${SchA}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" oninput="changeInvoice_oninput('D')" type='number' name='DPercent[]' value='${Percent}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" readonly type='number' name='DPercentAmount[]' value='${PercentAmount}'>
</div>
<div style="width: 10%;margin-right:3px">
<input style="width:100%" readonly type='number' name='DfinalTotal[]' value='${finalTotal}'>
</div>

<button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
</div>
`;

        if (ItemName != "" && qty != "" && price != "" && total != "" && TO != "" && TOA != "" &&
            Sch != "" && SchA != "" && Percent != "" && PercentAmount != "" && finalTotal != "") {

            document.getElementById('whereProductsShowD').insertAdjacentHTML("afterbegin", tr);
            // $('#whereProductsShow').append(tr);
            getTotalSalesBookData('D');
            document.getElementById('Dqty').value = 0;
            document.getElementById('Dprice').value = 0;
            document.getElementById('Dtotal').value = 0;
            document.getElementById('DTO').value = 0;
            document.getElementById('DTOA').value = 0;
            document.getElementById('DSch').value = 0;
            document.getElementById('DSchA').value = 0;
            document.getElementById('DPercent').value = 0;
            document.getElementById('DPercentAmount').value = 0;
            document.getElementById('DfinalTotal').value = 0;

            $("#DItemName").val('').trigger('change');
            document.getElementById('DItemName').focus()

        }

    };

    function changeInvoice_oninput(value) {
        if (value == 'D') {
            var qty = document.getElementsByName('Dqty[]');
            var price = document.getElementsByName('Dprice[]');
            var total = document.getElementsByName('Dtotal[]');
            var TO = document.getElementsByName('DTO[]');
            var TOA = document.getElementsByName("DTOA[]");
            var Sch = document.getElementsByName('DSch[]');
            var SchA = document.getElementsByName('DSchA[]');
            var Percent = document.getElementsByName('DPercent[]');
            var PercentAmount = document.getElementsByName('DPercentAmount[]');
            var finalTotal = document.getElementsByName('DfinalTotal[]');
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
            abc('D');
        } else {
            var qty = document.getElementsByName('Fqty[]');
            var price = document.getElementsByName('Fprice[]');
            var total = document.getElementsByName('Ftotal[]');
            var TO = document.getElementsByName('FTO[]');
            var TOA = document.getElementsByName("FTOA[]");
            var Sch = document.getElementsByName('FSch[]');
            var SchA = document.getElementsByName('FSchA[]');
            var Percent = document.getElementsByName('FPercent[]');
            var PercentAmount = document.getElementsByName('FPercentAmount[]');
            var finalTotal = document.getElementsByName('FfinalTotal[]');

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
            abc('F')
        }

    }

    var totalValue = 0;
    var TOAValue = 0;
    var SchAValue = 0;
    var PercentAmountValue = 0
    var FreshReturnValue = 0;
    var DamageReturnValue = 0;

    function getTotalSalesBookData(value) {

        if (value == 'F') {
            var ItemName = document.getElementsByName('FItemName[]');
            var total = document.getElementsByName('Ftotal[]');
            var TOA = document.getElementsByName('FTOA[]');
            var SchA = document.getElementsByName('FSchA[]');
            var PercentAmount = document.getElementsByName('FPercentAmount[]');


            totalValue = totalValue + parseInt(total[0].value);
            TOAValue = TOAValue + parseInt(TOA[0].value);
            SchAValue = SchAValue + parseInt(SchA[0].value);
            PercentAmountValue = PercentAmountValue + parseInt(PercentAmount[0].value);

            FreshReturnValue = FreshReturnValue + (total[0].value - TOA[0].value - SchA[0].value - PercentAmount[0].value);

            document.getElementById('SaleTotal').value = totalValue;
            document.getElementById('TODiscount').value = TOAValue;
            document.getElementById('schemeDiscount').value = SchAValue;
            document.getElementById('PercentDiscount').value = PercentAmountValue;
            document.getElementById('SaleFinalTotal').value = totalValue - TOAValue - SchAValue - PercentAmountValue;
            document.getElementById('Credit').value = totalValue - TOAValue - SchAValue - PercentAmountValue;
            document.getElementById('FreshReturn').value = FreshReturnValue;
            document.getElementById('DamageReturn').value = DamageReturnValue;

            abc('F')
        } else if (value == 'D') {
            var ItemName = document.getElementsByName('DItemName[]');
            var total = document.getElementsByName('Dtotal[]');
            var TOA = document.getElementsByName('DTOA[]');
            var SchA = document.getElementsByName('DSchA[]');
            var PercentAmount = document.getElementsByName('DPercentAmount[]');

            totalValue = totalValue + parseInt(total[0].value);
            TOAValue = TOAValue + parseInt(TOA[0].value);
            SchAValue = SchAValue + parseInt(SchA[0].value);
            PercentAmountValue = PercentAmountValue + parseInt(PercentAmount[0].value);

            DamageReturnValue = DamageReturnValue + (total[0].value - TOA[0].value - SchA[0].value - PercentAmount[0].value);
            document.getElementById('SaleTotal').value = totalValue;
            document.getElementById('TODiscount').value = TOAValue;
            document.getElementById('schemeDiscount').value = SchAValue;
            document.getElementById('PercentDiscount').value = PercentAmountValue;
            document.getElementById('SaleFinalTotal').value = totalValue - TOAValue - SchAValue - PercentAmountValue;
            document.getElementById('Credit').value = totalValue - TOAValue - SchAValue - PercentAmountValue;
            document.getElementById('FreshReturn').value = FreshReturnValue;
            document.getElementById('DamageReturn').value = DamageReturnValue;

            abc('D')

        }
        // alert(totalValue)


    }

    function abc(value) {
        var totalValue = 0;
        var TOAValue = 0;
        var SchAValue = 0;
        var PercentAmountValue = 0;
        var FreshReturnValue = 0;
        var DamageReturnValue = 0;

        var total = document.getElementsByName('Ftotal[]');
        var TOA = document.getElementsByName('FTOA[]');
        var SchA = document.getElementsByName('FSchA[]');
        var PercentAmount = document.getElementsByName('FPercentAmount[]');

        for (var i = 0; i < total.length; i++) {
            totalValue = totalValue + parseInt(total[i].value);
            TOAValue = TOAValue + parseInt(TOA[i].value);
            SchAValue = SchAValue + parseInt(SchA[i].value);
            PercentAmountValue = PercentAmountValue + parseInt(PercentAmount[i].value);

        }
        FreshReturnValue = FreshReturnValue + (totalValue - TOAValue - SchAValue - PercentAmountValue);
        document.getElementById('FreshReturn').value = FreshReturnValue;
        document.getElementById('SaleTotal').value = totalValue;
        document.getElementById('TODiscount').value = TOAValue;
        document.getElementById('schemeDiscount').value = SchAValue;
        document.getElementById('PercentDiscount').value = PercentAmountValue;
        document.getElementById('SaleFinalTotal').value = totalValue - TOAValue - SchAValue - PercentAmountValue;
        document.getElementById('Credit').value = totalValue - TOAValue - SchAValue - PercentAmountValue;


        var totalValue = 0;
        var TOAValue = 0;
        var SchAValue = 0;
        var PercentAmountValue = 0;

        var total = document.getElementsByName('Dtotal[]');
        var TOA = document.getElementsByName('DTOA[]');
        var SchA = document.getElementsByName('DSchA[]');
        var PercentAmount = document.getElementsByName('DPercentAmount[]');

        for (var i = 0; i < total.length; i++) {
            totalValue = totalValue + parseInt(total[i].value);
            TOAValue = TOAValue + parseInt(TOA[i].value);
            SchAValue = SchAValue + parseInt(SchA[i].value);
            PercentAmountValue = PercentAmountValue + parseInt(PercentAmount[i].value);
        }
        DamageReturnValue = DamageReturnValue + (totalValue - TOAValue - SchAValue - PercentAmountValue);
        document.getElementById('DamageReturn').value = DamageReturnValue;
        document.getElementById('SaleTotal').value = parseInt(document.getElementById('SaleTotal').value) + totalValue;
        document.getElementById('TODiscount').value = parseInt(document.getElementById('TODiscount').value) + TOAValue;
        document.getElementById('schemeDiscount').value = parseInt(document.getElementById('schemeDiscount').value) + SchAValue;
        document.getElementById('PercentDiscount').value = parseInt(document.getElementById('PercentDiscount').value) + PercentAmountValue;
        document.getElementById('SaleFinalTotal').value = parseInt(document.getElementById('SaleFinalTotal').value) + totalValue - TOAValue - SchAValue - PercentAmountValue;
        document.getElementById('Credit').value = parseInt(document.getElementById('Credit').value) + totalValue - TOAValue - SchAValue - PercentAmountValue;
    }



    function getSaleFinalTotal(extraDiscount) {
        var SaleTotal = document.getElementById('SaleTotal').value;
        var TODiscount = document.getElementById('TODiscount').value;
        var SchemeDiscount = document.getElementById('schemeDiscount').value;
        var PercentDiscount = document.getElementById('PercentDiscount').value;
        result = SaleTotal - TODiscount - SchemeDiscount - PercentDiscount - extraDiscount;
        document.getElementById('SaleFinalTotal').value = result;
        document.getElementById('Credit').value = result;
    }

    function getTotalPrice(value) {
        if (value == "F") {
            var qty = document.getElementById('Fqty');
            var price = document.getElementById('Fprice');
            var total = document.getElementById('Ftotal');
            var TO = document.getElementById('FTO');
            var TOA = document.getElementById("FTOA");
            var Sch = document.getElementById('FSch');
            var SchA = document.getElementById('FSchA');
            var Percent = document.getElementById('FPercent');
            var PercentAmount = document.getElementById('FPercentAmount');
            var finalTotal = document.getElementById('FfinalTotal');

        } else {
            var qty = document.getElementById('Dqty');
            var price = document.getElementById('Dprice');
            var total = document.getElementById('Dtotal');
            var TO = document.getElementById('DTO');
            var TOA = document.getElementById("DTOA");
            var Sch = document.getElementById('DSch');
            var SchA = document.getElementById('DSchA');
            var Percent = document.getElementById('DPercent');
            var PercentAmount = document.getElementById('DPercentAmount');
            var finalTotal = document.getElementById('DfinalTotal');

        }


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


    }



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

        $.ajax({
            url: 'getItemNames_Of_Selected_AccountHead_And_CompanyName',
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
                        // document.getElementById('DItemName').innerHTML = ItemName;
                        document.getElementById('FItemName').innerHTML = ItemName;
                    });
                    document.getElementById('Fqty').value = 0;
                    document.getElementById('Fprice').value = 0;
                    document.getElementById('Ftotal').value = 0;
                    document.getElementById('FTO').value = 0;
                    document.getElementById('FTOA').value = 0;
                    document.getElementById('FSch').value = 0;
                    document.getElementById('FSchA').value = 0;
                    document.getElementById('FPercent').value = 0;
                    document.getElementById('FPercentAmount').value = 0;
                    document.getElementById('FfinalTotal').value = 0;


                } else {
                    document.getElementById('FItemName').innerHTML = '';
                    // document.getElementById('DItemName').innerHTML = '';
                }
            }
        })

        $.ajax({
            url: 'getItemNames_Of_Selected_AccountHead_And_CompanyName',
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
                        document.getElementById('DItemName').innerHTML = ItemName;
                    });
                    document.getElementById('Dqty').value = 0;
                    document.getElementById('Dprice').value = 0;
                    document.getElementById('Dtotal').value = 0;
                    document.getElementById('DTO').value = 0;
                    document.getElementById('DTOA').value = 0;
                    document.getElementById('DSch').value = 0;
                    document.getElementById('DSchA').value = 0;
                    document.getElementById('DPercent').value = 0;
                    document.getElementById('DPercentAmount').value = 0;
                    document.getElementById('DfinalTotal').value = 0;


                } else {
                    document.getElementById('DItemName').innerHTML = '';
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

    function getPartyNamesOfSelectedBooker(Booker) {
        $.ajax({
            url: 'getPartyNamesOfSelectedBooker_sale',
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

    function getPriceOfSelectedItemName(ItemName, value) {
        if (value == 'F') {
            var ItemName = document.getElementById('FItemName').value;
        } else if (value == 'D') {
            var ItemName = document.getElementById('DItemName').value;
        }
        $.ajax({
            url: 'getPriceFromRateTable_sale',
            type: 'get',
            data: {
                ItemName: ItemName,
                PartyType: PartyType,
                AccountHead: AccountHead,
                CompanyName: CompanyName
            },
            success: function(data) {
                console.log(data)
                var RateValue = data.Rate;
                if (value == 'F') {

                    document.getElementById('Fprice').value = RateValue;
                } else if (value == 'D') {
                    document.getElementById('Dprice').value = RateValue;
                }
            }
        })


        $.ajax({
            url: 'getPriceFromItemsTable_sale',
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


    todatDate();

    function dispatch() {
        var ItemName = document.getElementsByName('ItemName[]');
        var qty = document.getElementsByName('qty[]');
        var price = document.getElementsByName('price[]');
        var saving_price = document.getElementsByName('saving_price[]');
        var total = document.getElementsByName('total[]');
        var TO = document.getElementsByName('TO[]');
        var TOA = document.getElementsByName('TOA[]');
        var Sch = document.getElementsByName('Sch[]');
        var SchA = document.getElementsByName('SchA[]');
        var Percent = document.getElementsByName('Percent[]');
        var PercentAmount = document.getElementsByName('PercentAmount[]');
        var finalTotal = document.getElementsByName('finalTotal[]');
        var different_priceValue = '';

        var obj = [];
        for (var i = 0; i < ItemName.length; i++) {
            var ItemName1 = ItemName[i].value;
            var qty1 = qty[i].value;
            var price1 = price[i].value;
            var different_priceValue = price[i].value - saving_price[i].value;
            // alert(different_priceValue)
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
        // console.log(obj);
        var Date = document.getElementById('Date').value;
        var Invoice = document.getElementById('Invoice').value;
        var PartyName = document.getElementById('PartyName').value;
        var City = document.getElementById('City').value;
        var Area = document.getElementById('Area').value;
        var booker = document.getElementById('saleOfficer').value;
        var CompanyName = document.getElementById('AccountHeadCompanyName').innerText;
        var AccountHead = document.getElementById('AccountHeadValue').innerText;
        var Total = document.getElementById('SaleTotal').value;
        var TODiscount = document.getElementById('TODiscount').value;
        var SchemeDiscount = document.getElementById('schemeDiscount').value;
        var PercentDiscount = document.getElementById('PercentDiscount').value;
        var ExtraDiscount = document.getElementById('extraDiscount').value;
        var FinalTotal = document.getElementById('SaleFinalTotal').value;
        var Debit = document.getElementById('debit').value;
        var Remarks = document.getElementById('remarks').value;
        var Balance = document.getElementById('balance').value;
        var Difference = different_priceValue;
        var InvoiceStatus = 'Enable';


        if (Date != '' && PartyName != '' && City != '' && Area != '' && booker != '' && CompanyName != '' && AccountHead != '' &&
            Total != '' && TODiscount != '' && SchemeDiscount != '' && PercentDiscount != '' && FinalTotal != '' && Debit != '' && Remarks != '' && InvoiceStatus != '') {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "dispatch",
                data: {

                    obj: obj,
                    Date: Date,
                    Invoice: Invoice,
                    PartyName: PartyName,
                    City: City,
                    Area: Area,
                    booker: booker,
                    CompanyName: CompanyName,
                    AccountHead: AccountHead,
                    Total: Total,
                    TODiscount: TODiscount,
                    SchemeDiscount: SchemeDiscount,
                    PercentDiscount: PercentDiscount,
                    ExtraDiscount: ExtraDiscount,
                    FinalTotal: FinalTotal,
                    Debit: Debit,
                    Remarks: Remarks,
                    Balance: Balance,
                    Difference: Difference,
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
        document.getElementById('debit').value = '';
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