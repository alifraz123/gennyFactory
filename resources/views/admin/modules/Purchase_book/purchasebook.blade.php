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
                                            <h3 class="card-title">PurchaseBook Detail Data</h3>
                                        </div>

                                    </div>


                                </div>
                                <div style="margin: 15px;line-height:0px" class="row">
                                    <div style="width: 30%;margin-right:3px">

                                        <label>Vender</label>
                                        <select name="vender" id="vender" class="control-form select2" style="width: 100%;" onchange="getDateOfSelectedSupplier()" required>
                                            <option readonly selected value="">Choose vender</option>
                                            @foreach($parties as $partydata)
                                            <option value="{{$partydata->name}}"> {{$partydata->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="width: 25%;margin-right:3px;display:none">
                                        <label>Date</label>
                                        <input type="date" name="Date" id="Date" class="form-control" style="width: 100%;padding:0;height:30px;" required>
                                    </div>

                                    <div style="width:25%;margin-right:3px">
                                        <label>Dispatch Date</label>
                                        <input type="date" name="dispatchDate" id="dispatchDate" class="form-control" style="width: 100%;padding:0;height:30px" required>

                                    </div>
                                    <div style="width:25%;margin-right:3px">
                                        <label>Recieve Date</label>
                                        <input type="date" name="recieveDate" id="recieveDate" class="form-control" style="width: 100%;padding:0;height:30px" required>

                                    </div>


                                </div>

                                <!-- Add Product Detail -->
                                <div style="line-height: 0;" class="card-body">

                                    <div style="display: flex;">

                                        <div style="width: 30%;margin-right:3px">
                                            <label>Item Name</label>
                                            <select name="itemname" id="itemname" style="width: 100%;" required class="select2">
                                                <option readonly selected value="">Choose Item...</option>
                                                @foreach($items as $item)
                                                <option value="{{$item->itemname}}"> {{$item->itemname}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="width: 20%;margin-right:3px">
                                            <label>Category</label>
                                            <select onchange="getVarientsOfSelectedItem(this.value)" name="category" id="category" style="width: 100%;" required class="select2">
                                                <option readonly selected value="">Choose category...</option>
                                                <option value="Raw Material">Raw Material</option>
                                                <option value="Packing Material">Packing Material</option>
                                                <option value="Stickers">Stickers</option>

                                            </select>
                                        </div>
                                        <div style="width: 15%;margin-right:3px">

                                            <label>Varient</label>
                                            <select name="varient" id="varient" style="width: 100%;" required class="select2">
                                                <option readonly selected value="">Choose varient...</option>


                                            </select>
                                        </div>
                                        <div style="width: 15%;margin-right:3px">
                                            <label>Carton qty</label>
                                            <input type="text" id="ctn_qty" name="ctn_qty" style="width: 100%;" require placeholder="Carton qty">

                                        </div>


                                        <div style="width: 15%;margin-right:3px">
                                            <label>T. Quantity</label>
                                            <input name="quantity" id="quantity" style="width: 100%;" type="number" required>

                                        </div>

                                        <button onclick="addRow()" id="addRow" style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" class="addRow">+</button>

                                    </div>
                                    <div id="whereProductsShow">
                                    </div>
                                </div>
                            </div>
                            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

                            <script>
                                function addRow() {
                                    var category = document.getElementById('category').value;
                                    var carton_qty = document.getElementById('ctn_qty').value;
                                    var itemname = document.getElementById('itemname').value;
                                    var varient = document.getElementById('varient').value;
                                  
                                    var quantity = document.getElementById('quantity').value;

                                    var tr =
                                        `<div>
                                       
                                        <input style="width:29.5%" readonly type='text' name='itemname[]' value='${itemname}'>
                                        <input style="width:19.5%" type='text' name='category[]' value='${category}'  >
                                        <input style="width:14.5%"readonly type='text' name='varient[]' value='${varient}'>
                                        <input style="width: 15%;" type="text" id="ctn_qty" name="ctn_qty[]" value='${carton_qty}'  require >
                                        <input style="width:14.5%" type='number' name='quantity[]' value='${quantity}'>
                                        <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                                        </div>
                                        `;
                                    if (cNo != "" && itemname != "" && varient != "" && quantity != "") {


                                        document.getElementById('whereProductsShow').innerHTML += tr;

                                        $("#itemname").val('').trigger('change');
                                        document.getElementById('varient').value = '';
                                        document.getElementById('quantity').value = '';
                                        document.getElementById('varient').focus();
                                    }
                                    // $(".deleteRow").click(function() {
                                    //     $(this).parent().remove();
                                    // });



                                };
                            </script>

                        </div>
                        <div class="col-md-3">
                            <div class="card card-dark">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="card-title">PurchaseBook Data</h3>
                                        </div>
                                    </div>
                                </div>

                                <div style="line-height: 0;padding-top: 10px;" class="card-body">
                                    <div class="row">
                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>Zone</label>
                                                <input id="zone" readonly name="zone" placeholder="Zone" style="width: 100%;" type="text" required>

                                            </div>
                                        </div>

                                        <div style="width: 100%;" class="form-group">
                                            <label>City</label>

                                            <input type="text" name="City" id="City" placeholder="City" readonly class="control-form" style="width: 100%;" required>

                                        </div>
                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" id="address" readonly style="width: 100%;line-height:initial" rows="3" required>

                                                </textarea>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Via Transport</label>
                                                    <input type="text" id="via" name="via" style="width: 100%;" required class="" placeholder="Via Transport">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Builty No.</label>
                                                    <input type="text" id="BuiltyNo" name="BuiltyNo" style="width: 100%;" required placeholder="builtyNo.">
                                                </div>

                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Remarks</label>
                                                    <textarea name="Remarks" id="Remarks" style="width: 100%;line-height:initial" rows="3" required>

                                                    </textarea>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button style="padding: 7px;" onclick="dispatch()" class="btn btn-primary">Submit</button>

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
    todatDate();

    function getDateOfSelectedSupplier() {
        var vender_value = document.getElementById('vender').value;
        if (vender_value != '') {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "getDateOfSelectedVender",
                data: {
                    vender: vender_value,
                    _token: token
                },

                success: function(data) {

                    // console.log("return : " + data);
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

    function dispatch() {

        var itemname = document.getElementsByName('itemname[]');
        var varient = document.getElementsByName('varient[]');
        var quantity = document.getElementsByName('quantity[]');
        var category = document.getElementsByName('category[]');
        var ctn_qty = document.getElementsByName('ctn_qty[]');
        var obj = [];
        for (var i = 0; i < itemname.length; i++) {
            var itemname1 = itemname[i].value;
            var quantity1 = quantity[i].value;
            var varient1 = varient[i].value;
            var category1 = category[i].value;
            var ctn_qty1 = ctn_qty[i].value;
            var obje;
            obje = {
                itemname: "",
                quantity: "",
                varient: "",
                category: "",
                ctn_qty:""
            };
            obje.itemname = itemname1;
            obje.quantity = quantity1;
            obje.varient = varient1;
            obje.category = category1;
            obje.ctn_qty = ctn_qty1;
            obj.push(obje);
        }
        console.log(obj);

        var City = document.getElementById('City').value;
        var zone = document.getElementById('zone').value;
        var via = document.getElementById('via').value;
        var BuiltyNo = document.getElementById('BuiltyNo').value;
        
        var Remarks = document.getElementById('Remarks').value;

        if (City != '' && Remarks != '' && zone != '' && via != '' && BuiltyNo != '' && ctn_qty != '') {
            
            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "purchase",
                data: {

                    obj: obj,
                    Date: document.getElementById('Date').value,
                    City: document.getElementById('City').value,
                    BuiltyNo: document.getElementById('BuiltyNo').value,
                    zone: document.getElementById('zone').value,
                   
                    vender: document.getElementById('vender').value,
                    address: document.getElementById('address').value,
                    via: document.getElementById('via').value,
                    Remarks: document.getElementById('Remarks').value,
                    dispatchDate: document.getElementById('dispatchDate').value,
                    recieveDate: document.getElementById('recieveDate').value,
                    _token: token
                },
                dataType: "text",
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


            $("#company").val('').trigger('change');
            $("#itemname").val('').trigger('change');
            $("#varient").val('').trigger('change');
            $("#quantity").val('').trigger('change');
            $("#City").val('').trigger('change');
            document.getElementById('address').value = '';
            document.getElementById('zone').value = '';
            document.getElementById('via').value = '';
            document.getElementById('BuiltyNo').value = '';
            document.getElementById('Remarks').value = '';
            document.getElementById('cNo').value = '';
            $("#whereProductsShow div").remove();
            $("#supplier").val('').trigger('change');
            todatDate();

        }



    }




    function getVarientsOfSelectedItem(material_type) {
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getVarientsOfSelectedItem_For_purchase',
            type: 'post',
            data: {
                material_type: material_type,
                _token: token
            },
            success: function(data) {

                if (data) {
                    // console.log(data)
                    let output2 = '<option selected readonly value="">Choose varient...</option>';
                    data.forEach(el => {
                        output2 += `
                    <option value="${el.material}">${el.material}</option>
                    `;
                        document.getElementById('varient').innerHTML = output2;
                    });
                }

            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }

    function todatDate() {
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        $('#Date').val(today);
    }


    var cNo = document.getElementById("cNo");
    cNo.addEventListener("keydown", function(e) {
        if (e.key === "Enter") {
            document.getElementById('addRow').click();

        }
    });
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