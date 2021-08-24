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
                                        <div class="col-md-6">
                                            <h3 class="card-title">Sales Book Detail Data</h3>
                                        </div>

                                    </div>


                                </div>
                                <div style="margin: 15px;line-height:0px" class="row">
                                    <div style="width: 30%;">

                                        <label>Party Name</label>
                                        <select name="PartyName" class="control-form select2" style="width: 100%;" onchange="getBalance_on_partyname_change(this)" id="PartyName" required >
                                            <option disabled selected value="">Choose value</option>
                                            @foreach($parties as $partydata)
                                            <option value="{{$partydata->PartyName}}"> {{$partydata->PartyName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="width: 25%;">
                                        <label>Date</label>
                                        <input type="date" class="form-control" style="width: 100%;padding:0;height:30px" name="Date"  id="Date" required>
                                    </div>
                                   
                                    <div style="width: 15%;">

                                        <label>Balance</label>
                                        <input type="text" style="width: 100%;height:30px" id="Balance" disabled name="Balance" required>

                                    </div>
                                </div>

                                <!-- Add Product Detail -->
                                <div style="line-height: 0;" class="card-body">

                                    <div class="row">
                                        <div style="width: 30%;">
                                            <label>Item Name</label>
                                            <select onchange="getSelectedProductData(this.id)" style="width: 100%;" required name="ItemName[]" id="ItemName" class="select2">
                                                <option disabled selected value="">Choose value</option>
                                                @foreach($items as $item)
                                                <option value="{{$item->ItemName}}"> {{$item->ItemName}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="width: 10%;">

                                            <label>Rate</label>
                                            <input style="width: 100%;" type="number" name="Rate[]" id="Rate" required class="">

                                        </div>
                                        <div style="width: 10%;">

                                            <label>Quantity</label>
                                            <input style="width: 100%;" type="number" oninput="countTotalWithQuantity()" name="Quantity[]" id="Quantity" required>

                                        </div>
                                        <div style="width: 20%;">
                                            <!-- text input -->
                                            <div class="form-group">
                                                <label>Category</label>
                                                <input style="width: 100%;" type="text" name="Category[]" id="Category" required>
                                            </div>
                                        </div>
                                        <div style="width: 10%;">
                                            <div class="form-group">
                                                <label>P. Total</label>
                                                <input style="width:100%;" type="number" name="productTotal[]" id="productTotal" required>
                                            </div>
                                        </div>
                                        <button style="width: 10%;height: 26px;margin-top: 8px;" class="addRow">ADD +</button>

                                    </div>

                                    <table style="margin-left: -10px;">

                                        <tbody id="whereProductsShow">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                            <script>
                                $('.addRow').on('click', function() {
                                    var ItemName = document.getElementById('ItemName').value;
                                    var Rate = document.getElementById('Rate').value;
                                    var Category = document.getElementById('Category').value;
                                    var Quantity = document.getElementById('Quantity').value;
                                    var productTotal = document.getElementById('productTotal').value;
                                    // alert(aa);



                                    var tr =
                                        `<tr>
                                        <td><input style="width:230px" type='text' class='' name='ItemName[]' value='${ItemName} '></td>
                                        <td><input style="width:70px" type='number' name='Rate[]' class='' value='${Rate}' ></td>
                                        <td><input style="width:70px" type='number' oninput='changeInvoice_oninput()' name='Quantity[]' value='${Quantity}' required >
                                        <td><input style="width:160px" type='text' name='Category[]'  value='${Category}' required class='' ></td>
                                        <td><input style="width:70px" type='number' name='productTotal[]' value='${productTotal}' required class='' >
                                       
                                                                              
                                        <td> <button style="padding:11px" class='deleteRow'>delete</button> </td>
                                        </tr>`;

                                    $('tbody').append(tr);



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

                                        <input type="hidden" id="invoice" name="invoice" value="{{$productSaleId}}">



                                        <div style="width: 100%;" class="form-group">
                                            <label>City</label>
                                            <!-- <select style="width: 100%;" name="City" id="City" required class=" select2 ">
                                                <option disabled selected value="">Choose value...</option>
                                                @foreach($data as $partydata)

                                                <option value="{{$partydata->CityName}}"> {{$partydata->CityName}}</option>
                                                @endforeach

                                            </select> -->
                                            <input type="text" disabled style="width: 100%;" name="City" id="City">

                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Sender Name</label>
                                                    <input style="width: 100%;" type="text" id="Sender" name="Sender" required class="" placeholder="Sender Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Reciever Name</label>
                                                    <input type="text" style="width: 100%;" id="Reciever" name="Reciever" required class="" placeholder="Reciever Name">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Total Bill</label>
                                                    <input type="text" style="width: 100%;" disabled name="Total" id="Total" required class="" placeholder="Total Bill">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <!-- text input -->
                                                <div class="form-group">
                                                    <label>Rent</label>
                                                    <input type="number" style="width: 100%;" oninput="add_total_and_rent()" name="Rent" id="Rent" required class="" placeholder="Rent">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Final Total</label>
                                                    <input type="text" style="width: 100%;" disabled name="FinalTotal" id="FinalTotal" required class="" placeholder="Final Total">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Builty No.</label>
                                                    <input type="text" style="width: 100%;" id="BuiltyNo" name="BuiltyNo" required class="" placeholder="Builty No.">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea name="Remarks"  id="Remarks" style="width: 100%;line-height:initial" rows="3" required>

                                                    </textarea>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button style="padding: 7px;" onclick="sendMultipleData()" class="btn btn-primary">Send Data</button>

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
    setDate();
    function setDate(){
        let currentDate = new Date();
                                        let cDay = currentDate.getDate();
                                        let cMonth = currentDate.getMonth() + 1;
                                        if (cMonth >= 1 || cMonth <= 9) {
                                            cMonth = "0" + cMonth;
                                            // alert(cMonth);

                                        } else {
                                            cMonth = cMonth;
                                            // alert(cMonth);

                                        }
                                        let cYear = currentDate.getFullYear();
                                        document.getElementById('Date').value = cYear + "-" + cMonth + "-" + cDay;
    }
    
    function getSelectedProductData(partyName) {
       
        var PartyName = document.getElementById(partyName).value;
        var token = '{{csrf_token()}}';
        $.ajax({
            type: "post",
            url: "getSelectedProductData",
            data: {
                id: PartyName,
                _token: token
            },
            dataType: "json",
            success: function(data) {
                console.log(data);
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
        var PartyName = document.getElementById('PartyName').value;
        $.ajax({
            type: "post",
            url: "getCityOfSelectedParty",
            data: {
                id: PartyName,
                _token: token
            },
            dataType: "json",
            success: function(data) {
               
                document.getElementById('City').value = data.City;
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

        if (partyname != '' && City != '' && Remarks != '' && Sender != '' && Reciever != '' && Rent != '' && BuiltyNo != '') {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "sendMultipleData",
                data: {

                    obj: obj,
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
                    setDate();
                    // console.log(data);
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
            let currentDate = new Date();
            let cDay = currentDate.getDate();
            let cMonth = currentDate.getMonth() + 1;
            let cYear = currentDate.getFullYear();
            document.getElementById('Date').value = cYear + "-" + cMonth + "-" + cDay;
            // window.location.reload();

        }



    }
</script>



@endsection