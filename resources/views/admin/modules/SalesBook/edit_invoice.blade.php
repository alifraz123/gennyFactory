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
                                            <h3 class="card-title">Edit Sales Book Detail Data</h3>
                                        </div>

                                    </div>


                                </div>
                                <div style="margin: 15px;line-height:0px" class="row">
                                    <div style="width: 30%;">
                                        <input type="hidden" id="invoice_edit" name="invoice_edit" value="{{$salebook[0]->invoice}}">
                                        <label>Supplier</label>
                                        <select name="supplier" id="supplier" class="control-form select2" style="width: 100%;" onchange="getDateOfSelectedSupplier()" required>
                                            <option disabled selected value="{{$salebook[0]->supplier}}">{{$salebook[0]->supplier}}</option>
                                            @foreach($salebook as $partydata)
                                            <option value="{{$partydata->supplier}}"> {{$partydata->supplier}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="width: 25%;">

                                        <label>Company</label>
                                        <select name="company" disabled id="company" class="control-form select2" style="width: 100%;">
                                            <option selected value="{{$salebook[0]->company}}">{{$salebook[0]->company}}</option>
                                            @foreach($salebook as $item)
                                            <option value="{{$item->company}}"> {{$item->company}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="width: 25%;">
                                        <label>Date</label>
                                        <input type="date" name="Date" value="{{$salebook[0]->date}}" id="Date" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                    </div>


                                </div>

                                <!-- Add Product Detail -->
                                <div style="line-height: 0;" class="card-body">

                                    <div class="row">
                                        <div style="width: 10%;">
                                            <label>C.No</label>
                                            <input name="cNo" id="cNo" style="width: 100%;" type="text" placeholder="C.No" required>
                                        </div>
                                        <div style="width: 30%;">
                                            <label>Item Name</label>
                                            <select name="itemname" id="itemname" style="width: 100%;" required class="select2">
                                                <option disabled selected value="">Choose ItemName</option>
                                                @foreach($items as $item)
                                                <option value="{{$item->itemname}}"> {{$item->itemname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="width: 25%;">

                                            <label>Varient</label>
                                            <select name="varient" id="varient" style="width: 100%;" required class="select2">
                                                <option disabled selected value="">Choose varient</option>
                                                @foreach($parties as $item)
                                                <option value="{{$item->varient}}"> {{$item->varient}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="width: 10%;">

                                            <label>Quantity</label>
                                            <input name="quantity" id="quantity" style="width: 100%;" type="number" required>

                                        </div>

                                        <button style="width: 10%;height: 26px;margin-top: 8px;" class="addRow">ADD +</button>

                                    </div>

                                    <table style="margin-left: -10px;">

                                        <tbody id="whereProductsShow">
                                            @foreach($salebook_detail as $sbd)
                                            <tr>
                                                <td><input style="width:100px"  value="{{$sbd->cno}}" type='text' name='cno[]'></td>
                                                <td><input style="width:230px" disabled value="{{$sbd->ItemName}}" type='text' name='itemname[]'></td>
                                                <td><input style="width:230px" disabled value="{{$sbd->varient}}" type='text' name='varient[]'></td>
                                                <td><input style="width:100px" value="{{$sbd->qty}}" type='text' name='quantity[]' required>
                                                <td> <button style="padding:11px" class='deleteRow'>delete</button> </td>
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
                                    var cNo = document.getElementById('cNo').value;
                                    var itemname = document.getElementById('itemname').value;
                                    var varient = document.getElementById('varient').value;
                                    var quantity = document.getElementById('quantity').value;

                                    var tr =
                                        `<tr>
                                        <td><input style="width:100px" type='text'  name='cno[]' value='${cNo}'  ></td>
                                        <td><input style="width:230px"disabled type='text'  name='itemname[]' value='${itemname} '></td>
                                        <td><input style="width:230px" disabled type='text' name='varient[]'  value='${varient}' ></td>
                                        <td><input style="width:100px" type='text'  name='quantity[]' value='${quantity}'  >
                                        <td> <button style="padding:11px" class='deleteRow'>delete</button> </td>
                                        </tr>`;

                                    $('tbody').append(tr);



                                    $(".deleteRow").click(function() {

                                        $(this).parent().parent().remove();

                                    });
                                    $("#itemname").val('').trigger('change');
                                    document.getElementById('varient').value = '';
                                    document.getElementById('quantity').value = '';
                                    document.getElementById('cno').value = '';

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

                                        <div style="width: 100%;" class="form-group">
                                            <label>City</label>

                                            <select disabled name="City" id="City" class="control-form select2" style="width: 100%;">
                                                <option selected value="{{$salebook[0]->city}}">{{$salebook[0]->city}}</option>
                                                @foreach($cities as $item)
                                                <option value="{{$item->city}}"> {{$item->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" id="address" disabled style="width: 100%;line-height:initial" rows="3" required>
                                                {{$salebook[0]->address}}
                                                </textarea>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Zone</label>
                                                    <input id="zone" disabled value="{{$salebook[0]->zone}}" name="zone" style="width: 100%;" type="text" required >
                                                </div>
                                            </div>


                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Gate Pass No</label>
                                                    <input type="text" value="{{$salebook[0]->gatePass}}" id="gatePass" name="gatePass" style="width: 100%;" required >
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Builty No.</label>
                                                    <input type="text" value="{{$salebook[0]->builtyNo}}" id="BuiltyNo" name="BuiltyNo" style="width: 100%;" required class="" placeholder="Builty No.">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea name="Remarks" id="Remarks" style="width: 100%;line-height:initial" rows="3" required>
                                                    {{$salebook[0]->remarks}}
                                                    </textarea>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button style="padding: 7px;" onclick="update_dispatch()" class="btn btn-primary">Submit</button>

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

    function setDate() {
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

    function getDateOfSelectedSupplier() {
        var supplier_value = document.getElementById('supplier').value;
        if (supplier_value != '') {
            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "../getDateOfSelectedSupplier",
                data: {
                    supplier: supplier_value,
                    _token: token
                },
                dataType: "json",
                success: function(data) {

                    // console.log(data);
                    document.getElementById('City').value = data.city;
                    document.getElementById('address').value = data.address;
                    document.getElementById('zone').value = data.zone;

                },
                error: function(req, status, error) {
                    console.log(error);
                }
            });
        }





    }

    function update_dispatch() {

        var itemname = document.getElementsByName('itemname[]');
        var varient = document.getElementsByName('varient[]');
        var quantity = document.getElementsByName('quantity[]');
        var cno = document.getElementsByName('cno[]');
        var obj = [];
        for (var i = 0; i < itemname.length; i++) {
            var itemname1 = itemname[i].value;
            var quantity1 = quantity[i].value;
            var varient1 = varient[i].value;
            var cno1 = cno[i].value;
            var obje;
            obje = {
                itemname: "",
                quantity: "",
                varient: "",
                cno: "",
            };
            obje.itemname = itemname1;
            obje.quantity = quantity1;
            obje.varient = varient1;
            obje.cno = cno1;
            obj.push(obje);
        }
        // console.log(obj);

        var City = document.getElementById('City').value;
        var zone = document.getElementById('zone').value;
        var gatePass = document.getElementById('gatePass').value;
        var BuiltyNo = document.getElementById('BuiltyNo').value;
        var Remarks = document.getElementById('Remarks').value;

        if (City != '' && Remarks != '' && zone != '' && gatePass != '' && BuiltyNo != '') {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "../update_dispatch",
                data: {

                    obj: obj,
                    Date: document.getElementById('Date').value,
                    City: document.getElementById('City').value,
                    BuiltyNo: document.getElementById('BuiltyNo').value,
                    zone: document.getElementById('zone').value,
                    company: document.getElementById('company').value,
                    supplier: document.getElementById('supplier').value,
                    address: document.getElementById('address').value,
                    gatePass: document.getElementById('gatePass').value,
                    Remarks: document.getElementById('Remarks').value,
                    invoice_edit: document.getElementById('invoice_edit').value,
                    _token: token
                },
                dataType: "text",
                success: function(data) {
                    console.log("returned data is :" + data);
                    setDate();
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


            $("#company").val('').trigger('change');
            $("#itemname").val('').trigger('change');
            $("#varient").val('').trigger('change');
            $("#quantity").val('').trigger('change');
            $("#City").val('').trigger('change');
            document.getElementById('address').value = '';
            document.getElementById('zone').value = '';
            document.getElementById('gatePass').value = '';
            document.getElementById('BuiltyNo').value = '';
            document.getElementById('Remarks').value = '';
            $("#whereProductsShow tr").remove();
            $("#supplier").val('').trigger('change');

        }



    }
</script>



@endsection