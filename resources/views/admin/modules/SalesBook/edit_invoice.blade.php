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
                        <div class="col-md-9">

                            <div class="card card-dark">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="card-title">Sales Book Detail Data</h3>
                                        </div>

                                    </div>


                                </div>
                                <div style="margin: 15px;line-height:0px" class="row">
                                    <div style="width: 30%;">

                                        <label>Party Name</label>
                                        <select name="PartyName" style="width: 100%;" disabled onchange="getBalance_on_partyname_change(this)" id="PartyName" required class="select2" placeholder="Party Name">
                                            <option selected value="{{$salebook->PartyName}}">{{$salebook->PartyName}}</option>
                                            @foreach($parties as $partydata)
                                            <option value="{{$partydata->PartyName}}"> {{$partydata->PartyName}}</option>
                                            @endforeach

                                        </select>

                                    </div>
                                    <div style="width: 25%;">

                                        <label>Date</label>
                                        <input type="date" style="width: 100%;padding:0;height:30px" name="Date" value="{{$salebook->Date}}"  id="Date" required class="form-control" >

                                    </div>
                                    <div style="width: 10%;">

                                        <label>Balance</label>
                                        <input type="text" style="width: 100%;" value="{{$salebook->Balance}}" id="Balance" disabled name="Balance" required class="">

                                    </div>

                                </div>
                                <!-- Add Product Detail -->
                                <div style="padding: 12px;line-height: 0.5;" class="card-body">

                                    <div style="margin: 0;" class="row">
                                        <div style="width: 30%;">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Item Name</label>
                                                <select onchange="getSelectedProductData(this.id)" style="width: 100%;" required name="ItemName[]" id="ItemName" class="select2">
                                                    <option disabled selected value="">Choose value</option>
                                                    @foreach($items as $item)

                                                    <option value="{{$item->ItemName}}"> {{$item->ItemName}}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>
                                        <div style="width: 10%;">
                                            <div class="form-group">
                                                <label>Rate</label>
                                                <input type="number" style="width: 70px;" name="Rate[]" id="Rate" required class="" placeholder="Rate">
                                            </div>
                                        </div>
                                        <div style="width: 10%;">
                                            <div class="form-group">
                                                <label>Quantity</label>
                                                <input type="number" style="width: 70px;" oninput="countTotalWithQuantity()" name="Quantity[]" id="Quantity" required class="" placeholder="Quantity">
                                            </div>
                                        </div>


                                        <div style="width: 10%;">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Category</label>
                                                <input type="text" style="width: 70px;" name="Category[]" id="Category" required class="" placeholder="Category">
                                            </div>
                                        </div>
                                        <div style="width: 10%;">
                                            <div class="form-group">
                                                <label>P. Total</label>
                                                <input type="number" style="width: 70px;" name="productTotal[]" id="productTotal" required class="" placeholder="Product Total">
                                            </div>
                                        </div>

                                        <button style="width: 10%;height: 26px;margin-top: 16px;" class="addRow">ADD +</button>


                                        <table style="margin-left: 0px;">

                                            <tbody id="whereProductsShow">
                                                @foreach($salebook_detail as $sbd)
                                                <tr>
                                                    <td><input style="width: 230px;" disabled type='text' class='' name='ItemName[]' value='{{$sbd->ItemName}}'></td>
                                                    <td><input type='number' style="width: 70px;" name='Rate[]' class='' value='{{$sbd->Rate}}'></td>
                                                    <td><input type='number' style="width: 70px;" oninput="changeInvoice_oninput()" name='Quantity[]' value='{{$sbd->Quantity}}' required class=''>
                                                    <td><input type='text' style="width: 160px;" name='Category[]' value='{{$sbd->Category}}' required class=''></td>
                                                    <td><input type='number' style="width: 70px;" name='productTotal[]' value='{{$sbd->Total}}' required class=''>
                                                    <th> <button style="padding:7px" class=' deleteRow'>delete</button> </th>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                                <script>
                                    $(".deleteRow").click(function() {

                                        $(this).parent().parent().remove();
                                        addTotal();
                                    });
                                    $('.addRow').on('click', function() {
                                        var ItemName = document.getElementById('ItemName').value;
                                        var Rate = document.getElementById('Rate').value;
                                        var Category = document.getElementById('Category').value;
                                        var Quantity = document.getElementById('Quantity').value;
                                        var productTotal = document.getElementById('productTotal').value;
                                        // alert(aa);
                                        if (Rate != '') {
                                            var tr =
                                                `<tr>
                                            <td><input type='text' style="width:230px" disabled class='' name='ItemName[]' value='${ItemName}'></td> 
                                            <td><input type='number' style="width:70px" name='Rate[]' class='' value='${Rate}' ></td>
                                            <td><input type='number' style="width:70px" oninput='changeInvoice_oninput()' name='Quantity[]' value='${Quantity}' required class='' >
                                            <td><input type='text' style="width:160px" name='Category[]'  value='${Category}' required class='' ></td>
                                            <td><input type='number' style="width:70px" name='productTotal[]' value='${productTotal}' required class='' >
                                            <th> <button style="padding:7px" class='deleteRow'>delete</button> </th>
                                            </tr>`;
                                            $('tbody').append(tr);
                                            $(".deleteRow").click(function() {

                                                $(this).parent().parent().remove();
                                                addTotal();
                                            });
                                        }
                                        $(".deleteRow").click(function() {
                                            $(this).parent().parent().remove();
                                            addTotal();
                                        });
                                        $("#ItemName").val('').trigger('change');
                                        document.getElementById('Rate').value = '';
                                        document.getElementById('Quantity').value = '';
                                        document.getElementById('Category').value = '';
                                        document.getElementById('productTotal').value = '';
                                        addTotal();
                                    });
                                </script>



                            </div>
                        </div>
                        <div class="col-md-3">

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

                                        <!-- <input type="hidden" id="invoice" name="invoice" value=""> -->
                                        <input type="hidden" id="invoice_edit" name="invoice_edit" value="{{$salebook->invoice}}">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>City</label>
                                                <select name="City" disabled style="width: 100%;" id="City" required class="select2">
                                                    <option selected value="{{$salebook->City}}">{{$salebook->City}}</option>
                                                    @foreach($cities as $partydata)

                                                    <option value="{{$partydata->CityName}}"> {{$partydata->CityName}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div style="width: 100%;">
                                                <div class="form-group">
                                                    <label>Sender Name</label>
                                                    <input type="text" style="width: 100%;" id="Sender" value="{{$salebook->Sender}}" name="Sender" required class="" placeholder="Sender Name">
                                                </div>
                                            </div>

                                            <div style="width: 100%;">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Reciever Name</label>
                                                    <input type="text" style="width: 100%;" id="Reciever" value="{{$salebook->Reciever}}" name="Reciever" required class="" placeholder="Reciever Name">
                                                </div>
                                            </div>
                                            <div style="width: 100%;">
                                                <div class="form-group">
                                                    <label>Total Bill</label>
                                                    <input type="text" style="width: 100%;" value="{{$salebook->Total}}" disabled name="Total" id="Total" required class="" placeholder="Total Bill">
                                                </div>
                                            </div>

                                            <div style="width: 100%;">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Rent</label>
                                                    <input type="number" style="width: 100%;" value="{{$salebook->Rent}}" oninput="add_total_and_rent()" name="Rent" id="Rent" required class="" placeholder="Rent">
                                                </div>
                                            </div>
                                            <div style="width: 100%;">
                                                <div class="form-group">
                                                    <label>Final Total</label>
                                                    <input type="text" style="width: 100%;" value="{{$salebook->FinalTotal}}" disabled name="FinalTotal" id="FinalTotal" required class="" placeholder="Final Total">
                                                </div>
                                            </div>
                                            <div style="width: 100%;">
                                                <div class="form-group">
                                                    <label>Builty No.</label>
                                                    <input type="text" style="width: 100%;" value="{{$salebook->BuiltyNo}}" id="BuiltyNo" name="BuiltyNo" required class="" placeholder="Builty No.">
                                                </div>

                                            </div>


                                            <div style="width: 100%;">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea name="Remarks" id="Remarks" value=" {{$salebook->Remarks}}" style="width: 100%;line-height:initial" rows="3" required placeholder="Remarks">
                                                    {{$salebook->Remarks}}
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button style="padding: 7px;" onclick="sendMultipleData()" class=" btn btn-primary">UPDATE</button>
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
    function getSelectedProductData(id) {

        var id = document.getElementById(id).value;

        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "../getSelectedProductData",
            data: {
                id: id,
                _token: token
            },
            dataType: "json",
            success: function(data) {
                // console.log("selected data is :"+data);
                document.getElementById('Rate').value = data[0].Rate;
                document.getElementById('Category').value = data[0].Category;
                document.getElementById('Quantity').value = data[0].Quantity;
                document.getElementById('productTotal').value = data[0].Rate * data[0].Quantity;
            },
            error: function(req, status, error) {
                console.log(error);
            }
        });
    }

    function getBalance_on_partyname_change() {
        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "../getBalanceOfCurrentParty",
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

    function countTotalWithQuantity() {
        var rate = document.getElementById('Rate').value;
        var quantity = document.getElementById('Quantity').value;
        var productTotal = rate * quantity;
        document.getElementById('productTotal').value = productTotal;
    }

    function addTotal() {
        var grandTotal = 0;
        var productTotal = document.getElementsByName('productTotal[]');
        for (var i = 1; i < productTotal.length; i++) {
            var productTotal1 = productTotal[i].value;
            grandTotal = grandTotal + parseInt(productTotal1);
        }
        document.getElementById('Total').value = grandTotal;
        // alert(grandTotal);
    }

    function add_total_and_rent() {
        var total = document.getElementById('Total').value;
        var rent = document.getElementById('Rent').value;
        var totalbill = parseInt(total) + parseInt(rent);
        document.getElementById('FinalTotal').value = totalbill;
    }

    function changeInvoice_oninput() {
        var ItemName = document.getElementsByName('ItemName[]');
        var Rate = document.getElementsByName('Rate[]');
        var Category = document.getElementsByName('Category[]');
        var Quantity = document.getElementsByName('Quantity[]');
        var productTotal = document.getElementsByName('productTotal[]');



        for (var i = 1; i < Rate.length; i++) {

            var ItemName1 = ItemName[i].value;

            var Rate1 = Rate[i].value;

            var Category1 = Category[i].value;
            var Quantity1 = Quantity[i].value;

            var productTotal1;
            productTotal[i].value = Rate1 * Quantity1;


            // alert(ItemName1+" "+Rate1+" "+Category1+" "+Quantity1+" "+productTotal1);


        }
    }

    function sendMultipleData() {


        var ItemName = document.getElementsByName('ItemName[]');
        var Rate = document.getElementsByName('Rate[]');
        var Category = document.getElementsByName('Category[]');
        var Quantity = document.getElementsByName('Quantity[]');
        var productTotal = document.getElementsByName('productTotal[]');
        var obj;
        obj = [];

        for (var i = 1; i < Rate.length; i++) {
            var ItemName1 = ItemName[i].value;
            var Rate1 = Rate[i].value;
            var Category1 = Category[i].value;
            var Quantity1 = Quantity[i].value;
            var productTotal1 = productTotal[i].value;
            //    console.log(ItemName1+"-"+Rate1+"-"+Category1+"-"+Quantity1+"-"+productTotal1);
            var obje;
            obje = {
                ItemName: "",
                Rate: "",
                Category: "",
                Quantity: "",
                Total: ""
            };
            obje.ItemName = ItemName1;
            obje.Rate = Rate1;
            obje.Category = Category1;
            obje.Quantity = Quantity1;
            obje.Total = productTotal1
            obj.push(obje);

        }
        // console.log(obj);
        var partyname = document.getElementById('PartyName').value;
        var City = document.getElementById('City').value;
        var Sender = document.getElementById('Sender').value;
        var Reciever = document.getElementById('Reciever').value;
        var Rent = document.getElementById('Rent').value;
        var BuiltyNo = document.getElementById('BuiltyNo').value;
        var Remarks = document.getElementById('Remarks').value;
        var Date = document.getElementById('Date').value;
        if (Date != '' && partyname != '' && City != '' && Remarks != '' && Sender != '' && Reciever != '' && Rent != '' && BuiltyNo != '') {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "../sendMultipleData_edit",
                data: {

                    obj: obj,
                    invoice_edit: document.getElementById('invoice_edit').value,
                    Date: document.getElementById('Date').value,
                    City: document.getElementById('City').value,
                    BuiltyNo: document.getElementById('BuiltyNo').value,
                    Sender: document.getElementById('Sender').value,
                    Reciever: document.getElementById('Reciever').value,
                    Total: document.getElementById('Total').value,
                    Rent: document.getElementById('Rent').value,
                    FinalTotal: document.getElementById('FinalTotal').value,
                    Balance: document.getElementById('Balance').value,
                    PartyName: document.getElementById('PartyName').value,
                    Remarks: document.getElementById('Remarks').value,
                    _token: token
                },
                dataType: "text",
                success: function(data) {
                    console.log(data);
                    var output = `
                                <div class="alert alert-success">
            <button class="close" style="font-size: 10px;" data-dismiss="alert">&times</button>
            Updated Successfuly
        </div>    
                                `;
                    document.getElementById('show_insert_status').innerHTML = output;


                },
                error: function(req, status, error) {
                    console.log(error);
                    var output = `
                                <div class="alert alert-danger">
            <button class="close" style="font-size: 10px;" data-dismiss="alert">&times</button>
            Not Updated
        </div>
                                `;
                    document.getElementById('show_insert_status').innerHTML = output;

                }
            });
            $("#whereProductsShow tr").remove();
            document.getElementById('Date').value = '';
            // document.getElementById('City').value = '';
            $("#City").val('').trigger('change');
            // document.getElementById('PartyName').value = '';
            $("#PartyName").val('').trigger('change');
            document.getElementById('Sender').value = '';
            document.getElementById('Reciever').value = '';
            document.getElementById('Total').value = '';
            document.getElementById('Rent').value = '';
            document.getElementById('FinalTotal').value = '';
            document.getElementById('Balance').value = '';
            document.getElementById('BuiltyNo').value = '';
            document.getElementById('Remarks').value = '';



        }



    }
</script>



@endsection