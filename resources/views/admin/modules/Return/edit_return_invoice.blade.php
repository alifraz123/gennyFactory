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
                                    <div style="width: 30%;margin-right:3px">
                                        <input type="hidden" id="invoice_edit" name="invoice_edit" value="{{$salebook[0]->invoice}}">
                                        <label>Supplier</label>
                                        <select name="supplier" id="supplier" class="control-form select2" style="width: 100%;" onchange="getDateOfSelectedSupplier()" required>
                                            <option readonly selected value="{{$salebook[0]->supplier}}">{{$salebook[0]->supplier}}</option>
                                            @foreach($salebook as $partydata)
                                            <option value="{{$partydata->supplier}}"> {{$partydata->supplier}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div style="width: 25%;margin-right:3px">

                                        <label>Company</label>
                                        <select name="company" readonly id="company" class="control-form select2" style="width: 100%;">
                                            <option selected value="{{$salebook[0]->company}}">{{$salebook[0]->company}}</option>
                                            @foreach($salebook as $item)
                                            <option value="{{$item->company}}"> {{$item->company}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div style="width: 25%;margin-right:3px">
                                        <label>Date</label>
                                        <input type="date" name="Date" value="{{$salebook[0]->date}}" id="Date" class="form-control" style="width: 100%;padding:0;height:30px" required>
                                    </div>


                                </div>

                                <!-- Add Product Detail -->
                                <div style="line-height: 0;" class="card-body">

                                    <div style="margin-left: -4px;" class="row">
                                        
                                        <div style="width: 29.5%;margin-right:3px">
                                            <label>Item Name</label>
                                            <select name="itemname" onchange="getVarientsOfSelectedItem(this.value)" id="itemname" style="width: 100%;" required class="select2">

                                            </select>
                                        </div>
                                        <div style="width: 25%;margin-right:3px">

                                            <label>Varient</label>
                                            <select name="varient" id="varient" style="width: 100%;" required class="select2">

                                            </select>
                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>Finish</label>
                                            <input name="finish" id="finish" style="width: 100%;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>S. Finish</label>
                                            <input name="sfinish" id="sfinish" style="width: 100%;" type="number" required>

                                        </div>
                                        <div style="width: 10%;margin-right:3px">
                                            <label>Damage</label>
                                            <input name="damage" id="damage" style="width: 100%;" type="number" required>

                                        </div>

                                        <button style="width: 5%;margin-left:-1px;height: 26px;margin-top: 8px;background:green;color:white;border:none" id="addRow" class="addRow">+</button>

                                    </div>


                                    <div style="margin-left: -4px;" id="whereProductsShow">
                                        @foreach($salebook_detail as $sbd)
                                        <div>
                                            
                                            <input style="width:30%" readonly value="{{$sbd->ItemName}}" type='text' name='itemname[]'>
                                            <input style="width:25%" readonly value="{{$sbd->varient}}" type='text' name='varient[]'>
                                            <input style="width:10%" value="{{$sbd->finish}}" type='text' name='finish[]' required>
                                            <input style="width:10%" value="{{$sbd->sfinish}}" type='text' name='sfinish[]' required>
                                            <input style="width:10%" value="{{$sbd->damage}}" type='text' name='damage[]' required>
                                            <button style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times;</button>
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
                                $('.addRow').on('click', function() {
                                    
                                    var itemname = document.getElementById('itemname').value;
                                    var varient = document.getElementById('varient').value;
                                    var finish = document.getElementById('finish').value;
                                    var sfinish = document.getElementById('sfinish').value;
                                    var damage = document.getElementById('damage').value;

                                    var tr =
                                        `<div>
                                      
                                        <input style="width:30%"readonly type='text'  name='itemname[]' value='${itemname} '>
                                        <input style="width:25%" readonly type='text' name='varient[]'  value='${varient}' >
                                        <input style="width:10%" type='text'  name='finish[]' value='${finish}'  >
                                        <input style="width:10%" type='text'  name='sfinish[]' value='${sfinish}'  >
                                        <input style="width:10%" type='text'  name='damage[]' value='${damage}'  >
                                         <button style="margin-left:-1.5px;width: 5%;height: 26px;margin-top: 8px;background:red;color:white;border:none" class='deleteRow'>&times;</button>
                                        </div>`;

                                    if (itemname != "" && varient != "" && quantity != "") {

                                        $('#whereProductsShow').append(tr);
                                    }

                                    $(".deleteRow").click(function() {
                                        $(this).parent().remove();
                                    });
                                    // $("#itemname").val('').trigger('change');
                                    document.getElementById('varient').value = '';
                                    document.getElementById('finish').value = '';
                                    document.getElementById('sfinish').value = '';
                                    document.getElementById('damage').value = '';
                                    document.getElementById('varient').focus();

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

                                            <select readonly name="City" id="City" class="control-form select2" style="width: 100%;">
                                                <option selected value="{{$salebook[0]->city}}">{{$salebook[0]->city}}</option>
                                                @foreach($cities as $item)
                                                <option value="{{$item->city}}"> {{$item->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="width: 100%;">
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea name="address" id="address" readonly style="width: 100%;line-height:initial" rows="3" required>
                                                {{$salebook[0]->address}}
                                                </textarea>

                                            </div>
                                        </div>

                                        <div class="row">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Zone</label>
                                                    <input id="zone"  value="{{$salebook[0]->zone}}" name="zone" style="width: 100%;" type="text" required>
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
    var company = document.getElementById('company').value;
    var token = '{{csrf_token()}}';
    $.ajax({
        url: '../getItemsOfSelectedCompany_For_dispatch',
        type: 'post',
        data: {
            company: company,
            _token: token
        },
        success: function(data) {
            let output = '<option selected readonly value="">Choose Item...</option>';
            let output2 = '<option selected readonly value="">Choose varient...</option>';
            data.forEach(el => {
                output += `
                    <option value="${el.itemname}">${el.itemname}</option>
                    `;
                output2 += `
                    <option value="${el.varient}">${el.varient}</option>
                    `;
                document.getElementById('itemname').innerHTML = output;
                document.getElementById('varient').innerHTML = output2;
            });
        },
        error: function(req, status, error) {
            console.log(error)

        }
    })


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
        var finish = document.getElementsByName('finish[]');
        var sfinish = document.getElementsByName('sfinish[]');
        var damage = document.getElementsByName('damage[]');
      
        var obj = [];
        for (var i = 0; i < itemname.length; i++) {
            var itemname1 = itemname[i].value;
            var finish1 = finish[i].value;
            var sfinish1 = sfinish[i].value;
            var damage1 = damage[i].value;
            var varient1 = varient[i].value;
            
            var obje;
            obje = {
                itemname: "",
                finish: "",
                sfinish: "",
                damage: "",
                varient: "",
                
            };
            obje.itemname = itemname1;
            obje.finish = finish1;
            obje.sfinish = sfinish1;
            obje.damage = damage1;
            obje.varient = varient1;
           
            obj.push(obje);
        }
        // console.log(obj);

        var City = document.getElementById('City').value;
        var zone = document.getElementById('zone').value;
      
        var Remarks = document.getElementById('Remarks').value;

       
            var token = '{{csrf_token()}}';
            $.ajax({
                type: "post",
                url: "../update_stockReturn",
                data: {

                    obj: obj,
                    Date: document.getElementById('Date').value,
                    City: document.getElementById('City').value,
                
                    zone: document.getElementById('zone').value,
                    company: document.getElementById('company').value,
                    supplier: document.getElementById('supplier').value,
                    address: document.getElementById('address').value,
                  
                    Remarks: document.getElementById('Remarks').value,
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


            $("#company").val('').trigger('change');
            $("#itemname").val('').trigger('change');
            $("#varient").val('').trigger('change');
            $("#quantity").val('').trigger('change');
            $("#City").val('').trigger('change');
            document.getElementById('address').value = '';
            document.getElementById('zone').value = '';
         
            
            document.getElementById('Remarks').value = '';
            $("#whereProductsShow tr").remove();
            $("#supplier").val('').trigger('change');

        

    }


    function getVarientsOfSelectedItem(ItemName) {
        alert(ItemName)
        var token = '{{csrf_token()}}';
        $.ajax({
            url: '../getVarientsOfSelectedItem_For_dispatch',
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