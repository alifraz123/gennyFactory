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
                                    <div style="width: 30%;margin-right:3px">

                                        <label>Supplier</label>
                                        <select name="supplier" id="supplier" class="control-form select2" style="width: 100%;" onchange="getDateOfSelectedSupplier()" required>
                                            <option readonly selected value="">Choose Supplier</option>
                                            @foreach($parties as $partydata)
                                            <option value="{{$partydata->name}}"> {{$partydata->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="width: 25%;margin-right:3px">

                                        <label>Company</label>
                                        <select name="company" onchange="getItemsOfSelectedCompany(this.value)" id="company" class="control-form select2" style="width: 100%;">
                                            <option selected readonly value="">Choose company...</option>
                                            @foreach($companies as $company)
                                            <option value="{{$company->companyName}}">{{$company->companyName}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="width: 25%;margin-right:3px">
                                        <label>Date</label>
                                        <input type="date" name="Date" id="Date" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                    </div>


                                </div>

                                <!-- Add Product Detail -->
                                <div style="line-height: 0;" class="card-body">

                                    <div style="display: flex;">
                                        <div style="width: 10%;margin-right:3px">
                                            <label>C.No</label>
                                            <input name="cNo" id="cNo" style="width: 100%;" type="text" placeholder="C.No" required>
                                        </div>
                                        <div style="width: 30%;margin-right:3px">
                                            <label>Item Name</label>
                                            <select onchange="getVarientsOfSelectedItem(this.value)" name="itemname" id="itemname" style="width: 100%;" required class="select2">
                                                <option readonly selected value="">Choose Item...</option>

                                            </select>
                                        </div>
                                        <div style="width: 25%;margin-right:3px">

                                            <label>Varient</label>
                                            <select name="varient" id="varient" style="width: 100%;" required class="select2">
                                                <option readonly selected value="">Choose varient...</option>

                                            </select>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>Quantity</label>
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
                                    var cNo = document.getElementById('cNo').value;
                                    var itemname = document.getElementById('itemname').value;
                                    var varient = document.getElementById('varient').value;
                                    var quantity = document.getElementById('quantity').value;

                                    var tr =
                                        `<div>
                                        <input style="width:10%" type='text' name='cno[]' value='${cNo}'  >
                                        <input style="width:30%" readonly type='text' name='itemname[]' value='${itemname}'>
                                        <input style="width:25%"readonly type='text' name='varient[]' value='${varient}'>
                                        <input style="width:10%" type='number' name='quantity[]' value='${quantity}'>
                                        <button onclick="return this.parentNode.remove();" style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times</button> 
                                        </div>
                                        `;
                                    if (cNo != "" && itemname != "" && varient != "" && quantity != "") {

                                       
                                        document.getElementById('whereProductsShow').innerHTML +=tr;
                                       
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
                                            <h3 class="card-title">Sales Book Data</h3>
                                        </div>
                                    </div>
                                </div>

                                <div style="line-height: 0;padding-top: 10px;" class="card-body">
                                    <div class="row">
                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>Zone</label>
                                                <input id="zone" readonly name="zone" style="width: 100%;" type="text" required>

                                            </div>
                                        </div>

                                        <div style="width: 100%;" class="form-group">
                                            <label>City</label>

                                            <input type="text" name="City" id="City" readonly class="control-form" style="width: 100%;" required>

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
                                                    <label>Gate Pass No</label>
                                                    <input type="text" id="gatePass" name="gatePass" style="width: 100%;" required class="" placeholder="Builty No.">
                                                </div>

                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Builty No.</label>
                                                    <input type="text" id="BuiltyNo" name="BuiltyNo" style="width: 100%;" required class="" placeholder="Gate Pass No.">
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
        var supplier_value = document.getElementById('supplier').value;
        if (supplier_value != '') {
            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "getDateOfSelectedSupplier",
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

    function dispatch() {

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
                cno: ""
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

        if (true) {

            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "dispatch",
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
            document.getElementById('gatePass').value = '';
            document.getElementById('BuiltyNo').value = '';
            document.getElementById('Remarks').value = '';
            document.getElementById('cNo').value = '';
            $("#whereProductsShow div").remove();
            $("#supplier").val('').trigger('change');
            todatDate();

        }



    }


    function getItemsOfSelectedCompany(companyName) {
        var company = companyName;
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getItemsOfSelectedCompany_For_dispatch',
            type: 'post',
            data: {
                company: company,
                _token: token
            },
            success: function(data) {
                // console.log(data)
                let output = '<option selected readonly value="">Choose Item...</option>';
              
                data.forEach(el => {
                    output += `
                    <option value="${el.itemname}">${el.itemname}</option>
                    `;

                    document.getElementById('itemname').innerHTML = output;
                    
                });
            },
            error: function(req, status, error) {
                console.log(error)

            }
        })

    }

    function getVarientsOfSelectedItem(ItemName) {
        var token = '{{csrf_token()}}';
        $.ajax({
            url: 'getVarientsOfSelectedItem_For_dispatch',
            type: 'post',
            data: {
                ItemName: ItemName,
                _token: token
            },
            success: function(data) {
                if (data) {
                    // console.log("varient data is :"+data)
                    let output2 = '<option selected readonly value="">Choose varient...</option>';
                    data.forEach(el => {
                        output2 += `
                    <option value="${el.varient}">${el.varient}</option>
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